@extends('layout.layout_login')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-center text-slate-800 mb-6">Data Alumni</h2>
    <p class="text-sm text-slate-600 text-center mb-4">Lengkapi data Anda untuk melanjutkan</p>

    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800 border border-red-300">
            <strong>Ada Kesalahan!</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('alumni.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8 space-y-6">
        @csrf
        
        <div>
            <label for="nim" class="block text-sm font-medium text-slate-700 mb-2">NIM <span class="text-red-500">*</span></label>
            <input id="nim" name="nim" type="text" required value="{{ old('nim') }}"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nim') border-red-500 @enderror" />
            @error('nim')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="graduation_year" class="block text-sm font-medium text-slate-700 mb-2">Tahun Lulus <span class="text-red-500">*</span></label>
            <input id="graduation_year" name="graduation_year" type="number" required value="{{ old('graduation_year') }}"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('graduation_year') border-red-500 @enderror" />
            @error('graduation_year')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="major" class="block text-sm font-medium text-slate-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
            <input id="major" name="major" type="text" required value="{{ old('major') }}"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('major') border-red-500 @enderror" />
            @error('major')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="current_job" class="block text-sm font-medium text-slate-700 mb-2">Status Pekerjaan <span class="text-red-500">*</span></label>
            <select id="current_job" name="current_job" required onchange="toggleJobFields()"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('current_job') border-red-500 @enderror">
                <option value="">-- Pilih Status --</option>
                <option value="bekerja" {{ old('current_job') === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                <option value="tidak_bekerja" {{ old('current_job') === 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                <option value="melanjutkan_studi" {{ old('current_job') === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
            </select>
            @error('current_job')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div id="job-fields" class="space-y-6 p-4 bg-slate-50 rounded-lg border-2 border-indigo-200" style="display: none;">
            <p class="text-sm text-slate-600 font-medium">Informasi Pekerjaan</p>
            
            <div>
                <label for="company_name" class="block text-sm font-medium text-slate-700 mb-2">Nama Perusahaan</label>
                <input id="company_name" name="company_name" type="text" value="{{ old('company_name') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
            </div>

            <div>
                <label for="job_position" class="block text-sm font-medium text-slate-700 mb-2">Posisi Pekerjaan</label>
                <input id="job_position" name="job_position" type="text" value="{{ old('job_position') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
            </div>

            <div>
                <label for="salary_range" class="block text-sm font-medium text-slate-700 mb-2">Range Gaji (Opsional)</label>
                <input id="salary_range" name="salary_range" type="text" placeholder="Contoh: 5-10 juta" value="{{ old('salary_range') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
            </div>
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
            <input id="phone" name="phone" type="text" required value="{{ old('phone') }}"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @enderror" />
            @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3 pt-6">
            <a href="{{ route('profil') }}" class="flex-1 px-6 py-3 bg-slate-300 text-slate-800 rounded-lg hover:bg-slate-400 font-semibold text-center">Batal</a>
            <button type="submit" name="submit" class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 font-semibold">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection

<script>
function toggleJobFields() {
    const jobStatus = document.getElementById('current_job').value;
    const jobFields = document.getElementById('job-fields');
    if (jobStatus === 'bekerja') {
        jobFields.style.display = 'block';
    } else {
        jobFields.style.display = 'none';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const currentJob = document.getElementById('current_job').value;
    if (currentJob !== 'bekerja') {
        document.getElementById('job-fields').style.display = 'none';
    }
});
</script>