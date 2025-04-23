@extends('layouts.admin')

@section('title', 'Tambah Blog Baru')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Blog Baru</h2>
                <p class="text-gray-600 mt-1">Buat artikel blog baru untuk ditampilkan di website Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.blogs') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden p-6">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kolom Kiri - Untuk Info Utama -->
                <div class="col-span-2 space-y-6">
                    <!-- Judul -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Blog <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" class="form-input w-full rounded-md" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug <span class="text-gray-400 text-xs">(otomatis dibuat dari judul)</span></label>
                        <div class="flex items-center">
                            <span class="text-gray-500 bg-gray-100 rounded-l px-3 py-2 border border-r-0 border-gray-300">{{ url('/') }}/</span>
                            <input type="text" name="slug" id="slug" class="form-input rounded-r-md w-full border-l-0" value="{{ old('slug') }}">
                        </div>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Deskripsi singkat untuk blog ini">{{ old('description') }}</textarea>
                            <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                <span id="descriptionCounter">0</span>/255
                            </div>
                        </div>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Deskripsi singkat tentang blog ini (maksimal 255 karakter).</p>
                    </div>

                    <!-- TOC (Table of Contents) -->
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-gray-700 text-sm font-medium">Daftar Isi (TOC)</label>
                            <span class="text-xs text-gray-600">Otomatis dari heading (H2, H3)</span>
                        </div>
                        
                        <!-- Auto TOC preview -->
                        <div id="toc_auto_container" class="border border-gray-300 rounded-md p-3 bg-gray-50">
                            <div id="toc_preview" class="text-sm">
                                <div class="text-gray-500 italic text-xs">Daftar isi otomatis akan muncul di sini setelah Anda menambahkan heading (H2, H3) ke konten.</div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">TOC otomatis akan dibuat dari heading H2 dan H3 di konten Anda.</p>
                        </div>
                        <input type="hidden" name="toc_mode" value="auto">
                    </div>

                    <!-- Konten dengan tinggi statis -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" class="form-textarea w-full rounded-md" style="height: 500px; min-height: 500px; max-height: 500px;">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan - Untuk Pengaturan -->
                <div class="col-span-1 space-y-6">
                    <!-- Publikasi -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4">Publikasi</h3>
                        
                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="form-select w-full rounded-md">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' || old('status') == null ? 'selected' : '' }}>Publikasikan</option>
                            </select>
                        </div>
                        
                        <!-- Penulis -->
                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                            <input type="text" name="author" id="author" class="form-input w-full rounded-md" value="{{ old('author') ?? (auth()->check() ? auth()->user()->name : 'Admin') }}">
                        </div>
                        
                        <!-- Tombol -->
                        <div class="flex justify-between items-center">
                            <button type="submit" name="save_draft" value="1" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-save mr-1"></i> Simpan Draft
                            </button>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-paper-plane mr-1"></i> Publikasikan
                            </button>
                        </div>
                    </div>

                    <!-- Kategori dan Tag -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4">Kategori & Tag</h3>
                        
                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <input type="text" name="category" id="category" class="form-input w-full rounded-md" value="{{ old('category') }}">
                            <p class="text-gray-500 text-xs mt-1">Contoh: Logistik, Pengiriman, Tips</p>
                        </div>
                        
                        <!-- Tag -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                            <input type="text" name="tags" id="tags" class="form-input w-full rounded-md" value="{{ old('tags') }}" placeholder="kargo, logistik, ekspedisi">
                            <p class="text-gray-500 text-xs mt-1">Pisahkan tag dengan koma</p>
                        </div>
                    </div>
                    
                    <!-- Gambar -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4">Gambar Blog</h3>
                        
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 transition-all hover:border-blue-400">
                                <div class="text-center" id="image-preview-container">
                                    <img id="image-preview" src="" alt="Preview" class="mx-auto mb-2 hidden max-h-40 object-cover rounded">
                                    <label for="image" class="cursor-pointer flex flex-col items-center justify-center">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                        <span class="text-sm text-gray-500">Klik untuk upload gambar</span>
                                        <span class="text-xs text-gray-400 mt-1">JPG, PNG, atau GIF (Maks. 2MB)</span>
                                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage()">
                                    </label>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="image_alt" class="block text-sm font-medium text-gray-700 mb-1">Teks Alt Gambar</label>
                            <input type="text" name="image_alt" id="image_alt" class="form-input w-full rounded-md" value="{{ old('image_alt') }}">
                            <p class="text-gray-500 text-xs mt-1">Deskripsi gambar untuk SEO dan aksesibilitas</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bagian SEO Optimization (2 baris) dipindahkan ke bawah -->
            <div class="mt-8 border-t pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri - Focus Keyword dan Metadata -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4 flex items-center justify-between">
                            <span><i class="fas fa-chart-line text-blue-500 mr-1"></i> SEO Optimization</span>
                            <span class="text-sm bg-gray-200 text-gray-700 py-1 px-2 rounded-full" id="seo-score">0%</span>
                        </h3>
                        
                        <!-- Focus Keyword -->
                        <div class="mb-4">
                            <label for="focus_keyword" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-key text-blue-500 mr-1"></i> Focus Keyword
                            </label>
                            <input type="text" name="focus_keyword" id="focus_keyword" class="form-input w-full rounded-md" value="{{ old('focus_keyword') }}" placeholder="keyword utama artikel">
                            <p class="text-gray-500 text-xs mt-1">Kata kunci yang menjadi fokus optimasi SEO artikel ini</p>
                        </div>
                        
                        <!-- Metadata Dasar -->
                        <div class="mb-4 pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-search text-blue-500 mr-2"></i> Metadata Dasar:
                            </h4>
                            
                            <!-- Title Override -->
                            <div class="mb-3">
                                <label for="seo_title" class="block text-xs font-medium text-gray-700 mb-1">
                                    Title <span class="text-xs text-gray-500">(maks. 60 karakter)</span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="seo_title" name="seo_title" value="{{ old('seo_title') }}"
                                        class="form-input w-full rounded-md text-sm"
                                        maxlength="100"
                                        placeholder="Judul untuk mesin pencari (kosongkan untuk gunakan judul artikel)">
                                    <span class="absolute right-2 bottom-2 text-xs text-gray-500">
                                        <span id="seoTitleCount">0</span>/60
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Meta Description Override -->
                            <div class="mb-3">
                                <label for="seo_description" class="block text-xs font-medium text-gray-700 mb-1">
                                    Meta Description <span class="text-xs text-gray-500">(maks. 160 karakter)</span>
                                </label>
                                <div class="relative">
                                    <textarea id="seo_description" name="seo_description" rows="2"
                                        class="form-textarea w-full rounded-md text-sm"
                                        maxlength="255"
                                        placeholder="Deskripsi singkat untuk mesin pencari (kosongkan untuk gunakan deskripsi artikel)">{{ old('seo_description') }}</textarea>
                                    <span class="absolute right-2 bottom-2 text-xs text-gray-500">
                                        <span id="seoDescriptionCount">0</span>/160
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Meta Keywords -->
                            <div class="mb-3">
                                <label for="seo_keywords" class="block text-xs font-medium text-gray-700 mb-1">
                                    Meta Keywords <span class="text-xs text-gray-500">(pisahkan dengan koma)</span>
                                </label>
                                <input type="text" id="seo_keywords" name="seo_keywords" value="{{ old('seo_keywords') }}"
                                    class="form-input w-full rounded-md text-sm"
                                    placeholder="kata-kunci, seo, artikel, blog">
                            </div>
                        </div>
                        
                        <!-- Preview di Google - dipindahkan ke sini dari kolom kanan -->
                        <div class="mb-4 pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-search text-blue-500 mr-2"></i> Preview di Google:
                            </h4>
                            <div class="p-3 bg-white rounded border border-gray-300">
                                <h5 id="seo-preview-title" class="text-blue-600 font-medium text-base line-clamp-1">Preview Judul - ZDX Cargo</h5>
                                <div class="text-green-600 text-xs mt-1">{{ url('/') }}/<span id="seo-preview-slug">preview-slug</span></div>
                                <p id="seo-preview-desc" class="text-gray-600 text-sm mt-1 line-clamp-2">Preview deskripsi akan muncul di sini.</p>
                            </div>
                        </div>
                        
                        <!-- SEO Tips -->
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Tips:
                            </h4>
                            <div id="seo-tips" class="text-xs text-gray-600 bg-yellow-50 p-3 rounded">
                                Masukkan focus keyword untuk mulai analisis SEO.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kolom Kanan - SEO Checklist -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-blue-500 mr-2"></i> SEO Checklist:
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <!-- Kolom Checklist Kiri -->
                            <div class="space-y-3">
                                <div class="flex items-center" id="keyword-presence">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Keyword dalam konten</span>
                                </div>
                                
                                <div class="flex items-center" id="keyword-title">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Keyword dalam judul</span>
                                </div>
                                
                                <div class="flex items-center" id="keyword-desc">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Keyword dalam deskripsi</span>
                                </div>
                                
                                <div class="flex items-center" id="keyword-density">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Kepadatan keyword (1-3%)</span>
                                </div>
                                
                                <div class="flex items-center" id="content-length">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Panjang konten (min. 300 kata)</span>
                                </div>
                            </div>
                            
                            <!-- Kolom Checklist Kanan -->
                            <div class="space-y-3">
                                <div class="flex items-center" id="seo-title-length">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Panjang judul (50-60 karakter)</span>
                                </div>
                                
                                <div class="flex items-center" id="seo-desc-length">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Panjang deskripsi (120-160 karakter)</span>
                                </div>
                                
                                <div class="flex items-center" id="header-presence">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Heading (H2, H3) dengan keyword</span>
                                </div>

                                <div class="flex items-center" id="image-alt">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Alt text pada gambar</span>
                                </div>
                                
                                <div class="flex items-center" id="url-friendly">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">URL yang SEO friendly</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    /* Toggle Switch */
    .toggle-checkbox:checked {
        right: 0;
        transform: translateX(100%);
        border-color: #3b82f6;
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #3b82f6;
    }
    .toggle-label, .toggle-checkbox {
        transition: all 0.3s ease-in-out;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // TinyMCE initialization - fallback to basic if API key not set
        let editor;

        if ('{{ env('TINYMCE_API_KEY', '') }}' !== 'no-api-key') {
            tinymce.init({
                selector: '#content',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                    'codesample', 'quickbars', 'template', 'pagebreak', 'nonbreaking',
                    'paste', 'print', 'visualchars', 'save', 'directionality', 'autoresize'
                ],
                toolbar: 'undo redo | blocks | formatselect | ' +
                        'bold italic forecolor backcolor emoticons | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image media table codesample | ' +
                        'visualblocks fullscreen preview | ' +
                        'pagebreak nonbreaking | removeformat help',
                formats: {
                    h1: { block: 'h1', wrapper: false },
                    h2: { block: 'h2', wrapper: false },
                    h3: { block: 'h3', wrapper: false },
                    h4: { block: 'h4', wrapper: false },
                },
                style_formats: [
                    { title: 'Headings', items: [
                        { title: 'Heading 1', format: 'h1' },
                        { title: 'Heading 2', format: 'h2' },
                        { title: 'Heading 3', format: 'h3' },
                        { title: 'Heading 4', format: 'h4' },
                        { title: 'Heading 5', format: 'h5' },
                        { title: 'Heading 6', format: 'h6' }
                    ]},
                    { title: 'Inline', items: [
                        { title: 'Bold', format: 'bold' },
                        { title: 'Italic', format: 'italic' },
                        { title: 'Underline', format: 'underline' },
                        { title: 'Strikethrough', format: 'strikethrough' },
                        { title: 'Code', format: 'code' }
                    ]},
                    { title: 'Blocks', items: [
                        { title: 'Paragraph', format: 'p' },
                        { title: 'Blockquote', format: 'blockquote' },
                        { title: 'Div', format: 'div' },
                        { title: 'Pre', format: 'pre' }
                    ]}
                ],
                toolbar_mode: 'sliding',
                toolbar_sticky: true,
                content_style: `
                    body { 
                        font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; 
                        font-size: 16px; 
                        line-height: 1.6; 
                        padding: 20px;
                    }
                    h1 {
                        font-size: 2.25rem;
                        font-weight: 700;
                        margin-top: 2.5rem;
                        margin-bottom: 1.25rem;
                        color: #1f2937;
                    }
                    img { 
                        max-width: 100%; 
                        height: auto;
                        border-radius: 4px;
                    }
                    pre {
                        background-color: #f5f5f5;
                        padding: 12px;
                        border-radius: 4px;
                        overflow-x: auto;
                    }
                    blockquote {
                        background-color: #f9f9f9;
                        padding: 10px 20px;
                        border-left: 4px solid #ccc;
                        margin: 15px 0;
                    }
                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }
                    table td, table th {
                        border: 1px solid #ddd;
                        padding: 8px;
                    }
                `,
                branding: false,
                promotion: false,
                images_upload_url: '{{ route("admin.tinymce.upload") }}',
                automatic_uploads: true,
                file_picker_types: 'image',
                image_class_list: [
                    {title: 'Responsive', value: 'img-fluid'},
                    {title: 'Left Aligned', value: 'float-left me-3 mb-3'},
                    {title: 'Right Aligned', value: 'float-right ms-3 mb-3'},
                    {title: 'Centered', value: 'mx-auto d-block'},
                    {title: 'No margins', value: 'mb-0'}
                ],
                image_caption: true,
                image_advtab: true,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                extended_valid_elements: 'iframe[src|frameborder|style|scrolling|class|width|height|name|align]',
                setup: function(ed) {
                    editor = ed;
                    // Event listener for content changes to update TOC
                    editor.on('Change', function() {
                        updateTableOfContents();
                    });
                    
                    // Keydown handler untuk menekan tab
                    editor.on('keydown', function(e) {
                        if (e.keyCode === 9) { // Tab key
                            if (e.shiftKey) {
                                editor.execCommand('Outdent');
                            } else {
                                editor.execCommand('Indent');
                            }
                            e.preventDefault();
                            return false;
                        }
                    });
                },
                templates: [
                    {
                        title: 'Callout Box',
                        description: 'Creates a callout box with a title',
                        content: '<div style="background-color: #f8f9fa; border-left: 4px solid #0d6efd; padding: 15px; margin-bottom: 20px;">' +
                                '<h3 style="margin-top: 0; color: #0d6efd;">Judul Callout</h3>' +
                                '<p>Teks callout Anda di sini...</p>' +
                                '</div>'
                    },
                    {
                        title: 'Info Box',
                        description: 'Creates an info box',
                        content: '<div style="background-color: #e8f4f8; border-radius: 5px; padding: 15px; margin-bottom: 20px;">' +
                                '<h4 style="color: #0c5460;"><strong>Info Penting</strong></h4>' +
                                '<p>Info Anda di sini...</p>' +
                                '</div>'
                    },
                    {
                        title: 'Tabel Perbandingan',
                        description: 'Membuat tabel perbandingan sederhana',
                        content: '<table style="width:100%; border-collapse: collapse;">' +
                                '<thead>' +
                                '<tr style="background-color: #f8f9fa;">' +
                                '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Fitur</th>' +
                                '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Opsi A</th>' +
                                '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Opsi B</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                '<tr>' +
                                '<td style="border: 1px solid #ddd; padding: 8px;">Fitur 1</td>' +
                                '<td style="border: 1px solid #ddd; padding: 8px;">Deskripsi</td>' +
                                '<td style="border: 1px solid #ddd; padding: 8px;">Deskripsi</td>' +
                                '</tr>' +
                                '<tr style="background-color: #f8f9fa;">' +
                                '<td style="border: 1px solid #ddd; padding: 8px;">Fitur 2</td>' +
                                '<td style="border: 1px solid #ddd; padding: 8px;">Deskripsi</td>' +
                                '<td style="border: 1px solid #ddd; padding: 8px;">Deskripsi</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>'
                    }
                ]
            });
        } else {
            // Fallback to basic editor if no API key
            const textarea = document.getElementById('content');
            textarea.style.minHeight = '500px';
            textarea.classList.add('p-3');
            
            // Use textarea for TOC updates
            textarea.addEventListener('input', function() {
                updateTableOfContents();
            });
        }

        // Function to update the TOC automatically
        function updateTableOfContents() {
            const tocPreview = document.getElementById('toc_preview');
            if (!tocPreview) return;
            
            let content = '';
            
            if (window.tinymce && tinymce.get('content')) {
                content = tinymce.get('content').getContent();
            } else {
                content = document.getElementById('content').value;
            }
            
            // Parse the content to find headings
            const parser = new DOMParser();
            const doc = parser.parseFromString(content, 'text/html');
            const h2Elements = Array.from(doc.querySelectorAll('h2'));
            const h3Elements = Array.from(doc.querySelectorAll('h3'));
            
            if (h2Elements.length === 0 && h3Elements.length === 0) {
                tocPreview.innerHTML = '<div class="text-gray-500 italic text-xs">Tidak ada heading yang ditemukan. Tambahkan heading H2 atau H3 ke konten untuk membuat TOC.</div>';
                return;
            }
            
            // Create TOC structure
            let tocHtml = '<ul class="list-disc pl-5 space-y-1">';
            let contentChanged = false;
            
            // Process H2 headings first
            h2Elements.forEach((h2, index) => {
                const headingText = h2.textContent.trim();
                if (!headingText) return;
                
                // Buat ID yang konsisten dari teks heading
                const headingSlug = headingText.toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                const headingId = `h2-${headingSlug}`;
                
                // Periksa apakah ID telah berubah
                if (h2.id !== headingId) {
                    h2.id = headingId;
                    contentChanged = true;
                }
                
                tocHtml += `<li><a href="#${headingId}" class="text-blue-600 hover:underline">${headingText}</a>`;
                
                // Check for H3 headings that follow this H2
                const nextH2 = h2Elements[index + 1];
                const h3Subset = h3Elements.filter(h3 => {
                    if (!nextH2) return h2.compareDocumentPosition(h3) & Node.DOCUMENT_POSITION_FOLLOWING;
                    return (h2.compareDocumentPosition(h3) & Node.DOCUMENT_POSITION_FOLLOWING) && 
                           (nextH2.compareDocumentPosition(h3) & Node.DOCUMENT_POSITION_PRECEDING);
                });
                
                if (h3Subset.length > 0) {
                    tocHtml += '<ul class="pl-4 mt-1 space-y-1">';
                    h3Subset.forEach((h3, subIndex) => {
                        const subHeadingText = h3.textContent.trim();
                        if (!subHeadingText) return;
                        
                        // Buat ID yang konsisten untuk sub-heading
                        const subHeadingSlug = subHeadingText.toLowerCase()
                            .replace(/[^a-z0-9]+/g, '-')
                            .replace(/(^-|-$)/g, '');
                        const subHeadingId = `h3-${headingSlug}-${subHeadingSlug}`;
                        
                        // Periksa apakah ID telah berubah
                        if (h3.id !== subHeadingId) {
                            h3.id = subHeadingId;
                            contentChanged = true;
                        }
                        
                        tocHtml += `<li><a href="#${subHeadingId}" class="text-blue-600 hover:underline">${subHeadingText}</a></li>`;
                    });
                    tocHtml += '</ul>';
                }
                
                tocHtml += '</li>';
            });
            
            tocHtml += '</ul>';
            
            // Update the preview
            tocPreview.innerHTML = tocHtml;
            
            // Update the actual content in the editor with the ID attributes hanya jika ada perubahan
            if (contentChanged && window.tinymce && tinymce.get('content')) {
                // Mencegah loop tak terbatas dengan menonaktifkan event handler sementara
                tinymce.get('content').off('Change');
                
                // Perbarui konten dengan ID yang benar
                const updatedContent = doc.body.innerHTML;
                tinymce.get('content').setContent(updatedContent);
                
                // Aktifkan kembali event handler setelah penundaan
                setTimeout(() => {
                    tinymce.get('content').on('Change', updateTableOfContents);
                }, 300);
            }
        }

        // Slug generator
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        // Variable untuk melacak apakah user sudah mengedit slug secara manual
        let slugManuallyChanged = false;
        
        titleInput.addEventListener('input', function() {
            updateSeoPreview();
            
            // Hanya update slug otomatis jika belum diubah secara manual
            if (!slugManuallyChanged && titleInput.value) {
                let slug = this.value.toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                slugInput.value = slug;
            }
        });
        
        // Tambahkan event listener untuk menandai slug sudah diubah manual
        slugInput.addEventListener('input', function() {
            slugManuallyChanged = true;
            updateSeoPreview();
        });

        document.getElementById('description').addEventListener('input', function() {
            updateSeoPreview();
            updateCharacterCount();
        });
        
        // Character counter for description
        function updateCharacterCount() {
            const description = document.getElementById('description').value;
            const counter = document.getElementById('descriptionCounter');
            const count = description.length;
            counter.textContent = count;
            
            if (count > 255) {
                counter.classList.add('text-red-500');
            } else {
                counter.classList.remove('text-red-500');
            }
        }
        
        // Form submission handler
        const form = document.getElementById('blogForm');
        form.addEventListener('submit', function(e) {
            const description = document.getElementById('description').value;
            if (description.length > 255) {
                e.preventDefault();
                alert('Deskripsi tidak boleh lebih dari 255 karakter.');
                return false;
            }
            
            // Set status based on button clicked
            const submitButton = document.activeElement;
            if (submitButton.name === 'save_draft') {
                document.getElementById('status').value = 'draft';
            } else {
                // If publishing, make sure required fields are filled
                if (!titleInput.value.trim()) {
                    e.preventDefault();
                    alert('Judul blog harus diisi');
                    titleInput.focus();
                    return false;
                }
                
                if (!document.getElementById('description').value.trim()) {
                    e.preventDefault();
                    alert('Deskripsi singkat harus diisi');
                    document.getElementById('description').focus();
                    return false;
                }
            }
        });
        
        // Fungsi untuk update preview di Google
        function updateSeoPreview() {
            const title = document.getElementById('title').value || 'Preview Judul';
            const slug = document.getElementById('slug').value || 'preview-slug';
            const description = document.getElementById('description').value || 'Preview deskripsi akan muncul di sini.';
            
            // Update elemen preview Google
            const seoTitleInput = document.getElementById('seo_title');
            const seoDescriptionInput = document.getElementById('seo_description');
            
            const titleForPreview = seoTitleInput && seoTitleInput.value ? seoTitleInput.value : title + ' - ZDX Cargo';
            const descForPreview = seoDescriptionInput && seoDescriptionInput.value ? seoDescriptionInput.value : description;
            
            document.getElementById('seo-preview-title').textContent = titleForPreview;
            document.getElementById('seo-preview-slug').textContent = slug;
            document.getElementById('seo-preview-desc').textContent = descForPreview;
        }

        // Image preview function
        function previewImage() {
            const preview = document.getElementById('image-preview');
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
        
        // Initial update
        updateSeoPreview();
        updateCharacterCount();
        setTimeout(updateTableOfContents, 1000); // Initial TOC update
    });
</script>

<!-- RankMath SEO Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan elemen-elemen yang dibutuhkan
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        const descInput = document.getElementById('description');
        const contentEditor = document.getElementById('content');
        const focusKeywordInput = document.getElementById('focus_keyword');
        const imageAltInput = document.getElementById('image_alt');
        const imageInput = document.getElementById('image');
        
        // Metadata dasar elements
        const seoTitleInput = document.getElementById('seo_title');
        const seoDescriptionInput = document.getElementById('seo_description');
        const seoKeywordsInput = document.getElementById('seo_keywords');
        const seoTitleCount = document.getElementById('seoTitleCount');
        const seoDescriptionCount = document.getElementById('seoDescriptionCount');
        
        // Preview elements
        const seoPreviewTitle = document.getElementById('seo-preview-title');
        const seoPreviewSlug = document.getElementById('seo-preview-slug');
        const seoPreviewDesc = document.getElementById('seo-preview-desc');
        const seoScoreElement = document.getElementById('seo-score');
        const seoTipsElement = document.getElementById('seo-tips');
        
        // SEO Check indicators
        const keywordPresence = document.getElementById('keyword-presence');
        const keywordTitle = document.getElementById('keyword-title');
        const keywordDesc = document.getElementById('keyword-desc');
        const keywordDensity = document.getElementById('keyword-density');
        const contentLength = document.getElementById('content-length');
        const seoTitleLength = document.getElementById('seo-title-length');
        const seoDescLength = document.getElementById('seo-desc-length');
        const headerPresence = document.getElementById('header-presence');
        const imageAlt = document.getElementById('image-alt');
        const urlFriendly = document.getElementById('url-friendly');
        
        // Event listeners untuk update real-time
        [titleInput, slugInput, descInput, focusKeywordInput, imageAltInput, 
         seoTitleInput, seoDescriptionInput, seoKeywordsInput].forEach(input => {
            if (input) {
                input.addEventListener('input', updateSeoAnalysis);
            }
        });
        
        // Update karakter metadata dasar
        if (seoTitleInput) {
            seoTitleInput.addEventListener('input', function() {
                seoTitleCount.textContent = this.value.length;
                updateSeoPreview();
            });
            seoTitleInput.dispatchEvent(new Event('input'));
        }
        
        if (seoDescriptionInput) {
            seoDescriptionInput.addEventListener('input', function() {
                seoDescriptionCount.textContent = this.value.length;
                updateSeoPreview();
            });
            seoDescriptionInput.dispatchEvent(new Event('input'));
        }
        
        if (imageInput) {
            imageInput.addEventListener('change', updateSeoAnalysis);
        }
        
        // Listener untuk TinyMCE jika tersedia
        if (window.tinymce) {
            tinymce.on('AddEditor', function(e) {
                e.editor.on('Change', updateSeoAnalysis);
                e.editor.on('Keyup', updateSeoAnalysis);
            });
            
            if (tinymce.get('content')) {
                tinymce.get('content').on('Change', updateSeoAnalysis);
                tinymce.get('content').on('Keyup', updateSeoAnalysis);
            }
        }
        
        // Update awal
        setTimeout(updateSeoAnalysis, 1000); // Sedikit delay untuk memastikan TinyMCE sudah terinisialisasi
        
        // Fungsi untuk menganalisis SEO
        function updateSeoAnalysis() {
            // Update preview menggunakan custom SEO title/desc jika ada, atau default
            const title = titleInput.value || 'Preview Judul';
            const customTitle = seoTitleInput && seoTitleInput.value ? seoTitleInput.value : title + ' - ZDX Cargo';
            const slug = slugInput.value || 'preview-slug';
            const desc = descInput.value || 'Preview deskripsi akan muncul di sini.';
            const customDesc = seoDescriptionInput && seoDescriptionInput.value ? seoDescriptionInput.value : desc;
            const keyword = focusKeywordInput.value?.trim().toLowerCase();
            
            seoPreviewTitle.textContent = customTitle;
            seoPreviewSlug.textContent = slug;
            seoPreviewDesc.textContent = customDesc;
            
            // Jika tidak ada keyword, reset status
            if (!keyword) {
                resetAllIndicators();
                seoScoreElement.textContent = '0%';
                seoTipsElement.textContent = 'Masukkan focus keyword untuk mulai analisis SEO.';
                return;
            }
            
            // Mulai analisis dengan semua indikator diatur ke 'none'
            resetAllIndicators();
            
            // Dapatkan konten dari TinyMCE atau textarea biasa
            let content = '';
            let contentHtml = '';
            if (window.tinymce && tinymce.get('content')) {
                content = tinymce.get('content').getContent({ format: 'text' }).toLowerCase();
                contentHtml = tinymce.get('content').getContent();
            } else {
                content = contentEditor.value.toLowerCase();
                contentHtml = contentEditor.value;
            }
            
            // Array untuk menyimpan tips
            let tips = [];
            
            // Array untuk menyimpan skor per kriteria
            let scores = {
                total: 0,
                maxPossible: 0
            };
            
            // --- Check 1: Keyword dalam judul ---
            // Cek dalam custom title jika ada, otherwise cek di title normal
            const titleToCheck = seoTitleInput && seoTitleInput.value ? seoTitleInput.value.toLowerCase() : title.toLowerCase();
            const titleCheck = titleToCheck.includes(keyword);
            setIndicatorStatus(keywordTitle, titleCheck ? 'good' : 'bad');
            if (!titleCheck) {
                tips.push('Tambahkan keyword utama ke judul artikel.');
            }
            scores.total += titleCheck ? 10 : 0;
            scores.maxPossible += 10;
            
            // --- Check 2: Keyword dalam deskripsi ---
            // Cek dalam custom description jika ada, otherwise cek di description normal
            const descToCheck = seoDescriptionInput && seoDescriptionInput.value ? seoDescriptionInput.value.toLowerCase() : desc.toLowerCase();
            const descCheck = descToCheck.includes(keyword);
            setIndicatorStatus(keywordDesc, descCheck ? 'good' : 'bad');
            if (!descCheck) {
                tips.push('Tambahkan keyword utama ke deskripsi artikel.');
            }
            scores.total += descCheck ? 10 : 0;
            scores.maxPossible += 10;
            
            // --- Check 3: Keyword dalam konten ---
            const contentCheck = content.includes(keyword);
            setIndicatorStatus(keywordPresence, contentCheck ? 'good' : 'bad');
            if (!contentCheck) {
                tips.push('Pastikan keyword utama muncul di dalam konten artikel.');
            }
            scores.total += contentCheck ? 10 : 0;
            scores.maxPossible += 10;
            
            // --- Check 4: Kepadatan keyword (1-3%) ---
            const wordCount = content.split(/\s+/).length;
            const keywordCount = (content.match(new RegExp(keyword, 'gi')) || []).length;
            const density = (keywordCount / wordCount) * 100;
            
            let densityStatus = 'none';
            if (keywordCount > 0) {
                if (density >= 1 && density <= 3) {
                    densityStatus = 'good';
                    scores.total += 10;
                } else if (density > 0 && density < 1) {
                    densityStatus = 'warning';
                    scores.total += 5;
                    tips.push('Kepadatan keyword kurang dari 1%, tambahkan lebih banyak penggunaan keyword.');
                } else if (density > 3) {
                    densityStatus = 'bad';
                    tips.push('Kepadatan keyword terlalu tinggi (>3%), kurangi penggunaan keyword.');
                }
            } else {
                densityStatus = 'bad';
                tips.push('Keyword utama tidak ditemukan dalam konten.');
            }
            
            setIndicatorStatus(keywordDensity, densityStatus);
            scores.maxPossible += 10;
            
            // --- Check 5: Panjang konten ---
            let contentLengthStatus = 'none';
            if (wordCount >= 300) {
                contentLengthStatus = 'good';
                scores.total += 10;
            } else if (wordCount >= 200) {
                contentLengthStatus = 'warning';
                scores.total += 5;
                tips.push(`Artikel terlalu pendek (${wordCount} kata). Idealnya minimal 300 kata.`);
            } else {
                contentLengthStatus = 'bad';
                tips.push(`Artikel terlalu pendek (${wordCount} kata). Tambahkan lebih banyak konten.`);
            }
            
            setIndicatorStatus(contentLength, contentLengthStatus);
            scores.maxPossible += 10;
            
            // --- Check 6: Panjang judul SEO ---
            // Gunakan custom SEO title jika tersedia
            const seoTitle = seoTitleInput && seoTitleInput.value ? seoTitleInput.value : title + ' - ZDX Cargo';
            const titleLength = seoTitle.length;
            let titleLengthStatus = 'none';
            
            if (titleLength >= 50 && titleLength <= 60) {
                titleLengthStatus = 'good';
                scores.total += 10;
            } else if ((titleLength >= 40 && titleLength < 50) || (titleLength > 60 && titleLength <= 70)) {
                titleLengthStatus = 'warning';
                scores.total += 5;
                tips.push(`Panjang judul (${titleLength} karakter) kurang ideal. Target: 50-60 karakter.`);
            } else {
                titleLengthStatus = 'bad';
                tips.push(`Panjang judul (${titleLength} karakter) tidak optimal. Target: 50-60 karakter.`);
            }
            
            setIndicatorStatus(seoTitleLength, titleLengthStatus);
            scores.maxPossible += 10;
            
            // --- Check 7: Panjang deskripsi ---
            // Gunakan custom SEO description jika tersedia
            const seoDesc = seoDescriptionInput && seoDescriptionInput.value ? seoDescriptionInput.value : desc;
            const descLength = seoDesc.length;
            let descLengthStatus = 'none';
            
            if (descLength >= 120 && descLength <= 160) {
                descLengthStatus = 'good';
                scores.total += 10;
            } else if ((descLength >= 100 && descLength < 120) || (descLength > 160 && descLength <= 180)) {
                descLengthStatus = 'warning';
                scores.total += 5;
                tips.push(`Panjang deskripsi (${descLength} karakter) kurang ideal. Target: 120-160 karakter.`);
            } else {
                descLengthStatus = 'bad';
                tips.push(`Panjang deskripsi (${descLength} karakter) tidak optimal. Target: 120-160 karakter.`);
            }
            
            setIndicatorStatus(seoDescLength, descLengthStatus);
            scores.maxPossible += 10;
            
            // --- Check 8: Heading (H2, H3) dengan keyword ---
            // Parse HTML untuk mencari heading
            const parser = new DOMParser();
            const doc = parser.parseFromString(contentHtml, 'text/html');
            const h2Elements = Array.from(doc.querySelectorAll('h2'));
            const h3Elements = Array.from(doc.querySelectorAll('h3'));
            const headings = [...h2Elements, ...h3Elements];
            
            let headingWithKeyword = false;
            for (const heading of headings) {
                if (heading.textContent.toLowerCase().includes(keyword)) {
                    headingWithKeyword = true;
                    break;
                }
            }
            
            setIndicatorStatus(headerPresence, headingWithKeyword ? 'good' : 'bad');
            if (!headingWithKeyword) {
                tips.push('Tambahkan keyword utama di salah satu heading (H2 atau H3).');
            }
            scores.total += headingWithKeyword ? 10 : 0;
            scores.maxPossible += 10;
            
            // --- Check 9: Alt text pada gambar ---
            const altText = imageAltInput ? imageAltInput.value : '';
            const hasImage = imageInput && imageInput.files.length > 0;
            
            let imageAltStatus = 'none';
            if (hasImage) {
                if (altText && altText.trim() !== '') {
                    if (altText.toLowerCase().includes(keyword)) {
                        imageAltStatus = 'good';
                        scores.total += 10;
                    } else {
                        imageAltStatus = 'warning';
                        scores.total += 5;
                        tips.push('Alt text pada gambar tidak mengandung keyword utama.');
                    }
                } else {
                    imageAltStatus = 'bad';
                    tips.push('Anda memiliki gambar tapi tidak ada alt text. Tambahkan alt text dengan keyword.');
                }
            } else {
                // Periksa gambar di konten
                const contentImages = doc.querySelectorAll('img');
                if (contentImages.length > 0) {
                    let imagesWithAlt = 0;
                    let imagesWithKeywordAlt = 0;
                    
                    contentImages.forEach(img => {
                        const alt = img.getAttribute('alt');
                        if (alt && alt.trim() !== '') {
                            imagesWithAlt++;
                            if (alt.toLowerCase().includes(keyword)) {
                                imagesWithKeywordAlt++;
                            }
                        }
                    });
                    
                    if (imagesWithKeywordAlt > 0) {
                        imageAltStatus = 'good';
                        scores.total += 10;
                    } else if (imagesWithAlt > 0) {
                        imageAltStatus = 'warning';
                        scores.total += 5;
                        tips.push('Gambar dalam konten tidak memiliki alt text dengan keyword utama.');
                    } else {
                        imageAltStatus = 'bad';
                        tips.push('Gambar dalam konten tidak memiliki alt text. Tambahkan alt text dengan keyword.');
                    }
                } else {
                    // Tidak ada gambar
                    imageAltStatus = 'warning';
                    tips.push('Tidak ada gambar di artikel. Pertimbangkan untuk menambahkan gambar dengan alt text.');
                    scores.total += 5;
                }
            }
            
            setIndicatorStatus(imageAlt, imageAltStatus);
            scores.maxPossible += 10;
            
            // --- Check 10: URL SEO friendly ---
            const slugValueClean = slug.replace(/[^a-z0-9-]/g, '');
            const isUrlFriendly = slugValueClean === slug && slug.includes(keyword.replace(/\s+/g, '-'));
            
            setIndicatorStatus(urlFriendly, isUrlFriendly ? 'good' : 'warning');
            if (!isUrlFriendly) {
                tips.push('URL tidak mengandung keyword utama atau mengandung karakter yang tidak SEO friendly.');
            }
            scores.total += isUrlFriendly ? 10 : 5;
            scores.maxPossible += 10;
            
            // Hitung skor total
            const finalScore = Math.round((scores.total / scores.maxPossible) * 100);
            
            // Update UI skor
            seoScoreElement.textContent = `${finalScore}%`;
            
            // Update kelas warna skor
            if (finalScore >= 80) {
                seoScoreElement.className = 'text-sm bg-green-100 text-green-800 py-1 px-2 rounded-full';
            } else if (finalScore >= 50) {
                seoScoreElement.className = 'text-sm bg-yellow-100 text-yellow-800 py-1 px-2 rounded-full';
            } else {
                seoScoreElement.className = 'text-sm bg-red-100 text-red-800 py-1 px-2 rounded-full';
            }
            
            // Tampilkan tips (maksimal 3)
            if (tips.length > 0) {
                seoTipsElement.innerHTML = tips.slice(0, 3).map(tip => `<div class="mb-1">• ${tip}</div>`).join('') + 
                    (tips.length > 3 ? `<div class="mt-2 text-blue-500">+${tips.length - 3} tip lainnya...</div>` : '');
            } else {
                seoTipsElement.textContent = 'Bagus! Artikel Anda telah teroptimasi dengan baik untuk SEO.';
            }
        }
        
        // Fungsi untuk reset indikator
        function resetAllIndicators() {
            const indicators = [
                keywordPresence, keywordTitle, keywordDesc, keywordDensity,
                contentLength, seoTitleLength, seoDescLength, headerPresence,
                imageAlt, urlFriendly
            ];
            
            indicators.forEach(indicator => {
                if (indicator) {
                    setIndicatorStatus(indicator, 'none');
                }
            });
        }
        
        // Fungsi untuk set status indikator
        function setIndicatorStatus(element, status) {
            if (!element) return;
            
            // Hapus semua kelas status
            element.classList.remove('bg-gray-200', 'bg-red-100', 'bg-yellow-100', 'bg-green-100');
            element.classList.remove('text-gray-500', 'text-red-800', 'text-yellow-800', 'text-green-800');
            
            // Tambahkan kelas berdasarkan status
            switch (status) {
                case 'none':
                    element.classList.add('bg-gray-200', 'text-gray-500');
                    break;
                case 'bad':
                    element.classList.add('bg-red-100', 'text-red-800');
                    break;
                case 'warning':
                    element.classList.add('bg-yellow-100', 'text-yellow-800');
                    break;
                case 'good':
                    element.classList.add('bg-green-100', 'text-green-800');
                    break;
            }
        }
        
        // Initial SEO update
        updateSeoAnalysis();
    });
</script>
@endpush 