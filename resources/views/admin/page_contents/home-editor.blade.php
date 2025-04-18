@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <!-- Navbar navigasi halaman yang lebih modern -->
    <div class="bg-white shadow-sm mb-0 sticky-top">
        <div class="d-flex justify-content-between align-items-center px-4 py-3">
            <h4 class="m-0 fw-bold"><i class="fas fa-edit me-2 text-primary"></i>Editor Konten Halaman</h4>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="button" class="btn btn-success" id="saveAllChanges">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
        
        <!-- Navigasi Halaman dengan style yang lebih baik -->
        <div class="px-4 py-2 bg-light border-top border-bottom">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link active rounded-pill px-3" href="#" data-page="home">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3" href="#" data-page="about">
                        <i class="fas fa-info-circle me-1"></i> Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3" href="#" data-page="services">
                        <i class="fas fa-truck me-1"></i> Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3" href="#" data-page="contact">
                        <i class="fas fa-phone me-1"></i> Kontak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3" href="#" data-page="footer">
                        <i class="fas fa-copyright me-1"></i> Footer
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Navigasi Bagian dengan style yang lebih konsisten -->
        <div class="px-4 py-2 border-bottom bg-white">
            <ul class="nav nav-tabs" id="sectionTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-section="hero">
                        <i class="fas fa-image me-1"></i> Hero
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="stats">
                        <i class="fas fa-chart-bar me-1"></i> Statistik
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="services">
                        <i class="fas fa-cog me-1"></i> Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="testimonials">
                        <i class="fas fa-quote-right me-1"></i> Testimoni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="cta">
                        <i class="fas fa-bullhorn me-1"></i> CTA
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Container Editor dan Preview yang direformasi -->
    <div class="row m-0 h-100">
        <!-- Editor Form Area -->
        <div class="col-md-5 p-0 border-end bg-white overflow-auto" style="height: calc(100vh - 143px);">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="border-start border-primary ps-2 m-0">Edit Konten</h5>
                    <span class="badge bg-primary rounded-pill">
                        <i class="fas fa-pencil-alt me-1"></i> Hero Section
                    </span>
                </div>
                
                <form id="contentEditForm" class="needs-validation" novalidate>
                    <input type="hidden" name="section" value="hero">
                    <input type="hidden" name="page_key" value="home">
                    
                    <!-- Form Hero Section -->
                    <div id="hero-form">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Judul Hero</label>
                            <input type="text" class="form-control form-control-lg" name="title" id="hero_title" 
                                value="{{ $heroContent->title ?? 'Solusi Pengiriman' }}" required>
                            <div class="form-text">Judul utama yang akan ditampilkan di bagian hero</div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Sub Judul</label>
                            <input type="text" class="form-control" name="subtitle" id="hero_subtitle" 
                                value="{{ $heroContent->subtitle ?? 'Cepat & Terpercaya' }}">
                            <div class="form-text">Teks pendukung di bawah judul utama</div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Konten</label>
                            <textarea class="form-control" name="content" id="hero_content" rows="3">{{ $heroContent->content ?? 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu' }}</textarea>
                            <div class="form-text">Deskripsi lengkap untuk bagian hero</div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Teks Tombol Lacak</label>
                                <input type="text" class="form-control" name="cta_tracking_text" id="hero_cta_tracking_text" 
                                    value="{{ $heroContent->extra_data['cta_tracking_text'] ?? 'Lacak Pengiriman' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Teks Tombol Tarif</label>
                                <input type="text" class="form-control" name="cta_tarif_text" id="hero_cta_tarif_text" 
                                    value="{{ $heroContent->extra_data['cta_tarif_text'] ?? 'Cek Tarif' }}">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Gambar Hero (Opsional)</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="hero_image" name="image">
                                <button class="btn btn-outline-secondary" type="button">Browse</button>
                            </div>
                            <div class="form-text">Ukuran yang direkomendasikan: 800x600px, format: JPG, PNG</div>
                            
                            @if(!empty($heroContent->image))
                            <div class="d-flex align-items-center mt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="removeHeroImage" name="remove_image">
                                    <label class="form-check-label" for="removeHeroImage">Hapus gambar saat ini</label>
                                </div>
                                <img src="{{ asset('storage/'.$heroContent->image) }}" alt="Current Image" class="img-thumbnail ms-3" style="height: 60px;">
                            </div>
                            @endif
                        </div>
                        
                        <div class="border-top pt-4 mt-4">
                            <button type="button" class="btn btn-primary" id="updateHeroContent">
                                <i class="fas fa-sync-alt me-1"></i> Update Konten
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="resetHeroContent">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                    
                    <!-- Form Stats Section (tersembunyi) -->
                    <div id="stats-form" style="display: none;">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Judul Statistik</label>
                            <input type="text" class="form-control" name="title" id="stats_title" 
                                value="{{ $statsContent->title ?? 'Statistik Kami' }}">
                        </div>
                        
                        <div class="row">
                            @for($i = 0; $i < 4; $i++)
                            <div class="col-md-6 mb-4">
                                <div class="card border">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="m-0">Item #{{ $i+1 }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Label</label>
                                            <input type="text" class="form-control" 
                                                name="stats[{{ $i }}][label]" 
                                                id="stats_label_{{ $i }}" 
                                                value="{{ $statsContent->extra_data['stats'][$i]['label'] ?? 'Label '.($i+1) }}">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Nilai</label>
                                            <input type="text" class="form-control" 
                                                name="stats[{{ $i }}][value]" 
                                                id="stats_value_{{ $i }}" 
                                                value="{{ $statsContent->extra_data['stats'][$i]['value'] ?? '100+' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                        
                        <div class="border-top pt-4 mt-2">
                            <button type="button" class="btn btn-primary" id="updateStatsContent">
                                <i class="fas fa-sync-alt me-1"></i> Update Statistik
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="resetStatsContent">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Preview Area yang lebih modern -->
        <div class="col-md-7 p-0 bg-light overflow-auto" style="height: calc(100vh - 143px);">
            <div class="bg-white border-bottom px-4 py-3 d-flex justify-content-between">
                <div>
                    <span class="badge bg-secondary">Preview:</span> 
                    <span class="fw-bold text-primary" id="currentPage">Beranda</span> - 
                    <span class="fw-bold" id="currentSection">Hero</span>
                </div>
                <div>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary active" data-device="desktop">
                            <i class="fas fa-desktop"></i>
                        </button>
                        <button class="btn btn-outline-primary" data-device="tablet">
                            <i class="fas fa-tablet-alt"></i>
                        </button>
                        <button class="btn btn-outline-primary" data-device="mobile">
                            <i class="fas fa-mobile-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Live Preview Area dengan UI yang lebih baik -->
            <div id="previewArea" class="p-4">
                <!-- Hero Section Preview -->
                <div class="section-preview shadow-sm" id="hero-preview">
                    <div class="preview-container">
                        <!-- Hero Background -->
                        <div class="position-relative bg-primary text-white p-4 rounded editable-bg">
                            <!-- Hero Content -->
                            <div class="row align-items-center py-5">
                                <div class="col-lg-6">
                                    <h1 class="display-4 fw-bold editable-text" id="preview_hero_title">
                                        {{ $heroContent->title ?? 'Solusi Pengiriman' }}
                                    </h1>
                                    <h3 id="preview_hero_subtitle">
                                        {{ $heroContent->subtitle ?? 'Cepat & Terpercaya' }}
                                    </h3>
                                    <p class="lead mt-3" id="preview_hero_content">
                                        {{ $heroContent->content ?? 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu' }}
                                    </p>
                                    <div class="mt-4">
                                        <button class="btn btn-warning btn-lg me-2" id="preview_hero_cta_tracking_text">
                                            {{ $heroContent->extra_data['cta_tracking_text'] ?? 'Lacak Pengiriman' }}
                                        </button>
                                        <button class="btn btn-outline-light btn-lg" id="preview_hero_cta_tarif_text">
                                            {{ $heroContent->extra_data['cta_tarif_text'] ?? 'Cek Tarif' }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-4 mt-lg-0 text-center">
                                        <img src="{{ asset('asset/hero-image.png') }}" alt="Hero Image" class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Section Preview -->
                <div class="section-preview d-none shadow-sm" id="stats-preview">
                    <div class="preview-container">
                        <div class="bg-light p-4 rounded my-4">
                            <h2 class="text-center mb-4" id="preview_stats_title">
                                {{ $statsContent->title ?? 'Statistik Kami' }}
                            </h2>
                            
                            <div class="row text-center">
                                @for($i = 0; $i < 4; $i++)
                                <div class="col-md-3 mb-4 mb-md-0">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body">
                                            <h5 id="preview_stats_label_{{ $i }}">
                                                {{ $statsContent->extra_data['stats'][$i]['label'] ?? 'Label '.($i+1) }}
                                            </h5>
                                            <h2 class="display-4 text-primary fw-bold" id="preview_stats_value_{{ $i }}">
                                                {{ $statsContent->extra_data['stats'][$i]['value'] ?? '100+' }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Services Section Preview (Dummy) tetap dipertahankan -->
                <div class="section-preview d-none shadow-sm" id="services-preview">
                    <!-- Konten layanan tetap sama -->
                </div>
                
                <!-- Notifikasi status penyimpanan -->
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
                    <div id="saveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success text-white">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong class="me-auto">Berhasil</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Konten berhasil disimpan!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style untuk form dan elemen editor */
    .form-label.fw-bold {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
    }
    
    .form-text {
        font-size: 0.75rem;
        color: #6c757d;
    }
    
    /* Style untuk panel preview */
    .section-preview {
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
    }
    
    /* Responsif preview berdasarkan device */
    [data-device="desktop"] .preview-container {
        max-width: 100%;
    }
    
    [data-device="tablet"] .preview-container {
        max-width: 768px;
        margin: 0 auto;
    }
    
    [data-device="mobile"] .preview-container {
        max-width: 375px;
        margin: 0 auto;
    }
    
    /* Efek hover untuk tombol dan navigasi */
    .nav-link {
        transition: all 0.2s ease;
    }
    
    .nav-pills .nav-link.active {
        background-color: #4e73df;
    }
    
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #4e73df;
        font-weight: 500;
    }
    
    /* Animasi untuk perubahan konten */
    .editable-text {
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
</style>

@push('scripts')
<script>
    $(document).ready(function() {
        // Menghubungkan form dengan preview
        $('#hero_title').on('input', function() {
            $('#preview_hero_title').text($(this).val());
        });
        
        $('#hero_subtitle').on('input', function() {
            $('#preview_hero_subtitle').text($(this).val());
        });
        
        $('#hero_content').on('input', function() {
            $('#preview_hero_content').text($(this).val());
        });
        
        $('#hero_cta_tracking_text').on('input', function() {
            $('#preview_hero_cta_tracking_text').text($(this).val());
        });
        
        $('#hero_cta_tarif_text').on('input', function() {
            $('#preview_hero_cta_tarif_text').text($(this).val());
        });
        
        // Statistik preview update
        $('#stats_title').on('input', function() {
            $('#preview_stats_title').text($(this).val());
        });
        
        // Stats items
        for (let i = 0; i < 4; i++) {
            $(`#stats_label_${i}`).on('input', function() {
                $(`#preview_stats_label_${i}`).text($(this).val());
            });
            
            $(`#stats_value_${i}`).on('input', function() {
                $(`#preview_stats_value_${i}`).text($(this).val());
            });
        }
        
        // Tab navigasi section
        $('#sectionTabs .nav-link').on('click', function(e) {
            e.preventDefault();
            
            // Aktifkan tab
            $('#sectionTabs .nav-link').removeClass('active');
            $(this).addClass('active');
            
            // Tampilkan konten sesuai
            const section = $(this).data('section');
            $('#currentSection').text(section.charAt(0).toUpperCase() + section.slice(1));
            
            // Sembunyikan semua form dan preview
            $('[id$="-form"]').hide();
            $('.section-preview').addClass('d-none');
            
            // Tampilkan form dan preview yang dipilih
            $(`#${section}-form`).show();
            $(`#${section}-preview`).removeClass('d-none');
        });
        
        // Responsive preview toggle
        $('.btn-group [data-device]').on('click', function() {
            $('.btn-group [data-device]').removeClass('active');
            $(this).addClass('active');
            
            const device = $(this).data('device');
            $('#previewArea').attr('data-device', device);
        });
        
        // Tombol simpan perubahan
        $('#updateHeroContent, #updateStatsContent').on('click', function() {
            $('#saveToast').toast('show');
            // Di sini bisa ditambahkan AJAX untuk menyimpan perubahan
        });
        
        // Tombol simpan semua perubahan
        $('#saveAllChanges').on('click', function() {
            $('#saveToast').toast('show');
            // Di sini bisa ditambahkan AJAX untuk menyimpan semua perubahan
        });
    });
</script>
@endpush
@endsection 