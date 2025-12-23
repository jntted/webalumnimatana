<!-- Job Vacancy Upload Section -->
<div class="mt-8 pt-8 border-t border-slate-200">
    <h3 class="text-xl font-bold text-slate-800 mb-6">Upload Lowongan Pekerjaan</h3>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Info Alert -->
    <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 p-4">
        <div class="flex items-start gap-3">
            <i class="fas fa-info-circle text-blue-600 mt-1"></i>
            <div>
                <p class="text-sm text-blue-800 font-semibold mb-1">Informasi Penting</p>
                <p class="text-sm text-blue-700">Lowongan pekerjaan yang Anda upload akan menjalani proses persetujuan admin terlebih dahulu sebelum dipublikasikan. Isi data dengan lengkap dan jelas untuk mempercepat proses persetujuan.</p>
            </div>
        </div>
    </div>

    <!-- Upload Form -->
    <form action="{{ route('profile.jobs.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Judul Lowongan -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Judul Lowongan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="judul" placeholder="Contoh: Software Engineer" 
                    value="{{ old('judul') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('judul') border-red-500 @enderror"
                    required>
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Perusahaan -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Perusahaan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="perusahaan" placeholder="Contoh: PT. XYZ Indonesia" 
                    value="{{ old('perusahaan') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('perusahaan') border-red-500 @enderror"
                    required>
                @error('perusahaan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipe Pekerjaan -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Tipe Pekerjaan <span class="text-red-600">*</span>
                </label>
                <select name="tipe_pekerjaan" 
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('tipe_pekerjaan') border-red-500 @enderror"
                    required>
                    <option value="">-- Pilih Tipe Pekerjaan --</option>
                    <option value="full_time" {{ old('tipe_pekerjaan') === 'full_time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part_time" {{ old('tipe_pekerjaan') === 'part_time' ? 'selected' : '' }}>Part Time</option>
                    <option value="internship" {{ old('tipe_pekerjaan') === 'internship' ? 'selected' : '' }}>Internship</option>
                    <option value="contract" {{ old('tipe_pekerjaan') === 'contract' ? 'selected' : '' }}>Kontrak</option>
                    <option value="freelance" {{ old('tipe_pekerjaan') === 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
                @error('tipe_pekerjaan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Lokasi <span class="text-red-600">*</span>
                </label>
                <input type="text" name="lokasi" placeholder="Contoh: Jakarta, Indonesia" 
                    value="{{ old('lokasi') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('lokasi') border-red-500 @enderror"
                    required>
                @error('lokasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Kontak -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Email Kontak <span class="text-red-600">*</span>
                </label>
                <input type="email" name="kontak_email" placeholder="Contoh: hr@perusahaan.com" 
                    value="{{ old('kontak_email') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('kontak_email') border-red-500 @enderror"
                    required>
                @error('kontak_email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nomor Telepon <span class="text-slate-500">(Opsional)</span>
                </label>
                <input type="text" name="kontak_phone" placeholder="Contoh: +62-812-3456-7890" 
                    value="{{ old('kontak_phone') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('kontak_phone') border-red-500 @enderror">
                @error('kontak_phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Gaji Range -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Gaji Minimum <span class="text-slate-500">(Opsional)</span>
                </label>
                <input type="number" name="gaji_min" placeholder="Contoh: 5000000" 
                    value="{{ old('gaji_min') }}"
                    min="0" step="1000"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('gaji_min') border-red-500 @enderror">
                @error('gaji_min')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-slate-500">Dalam IDR (Rupiah)</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Gaji Maksimum <span class="text-slate-500">(Opsional)</span>
                </label>
                <input type="number" name="gaji_max" placeholder="Contoh: 8000000" 
                    value="{{ old('gaji_max') }}"
                    min="0" step="1000"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('gaji_max') border-red-500 @enderror">
                @error('gaji_max')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-slate-500">Dalam IDR (Rupiah)</p>
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Deskripsi Lowongan <span class="text-red-600">*</span>
            </label>
            <textarea name="deskripsi" placeholder="Jelaskan tentang posisi, tanggung jawab, dan deskripsi pekerjaan..."
                rows="5"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('deskripsi') border-red-500 @enderror"
                required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Persyaratan -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Persyaratan & Kualifikasi <span class="text-slate-500">(Opsional)</span>
            </label>
            <textarea name="persyaratan" placeholder="Sebutkan pendidikan, pengalaman, skill, dan persyaratan lainnya..."
                rows="4"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('persyaratan') border-red-500 @enderror">{{ old('persyaratan') }}</textarea>
            @error('persyaratan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex gap-3 pt-4">
            <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold transition">
                <i class="fas fa-upload"></i> Upload Lowongan
            </button>
            <button type="reset" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 font-semibold transition">
                Bersihkan Form
            </button>
        </div>
    </form>
</div>
