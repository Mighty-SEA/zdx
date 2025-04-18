@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-3 animated fadeIn">
        <div>
            <h1 class="mt-4 mb-1 fw-bold">Manajemen Konten Halaman</h1>
            <p class="text-muted">Pilih halaman yang ingin diedit untuk mengubah kontennya</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
        </a>
    </div>
    
    <ol class="breadcrumb mb-4 bg-light py-2 px-3 rounded shadow-sm animated fadeIn">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Pilih Halaman</li>
    </ol>

    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4 shadow border-0 animated fadeInUp">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt me-2"></i>
                        <h5 class="mb-0">Pilih Halaman untuk Diedit</h5>
                    </div>
                </div>
                <div class="card-body p-4 bg-light">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
                        <!-- Halaman Utama -->
                        <div class="col" data-aos="fade-up" data-aos-delay="100">
                            <div class="card h-100 border-0 shadow-sm gradient-card-primary hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-home fa-3x text-white"></i>
                                    </div>
                                    <h5 class="card-title text-white mb-3">Halaman Utama</h5>
                                    <p class="card-text text-white-50 small">Edit konten beranda, hero, statistik, dan informasi utama</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center pb-4">
                                    <a href="{{ route('admin.page-contents.edit-page', 'home') }}" class="btn btn-light btn-glow px-4 rounded-pill">
                                        <i class="fas fa-edit me-2"></i>Edit Halaman
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Halaman Layanan -->
                        <div class="col" data-aos="fade-up" data-aos-delay="200">
                            <div class="card h-100 border-0 shadow-sm gradient-card-success hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-truck fa-3x text-white"></i>
                                    </div>
                                    <h5 class="card-title text-white mb-3">Halaman Layanan</h5>
                                    <p class="card-text text-white-50 small">Edit konten layanan, deskripsi, dan informasi terkait layanan</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center pb-4">
                                    <a href="{{ route('admin.page-contents.edit-page', 'services') }}" class="btn btn-light btn-glow px-4 rounded-pill">
                                        <i class="fas fa-edit me-2"></i>Edit Halaman
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Halaman Tentang Kami -->
                        <div class="col" data-aos="fade-up" data-aos-delay="300">
                            <div class="card h-100 border-0 shadow-sm gradient-card-info hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-info-circle fa-3x text-white"></i>
                                    </div>
                                    <h5 class="card-title text-white mb-3">Tentang Kami</h5>
                                    <p class="card-text text-white-50 small">Edit profil perusahaan, sejarah, visi, dan misi</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center pb-4">
                                    <a href="{{ route('admin.page-contents.edit-page', 'about') }}" class="btn btn-light btn-glow px-4 rounded-pill">
                                        <i class="fas fa-edit me-2"></i>Edit Halaman
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Halaman Kontak -->
                        <div class="col" data-aos="fade-up" data-aos-delay="400">
                            <div class="card h-100 border-0 shadow-sm gradient-card-danger hover-card">
                                <div class="card-body text-center p-4">
                                    <div class="icon-wrapper mb-3">
                                        <i class="fas fa-phone fa-3x text-white"></i>
                                    </div>
                                    <h5 class="card-title text-white mb-3">Kontak</h5>
                                    <p class="card-text text-white-50 small">Edit informasi kontak, alamat, dan formulir kontak</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center pb-4">
                                    <a href="{{ route('admin.page-contents.edit-page', 'contact') }}" class="btn btn-light btn-glow px-4 rounded-pill">
                                        <i class="fas fa-edit me-2"></i>Edit Halaman
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5 pt-4 border-top" data-aos="fade-up">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 border-start border-primary ps-3">Manajemen Konten Lainnya</h5>
                            <div class="d-flex">
                                <span class="badge bg-primary me-2 py-2 px-3 rounded-pill"><i class="fas fa-info-circle me-1"></i> Total Konten: {{ \App\Models\PageContent::count() }}</span>
                                <span class="badge bg-success py-2 px-3 rounded-pill"><i class="fas fa-check-circle me-1"></i> Aktif: {{ \App\Models\PageContent::where('is_active', true)->count() }}</span>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex action-card bg-white rounded shadow-sm overflow-hidden h-100">
                                    <div class="bg-primary text-white p-4 d-flex align-items-center justify-content-center" style="min-width: 90px;">
                                        <i class="fas fa-list fa-2x"></i>
                                    </div>
                                    <div class="p-4 w-100">
                                        <h5 class="fw-bold mb-2">Daftar Semua Konten</h5>
                                        <p class="text-muted small mb-3">Lihat dan kelola semua konten halaman dalam sistem</p>
                                        <a href="{{ route('admin.page-contents.list') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-search me-2"></i>Lihat Konten
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex action-card bg-white rounded shadow-sm overflow-hidden h-100">
                                    <div class="bg-success text-white p-4 d-flex align-items-center justify-content-center" style="min-width: 90px;">
                                        <i class="fas fa-plus-circle fa-2x"></i>
                                    </div>
                                    <div class="p-4 w-100">
                                        <h5 class="fw-bold mb-2">Tambah Konten Baru</h5>
                                        <p class="text-muted small mb-3">Buat konten halaman baru untuk website Anda</p>
                                        <a href="{{ route('admin.page-contents.create') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="fas fa-plus me-2"></i>Tambah Konten
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animations */
    .animated {
        animation-duration: 0.5s;
        animation-fill-mode: both;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    .fadeIn { animation-name: fadeIn; }
    .fadeInUp { animation-name: fadeInUp; }
    
    /* Card gradients */
    .gradient-card-primary {
        background: linear-gradient(135deg, #4e73df 0%, #2242a3 100%);
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    .gradient-card-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    .gradient-card-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    .gradient-card-danger {
        background: linear-gradient(135deg, #e74a3b 0%, #af2617 100%);
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    /* Hover effects */
    .hover-card {
        overflow: hidden;
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.27, 1.55);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important;
    }
    
    .hover-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.1);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }
    
    .hover-card:hover:before {
        transform: translateX(100%);
    }
    
    /* Card header gradient */
    .bg-gradient-primary {
        background: linear-gradient(90deg, #4e73df, #224abe);
        border-radius: 5px 5px 0 0;
    }
    
    /* Icon styles */
    .icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 85px;
        width: 85px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        margin-bottom: 1rem;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
    
    .hover-card:hover .icon-wrapper {
        transform: rotateY(180deg);
        background: rgba(255,255,255,0.25);
    }
    
    /* Button glow effects */
    .btn-glow {
        position: relative;
        z-index: 1;
        overflow: hidden;
        transition: all 0.3s ease;
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    
    .btn-glow:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .btn-glow-primary {
        background-color: #4e73df;
        color: white;
    }
    
    .btn-glow-success {
        background-color: #1cc88a;
        color: white;
    }
    
    /* List item hover */
    .hover-list-item {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .hover-list-item:hover {
        border-left: 3px solid #4e73df;
        background-color: #f8f9fc;
    }
    
    /* Card animations */
    .action-card {
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    /* General styles */
    .shadow {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05) !important;
    }
    
    .rounded {
        border-radius: 15px !important;
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>

@push('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    });
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush
@endsection 