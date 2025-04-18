@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editor Halaman Beranda</h4>
                    <a href="{{ route('admin.page-contents.index') }}" class="btn btn-warning float-right">
                        <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.page-contents.update-home') }}" method="POST">
                        @csrf

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="hero-tab" data-toggle="tab" href="#hero" role="tab" aria-controls="hero" aria-selected="true">
                                    Bagian Hero
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab" aria-controls="stats" aria-selected="false">
                                    Bagian Statistik
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="myTabContent">
                            <!-- Hero Section Content -->
                            <div class="tab-pane fade show active" id="hero" role="tabpanel" aria-labelledby="hero-tab">
                                <h5 class="mb-3">Bagian Utama</h5>
                                
                                <div class="form-group">
                                    <label for="hero_title">Judul</label>
                                    <input type="text" name="hero_title" id="hero_title" class="form-control" 
                                           value="{{ old('hero_title', $heroContent->title ?? '') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="hero_subtitle">Sub Judul</label>
                                    <input type="text" name="hero_subtitle" id="hero_subtitle" class="form-control" 
                                           value="{{ old('hero_subtitle', $heroContent->subtitle ?? '') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="hero_content">Deskripsi</label>
                                    <textarea name="hero_content" id="hero_content" class="form-control" rows="3">{{ old('hero_content', $heroContent->content ?? '') }}</textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hero_cta_tracking_text">Teks Tombol Lacak Pengiriman</label>
                                            <input type="text" name="hero_cta_tracking_text" id="hero_cta_tracking_text" class="form-control" 
                                                   value="{{ old('hero_cta_tracking_text', $heroContent->extra_data['cta_tracking_text'] ?? 'Lacak Pengiriman') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hero_cta_tarif_text">Teks Tombol Cek Tarif</label>
                                            <input type="text" name="hero_cta_tarif_text" id="hero_cta_tarif_text" class="form-control" 
                                                   value="{{ old('hero_cta_tarif_text', $heroContent->extra_data['cta_tarif_text'] ?? 'Cek Tarif') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Stats Section Content -->
                            <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                                <h5 class="mb-3">Bagian Statistik</h5>
                                
                                <div class="row">
                                    @for($i = 0; $i < 4; $i++)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    Statistik {{ $i + 1 }}
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="stats_label_{{ $i }}">Label</label>
                                                        <input type="text" name="stats_label_{{ $i }}" id="stats_label_{{ $i }}" class="form-control" 
                                                               value="{{ old('stats_label_'.$i, $statsContent->extra_data['stats'][$i]['label'] ?? '') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stats_value_{{ $i }}">Nilai</label>
                                                        <input type="text" name="stats_value_{{ $i }}" id="stats_value_{{ $i }}" class="form-control" 
                                                               value="{{ old('stats_value_'.$i, $statsContent->extra_data['stats'][$i]['value'] ?? '') }}">
                                                        <small class="text-muted">Contoh: 10000+, 24/7, 99%, dll.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi editor jika ada
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('hero_content');
        }
    });
</script>
@endpush 