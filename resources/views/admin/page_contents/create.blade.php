@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0 text-gray-800">Tambah Konten Halaman</h2>
                <a href="{{ route('admin.page-contents.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Form Editor (Kolom Kiri) -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit mr-1"></i> Editor</h6>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.page-contents.store') }}" method="POST" enctype="multipart/form-data" id="contentForm">
                        @csrf
                        
                        <!-- Halaman -->
                        <div class="form-group">
                            <label for="page_key">Halaman <span class="text-danger">*</span></label>
                            <select name="page_key" id="page_key" class="form-control @error('page_key') is-invalid @enderror" required onchange="updatePreview()">
                                <option value="">Pilih Halaman</option>
                                <option value="home">Beranda</option>
                                <option value="about">Tentang Kami</option>
                                <option value="services">Layanan</option>
                                <option value="contact">Kontak</option>
                                <option value="tracking">Tracking</option>
                                <option value="rates">Tarif</option>
                            </select>
                            @error('page_key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Bagian -->
                        <div class="form-group">
                            <label for="section">Bagian <span class="text-danger">*</span></label>
                            <input type="text" name="section" id="section" class="form-control @error('section') is-invalid @enderror" value="{{ old('section') }}" required placeholder="Contoh: hero, about, features" onchange="updatePreview()" onkeyup="updatePreview()">
                            <small class="form-text text-muted">Bagian dari halaman dimana konten ini akan ditampilkan</small>
                            @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Judul -->
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" onchange="updatePreview()" onkeyup="updatePreview()">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sub Judul -->
                        <div class="form-group">
                            <label for="subtitle">Sub Judul</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle') }}" onchange="updatePreview()" onkeyup="updatePreview()">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Konten -->
                        <div class="form-group">
                            <label for="content">Konten</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" onchange="updatePreview()">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Gambar -->
                        <div class="form-group">
                            <label for="image">Gambar (opsional)</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" onchange="previewImage(this)">
                                <label class="custom-file-label" for="image">Pilih file</label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Data Tambahan (JSON) -->
                        <div class="form-group">
                            <label for="extra_data">Data Tambahan (JSON)</label>
                            <textarea name="extra_data" id="extra_data" class="form-control @error('extra_data') is-invalid @enderror" rows="3" placeholder='{"key": "value"}' onchange="updatePreview()" onkeyup="updatePreview()">{{ old('extra_data') }}</textarea>
                            <small class="form-text text-muted">Data tambahan dalam format JSON (opsional)</small>
                            @error('extra_data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Urutan -->
                        <div class="form-group">
                            <label for="order">Urutan</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 1) }}" min="0" onchange="updatePreview()">
                            <small class="form-text text-muted">Urutan tampilan konten (angka lebih kecil ditampilkan lebih dulu)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Aktif -->
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} onchange="updatePreview()">
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                            <small class="form-text text-muted">Konten akan langsung ditampilkan jika aktif</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Preview (Kolom Kanan) -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-eye mr-1"></i> Preview</h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary active" id="previewDesktop">
                            <i class="fas fa-desktop"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="previewTablet">
                            <i class="fas fa-tablet-alt"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="previewMobile">
                            <i class="fas fa-mobile-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="preview-container" id="previewDesktopContainer">
                        <div class="border rounded p-3 bg-light" style="min-height: 500px; overflow: auto">
                            <div id="previewContent" class="preview-content">
                                <div class="text-center text-muted py-5">
                                    <i class="fas fa-edit fa-2x mb-2"></i>
                                    <p>Preview akan muncul saat Anda mulai mengedit konten</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="preview-container d-none" id="previewTabletContainer">
                        <div class="border rounded mx-auto bg-light" style="width: 768px; max-width: 100%; min-height: 500px; overflow: auto">
                            <div id="previewContentTablet" class="preview-content p-3">
                                <!-- Preview tablet content -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="preview-container d-none" id="previewMobileContainer">
                        <div class="border rounded mx-auto bg-light" style="width: 375px; max-width: 100%; min-height: 500px; overflow: auto">
                            <div id="previewContentMobile" class="preview-content p-3">
                                <!-- Preview mobile content -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small><i class="fas fa-info-circle mr-1"></i> Preview ini hanya perkiraan. Tampilan sebenarnya mungkin berbeda tergantung tema dan konfigurasi website.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('content', {
                height: 300,
                on: {
                    change: function(evt) {
                        updatePreview();
                    }
                }
            });
        }
        
        // Toggle preview devices
        $('#previewDesktop').click(function() {
            $('.preview-container').addClass('d-none');
            $('#previewDesktopContainer').removeClass('d-none');
            $('.btn-outline-secondary').removeClass('active');
            $(this).addClass('active');
        });
        
        $('#previewTablet').click(function() {
            $('.preview-container').addClass('d-none');
            $('#previewTabletContainer').removeClass('d-none');
            $('.btn-outline-secondary').removeClass('active');
            $(this).addClass('active');
            
            // Copy content from desktop preview to tablet
            $('#previewContentTablet').html($('#previewContent').html());
        });
        
        $('#previewMobile').click(function() {
            $('.preview-container').addClass('d-none');
            $('#previewMobileContainer').removeClass('d-none');
            $('.btn-outline-secondary').removeClass('active');
            $(this).addClass('active');
            
            // Copy content from desktop preview to mobile
            $('#previewContentMobile').html($('#previewContent').html());
        });
    });
    
    function updatePreview() {
        // Get values from form
        const page = $('#page_key').val() || 'home';
        const section = $('#section').val() || 'section';
        const title = $('#title').val() || '';
        const subtitle = $('#subtitle').val() || '';
        let content = '';
        
        // Check if CKEDITOR is initialized
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
            content = CKEDITOR.instances.content.getData();
        } else {
            content = $('#content').val() || '';
        }
        
        // Check if extra data is valid JSON
        let extraData = {};
        try {
            const extraDataRaw = $('#extra_data').val();
            if (extraDataRaw) {
                extraData = JSON.parse(extraDataRaw);
            }
        } catch (e) {
            console.warn('Invalid JSON in extra data');
        }
        
        // If everything is empty, show placeholder
        if (!title && !subtitle && !content) {
            $('#previewContent').html(`
                <div class="text-center text-muted py-5">
                    <i class="fas fa-edit fa-2x mb-2"></i>
                    <p>Preview akan muncul saat Anda mulai mengedit konten</p>
                </div>
            `);
            return;
        }
        
        // Create preview
        let preview = `
            <div class="preview-page preview-${page} preview-section-${section}">
                <div class="preview-header mb-2 p-2 bg-warning text-dark rounded">
                    Halaman: <strong>${page}</strong> | Bagian: <strong>${section}</strong>
                </div>
                ${title ? `<h2 class="preview-title">${title}</h2>` : ''}
                ${subtitle ? `<h4 class="preview-subtitle text-muted">${subtitle}</h4>` : ''}
                ${content ? `<div class="preview-content-body mt-3">${content}</div>` : ''}
            </div>
        `;
        
        // Update preview containers
        $('#previewContent').html(preview);
        $('#previewContentTablet').html(preview);
        $('#previewContentMobile').html(preview);
    }
    
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                // Add image to preview
                $('#previewContent .preview-content-body').append(`
                    <div class="preview-image mt-3">
                        <img src="${e.target.result}" class="img-fluid border" style="max-height: 200px">
                    </div>
                `);
                
                // Update labels
                $('.custom-file-label').text(input.files[0].name);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function resetForm() {
        document.getElementById('contentForm').reset();
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
            CKEDITOR.instances.content.setData('');
        }
        updatePreview();
    }
</script>
@endpush

@push('styles')
<style>
    .preview-container {
        transition: all 0.3s ease;
    }
    
    .preview-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: #333;
    }
    
    .preview-subtitle {
        font-size: 1.25rem;
        font-weight: normal;
        color: #666;
    }
</style>
@endpush 