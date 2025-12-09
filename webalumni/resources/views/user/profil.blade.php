@extends('layout.layout_login')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-slate-800 mb-8">Profil Saya</h2>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800">{{ session('error') }}</div>
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
                    @case('teacher')
                        Dosen
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
                    @case('teacher')
                        Data Akademik
                        @break
                @endswitch
            </h3>

            <div class="space-y-4">
                @switch($user->role)
                    @case('alumni')
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
                        @break
                    
                    @case('student')
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
                        @break
                    
                    @case('teacher')
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">NIP</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->nip }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Departemen</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->department }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-4">
                            <p class="text-sm text-slate-500">Keahlian</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $data->specialization }}</p>
                        </div>
                        @break
                @endswitch
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex items-center justify-between mt-8 pt-8 border-t border-slate-200">
        <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:text-indigo-500">← Kembali ke Beranda</a>
        <a href="{{ url('/logout') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-500">Logout</a>
    </div>
</div>

@include('layout.footer')
@endsection
