@extends('layout.layout_login')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('profil') }}" class="text-indigo-600 hover:text-indigo-500">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>
        </div>
        <h1 class="text-4xl font-bold text-slate-800">Kelola Lowongan Pekerjaan</h1>
        <p class="text-slate-600 mt-2">Upload dan kelola semua lowongan pekerjaan Anda di sini</p>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Main Grid: Left = Form, Right = Status -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Upload Form (2 columns) -->
        <div class="lg:col-span-2">
            @include('user.job-upload')
        </div>

        <!-- Right: Status Overview (1 column) -->
        <div class="lg:col-span-1">
            <!-- Status Cards -->
            <div class="sticky top-8 space-y-4">
                <!-- Pending Count -->
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-amber-600">{{ $pendingJobs->count() }}</div>
                        <p class="text-sm text-amber-700 font-semibold mt-1">Menunggu Persetujuan</p>
                        <p class="text-xs text-amber-600 mt-2">Sedang di-review admin</p>
                    </div>
                </div>

                <!-- Approved Count -->
                <div class="rounded-lg border border-green-200 bg-green-50 p-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $approvedJobs->count() }}</div>
                        <p class="text-sm text-green-700 font-semibold mt-1">Lowongan Aktif</p>
                        <p class="text-xs text-green-600 mt-2">Sudah dipublikasikan</p>
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
                    <div class="flex gap-3">
                        <i class="fas fa-info-circle text-blue-600 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <p class="text-xs font-semibold text-blue-900">Tips</p>
                            <p class="text-xs text-blue-700 mt-1">Lengkapi form dengan detail untuk mempercepat approval admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-12 border-t border-slate-200"></div>

    <!-- Lowongan Sections -->
    <div class="space-y-8">
        <!-- Pending Lowongan Section -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <i class="fas fa-clock text-amber-500 text-2xl"></i>
                <h2 class="text-2xl font-bold text-slate-800">Menunggu Persetujuan</h2>
                <span class="ml-auto inline-block px-3 py-1 bg-amber-100 text-amber-800 text-sm font-semibold rounded-full">
                    {{ $pendingJobs->count() }}
                </span>
            </div>

            @if($pendingJobs->count() > 0)
                <div class="space-y-4">
                    @foreach($pendingJobs as $job)
                        <div class="rounded-lg border-2 border-amber-200 bg-white p-6 hover:shadow-lg transition">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <!-- Status Badge -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="inline-block px-3 py-1 bg-amber-500 text-white text-xs font-bold rounded-full">
                                            ⏳ PENDING
                                        </span>
                                        <span class="text-xs text-slate-500">{{ $job->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Job Details -->
                                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $job->judul }}</h3>
                                    
                                    <div class="space-y-2 mb-4">
                                        <p class="text-slate-700">
                                            <i class="fas fa-building text-slate-500 w-5"></i>
                                            <strong>{{ $job->perusahaan }}</strong>
                                        </p>
                                        <p class="text-slate-600">
                                            <i class="fas fa-map-marker-alt text-slate-500 w-5"></i>
                                            {{ $job->lokasi }}
                                        </p>
                                        <p class="text-slate-600">
                                            <i class="fas fa-briefcase text-slate-500 w-5"></i>
                                            {{ ucfirst(str_replace('_', ' ', $job->tipe_pekerjaan)) }}
                                        </p>
                                    </div>

                                    <!-- Description Preview -->
                                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                        {{ substr($job->deskripsi, 0, 150) }}{{ strlen($job->deskripsi) > 150 ? '...' : '' }}
                                    </p>

                                    <!-- Warning -->
                                    <div class="bg-amber-50 border border-amber-100 rounded p-3 text-xs text-amber-700">
                                        <i class="fas fa-exclamation-triangle"></i> Sedang dalam proses review admin. Lowongan tidak akan tampil di halaman publik sampai disetujui.
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-700 transition text-center">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="px-3 py-2 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition text-center">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus lowongan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-lg border border-slate-200 p-8 text-center bg-slate-50">
                    <i class="fas fa-inbox text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-600">Tidak ada lowongan yang menunggu persetujuan</p>
                    <p class="text-sm text-slate-500 mt-2">Lowongan baru yang Anda upload akan muncul di sini</p>
                </div>
            @endif
        </div>

        <!-- Divider -->
        <div class="border-t border-slate-200"></div>

        <!-- Approved Lowongan Section -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                <h2 class="text-2xl font-bold text-slate-800">Lowongan Aktif</h2>
                <span class="ml-auto inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                    {{ $approvedJobs->count() }}
                </span>
            </div>

            @if($approvedJobs->count() > 0)
                <div class="space-y-4">
                    @foreach($approvedJobs as $job)
                        <div class="rounded-lg border-2 border-green-200 bg-white p-6 hover:shadow-lg transition">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <!-- Status Badge -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="inline-block px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full">
                                            ✓ AKTIF
                                        </span>
                                        <span class="text-xs text-slate-500">{{ $job->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Job Details -->
                                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $job->judul }}</h3>
                                    
                                    <div class="space-y-2 mb-4">
                                        <p class="text-slate-700">
                                            <i class="fas fa-building text-slate-500 w-5"></i>
                                            <strong>{{ $job->perusahaan }}</strong>
                                        </p>
                                        <p class="text-slate-600">
                                            <i class="fas fa-map-marker-alt text-slate-500 w-5"></i>
                                            {{ $job->lokasi }}
                                        </p>
                                        <p class="text-slate-600">
                                            <i class="fas fa-briefcase text-slate-500 w-5"></i>
                                            {{ ucfirst(str_replace('_', ' ', $job->tipe_pekerjaan)) }}
                                        </p>
                                        @if($job->gaji_min || $job->gaji_max)
                                            <p class="text-slate-600">
                                                <i class="fas fa-money-bill text-slate-500 w-5"></i>
                                                {{ $job->formatted_gaji }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Description Preview -->
                                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                        {{ substr($job->deskripsi, 0, 150) }}{{ strlen($job->deskripsi) > 150 ? '...' : '' }}
                                    </p>

                                    <!-- Success Message -->
                                    <div class="bg-green-50 border border-green-100 rounded p-3 text-xs text-green-700">
                                        <i class="fas fa-check"></i> Lowongan aktif dan dapat dilihat oleh semua pengguna di halaman publik.
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-700 transition text-center">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="px-3 py-2 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition text-center">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus lowongan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-lg border border-slate-200 p-8 text-center bg-slate-50">
                    <i class="fas fa-inbox text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-600">Belum ada lowongan yang disetujui</p>
                    <p class="text-sm text-slate-500 mt-2">Lowongan Anda akan muncul di sini setelah disetujui admin</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-12 pt-8 border-t border-slate-200">
        <div class="text-center">
            <a href="{{ route('profil') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
