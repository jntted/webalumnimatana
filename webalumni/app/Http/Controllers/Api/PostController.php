<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of all posts
     */
    public function index()
    {
        $posts = Post::with('user', 'comments.user', 'likes')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video' => 'nullable|file|mimes:mp4,avi,mov|max:51200',
        ]);

        // Pastikan minimal ada content atau media
        if (empty($validated['content']) && !$request->hasFile('image') && !$request->hasFile('video')) {
            return response()->json([
                'success' => false,
                'message' => 'Post harus memiliki konten, gambar, atau video',
            ], 422);
        }

        $post = new Post();
        // Check session auth first (web guard), then sanctum, then guest (id: 2)
        $user = auth('web')->user() ?? auth('sanctum')->user();
        $post->user_id = $user ? $user->id : 2;
        $post->content = $validated['content'] ?? null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts/images', 'public');
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('posts/videos', 'public');
        }

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat',
            'data' => $post->load('user'),
        ], 201);
    }

    /**
     * Display the specified post with its comments
     */
    public function show(string $id)
    {
        $post = Post::with('user', 'comments.user', 'likes')
                   ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        // Pastikan user adalah pemilik post
        if ($post->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah post ini',
            ], 403);
        }

        $validated = $request->validate([
            'content' => 'nullable|string',
        ]);

        $post->content = $validated['content'] ?? $post->content;
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diperbarui',
            'data' => $post->load('user'),
        ]);
    }

    /**
     * Delete the specified post
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Pastikan user adalah pemilik post
        if ($post->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus post ini',
            ], 403);
        }

        // Hapus file media jika ada
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        if ($post->video) {
            Storage::disk('public')->delete($post->video);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus',
        ]);
    }

    /**
     * Like/Unlike a post
     */
    public function toggleLike(string $id)
    {
        $post = Post::findOrFail($id);
        // Check session auth first (web guard), then sanctum
        $user = auth('web')->user() ?? auth('sanctum')->user();

        // Allow guest to like (just return success without saving)
        if (!$user) {
            return response()->json([
                'success' => true,
                'message' => 'Post di-like',
                'liked' => false,
                'likes_count' => $post->likes_count + 1,
            ]);
        }

        if ($user->likedPosts()->where('post_id', $id)->exists()) {
            // Unlike
            $user->likedPosts()->detach($id);
            $post->decrement('likes_count');
        } else {
            // Like
            $user->likedPosts()->attach($id);
            $post->increment('likes_count');
        }

        return response()->json([
            'success' => true,
            'message' => $user->likedPosts()->where('post_id', $id)->exists() ? 'Post di-like' : 'Like dihapus',
            'liked' => $user->likedPosts()->where('post_id', $id)->exists(),
            'likes_count' => $post->fresh()->likes_count,
        ]);
    }
}
