<!-- Job Management Section -->
<div class="mt-8 pt-8 border-t border-slate-200">
    <h3 class="text-xl font-bold text-slate-800 mb-6">Lowongan Pekerjaan Saya</h3>

    <!-- Pending Jobs Section -->
    @if($pendingJobs->count() > 0)
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-clock text-amber-500 text-lg"></i>
                <h4 class="text-lg font-bold text-slate-800">Menunggu Persetujuan ({{ $pendingJobs->count() }})</h4>
            </div>
            
            <div class="space-y-3">
                @foreach($pendingJobs as $job)
                    <div class="border border-amber-200 rounded-lg p-4 bg-amber-50 hover:bg-amber-100 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h5 class="font-bold text-slate-800">{{ $job->judul }}</h5>
                                <p class="text-sm text-slate-600 mt-1">
                                    <i class="fas fa-building"></i> {{ $job->perusahaan }}
                                </p>
                                <div class="flex items-center gap-4 mt-2 text-xs text-slate-500">
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $job->lokasi }}</span>
                                    <span><i class="fas fa-briefcase"></i> {{ ucfirst(str_replace('_', ' ', $job->tipe_pekerjaan)) }}</span>
                                    <span><i class="fas fa-calendar"></i> {{ $job->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="text-xs text-amber-700 mt-2 font-semibold">
                                    <i class="fas fa-exclamation-circle"></i> Sedang menjalani proses persetujuan admin
                                </p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="inline-block px-3 py-1 bg-amber-500 text-white text-xs font-semibold rounded-full text-center">
                                    Pending
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Approved Jobs Section -->
    @if($approvedJobs->count() > 0)
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-check-circle text-green-500 text-lg"></i>
                <h4 class="text-lg font-bold text-slate-800">Lowongan Disetujui ({{ $approvedJobs->count() }})</h4>
            </div>
            
            <div class="space-y-3">
                @foreach($approvedJobs as $job)
                    <div class="border border-green-200 rounded-lg p-4 bg-green-50 hover:bg-green-100 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h5 class="font-bold text-slate-800">{{ $job->judul }}</h5>
                                <p class="text-sm text-slate-600 mt-1">
                                    <i class="fas fa-building"></i> {{ $job->perusahaan }}
                                </p>
                                <div class="flex items-center gap-4 mt-2 text-xs text-slate-500">
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $job->lokasi }}</span>
                                    <span><i class="fas fa-briefcase"></i> {{ ucfirst(str_replace('_', ' ', $job->tipe_pekerjaan)) }}</span>
                                    <span><i class="fas fa-calendar"></i> {{ $job->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="text-xs text-green-700 mt-2 font-semibold">
                                    <i class="fas fa-check"></i> Sudah dipublikasikan dan dapat dilihat oleh semua pengguna
                                </p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="inline-block px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full text-center">
                                    Disetujui
                                </span>
                                <a href="{{ route('jobs.show', $job->id) }}" class="px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded text-center hover:bg-indigo-700 transition">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Empty State -->
    @if($pendingJobs->count() === 0 && $approvedJobs->count() === 0)
        <div class="rounded-lg border border-slate-200 p-8 text-center bg-slate-50">
            <i class="fas fa-briefcase text-5xl text-slate-300 mb-3"></i>
            <p class="text-slate-600 mb-4">Anda belum mengunggah lowongan pekerjaan apapun</p>
            <p class="text-sm text-slate-500 mb-4">Mulai upload lowongan pekerjaan dengan mengisi form di atas</p>
            <a href="#upload-section" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                <i class="fas fa-plus-circle"></i> Upload Sekarang
            </a>
        </div>
    @endif
</div>
