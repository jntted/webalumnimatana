@extends('layout.layout')

@section('content')
<!-- Hero Section -->
<div class="create-hero-modern">
    <div class="container text-center">
        <div class="hero-icon-bounce">➕</div>
        <h1 class="hero-heading-create">Tambah Lowongan Pekerjaan</h1>
        <p class="hero-description-create">Isi informasi lowongan dengan lengkap dan jelas</p>
    </div>
</div>
@endsection

@section('isiWebsite')
<style>
    /* Modern Background - SAMA seperti halaman jobs */
    body {
        background: linear-gradient(to bottom, #667eea 0%, #764ba2 50%, #667eea 100%) !important;
        position: relative;
        overflow-x: hidden;
    }

    /* Hide decorative elements */
    .main-banner {
        background-image: none !important;
        background: transparent !important;
    }

    .main-banner::before,
    .main-banner::after {
        display: none !important;
    }

    /* Hero Section untuk Create Page */
    .create-hero-modern {
        padding: 60px 24px 40px;
        position: relative;
        overflow: visible;
        margin-bottom: 40px;
    }

    .hero-icon-bounce {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 50px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        animation: bounceIcon 2s ease-in-out infinite;
    }

    @keyframes bounceIcon {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .hero-heading-create {
        font-size: 3rem;
        font-weight: 900;
        color: white;
        margin-bottom: 15px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInDown 0.8s ease-out;
        letter-spacing: -1px;
    }

    .hero-description-create {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.95);
        animation: fadeInDown 1s ease-out;
        font-weight: 400;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Main Container */
    .create-wrapper {
        max-width: 950px;
        margin: 0 auto;
        padding: 0 20px 80px;
    }

    /* Error Alert */
    .alert-modern {
        background: rgba(248, 215, 218, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 25px 30px;
        margin-bottom: 30px;
        border: 2px solid rgba(220, 53, 69, 0.3);
        animation: slideUp 0.6s ease-out;
    }

    .alert-modern strong {
        color: #842029;
        font-weight: 800;
        font-size: 16px;
    }

    .alert-modern ul {
        margin: 12px 0 0 20px;
        color: #842029;
    }

    /* Form Card */
    .form-card-glass {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 28px;
        padding: 50px;
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideUp 0.8s ease-out;
    }

    /* Form Label */
    .form-label-modern {
        font-weight: 800;
        color: #2d3436;
        margin-bottom: 12px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .label-icon-box {
        width: 26px;
        height: 26px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .optional-tag {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        margin-left: auto;
    }

    /* Form Inputs */
    .input-glass {
        border: 2px solid #e9ecef;
        border-radius: 16px;
        padding: 16px 20px;
        font-size: 15px;
        transition: all 0.3s;
        width: 100%;
        background: white;
        font-family: inherit;
    }

    .input-glass:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    textarea.input-glass {
        resize: vertical;
        min-height: 140px;
    }

    select.input-glass {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%23667eea' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        padding-right: 50px;
    }

    /* Character Counter */
    .char-counter-modern {
        font-size: 13px;
        color: #6c757d;
        margin-top: 8px;
        text-align: right;
        font-weight: 600;
    }

    /* Salary Range */
    .salary-range-group {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 15px;
        align-items: end;
    }

    .salary-separator {
        font-weight: 800;
        color: #667eea;
        font-size: 20px;
        padding-bottom: 16px;
    }

    /* Form Actions */
    .form-actions-modern {
        display: flex;
        gap: 20px;
        margin-top: 45px;
        padding-top: 35px;
        border-top: 2px solid rgba(0, 0, 0, 0.05);
    }

    .btn-modern {
        flex: 1;
        padding: 18px 40px;
        border-radius: 16px;
        font-weight: 800;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .btn-submit-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        color: white;
    }

    .btn-cancel-modern {
        background: white;
        color: #6c757d;
        border: 2px solid #e9ecef;
        text-decoration: none;
    }

    .btn-cancel-modern:hover {
        border-color: #667eea;
        color: #667eea;
        background: #f8f9ff;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-heading-create {
            font-size: 2rem;
        }

        .hero-description-create {
            font-size: 1rem;
        }

        .form-card-glass {
            padding: 30px 20px;
        }

        .salary-range-group {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .salary-separator {
            display: none;
        }

        .form-actions-modern {
            flex-direction: column;
        }
    }
</style>

<div class="create-wrapper">
    
    {{-- Error Alert --}}
    @if ($errors->any())
    <div class="alert-modern">
        <strong>⚠️ Terjadi kesalahan:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card-glass">
        <form method="POST" action="{{ route('jobs.store') }}">
            @csrf

            <div class="row g-4">

                {{-- Judul & Perusahaan --}}
                <div class="col-md-6">
                    <label class="form-label-modern">
                        <span class="label-icon-box">📋</span>
                        Judul Lowongan
                    </label>
                    <input type="text" name="judul" class="input-glass" 
                           placeholder="Contoh: Senior Frontend Developer" 
                           value="{{ old('judul') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">
                        <span class="label-icon-box">🏢</span>
                        Perusahaan
                    </label>
                    <input type="text" name="perusahaan" class="input-glass" 
                           placeholder="Nama perusahaan" 
                           value="{{ old('perusahaan') }}" required>
                </div>

                {{-- Lokasi & Tipe --}}
                <div class="col-md-6">
                    <label class="form-label-modern">
                        <span class="label-icon-box">📍</span>
                        Lokasi
                    </label>
                    <input type="text" name="lokasi" class="input-glass" 
                           placeholder="Contoh: Jakarta, Indonesia" 
                           value="{{ old('lokasi') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">
                        <span class="label-icon-box">💼</span>
                        Tipe Pekerjaan
                    </label>
                    <select name="tipe_pekerjaan" class="input-glass" required>
                        <option value="">Pilih Tipe</option>
                        <option value="full_time" {{ old('tipe_pekerjaan')=='full_time'?'selected':'' }}>Full Time</option>
                        <option value="part_time" {{ old('tipe_pekerjaan')=='part_time'?'selected':'' }}>Part Time</option>
                        <option value="internship" {{ old('tipe_pekerjaan')=='internship'?'selected':'' }}>Internship</option>
                        <option value="contract" {{ old('tipe_pekerjaan')=='contract'?'selected':'' }}>Contract</option>
                        <option value="freelance" {{ old('tipe_pekerjaan')=='freelance'?'selected':'' }}>Freelance</option>
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="col-12">
                    <label class="form-label-modern">
                        <span class="label-icon-box">📝</span>
                        Deskripsi Pekerjaan
                    </label>
                    <textarea name="deskripsi" class="input-glass" 
                              placeholder="Jelaskan detail pekerjaan, tanggung jawab, dan kualifikasi..." 
                              required maxlength="2000" 
                              oninput="updateCounter(this, 'desc-counter')">{{ old('deskripsi') }}</textarea>
                    <div class="char-counter-modern" id="desc-counter">0 / 2000 karakter</div>
                </div>

                {{-- Persyaratan --}}
                <div class="col-12">
                    <label class="form-label-modern">
                        <span class="label-icon-box">✅</span>
                        Persyaratan
                        <span class="optional-tag">Opsional</span>
                    </label>
                    <textarea name="persyaratan" class="input-glass" 
                              placeholder="Contoh: Minimal S1, pengalaman 2 tahun..." 
                              maxlength="1000" 
                              oninput="updateCounter(this, 'req-counter')">{{ old('persyaratan') }}</textarea>
                    <div class="char-counter-modern" id="req-counter">0 / 1000 karakter</div>
                </div>

                {{-- Gaji --}}
                <div class="col-12">
                    <label class="form-label-modern">
                        <span class="label-icon-box">💰</span>
                        Rentang Gaji
                        <span class="optional-tag">Opsional</span>
                    </label>
                    <div class="salary-range-group">
                        <input type="number" name="gaji_min" class="input-glass" 
                               placeholder="Gaji Minimum (Rp)" 
                               value="{{ old('gaji_min') }}">
                        <span class="salary-separator">—</span>
                        <input type="number" name="gaji_max" class="input-glass" 
                               placeholder="Gaji Maksimum (Rp)" 
                               value="{{ old('gaji_max') }}">
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="col-md-6">
                    <label class="form-label-modern">
                        <span class="label-icon-box">✉️</span>
                        Kontak Email
                    </label>
                    <input type="email" name="kontak_email" class="input-glass" 
                           placeholder="email@perusahaan.com" 
                           value="{{ old('kontak_email') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">
                        <span class="label-icon-box">📞</span>
                        Kontak Telepon
                        <span class="optional-tag">Opsional</span>
                    </label>
                    <input type="tel" name="kontak_phone" class="input-glass" 
                           placeholder="Contoh: 081234567890" 
                           value="{{ old('kontak_phone') }}">
                </div>

            </div>

            {{-- Actions --}}
            <div class="form-actions-modern">
                <button type="submit" class="btn-modern btn-submit-modern">
                    <span>✓</span>
                    Simpan Lowongan
                </button>
                <a href="{{ route('jobs.index') }}" class="btn-modern btn-cancel-modern">
                    <span>←</span>
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<script>
function updateCounter(textarea, counterId) {
    const counter = document.getElementById(counterId);
    const maxLength = textarea.getAttribute('maxlength');
    const currentLength = textarea.value.length;
    counter.textContent = `${currentLength} / ${maxLength} karakter`;
}

document.addEventListener('DOMContentLoaded', function() {
    const descTextarea = document.querySelector('textarea[name="deskripsi"]');
    const reqTextarea = document.querySelector('textarea[name="persyaratan"]');
    
    if (descTextarea) updateCounter(descTextarea, 'desc-counter');
    if (reqTextarea) updateCounter(reqTextarea, 'req-counter');
});
</script>

@endsection