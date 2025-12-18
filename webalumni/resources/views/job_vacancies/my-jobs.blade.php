@extends('layout.app')

@section('title', 'Lowongan Saya')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="row mb-4 job-header align-items-center">
        <div class="col-md-8">
            <h2 class="mb-1">📋 Lowongan Pekerjaan Saya</h2>
            <p class="text-muted mb-0">Kelola semua lowongan yang Anda posting</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Lowongan
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card text-center">
                <div class="card-body">
                    <h3 class="text-primary mb-0">{{ $stats['total'] }}</h3>
                    <p class="text-muted mb-0">Total Lowongan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card text-center">
                <div class="card-body">
                    <h3 class="text-warning mb-0">{{ $stats['pending'] }}</h3>
                    <p class="text-muted mb-0">Menunggu Review</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card text-center">
                <div class="card-body">
                    <h3 class="text-success mb-0">{{ $stats['approved'] }}</h3>
                    <p class="text-muted mb-0">Disetujui</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card text-center">
                <div class="card-body">
                    <h3 class="text-danger mb-0">{{ $stats['rejected'] }}</h3>
                    <p class="text-muted mb-0">Ditolak</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <ul class="nav nav-tabs mb-4 job-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#all">
                Semua <span class="badge bg-secondary">{{ $stats['total'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#pending">
                Pending <span class="badge bg-warning">{{ $stats['pending'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#approved">
                Disetujui <span class="badge bg-success">{{ $stats['approved'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#rejected">
                Ditolak <span class="badge bg-danger">{{ $stats['rejected'] }}</span>
            </a>
        </li>
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all">
            @include('job_vacancies.partials.job_list', ['jobs' => $jobs])
        </div>

        <div class="tab-pane fade" id="pending">
            @include('job_vacancies.partials.job_list', ['jobs' => $jobs->where('status', 'pending')])
        </div>

        <div class="tab-pane fade" id="approved">
            @include('job_vacancies.partials.job_list', ['jobs' => $jobs->where('status', 'approved')])
        </div>

        <div class="tab-pane fade" id="rejected">
            @include('job_vacancies.partials.job_list', ['jobs' => $jobs->where('status', 'rejected')])
        </div>
    </div>

</div>
@endsection@extends('layout.layout')

@section('title', 'Lowongan Saya')
@section('body-class', 'page-my-jobs')

@section('content')
<div class="myjobs-hero">
    <div class="container">
        <h1 class="hero-title">📋 Lowongan Pekerjaan Saya</h1>
        <p class="hero-subtitle">
            Kelola semua lowongan yang telah Anda posting
        </p>

        <a href="{{ route('jobs.create') }}" class="btn-hero-add">
            <i class="fas fa-plus-circle"></i> Tambah Lowongan
        </a>
    </div>
</div>
@endsection

@section('isiWebsite')
<style>
/* ================= PAGE SCOPE ================= */
.page-my-jobs {
    background: linear-gradient(to bottom, #667eea 0%, #764ba2 50%, #f4f6fb 100%);
}

/* ================= HERO ================= */
.myjobs-hero {
    padding: 70px 20px;
    text-align: center;
    color: white;
}

.hero-title {
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 10px;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.95;
    margin-bottom: 30px;
}

.btn-hero-add {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 38px;
    background: white;
    color: #667eea;
    border-radius: 50px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 10px 35px rgba(0,0,0,.25);
    transition: all .3s;
}

.btn-hero-add:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 50px rgba(0,0,0,.35);
    color: #667eea;
}

/* ================= WRAPPER ================= */
.myjobs-wrapper {
    max-width: 1200px;
    margin: -50px auto 80px;
    padding: 0 20px;
}

/* ================= STATS ================= */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.stat-card {
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(15px);
    border-radius: 22px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 15px 45px rgba(0,0,0,.18);
    transition: all .3s;
}

.stat-card:hover {
    transform: translateY(-10px);
}

.stat-number {
    font-size: 3rem;
    font-weight: 900;
    background: linear-gradient(135deg,#667eea,#764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat-label {
    font-weight: 700;
    color: #6c757d;
}

/* ================= TABS ================= */
.tabs-modern {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.tab-modern {
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 800;
    background: rgba(255,255,255,.2);
    color: white;
    border: 2px solid rgba(255,255,255,.4);
    text-decoration: none;
    transition: all .3s;
}

.tab-modern:hover,
.tab-modern.active {
    background: white;
    color: #667eea;
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
}

/* ================= JOB LIST ================= */
.job-card {
    background: rgba(255,255,255,.95);
    border-radius: 22px;
    padding: 28px;
    margin-bottom: 24px;
    box-shadow: 0 15px 45px rgba(0,0,0,.15);
    transition: all .3s;
}

.job-card:hover {
    transform: translateY(-6px);
}

.job-title {
    font-size: 1.4rem;
    font-weight: 900;
}

.job-meta {
    color: #6c757d;
    font-size: 14px;
}

/* ================= EMPTY ================= */
.empty-box {
    background: rgba(255,255,255,.95);
    border-radius: 24px;
    padding: 80px 40px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0,0,0,.2);
}

.empty-box h2 {
    font-weight: 900;
    margin-bottom: 15px;
}

</style>

<div class="myjobs-wrapper">

    {{-- STATS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Lowongan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['pending'] }}</div>
            <div class="stat-label">Menunggu Review</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['approved'] }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['rejected'] }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="tabs-modern">
        <a class="tab-modern active">Semua ({{ $stats['total'] }})</a>
        <a class="tab-modern">Pending ({{ $stats['pending'] }})</a>
        <a class="tab-modern">Disetujui ({{ $stats['approved'] }})</a>
        <a class="tab-modern">Ditolak ({{ $stats['rejected'] }})</a>
    </div>

    {{-- JOB LIST --}}
    @if($jobs->count())
        @foreach($jobs as $job)
            <div class="job-card">
                <div class="job-title">{{ $job->title }}</div>
                <div class="job-meta">
                    {{ $job->company_name }} • {{ ucfirst($job->status) }}
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-box">
            <h2>Belum Ada Lowongan</h2>
            <p>Anda belum memposting lowongan pekerjaan.</p>
            <a href="{{ route('jobs.create') }}" class="btn-hero-add">
                ➕ Tambah Lowongan
            </a>
        </div>
    @endif

</div>
@endsection

