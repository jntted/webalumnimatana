@extends('layout.layout')

@section('content')
<!-- Hero Section with Gradient -->
<div class="jobs-hero-modern">
    <div class="container text-center position-relative">
        <div class="hero-badge">💼 Job Board</div>
        <h1 class="hero-heading">Lowongan Pekerjaan</h1>
        <p class="hero-description">Temukan peluang karir terbaik untuk alumni Matana University</p>
        @auth
        <a href="{{ route('jobs.create') }}" class="btn-hero-cta">
            <i class="fas fa-plus-circle"></i> Pasang Lowongan
        </a>
        @endauth
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lowongan Pekerjaan - Matana University Alumni</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  
  <style>
    /* Job Board Specific Styles */
    :root {
      --primary-color: #ffffffff;
      --secondary-color: #8f94fb;
      --accent-color: #ff6b6b;
      --dark-color: #2d3436;
      --light-bg: #f8f9fa;
    }

@section('isiWebsite')
<style>
    /* Modern Job Board Background */
    body {
        background: linear-gradient(to bottom, #667eea 0%, #764ba2 50%, #667eea 100%) !important;
        position: relative;
        overflow-x: hidden;
    }

    /* Kembalikan main-banner tapi sembunyikan background image-nya */
    .main-banner {
        background-image: none !important;
        background: transparent !important;
    }

    .main-banner::before,
    .main-banner::after {
        display: none !important;
    }

    /* Animated Background Pattern - DIHAPUS (penyebab garis kotak) */

    /* Floating Shapes - DIHAPUS (body::after yang bikin biru di kiri) */

    /* Ensure all content is above background */
    .container, .jobs-wrapper {
        position: relative;
        z-index: 1;
    }

    /* Hero Section */
    /* HERO FIX ANTI KEPOTONG */
/* HERO FIX - Ilustrasi Tidak Kepotong & Centered */
/* GAMBAR CENTERED VERTIKAL & GESER KANAN */

/* Hero section - beri ruang lebih */
.jobs-hero-modern {
    padding: 80px 24px;
    position: relative;
    overflow: visible !important;
    margin-bottom: 50px;
    background: none !important;
    min-height: 550px; /* ✅ Tambah tinggi */
}

/* Pastikan main-banner bisa tampung gambar */
.main-banner {
    overflow: visible !important;
    position: relative;
    min-height: 550px; /* ✅ Tambah tinggi */
}

/* Gambar - centered & ke kanan */
.right-image {
    position: absolute !important;
    right: 1% !important; /* Posisi kanan */
    top: 50% !important; /* ✅ 50% dari atas */
    transform: translateY(-50%) !important; /* ✅ CENTERED VERTIKAL */
    width: 480px;
    max-width: 42%;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 40px 20px; /* ✅ Padding vertikal lebih */
    z-index: 1;
}

.right-image img {
    max-width: 100% !important;
    max-height: 500px !important; /* ✅ Tinggi maksimal */
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.15));
}

/* Pastikan parent tidak clip */
.col-lg-12 .main-banner {
    overflow: visible !important;
    min-height: 550px;
}

/* Responsive - Tablet */
@media (max-width: 1200px) {
    .jobs-hero-modern {
        min-height: 500px;
    }
    
    .main-banner {
        min-height: 500px;
    }
    
    .right-image {
        width: 400px;
        max-width: 38%;
        right: 2%;
    }
    
    .right-image img {
        max-height: 440px !important;
    }
}

@media (max-width: 992px) {
    .jobs-hero-modern {
        min-height: auto;
    }
    
    .main-banner {
        min-height: auto;
    }
    
    .right-image {
        position: relative !important;
        transform: none !important;
        width: 100%;
        max-width: 420px;
        margin: 40px auto 0;
        right: auto;
        top: auto;
    }
    
    .right-image img {
        max-height: 380px !important;
    }
}

@media (max-width: 768px) {
    .right-image {
        max-width: 320px;
        padding: 20px 10px;
        margin-top: 30px;
    }
    
    .right-image img {
        max-height: 300px !important;
    }
}
}


    /* Force hide all decorative background images */
    .main-banner {
        background-image: none !important;
    }

    .main-banner::before,
    .main-banner::after,
    .jobs-hero-modern::before,
    .jobs-hero-modern::after {
        display: none !important;
    }

    /* Hero background animated - DIHAPUS (penyebab kotak kepotong) */

    .hero-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        color: white;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        position: relative;
        animation: fadeInDown 0.6s ease-out;
        cursor: pointer;
        transition: all 0.3s;
    }

    .hero-badge:hover {
        transform: scale(1.1);
        background: rgba(255, 255, 255, 0.3);
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
        border-color: rgba(255, 255, 255, 0.6);
    }

    .hero-heading {
        font-size: 3.5rem;
        font-weight: 900;
        color: white;
        margin-bottom: 15px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInDown 0.8s ease-out;
        letter-spacing: -1px;
    }

    .hero-description {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 30px;
        animation: fadeInDown 1s ease-out;
        font-weight: 400;
    }

    .btn-hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: white;
        color: #667eea;
        border-radius: 50px;
        font-weight: 700;
        font-size: 16px;
        text-decoration: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        transition: all 0.3s;
        animation: fadeInUp 1.2s ease-out;
    }

    .btn-hero-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        color: #667eea;
        text-decoration: none;
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

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Main Container */
    .jobs-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px 80px;
    }

    /* Search Card with Glassmorphism */
    .search-card-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        margin-bottom: 40px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideUp 0.6s ease-out;
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

    .search-label-modern {
        font-weight: 800;
        color: #2d3436;
        margin-bottom: 12px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .input-modern {
        border: 2px solid #e9ecef;
        border-radius: 14px;
        padding: 15px 20px;
        font-size: 15px;
        transition: all 0.3s;
        width: 100%;
        background: white;
    }

    .input-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .btn-search-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 15px 0;
        border-radius: 14px;
        font-weight: 800;
        font-size: 15px;
        transition: all 0.3s;
        width: 100%;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-search-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.5);
    }

    .btn-search-modern:active {
        transform: translateY(-1px);
    }

    .btn-reset-modern {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 15px 0;
        border-radius: 14px;
        font-weight: 800;
        font-size: 15px;
        transition: all 0.3s;
        width: 100%;
        text-decoration: none;
        display: block;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-reset-modern:hover {
        border-color: #667eea;
        color: #667eea;
        background: #f8f9ff;
        text-decoration: none;
        transform: translateY(-2px);
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
        animation: slideUp 0.8s ease-out;
    }

    .stat-card-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 32px;
        text-align: center;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .stat-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card-modern::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.1), transparent);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .stat-card-modern:hover::after {
        width: 300px;
        height: 300px;
    }

    .stat-card-modern:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
    }

    .stat-number-modern {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .stat-label-modern {
        color: #6c757d;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        position: relative;
        z-index: 1;
    }

    /* Tabs */
    .tabs-modern {
        display: flex;
        gap: 15px;
        margin-bottom: 40px;
        flex-wrap: wrap;
        animation: slideUp 1s ease-out;
    }

    .tab-modern {
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 14px;
        transition: all 0.3s;
        text-decoration: none;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tab-modern:hover {
        background: rgba(255, 255, 255, 0.95);
        color: #667eea;
        text-decoration: none;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .tab-modern.active {
        background: rgba(255, 255, 255, 0.95);
        color: #667eea;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
        border-color: transparent;
    }

    /* Jobs Grid */
    .jobs-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(540px, 1fr));
        gap: 28px;
        margin-bottom: 50px;
    }

    @media (max-width: 768px) {
        .jobs-grid-modern {
            grid-template-columns: 1fr;
        }
    }

    .job-card-ultra {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }

    .job-card-ultra::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.5s;
    }

    .job-card-ultra:hover::before {
        transform: scaleX(1);
    }

    .job-card-ultra::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.05), transparent);
        transition: left 0.5s;
    }

    .job-card-ultra:hover::after {
        left: 100%;
    }

    .job-card-ultra:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
    }

    .job-header-flex {
        display: flex;
        gap: 22px;
        margin-bottom: 22px;
        align-items: flex-start;
    }

    .company-logo-modern {
        width: 72px;
        height: 72px;
        min-width: 72px;
        border-radius: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 900;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transition: all 0.3s;
    }

    .job-card-ultra:hover .company-logo-modern {
        transform: rotate(10deg) scale(1.1);
    }

    .job-info-section {
        flex: 1;
        min-width: 0;
    }

    .job-title-ultra {
        font-size: 1.45rem;
        font-weight: 900;
        color: #1a1a2e;
        margin-bottom: 8px;
        line-height: 1.3;
        word-wrap: break-word;
        transition: color 0.3s;
    }

    .job-card-ultra:hover .job-title-ultra {
        color: #667eea;
    }

    .company-name-ultra {
        color: #6c757d;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0;
    }

    .badge-type-modern {
        display: inline-block;
        padding: 8px 18px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 800;
        margin-top: 14px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .badge-fulltime {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-parttime {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-freelance {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .badge-remote {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .job-details-section {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 22px;
        padding-top: 22px;
        border-top: 2px solid rgba(0, 0, 0, 0.05);
        font-size: 14px;
        color: #6c757d;
    }

    .detail-tag {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        padding: 6px 14px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 20px;
        transition: all 0.3s;
    }

    .detail-tag:hover {
        background: rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .detail-tag i {
        color: #667eea;
        font-size: 13px;
    }

    /* Empty State */
    .empty-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 100px 50px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideUp 0.8s ease-out;
    }

    .empty-icon-modern {
        font-size: 120px;
        margin-bottom: 35px;
        opacity: 0.8;
        animation: bounce 3s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-30px); }
    }

    .empty-title-modern {
        font-size: 2.2rem;
        font-weight: 900;
        color: #1a1a2e;
        margin-bottom: 18px;
    }

    .empty-text-modern {
        color: #6c757d;
        font-size: 1.15rem;
        margin-bottom: 40px;
        font-weight: 500;
    }

    .btn-create-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 18px 50px;
        border-radius: 50px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s;
        box-shadow: 0 12px 40px rgba(102, 126, 234, 0.45);
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-create-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 55px rgba(102, 126, 234, 0.55);
        color: white;
        text-decoration: none;
    }

    /* Kembalikan right-image (ilustrasi kanan tetap muncul) */
    .right-image {
        display: block !important;
    }
    
    /* Hide shape biru besar di kiri */
    .main-banner::before,
    .main-banner::after {
        display: none !important;
    }

    .col-lg-12 .main-banner {
        background-image: none !important;
        overflow: hidden !important;
    }

    /* Hide background decorative elements */
    .main-banner > img:not(.right-image img),
    .main-banner .left-image,
    .main-banner [class*="left"],
    .main-banner [class*="decoration"]:not(.right-image) {
        display: none !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .jobs-hero h1 {
        font-size: 2rem;
      }
      
      .search-card {
        padding: 20px;
      }
      
      .job-card {
        padding: 20px;
      }
    }

    /* Loading Animation */
    .loading-spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid var(--primary-color);
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 50px auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

  <!-- ***** Header Area Start ***** -->
  <!-- <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <a href="/" class="logo">
              <img src="{{ asset('assets/images/logo_matana.png') }}" alt="Matana University">
            </a>

    @media (max-width: 768px) {
        .hero-heading {
            font-size: 2rem;
        }
        
        .hero-description {
            font-size: 1rem;
        }
        
        .search-card-glass {
            padding: 25px;
        }
        
        .job-card-ultra {
            padding: 24px;
        }
        
        .company-logo-modern {
            width: 60px;
            height: 60px;
            min-width: 60px;
            font-size: 26px;
        }
        
        .job-title-ultra {
            font-size: 1.2rem;
        }
        
        .empty-modern {
            padding: 70px 35px;
        }
        
    }
</style>

<div class="jobs-wrapper">
    
    <!-- Search Card -->
    <div class="search-card-glass">
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-lg-5 col-md-6">
                    <label class="search-label-modern">
                        <i class="fas fa-search"></i> Cari Lowongan
                    </label>
                    <input type="text" name="search" class="input-modern" 
                           placeholder="Ketik judul atau perusahaan..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="search-label-modern">
                        <i class="fas fa-filter"></i> Tipe Pekerjaan
                    </label>
                    <select name="type" class="input-modern">
                        <option value="">Semua Tipe</option>
                        <option value="fulltime" {{ request('type') == 'fulltime' ? 'selected' : '' }}>Full Time</option>
                        <option value="parttime" {{ request('type') == 'parttime' ? 'selected' : '' }}>Part Time</option>
                        <option value="freelance" {{ request('type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn-search-modern">Cari</button>
                </div>
                <div class="col-lg-2 col-md-6 d-flex align-items-end">
                    <a href="{{ route('jobs.index') }}" class="btn-reset-modern">Reset</a>
                </div>
              @endauth
            </div>

            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </header> -->

  @extends('layout.header')
  <!-- ***** Header Area End ***** -->

  <!-- Hero Section -->
  <section class="jobs-hero">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="animate__animated animate__fadeInDown">🔍 Lowongan Pekerjaan</h1>
          <p class="animate__animated animate__fadeInUp">Temukan peluang karir terbaik untuk alumni Matana University</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="pb-5">
    <div class="container">
      
      <!-- Search Card -->
      <div class="search-card">
        <form action="{{ route('jobs.index') }}" method="GET">
          <div class="row g-3 align-items-end">
            <div class="col-lg-5">
              <label class="form-label fw-bold"><i class="fas fa-search me-2"></i>Cari Lowongan</label>
              <input type="text" name="search" class="form-control search-input" 
                     placeholder="Cari judul, perusahaan, atau keyword..." 
                     value="{{ request('search') }}">
            </div>
            <div class="col-lg-3">
              <label class="form-label fw-bold"><i class="fas fa-filter me-2"></i>Kategori</label>
              <select name="type" class="form-select search-input">
                <option value="">Semua Tipe</option>
                <option value="fulltime" {{ request('type') == 'fulltime' ? 'selected' : '' }}>Full Time</option>
                <option value="parttime" {{ request('type') == 'parttime' ? 'selected' : '' }}>Part Time</option>
                <option value="freelance" {{ request('type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
              </select>
            </div>
            <div class="col-lg-2">
              <button type="submit" class="btn btn-search w-100">
                <i class="fas fa-search me-2"></i>Cari
              </button>
            </div>
            <div class="col-lg-2">
              <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-100" style="border-radius: 12px; padding: 15px;">
                <i class="fas fa-redo me-2"></i>Reset
              </a>
            </div>
        </form>
    </div>

    <!-- Stats -->
    <div class="stats-container">
        <div class="stat-card-modern">
            <div class="stat-number-modern">{{ $totalJobs ?? 0 }}</div>
            <div class="stat-label-modern">Total Lowongan</div>
        </div>
        <div class="stat-card-modern">
            <div class="stat-number-modern">{{ $activeJobs ?? 0 }}</div>
            <div class="stat-label-modern">Lowongan Aktif</div>
        </div>
        <div class="stat-card-modern">
            <div class="stat-number-modern">{{ $companies ?? 0 }}</div>
            <div class="stat-label-modern">Perusahaan</div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs-modern">
        <a href="{{ route('jobs.index') }}" class="tab-modern active">
            📋 Semua Lowongan
        </a>
        @auth
        <a href="{{ route('jobs.my-jobs') }}" class="tab-modern">
            👤 Lowongan Saya
        </a>
        <a href="{{ route('jobs.create') }}" class="tab-modern" style="margin-left: auto;">
            ➕ Pasang Lowongan
        </a>
        @endauth
    </div>

    <!-- Jobs Grid -->
    @if(isset($jobs) && $jobs->count() > 0)
        <div class="jobs-grid-modern">
            @foreach($jobs as $job)
            <div class="job-card-ultra" onclick="window.location='{{ route('jobs.show', $job->id) }}'">
                <div class="job-header-flex">
                    <div class="company-logo-modern">
                        {{ strtoupper(substr($job->company_name ?? 'C', 0, 1)) }}
                    </div>
                    <div class="job-info-section">
                        <h3 class="job-title-ultra">{{ $job->title }}</h3>
                        <p class="company-name-ultra">{{ $job->company_name }}</p>
                        <span class="badge-type-modern badge-{{ strtolower($job->type) }}">
                            {{ ucfirst($job->type) }}
                        </span>
                    </div>
                </div>
                <div class="job-details-section">
                    <div class="detail-tag">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $job->location }}</span>
                    </div>
                    @if($job->salary_range)
                    <div class="detail-tag">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>{{ $job->salary_range }}</span>
                    </div>
                    @endif
                    <div class="detail-tag">
                        <i class="fas fa-clock"></i>
                        <span>{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="detail-tag">
                        <i class="fas fa-eye"></i>
                        <span>{{ $job->views ?? 0 }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $jobs->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="empty-modern">
            <div class="empty-icon-modern">💼</div>
            <h2 class="empty-title-modern">Belum Ada Lowongan</h2>
            <p class="empty-text-modern">
                Jadilah yang pertama memposting lowongan pekerjaan!
            </p>
            @auth
            <a href="{{ route('jobs.create') }}" class="btn-create-modern">
                <i class="fas fa-plus-circle"></i>
                Pasang Lowongan Sekarang
            </a>
            @else
            <a href="{{ route('login') }}" class="btn-create-modern">
                <i class="fas fa-sign-in-alt"></i>
                Login untuk Pasang Lowongan
            </a>
            @endauth
        </div>
    @endif

</div>
@endsection