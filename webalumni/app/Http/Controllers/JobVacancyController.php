<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    /**
     * Public - Tampilkan daftar lowongan approved
     */
    public function index(Request $request)
    {
        $query = JobVacancy::where('status', 'approved')
            ->with('postedBy')
            ->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('tipe')) {
            $query->where('tipe_pekerjaan', $request->tipe);
        }

        // Filter by location
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        $jobs = $query->paginate(12);
        $locations = JobVacancy::where('status', 'approved')
            ->distinct()
            ->pluck('lokasi');

        return view('job_vacancies.index', compact('jobs', 'locations'));
    }

    /**
     * Show single job detail
     */
    public function show($id)
    {
        $job = JobVacancy::where('status', 'approved')
            ->with('postedBy')
            ->findOrFail($id);

        return view('job_vacancies.show', compact('job'));
    }

    /**
     * Alumni/Teacher/Admin - Show create form
     */
    public function create()
    {
        return view('job_vacancies.create');
    }

    /**
     * Alumni/Teacher/Admin - Store new job
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perusahaan' => 'required|string|max:150',
            'tipe_pekerjaan' => 'required|in:full_time,part_time,internship,contract,freelance',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'kontak_email' => 'required|email|max:100',
            'kontak_phone' => 'nullable|string|max:20',
        ]);

        $job = JobVacancy::create([
            'judul' => $validated['judul'],
            'perusahaan' => $validated['perusahaan'],
            'tipe_pekerjaan' => $validated['tipe_pekerjaan'],
            'lokasi' => $validated['lokasi'],
            'deskripsi' => $validated['deskripsi'],
            'persyaratan' => $validated['persyaratan'] ?? null,
            'gaji_min' => $validated['gaji_min'] ?? null,
            'gaji_max' => $validated['gaji_max'] ?? null,
            'kontak_email' => $validated['kontak_email'],
            'kontak_phone' => $validated['kontak_phone'] ?? null,
            'posted_by' => Auth::id(),
            'status' => 'pending' // Semua loker pending dulu
        ]);

        return redirect()->route('jobs.my-jobs')
            ->with('success', 'Lowongan berhasil d  iposting dan menunggu persetujuan!');
    }

    /**
     * Alumni - Show edit form (hanya yang posting atau admin/teacher)
     */
    public function edit($id)
    {
        if (in_array(Auth::user()->role, ['admin', 'teacher'])) {
            $job = JobVacancy::findOrFail($id);
        } else {
            $job = JobVacancy::where('posted_by', Auth::id())->findOrFail($id);
        }
        
        return view('job_vacancies.edit', compact('job'));
    }

    /**
     * Alumni - Update job
     */
    public function update(Request $request, $id)
    {
        if (in_array(Auth::user()->role, ['admin', 'teacher'])) {
            $job = JobVacancy::findOrFail($id);
        } else {
            $job = JobVacancy::where('posted_by', Auth::id())->findOrFail($id);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perusahaan' => 'required|string|max:150',
            'tipe_pekerjaan' => 'required|in:full_time,part_time,internship,contract,freelance',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'kontak_email' => 'required|email|max:100',
            'kontak_phone' => 'nullable|string|max:20',
        ]);

        // If approved job is edited by alumni, reset to pending
        $wasApproved = $job->status === 'approved';
        $isAdmin = in_array(Auth::user()->role, ['admin', 'teacher']);
        $newStatus = ($wasApproved && !$isAdmin) ? 'pending' : $job->status;

        $job->update([
            'judul' => $validated['judul'],
            'perusahaan' => $validated['perusahaan'],
            'tipe_pekerjaan' => $validated['tipe_pekerjaan'],
            'lokasi' => $validated['lokasi'],
            'deskripsi' => $validated['deskripsi'],
            'persyaratan' => $validated['persyaratan'] ?? null,
            'gaji_min' => $validated['gaji_min'] ?? null,
            'gaji_max' => $validated['gaji_max'] ?? null,
            'kontak_email' => $validated['kontak_email'],
            'kontak_phone' => $validated['kontak_phone'] ?? null,
            'status' => $newStatus
        ]);

        $message = ($wasApproved && !$isAdmin)
            ? 'Lowongan berhasil diupdate! Status dikembalikan ke "Pending" untuk review ulang.'
            : 'Lowongan berhasil diupdate!';

        return redirect()->route('jobs.my')->with('success', $message);
    }

    /**
     * Alumni/Admin - Delete job
     */
    public function destroy($id)
    {
        if (in_array(Auth::user()->role, ['admin', 'teacher'])) {
            // Admin/Teacher can delete any job
            $job = JobVacancy::findOrFail($id);
        } else {
            // Alumni can only delete their own jobs
            $job = JobVacancy::where('posted_by', Auth::id())->findOrFail($id);
        }

        $job->delete();

        return back()->with('success', 'Lowongan berhasil dihapus!');
    }

    /**
     * Alumni - My jobs dashboard
     */
    public function myJobs()
    {
        $jobs = JobVacancy::where('posted_by', Auth::id())
            ->latest()
            ->get();

        $stats = [
            'total' => $jobs->count(),
            'pending' => $jobs->where('status', 'pending')->count(),
            'approved' => $jobs->where('status', 'approved')->count(),
            'rejected' => $jobs->where('status', 'rejected')->count(),
        ];

        return view('job_vacancies.my-jobs', compact('jobs', 'stats'));
    }

    /**
     * Admin/Teacher - Dashboard
     */
    public function adminIndex(Request $request)
    {
        $filter = $request->get('filter', 'pending');

        $query = JobVacancy::with('postedBy')->latest();

        if ($filter !== 'all') {
            $query->where('status', $filter);
        }

        $jobs = $query->get();

        $stats = [
            'total' => JobVacancy::count(),
            'pending' => JobVacancy::where('status', 'pending')->count(),
            'approved' => JobVacancy::where('status', 'approved')->count(),
            'rejected' => JobVacancy::where('status', 'rejected')->count(),
        ];

        return view('job_vacancies.admin', compact('jobs', 'stats', 'filter'));
    }

    /**
     * Admin/Teacher - Approve job
     */
    public function approve($id)
    {
        $job = JobVacancy::findOrFail($id);
        
        $job->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        return back()->with('success', 'Lowongan berhasil disetujui!');
    }

    /**
     * Admin/Teacher - Reject job
     */
    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'rejection_note' => 'required|string|max:500',
        ]);

        $job = JobVacancy::findOrFail($id);
        
        $job->update([
            'status' => 'rejected',
            'rejection_note' => $validated['rejection_note']
        ]);

        return back()->with('success', 'Lowongan berhasil ditolak!');
    }
}