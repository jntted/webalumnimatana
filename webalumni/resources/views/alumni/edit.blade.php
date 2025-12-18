@extends('layout.layout_login')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 flex items-center justify-center">
    <div class="max-w-3xl mx-auto w-full">
        <!-- Header dengan Back Button -->
        <div class="mb-8">
            <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium transition">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Section dengan Gradient -->
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-8 py-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-edit text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Data Alumni</h2>
                        <p class="text-indigo-100 text-sm">Perbarui informasi profil Anda</p>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                        <div class="flex gap-3">
                            <i class="fas fa-check-circle text-green-600 mt-1"></i>
                            <div>
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                        <div class="flex gap-3">
                            <i class="fas fa-exclamation-circle text-red-600 mt-1"></i>
                            <div class="flex-1">
                                <h3 class="font-semibold text-red-900 mb-2">Terjadi Kesalahan!</h3>
                                <ul class="text-sm text-red-700 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('alumni.update', $alumni->user_id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: Data Akademik -->
                    <div class="border border-slate-200 rounded-lg p-6 bg-slate-50">
                        <div class="flex items-center gap-2 mb-4 pb-4 border-b border-slate-200">
                            <span class="inline-block w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full text-center text-sm font-bold">1</span>
                            <h3 class="text-lg font-bold text-slate-900">Data Akademik</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIM -->
                            <div>
                                <label for="nim" class="block text-sm font-semibold text-slate-900 mb-2">NIM <span class="text-red-500">*</span></label>
                                <input type="text" 
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('nim') border-red-500 @enderror" 
                                    id="nim" name="nim" value="{{ old('nim', $alumni->nim) }}" required>
                                @error('nim')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>

                            <!-- Tahun Lulus -->
                            <div>
                                <label for="graduation_year" class="block text-sm font-semibold text-slate-900 mb-2">Tahun Lulus <span class="text-red-500">*</span></label>
                                <input type="number" 
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('graduation_year') border-red-500 @enderror" 
                                    id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $alumni->graduation_year) }}" min="2000" max="{{ date('Y') }}" required>
                                @error('graduation_year')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>

                            <!-- Program Studi -->
                            <div class="md:col-span-2">
                                <label for="major" class="block text-sm font-semibold text-slate-900 mb-2">Program Studi <span class="text-red-500">*</span></label>
                                <input type="text" 
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('major') border-red-500 @enderror" 
                                    id="major" name="major" value="{{ old('major', $alumni->major) }}" required>
                                @error('major')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Data Pekerjaan -->
                    <div class="border border-slate-200 rounded-lg p-6 bg-slate-50">
                        <div class="flex items-center gap-2 mb-4 pb-4 border-b border-slate-200">
                            <span class="inline-block w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full text-center text-sm font-bold">2</span>
                            <h3 class="text-lg font-bold text-slate-900">Data Pekerjaan</h3>
                        </div>

                        <div class="space-y-6">
                            <!-- Status Pekerjaan -->
                            <div class="md:col-span-2">
                                <label for="current_job" class="block text-sm font-semibold text-slate-900 mb-2">Status Pekerjaan <span class="text-red-500">*</span></label>
                                <select class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('current_job') border-red-500 @enderror" 
                                    id="current_job" name="current_job" required onchange="toggleJobFields()">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="bekerja" {{ old('current_job', $alumni->current_job) === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                                    <option value="tidak_bekerja" {{ old('current_job', $alumni->current_job) === 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="melanjutkan_studi" {{ old('current_job', $alumni->current_job) === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                </select>
                                @error('current_job')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>

                            <!-- Nama Perusahaan -->
                            <div id="company_name_div" style="display: {{ $alumni->current_job === 'bekerja' ? 'block' : 'none' }};">
                                <label for="company_name" class="block text-sm font-semibold text-slate-900 mb-2">Nama Perusahaan</label>
                                <input type="text" 
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('company_name') border-red-500 @enderror" 
                                    id="company_name" name="company_name" value="{{ old('company_name', $alumni->company_name) }}" placeholder="Nama perusahaan tempat Anda bekerja">
                                @error('company_name')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>

                            <!-- Posisi Pekerjaan -->
                            <div id="job_position_div" style="display: {{ $alumni->current_job === 'bekerja' ? 'block' : 'none' }};">
                                <label for="job_position" class="block text-sm font-semibold text-slate-900 mb-2">Posisi / Jabatan</label>
                                <input type="text" 
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('job_position') border-red-500 @enderror" 
                                    id="job_position" name="job_position" value="{{ old('job_position', $alumni->job_position) }}" placeholder="Posisi atau jabatan Anda">
                                @error('job_position')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-slate-900 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                                <div class="flex gap-2">
                                    <span class="inline-flex items-center px-3 py-3 bg-slate-100 border border-slate-300 rounded-lg text-slate-600">+62</span>
                                    <input type="text" 
                                        class="flex-1 px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('phone') border-red-500 @enderror" 
                                        id="phone" name="phone" value="{{ old('phone', $alumni->phone) }}" placeholder="8xx xxxx xxxx" required>
                                </div>
                                @error('phone')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>

                            <!-- Rentang Gaji -->
                            <div>
                                <label for="salary_range" class="block text-sm font-semibold text-slate-900 mb-2">Rentang Gaji</label>
                                <input type="text" 
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('salary_range') border-red-500 @enderror" 
                                    id="salary_range" name="salary_range" value="{{ old('salary_range', $alumni->salary_range) }}" placeholder="Contoh: 5-10 juta">
                                @error('salary_range')<p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('profil') }}" class="flex-1 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold rounded-lg transition text-center">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-semibold rounded-lg transition">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleJobFields() {
    const status = document.getElementById('current_job').value;
    const companyDiv = document.getElementById('company_name_div');
    const positionDiv = document.getElementById('job_position_div');
    
    if (status === 'bekerja') {
        companyDiv.style.display = 'block';
        positionDiv.style.display = 'block';
    } else {
        companyDiv.style.display = 'none';
        positionDiv.style.display = 'none';
    }
}
</script>
@endsection
