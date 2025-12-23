@extends('layout.layout_profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-slate-800 mb-8">Profil Saya</h2>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800">{{ session('error') }}</div>
    @endif

    <!-- Tracer Study Alert for Alumni -->
    @if($user->role === 'alumni')
        @php
            $tracerStudy = $data && $data->tracerStudy ? $data->tracerStudy : null;
        @endphp
        @if(!$tracerStudy)
            <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-exclamation-circle text-amber-600 text-lg"></i>
                            <strong class="text-amber-900">Penting!</strong>
                        </div>
                        <p class="text-sm text-amber-800 mb-0">Anda belum mengisi Tracer Study. Tracer Study adalah survei wajib untuk melacak perkembangan karir Anda sebagai alumni. Silahkan isi sekarang.</p>
                    </div>
                    <a href="{{ route('tracer.form') }}" class="flex-shrink-0 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-plus-circle"></i> Isi Tracer Study
                    </a>
                </div>
            </div>
        @endif
    @endif

    <!-- Profile Picture Section -->
    <div class="text-center mb-8">
        <div class="mb-4">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}"
                    class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-indigo-200">
            @else
                <div class="w-24 h-24 rounded-full mx-auto bg-slate-300 flex items-center justify-center">
                    <i class="fas fa-user text-4xl text-slate-600"></i>
                </div>
            @endif
        </div>

        @if($user->data_completed)
            <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" class="inline">
                @csrf
                <label class="cursor-pointer">
                    <span class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 text-sm">
                        Ubah Foto
                    </span>
                    <input type="file" name="profile_picture" accept="image/*" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        @endif
    </div>

    <!-- User Basic Info -->
    <div class="space-y-4 mb-8">
        <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
            <p class="text-sm text-slate-500">Nama</p>
            <p class="text-lg font-semibold text-slate-800">{{ $user->name }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
            <p class="text-sm text-slate-500">Email</p>
            <p class="text-lg font-semibold text-slate-800">{{ $user->email }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-4 bg-slate-50">
            <p class="text-sm text-slate-500">Status</p>
            <p class="text-lg font-semibold text-slate-800">
                @switch($user->role)
                    @case('alumni')
                        Alumni
                        @break
                    @case('student')
                        Mahasiswa Aktif
                        @break
                @endswitch
            </p>
        </div>
    </div>

    <!-- Role-based Data Display -->
    @if($data)
        <div class="border-t border-slate-200 pt-8 mt-8">
            <h3 class="text-xl font-bold text-slate-800 mb-6">
                @switch($user->role)
                    @case('alumni')
                        Data Alumni
                        @break
                    @case('student')
                        Data Akademik
                        @break
                @endswitch
            </h3>

            <div class="space-y-4">
                @switch($user->role)
                    @case('alumni')
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-slate-800">Data Alumni</h4>
                            <a href="{{ route('alumni.edit', $data->user_id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">NIM</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->nim }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Program Studi</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->major }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Tahun Lulus</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->graduation_year }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Status Pekerjaan</p>
                            <p class="text-lg font-semibold text-slate-800">
                                @switch($data->current_job)
                                    @case('bekerja')
                                        Bekerja
                                        @break
                                    @case('tidak_bekerja')
                                        Tidak Bekerja
                                        @break
                                    @case('melanjutkan_studi')
                                        Melanjutkan Studi
                                        @break
                                @endswitch
                            </p>
                        </div>
                        @if($data->current_job === 'bekerja')
                            <div class="rounded-lg border border-slate-200 p-4">
                                <p class="text-sm text-slate-500">Perusahaan</p>
                                <p class="text-lg font-semibold text-slate-800">{{ $data->company_name }}</p>
                            </div>
                            <div class="rounded-lg border border-slate-200 p-4">
                                <p class="text-sm text-slate-500">Posisi</p>
                                <p class="text-lg font-semibold text-slate-800">{{ $data->job_position }}</p>
                            </div>
                        @endif
                        
                        <!-- Tracer Study Data Section -->
                        @php
                            $tracerStudy = $data && $data->tracerStudy ? $data->tracerStudy : null;
                        @endphp
                        @if($tracerStudy)
                            <div class="mt-8 border-t border-slate-200 pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-lg font-bold text-slate-800">
                                        <i class="fas fa-chart-line"></i> Data Tracer Study
                                    </h4>
                                    <a href="{{ route('tracer.form') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                                
                                <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 mb-4">
                                    <p class="text-sm text-blue-600">Tanggal Survei</p>
                                    <p class="text-lg font-semibold text-blue-900">{{ $tracerStudy->survey_date->format('d F Y') }}</p>
                                </div>

                                <div class="space-y-4">
                                    <!-- Status Pekerjaan -->
                                    <div class="rounded-lg border border-slate-200 p-4">
                                        <p class="text-sm text-slate-500">Status Pekerjaan</p>
                                        <p class="text-lg font-semibold text-slate-800">
                                            @switch($tracerStudy->status)
                                                @case('bekerja_full_time')
                                                    Bekerja Full Time
                                                    @break
                                                @case('bekerja_part_time')
                                                    Bekerja Part Time
                                                    @break
                                                @case('wiraswasta')
                                                    Wiraswasta
                                                    @break
                                                @case('lanjut_pendidikan')
                                                    Lanjut Pendidikan
                                                    @break
                                                @case('tidak_kerja_sedang_cari')
                                                    Tidak Bekerja (Sedang Cari)
                                                    @break
                                                @case('belum_memungkinkan_kerja')
                                                    Belum Memungkinkan Bekerja
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>

                                    <!-- Perusahaan (jika bekerja) -->
                                    @if($tracerStudy->current_company)
                                        <div class="rounded-lg border border-slate-200 p-4">
                                            <p class="text-sm text-slate-500">Perusahaan / Institusi</p>
                                            <p class="text-lg font-semibold text-slate-800">{{ $tracerStudy->current_company }}</p>
                                        </div>
                                    @endif

                                    <!-- Posisi (jika bekerja) -->
                                    @if($tracerStudy->current_position)
                                        <div class="rounded-lg border border-slate-200 p-4">
                                            <p class="text-sm text-slate-500">Posisi / Jabatan</p>
                                            <p class="text-lg font-semibold text-slate-800">{{ $tracerStudy->current_position }}</p>
                                        </div>
                                    @endif

                                    <!-- Sumber Pendanaan -->
                                    <div class="rounded-lg border border-slate-200 p-4">
                                        <p class="text-sm text-slate-500">Sumber Pendanaan</p>
                                        <p class="text-lg font-semibold text-slate-800">
                                            @switch($tracerStudy->funding_source)
                                                @case('biaya_sendiri')
                                                    Biaya Sendiri
                                                    @break
                                                @case('beasiswa_adik')
                                                    Beasiswa ADIK
                                                    @break
                                                @case('beasiswa_bidikmisi')
                                                    Beasiswa Bidikmisi
                                                    @break
                                                @case('beasiswa_ppa')
                                                    Beasiswa PPA
                                                    @break
                                                @case('beasiswa_afirmasi')
                                                    Beasiswa Afirmasi
                                                    @break
                                                @case('beasiswa_swasta')
                                                    Beasiswa Swasta
                                                    @break
                                                @case('lainnya')
                                                    Lainnya
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>

                                    <!-- Rating Scales -->
                                    <div class="rounded-lg border border-purple-200 bg-purple-50 p-4">
                                        <h5 class="font-bold text-purple-900 mb-3">Penilaian Kualitas Pembelajaran</h5>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Perkuliahan & Metode Pengajaran</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f21_perkuliahan ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Demonstrasi / Praktik Langsung</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f22_demonstrasi ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Riset dan Project-Based Learning</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f23_riset_project ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Program Magang & Pengalaman Kerja</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f24_magang ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Praktikum dan Laboratorium</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f25_praktikum ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Kerja Lapangan dan Study Tour</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f26_kerja_lapangan ?? '-' }}/5</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-purple-700">Diskusi dan Interaksi Akademik</span>
                                                <span class="font-semibold text-purple-900">{{ $tracerStudy->f27_diskusi ?? '-' }}/5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('tracer.form') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-semibold">
                                        <i class="fas fa-edit"></i> Edit Tracer Study
                                    </a>
                                </div>
                            </div>
                        @endif
                        @break
                    
                    @case('student')
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-slate-800">Data Akademik</h4>
                            <a href="{{ route('student.edit', $user->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 text-sm font-semibold">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>

                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">NIM</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->nim }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Program Studi</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->major }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Semester</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->semester }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Nomor Telepon</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->phone }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Alamat</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->address }}</p>
                        </div>
                        @break
                @endswitch
            </div>
        </div>
    @endif

    <!-- Job Management Section for Alumni -->
    @if($user->role === 'alumni')
        <div class="border-t border-slate-200 pt-8 mt-8">
            <h3 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                <i class="fas fa-briefcase text-indigo-600"></i>
                Kelola Lowongan Pekerjaan
            </h3>

            <!-- Main Grid: Left = Form, Right = Status -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Left: Upload Form (2 columns) -->
                <div class="lg:col-span-2">
                    @include('user.job-upload')
                </div>

                <!-- Right: Status Overview (1 column) -->
                <div class="lg:col-span-1">
                    <!-- Status Cards (Sticky) -->
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
            <div class="border-t border-slate-200 my-12"></div>

            <!-- Lowongan Sections -->
            <div class="space-y-8">
                <!-- Pending Lowongan Section -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-clock text-amber-500 text-2xl"></i>
                        <h4 class="text-2xl font-bold text-slate-800">Menunggu Persetujuan</h4>
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
                                            <h5 class="text-lg font-bold text-slate-900 mb-2">{{ $job->judul }}</h5>
                                            
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
                                            <p class="text-slate-600 text-sm mb-4">
                                                {{ substr($job->deskripsi, 0, 150) }}{{ strlen($job->deskripsi) > 150 ? '...' : '' }}
                                            </p>

                                            <!-- Warning -->
                                            <div class="bg-amber-50 border border-amber-100 rounded p-3 text-xs text-amber-700">
                                                <i class="fas fa-exclamation-triangle"></i> Sedang dalam proses review admin. Lowongan tidak akan tampil di halaman publik sampai disetujui.
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex flex-col gap-2 flex-shrink-0">
                                            <a href="{{ route('jobs.show', $job->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-700 transition text-center whitespace-nowrap">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="{{ route('jobs.edit', $job->id) }}" class="px-3 py-2 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition text-center whitespace-nowrap">
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
                        </div>
                    @endif
                </div>

                <!-- Divider -->
                <div class="border-t border-slate-200"></div>

                <!-- Approved Lowongan Section -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        <h4 class="text-2xl font-bold text-slate-800">Lowongan Aktif</h4>
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
                                            <h5 class="text-lg font-bold text-slate-900 mb-2">{{ $job->judul }}</h5>
                                            
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
                                            <p class="text-slate-600 text-sm mb-4">
                                                {{ substr($job->deskripsi, 0, 150) }}{{ strlen($job->deskripsi) > 150 ? '...' : '' }}
                                            </p>

                                            <!-- Success Message -->
                                            <div class="bg-green-50 border border-green-100 rounded p-3 text-xs text-green-700">
                                                <i class="fas fa-check"></i> Lowongan aktif dan dapat dilihat oleh semua pengguna di halaman publik.
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex flex-col gap-2 flex-shrink-0">
                                            <a href="{{ route('jobs.show', $job->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-700 transition text-center whitespace-nowrap">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="{{ route('jobs.edit', $job->id) }}" class="px-3 py-2 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition text-center whitespace-nowrap">
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex items-center justify-between mt-8 pt-8 border-t border-slate-200">
        <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:text-indigo-500">← Kembali ke Beranda</a>
        <a href="{{ url('/logout') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-500">Logout</a>
    </div>
</div>

@endsection
