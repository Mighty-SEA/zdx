@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0 text-gray-800">Edit Konten Halaman</h2>
                <div>
                    <a href="{{ url()->previous() == route('admin.page-contents.edit', $pageContent->id) ? route('admin.page-contents.index') : url()->previous() }}" class="btn btn-outline-secondary btn-sm mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <a href="{{ url('/') }}?preview={{ $pageContent->id }}" class="btn btn-info btn-sm" target="_blank">
                        <i class="fas fa-eye mr-1"></i> Lihat di Website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Form Editor (Kolom Kiri) -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-edit mr-1"></i> Editor</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.page-contents.update', $pageContent->id) }}" method="POST" enctype="multipart/form-data" id="contentForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Halaman -->
                        <div class="form-group">
                            <label for="page_key">Halaman <span class="text-danger">*</span></label>
                            <select name="page_key" id="page_key" class="form-control @error('page_key') is-invalid @enderror" required onchange="updatePreview()">
                                <option value="">Pilih Halaman</option>
                                <option value="home" {{ $pageContent->page_key == 'home' ? 'selected' : '' }}>Beranda</option>
                                <option value="about" {{ $pageContent->page_key == 'about' ? 'selected' : '' }}>Tentang Kami</option>
                                <option value="services" {{ $pageContent->page_key == 'services' ? 'selected' : '' }}>Layanan</option>
                                <option value="contact" {{ $pageContent->page_key == 'contact' ? 'selected' : '' }}>Kontak</option>
                                <option value="tracking" {{ $pageContent->page_key == 'tracking' ? 'selected' : '' }}>Tracking</option>
                                <option value="rates" {{ $pageContent->page_key == 'rates' ? 'selected' : '' }}>Tarif</option>
                            </select>
                            @error('page_key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Bagian -->
                        <div class="form-group">
                            <label for="section">Bagian <span class="text-danger">*</span></label>
                            <input type="text" name="section" id="section" class="form-control @error('section') is-invalid @enderror" value="{{ old('section', $pageContent->section) }}" required onchange="updatePreview()" onkeyup="updatePreview()">
                            <small class="form-text text-muted">Bagian dari halaman dimana konten ini akan ditampilkan</small>
                            @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Judul -->
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $pageContent->title) }}" onchange="updatePreview()" onkeyup="updatePreview()">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sub Judul -->
                        <div class="form-group">
                            <label for="subtitle">Sub Judul</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $pageContent->subtitle) }}" onchange="updatePreview()" onkeyup="updatePreview()">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Konten -->
                        <div class="form-group">
                            <label for="content">Konten</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" onchange="updatePreview()">{{ old('content', $pageContent->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Gambar -->
                        <div class="form-group">
                            <label for="image">Gambar (opsional)</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" onchange="previewImage(this)">
                                <label class="custom-file-label" for="image">Pilih file baru</label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($pageContent->image)
                                <div class="mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                        <label class="form-check-label text-danger" for="remove_image">
                                            Hapus gambar saat ini
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Gambar saat ini: {{ basename($pageContent->image) }}</small>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Data Tambahan (JSON) -->
                        <div class="form-group">
                            <label for="extra_data">Data Tambahan (JSON)</label>
                            <textarea name="extra_data" id="extra_data" class="form-control @error('extra_data') is-invalid @enderror" rows="3" onchange="updatePreview()" onkeyup="updatePreview()">{{ old('extra_data', is_array($pageContent->extra_data) || is_object($pageContent->extra_data) ? json_encode($pageContent->extra_data, JSON_PRETTY_PRINT) : $pageContent->extra_data) }}</textarea>
                            <small class="form-text text-muted">Data tambahan dalam format JSON (opsional)</small>
                            @error('extra_data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Urutan -->
                        <div class="form-group">
                            <label for="order">Urutan</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $pageContent->order) }}" min="0" onchange="updatePreview()">
                            <small class="form-text text-muted">Urutan tampilan konten (angka lebih kecil ditampilkan lebih dulu)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Aktif -->
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $pageContent->is_active) ? 'checked' : '' }} onchange="updatePreview()">
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                            <small class="form-text text-muted">Konten akan langsung ditampilkan jika aktif</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Preview (Kolom Kanan) -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-success text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-eye mr-1"></i> Preview</h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-light active" id="previewDesktop">
                            <i class="fas fa-desktop"></i>
                        </button>
                        <button type="button" class="btn btn-outline-light" id="previewTablet">
                            <i class="fas fa-tablet-alt"></i>
                        </button>
                        <button type="button" class="btn btn-outline-light" id="previewMobile">
                            <i class="fas fa-mobile-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Status Preview -->
                    <div class="mb-3 p-2 bg-light border rounded">
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Status: {{ $pageContent->is_active ? '<span class="text-success">Aktif</span>' : '<span class="text-danger">Tidak Aktif</span>' }}</small>
                            <small class="text-muted">ID: {{ $pageContent->id }}</small>
                        </div>
                    </div>
                
                    <div class="preview-container" id="previewDesktopContainer">
                        <div class="border rounded p-3 bg-light" style="min-height: 500px; overflow: auto">
                            <div id="previewContent" class="preview-content">
                                <!-- Preview content will be loaded by JS -->
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
                    <div class="d-flex justify-content-between align-items-center">
                        <small><i class="fas fa-sync-alt mr-1"></i> Preview secara otomatis diperbarui saat Anda mengedit</small>
                        <a href="{{ url('/') }}?preview={{ $pageContent->id }}" target="_blank" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-external-link-alt mr-1"></i> Preview di Website
                        </a>
                    </div>
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
            $('.btn-outline-light').removeClass('active');
            $(this).addClass('active');
        });
        
        $('#previewTablet').click(function() {
            $('.preview-container').addClass('d-none');
            $('#previewTabletContainer').removeClass('d-none');
            $('.btn-outline-light').removeClass('active');
            $(this).addClass('active');
            
            // Copy content from desktop preview
            $('#previewContentTablet').html($('#previewContent').html());
        });
        
        $('#previewMobile').click(function() {
            $('.preview-container').addClass('d-none');
            $('#previewMobileContainer').removeClass('d-none');
            $('.btn-outline-light').removeClass('active');
            $(this).addClass('active');
            
            // Copy content from desktop preview
            $('#previewContentMobile').html($('#previewContent').html());
        });
        
        // Initialize preview on load
        updatePreview();
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
            extraData = {};
        }
        
        // Create preview HTML
        let preview = `
            <div class="preview-page preview-${page} preview-section-${section}">
                <div class="preview-header mb-2 p-2 bg-warning text-dark rounded d-flex justify-content-between align-items-center">
                    <div>
                        <span>Halaman: <strong>${page}</strong> | Bagian: <strong>${section}</strong></span>
                    </div>
                    <span class="badge badge-${$('#is_active').is(':checked') ? 'success' : 'danger'}">
                        ${$('#is_active').is(':checked') ? 'Aktif' : 'Tidak Aktif'}
                    </span>
                </div>
                ${title ? `<h2 class="preview-title">${title}</h2>` : ''}
                ${subtitle ? `<h4 class="preview-subtitle text-muted">${subtitle}</h4>` : ''}
                ${content ? `<div class="preview-content-body mt-3">${content}</div>` : ''}
            </div>
        `;
        
        // Add image to preview if exists
        @if($pageContent->image && !empty($pageContent->image))
        if (!$('#remove_image').is(':checked')) {
            const imagePath = "{{ asset($pageContent->image) }}";
            const imageHtml = `
                <div class="preview-image mt-3 mb-3">
                    <img src="${imagePath}" class="img-fluid border" style="max-height: 200px">
                    <small class="d-block mt-1 text-muted">Gambar saat ini</small>
                </div>
            `;
            
            // Insert after content or after subtitle if no content
            if (content) {
                preview = preview.replace('</div>', imageHtml + '</div>');
            } else if (subtitle) {
                preview = preview.replace('</h4>', '</h4>' + imageHtml);
            } else if (title) {
                preview = preview.replace('</h2>', '</h2>' + imageHtml);
            } else {
                preview = preview.replace('</span>\n                </div>', '</span>\n                </div>' + imageHtml);
            }
        }
        @endif
        
        // Add extra data section if not empty
        if (Object.keys(extraData).length > 0) {
            const extraDataHtml = `
                <div class="preview-extra-data mt-3 pt-3 border-top">
                    <h6 class="text-muted mb-2">Data Tambahan:</h6>
                    <pre class="bg-light p-2 rounded" style="font-size: 0.8rem; max-height: 150px; overflow: auto">${JSON.stringify(extraData, null, 2)}</pre>
                </div>
            `;
            preview += extraDataHtml;
        }
        
        // Update preview containers
        $('#previewContent').html(preview);
        $('#previewContentTablet').html(preview);
        $('#previewContentMobile').html(preview);
    }
    
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                // Add new image to preview
                const imageHtml = `
                    <div class="preview-new-image mt-3 mb-3">
                        <img src="${e.target.result}" class="img-fluid border" style="max-height: 200px">
                        <small class="d-block mt-1 text-success">Gambar baru yang akan diupload</small>
                    </div>
                `;
                
                // Remove old image preview if it exists
                $('.preview-image').remove();
                
                // Find good place to insert image
                if ($('.preview-content-body').length) {
                    $('.preview-content-body').append(imageHtml);
                } else {
                    $('#previewContent').append(imageHtml);
                }
                
                // Update custom file label
                $('.custom-file-label').text(input.files[0].name);
            }
            
            reader.readAsDataURL(input.files[0]);
            
            // Uncheck remove image if checked
            $('#remove_image').prop('checked', false);
        }
    }
    
    // Handle remove image checkbox
    $('#remove_image').change(function() {
        if ($(this).is(':checked')) {
            $('.preview-image').addClass('opacity-50');
            $('.preview-image small').text('Gambar akan dihapus').removeClass('text-muted').addClass('text-danger');
        } else {
            $('.preview-image').removeClass('opacity-50');
            $('.preview-image small').text('Gambar saat ini').removeClass('text-danger').addClass('text-muted');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Tombol Preview di website
        const previewBtn = document.querySelector('a[href*="preview"]');
        if (previewBtn) {
            previewBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Simpan form data ke session storage
                const formData = new FormData(document.getElementById('editPageContentForm'));
                const formObject = {};
                for (const [key, value] of formData.entries()) {
                    formObject[key] = value;
                }
                sessionStorage.setItem('previewFormData', JSON.stringify(formObject));
                
                // Buka halaman preview di tab baru
                window.open(this.getAttribute('href'), '_blank');
            });
        }
    });
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
    
    .opacity-50 {
        opacity: 0.5;
    }
    
    .preview-content img {
        max-width: 100%;
    }
</style>
@endpush 