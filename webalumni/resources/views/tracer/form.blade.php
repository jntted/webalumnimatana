@extends('layout.layout_login')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Tracer Study Alumni</h1>
                    <p class="text-slate-600 text-sm">Survei Pelacakan Karir Alumni Pascasarjana</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="flex gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                    <div>
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

        @php
            $incompleteData = [];
            if (!$alumni->nim) $incompleteData[] = 'NIM';
            if (!$alumni->graduation_year) $incompleteData[] = 'Tahun Lulus';
            if (!$alumni->major) $incompleteData[] = 'Program Studi';
            if (!$alumni->current_job) $incompleteData[] = 'Status Pekerjaan';
            if ($alumni->current_job === 'bekerja' && !$alumni->company_name) $incompleteData[] = 'Nama Perusahaan';
            if ($alumni->current_job === 'bekerja' && !$alumni->job_position) $incompleteData[] = 'Posisi Pekerjaan';
            if (!$alumni->phone) $incompleteData[] = 'Nomor Telepon';
        @endphp

        @if (count($incompleteData) > 0)
            <div class="mb-6 rounded-lg bg-amber-50 border border-amber-200 p-4">
                <div class="flex gap-3">
                    <i class="fas fa-info-circle text-amber-600 mt-1"></i>
                    <div class="flex-1">
                        <h3 class="font-semibold text-amber-900 mb-2">Data Profil Belum Lengkap</h3>
                        <p class="text-sm text-amber-800 mb-3">Silahkan lengkapi data berikut sebelum mengisi tracer study:</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($incompleteData as $field)
                                <span class="text-xs bg-amber-100 text-amber-900 px-3 py-1 rounded-full">{{ $field }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('profil') }}" class="inline-block px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-semibold transition">
                            <i class="fas fa-arrow-left"></i> Lengkapi Data Profil
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('tracer.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Status Pekerjaan -->
            <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                <div class="mb-4 pb-4 border-b border-slate-200">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full text-center text-sm font-bold">1</span>
                        <h2 class="text-lg font-bold text-slate-900">Status Pekerjaan</h2>
                    </div>
                    <p class="text-sm text-slate-600 ml-10">Informasi status pekerjaan Anda saat ini</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-900 mb-2">
                            Status Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('status') border-red-500 @enderror" 
                            id="status" name="status" required onchange="toggleJobFields()">
                            <option value="">-- Pilih Status Pekerjaan --</option>
                            <option value="bekerja_full_time" {{ old('status', $existingTracer->status ?? '') === 'bekerja_full_time' ? 'selected' : '' }}>Bekerja Full Time</option>
                            <option value="bekerja_part_time" {{ old('status', $existingTracer->status ?? '') === 'bekerja_part_time' ? 'selected' : '' }}>Bekerja Part Time</option>
                            <option value="wiraswasta" {{ old('status', $existingTracer->status ?? '') === 'wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                            <option value="lanjut_pendidikan" {{ old('status', $existingTracer->status ?? '') === 'lanjut_pendidikan' ? 'selected' : '' }}>Lanjut Pendidikan</option>
                            <option value="tidak_kerja_sedang_cari" {{ old('status', $existingTracer->status ?? '') === 'tidak_kerja_sedang_cari' ? 'selected' : '' }}>Tidak Bekerja (Sedang Cari)</option>
                            <option value="belum_memungkinkan_kerja" {{ old('status', $existingTracer->status ?? '') === 'belum_memungkinkan_kerja' ? 'selected' : '' }}>Belum Memungkinkan Bekerja</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="company-field" style="display: none;">
                        <label for="current_company" class="block text-sm font-semibold text-slate-900 mb-2">
                            Perusahaan / Institusi <span class="text-red-500">*</span>
                        </label>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-2">
                            <p class="text-sm text-blue-700"><i class="fas fa-info-circle"></i> Data dari profil Anda. Ubah di halaman profil jika ingin mengubah.</p>
                        </div>
                        <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 @error('current_company') border-red-500 @enderror" 
                            id="current_company" name="current_company" 
                            value="{{ old('current_company', $existingTracer->current_company ?? $alumni->company_name ?? '') }}" 
                            readonly>
                        @error('current_company')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="position-field" style="display: none;">
                        <label for="current_position" class="block text-sm font-semibold text-slate-900 mb-2">
                            Posisi / Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 @error('current_position') border-red-500 @enderror" 
                            id="current_position" name="current_position" 
                            value="{{ old('current_position', $existingTracer->current_position ?? $alumni->job_position ?? '') }}" 
                            readonly>
                        @error('current_position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Sumber Pendanaan -->
            <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                <div class="mb-4 pb-4 border-b border-slate-200">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full text-center text-sm font-bold">2</span>
                        <h2 class="text-lg font-bold text-slate-900">Sumber Pendanaan</h2>
                    </div>
                    <p class="text-sm text-slate-600 ml-10">Sumber pendanaan pendidikan Anda</p>
                </div>

                <div>
                    <label for="funding_source" class="block text-sm font-semibold text-slate-900 mb-2">
                        Pilih Sumber Pendanaan <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('funding_source') border-red-500 @enderror" 
                        id="funding_source" name="funding_source" required>
                        <option value="">-- Pilih Sumber Pendanaan --</option>
                        <option value="biaya_sendiri" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'biaya_sendiri' ? 'selected' : '' }}>Biaya Sendiri</option>
                        <option value="beasiswa_adik" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_adik' ? 'selected' : '' }}>Beasiswa ADIK</option>
                        <option value="beasiswa_bidikmisi" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_bidikmisi' ? 'selected' : '' }}>Beasiswa Bidikmisi</option>
                        <option value="beasiswa_ppa" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_ppa' ? 'selected' : '' }}>Beasiswa PPA</option>
                        <option value="beasiswa_afirmasi" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_afirmasi' ? 'selected' : '' }}>Beasiswa Afirmasi</option>
                        <option value="beasiswa_swasta" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'beasiswa_swasta' ? 'selected' : '' }}>Beasiswa Swasta</option>
                        <option value="lainnya" {{ old('funding_source', $existingTracer->funding_source ?? '') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('funding_source')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section 3: Penilaian Kualitas Pembelajaran -->
            <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                <div class="mb-4 pb-4 border-b border-slate-200">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full text-center text-sm font-bold">3</span>
                        <h2 class="text-lg font-bold text-slate-900">Penilaian Kualitas Pembelajaran</h2>
                    </div>
                    <p class="text-sm text-slate-600 ml-10">Berikan penilaian terhadap aspek-aspek pendidikan (1 = Sangat Kurang, 5 = Sangat Baik)</p>
                </div>

                <div class="space-y-4">
                    @php
                        $ratings = [
                            ['id' => 'f21_perkuliahan', 'label' => 'Kualitas Perkuliahan dan Metode Pengajaran', 'icon' => 'fa-chalkboard'],
                            ['id' => 'f22_demonstrasi', 'label' => 'Demonstrasi / Praktik Langsung', 'icon' => 'fa-flask'],
                            ['id' => 'f23_riset_project', 'label' => 'Riset dan Project-Based Learning', 'icon' => 'fa-microscope'],
                            ['id' => 'f24_magang', 'label' => 'Program Magang dan Pengalaman Kerja', 'icon' => 'fa-briefcase'],
                            ['id' => 'f25_praktikum', 'label' => 'Praktikum dan Laboratorium', 'icon' => 'fa-test-tube'],
                            ['id' => 'f26_kerja_lapangan', 'label' => 'Kerja Lapangan dan Study Tour', 'icon' => 'fa-map'],
                            ['id' => 'f27_diskusi', 'label' => 'Diskusi dan Interaksi Akademik', 'icon' => 'fa-comments'],
                        ]
                    @endphp

                    @foreach ($ratings as $index => $rating)
                        <div class="border border-slate-200 rounded-lg p-4 hover:border-indigo-300 transition">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center text-sm flex-shrink-0">
                                    <i class="fas {{ $rating['icon'] }}"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-900">
                                        {{ $index + 1 }}. {{ $rating['label'] }} <span class="text-red-500">*</span>
                                    </label>
                                </div>
                            </div>
                            <select class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error($rating['id']) border-red-500 @enderror" 
                                id="{{ $rating['id'] }}" name="{{ $rating['id'] }}" required>
                                <option value="">-- Pilih Rating --</option>
                                <option value="1" {{ old($rating['id'], $existingTracer->{$rating['id']} ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                <option value="2" {{ old($rating['id'], $existingTracer->{$rating['id']} ?? '') == '2' ? 'selected' : '' }}>2 - Kurang</option>
                                <option value="3" {{ old($rating['id'], $existingTracer->{$rating['id']} ?? '') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                                <option value="4" {{ old($rating['id'], $existingTracer->{$rating['id']} ?? '') == '4' ? 'selected' : '' }}>4 - Baik</option>
                                <option value="5" {{ old($rating['id'], $existingTracer->{$rating['id']} ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                            </select>
                            @error($rating['id'])
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('profil') }}" class="flex-1 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold rounded-lg transition text-center">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-semibold rounded-lg transition">
                    <i class="fas fa-save"></i> Simpan Tracer Study
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleJobFields() {
    const status = document.getElementById('status').value;
    const companyField = document.getElementById('company-field');
    const positionField = document.getElementById('position-field');

    if (status === 'bekerja_full_time' || status === 'bekerja_part_time' || status === 'wiraswasta') {
        companyField.style.display = 'block';
        positionField.style.display = 'block';
    } else {
        companyField.style.display = 'none';
        positionField.style.display = 'none';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleJobFields();
});
</script>
@endsection

