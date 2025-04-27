@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Blog</h2>
                <p class="text-gray-600 mt-1">Edit artikel blog yang telah dipublikasikan</p>
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
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kolom Kiri - Untuk Info Utama -->
                <div class="col-span-2 space-y-6">
                    <!-- Judul -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Blog <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" class="form-input w-full rounded-md" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <div class="flex items-center">
                            <span class="text-gray-500 bg-gray-100 rounded-l px-3 py-2 border border-r-0 border-gray-300">{{ url('/') }}/</span>
                            <input type="text" name="slug" id="slug" class="form-input rounded-r-md w-full border-l-0" value="{{ old('slug', $blog->slug) }}">
                        </div>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="3" class="form-textarea w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('description', $blog->description) }}</textarea>
                        <div class="flex justify-between">
                            <p class="text-gray-500 text-xs mt-1">Ringkasan singkat yang akan tampil di halaman daftar blog</p>
                            <div class="text-xs text-gray-500 mt-1"><span id="descriptionCounter">0</span>/255 karakter</div>
                        </div>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Table of Contents -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-sm font-medium text-gray-700">Table of Contents</label>
                            <span class="text-xs text-gray-600">Otomatis dari heading (H2, H3)</span>
                                </div>
                        <div id="toc_auto_container" class="bg-gray-50 border border-gray-200 rounded-md p-3">
                            <div class="text-sm text-gray-700">TOC akan dibuat otomatis dari heading (H2, H3) dalam konten.</div>
                            <div id="toc_preview" class="mt-2 text-sm">
                                <div class="text-gray-500 italic text-xs">Preview akan muncul setelah konten artikel ditulis dengan heading.</div>
                            </div>
                        </div>
                        <input type="hidden" name="toc_mode" value="auto">
                    </div>

                    <!-- Konten dengan tinggi statis -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                        <!-- Editor TinyMCE dengan tinggi tetap dan scrollbar - ukuran diatur melalui CSS -->
                        <textarea name="content" id="content" class="form-textarea w-full rounded-md">{{ old('content', $blog->content) }}</textarea>
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
                                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Publikasikan</option>
                            </select>
                        </div>
                        
                        <!-- Penulis -->
                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                            <input type="text" name="author" id="author" class="form-input w-full rounded-md" value="{{ old('author', $blog->author) }}">
                        </div>
                        
                        <!-- Tombol -->
                        <div class="flex justify-between items-center">
                            <button type="submit" name="save_draft" value="1" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-save mr-1"></i> Simpan Draft
                            </button>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-paper-plane mr-1"></i> {{ $blog->status == 'published' ? 'Update' : 'Publikasikan' }}
                            </button>
                        </div>

                        @if($blog->status == 'published')
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="/{{ $blog->slug }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt mr-2"></i> Lihat di Website
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Kategori dan Tag -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4">Kategori & Tag</h3>
                        
                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <input type="text" name="category" id="category" class="form-input w-full rounded-md" value="{{ old('category', $blog->category) }}">
                            <p class="text-gray-500 text-xs mt-1">Contoh: Logistik, Pengiriman, Tips</p>
                        </div>
                        
                        <!-- Tag -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                            <input type="text" name="tags" id="tags" class="form-input w-full rounded-md" value="{{ old('tags', is_array($blog->tags) ? implode(', ', $blog->tags) : $blog->tags) }}" placeholder="kargo, logistik, ekspedisi">
                            <p class="text-gray-500 text-xs mt-1">Pisahkan tag dengan koma</p>
                        </div>
                    </div>
                    
                    <!-- Gambar -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4">Gambar Blog</h3>
                        
                        <div class="mb-4">
                            @if($blog->image)
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                                <div class="relative group">
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="h-40 w-full object-cover rounded">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded">
                                        <form action="{{ route('admin.blogs.delete-image', $blog->id) }}" method="POST" class="image-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-red-500 text-white rounded-full p-2 hover:bg-red-600" onclick="confirmDeleteImage(this.closest('form'))">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $blog->image ? 'Ganti Gambar' : 'Upload Gambar' }}</label>
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
                            <input type="text" name="image_alt" id="image_alt" class="form-input w-full rounded-md" value="{{ old('image_alt', $blog->image_alt) }}">
                            <p class="text-gray-500 text-xs mt-1">Deskripsi gambar untuk SEO dan aksesibilitas</p>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4">Informasi Tambahan</h3>
                        <div class="text-sm text-gray-600">
                            <p class="mb-2">
                                <span class="font-medium">Dibuat Pada:</span> 
                                {{ $blog->created_at->format('d M Y H:i') }}
                            </p>
                            <p class="mb-2">
                                <span class="font-medium">Terakhir Diperbarui:</span> 
                                {{ $blog->updated_at->format('d M Y H:i') }}
                            </p>
                            @if($blog->published_at)
                            <p>
                                <span class="font-medium">Tanggal Publikasi:</span> 
                                {{ $blog->published_at->format('d M Y H:i') }}
                            </p>
                            @endif
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
                            @php
                                $blogSeo = \App\Models\PageSeoSetting::where('page_identifier', 'blog-' . $blog->slug)->first();
                                $focusKeyword = $blogSeo ? $blogSeo->focus_keyword : '';
                            @endphp
                            <input type="text" name="focus_keyword" id="focus_keyword" class="form-input w-full rounded-md" value="{{ old('focus_keyword', $focusKeyword) }}" placeholder="keyword utama artikel">
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
                                    <input type="text" id="seo_title" name="seo_title" 
                                        value="{{ old('seo_title', $blogSeo ? $blogSeo->title : '') }}"
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
                                        placeholder="Deskripsi singkat untuk mesin pencari (kosongkan untuk gunakan deskripsi artikel)">{{ old('seo_description', $blogSeo ? $blogSeo->description : '') }}</textarea>
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
                                <input type="text" id="seo_keywords" name="seo_keywords" 
                                    value="{{ old('seo_keywords', $blogSeo ? $blogSeo->keywords : '') }}"
                                    class="form-input w-full rounded-md text-sm"
                                    placeholder="kata-kunci, seo, artikel, blog">
                            </div>
                        </div>
                        
                        <!-- Preview di Google -->
                        <div class="mb-4 pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-search text-blue-500 mr-2"></i> Preview di Google:
                            </h4>
                            <div class="p-3 bg-white rounded border border-gray-300">
                                <h5 id="seo-preview-title" class="text-blue-600 font-medium text-base line-clamp-1">{{ $blog->title }}</h5>
                                <div class="text-green-600 text-xs mt-1">{{ url('/') }}/<span id="seo-preview-slug">{{ $blog->slug }}</span></div>
                                <p id="seo-preview-desc" class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $blog->description }}</p>
                            </div>
                        </div>
                        
                        <!-- SEO Tips -->
                        <div class="pt-3 border-t border-gray-200">
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

<!-- Modal Konfirmasi Hapus Gambar -->
<div id="deleteImageModal" class="fixed inset-0 hidden z-50">
    <div class="fixed inset-0 bg-black bg-opacity-50" id="deleteImageBackdrop"></div>
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 z-50">
            <div class="p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus Gambar</h3>
                        <p class="mt-2 text-sm text-gray-500">Apakah Anda yakin ingin menghapus gambar ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="cancelDeleteImage" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">Batal</button>
                    <button type="button" id="confirmDeleteImage" class="px-4 py-2 border border-transparent rounded-md text-white bg-red-600 hover:bg-red-700">Hapus Gambar</button>
                </div>
            </div>
        </div>
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
    
    /* TinyMCE Fixed Height dengan Scrollbar */
    /* Pengaturan ini akan membuat editor TinyMCE memiliki ukuran statis dengan scrollbar */
    .tox-tinymce {
        height: 500px !important;
    }
    .tox .tox-edit-area__iframe {
        height: 100% !important;
    }
    .tox .tox-edit-area {
        overflow-y: hidden !important;
    }
    .tox-editor-container {
        display: flex;
        flex-direction: column;
        height: 500px !important;
    }
    
    /* Custom scrollbar for TinyMCE */
    .tox-edit-area__iframe {
        scrollbar-width: thin;
        scrollbar-color: #d1d5db #f3f4f6;
    }
    .tox-edit-area__iframe::-webkit-scrollbar {
        width: 8px;
    }
    .tox-edit-area__iframe::-webkit-scrollbar-track {
        background: #f3f4f6;
    }
    .tox-edit-area__iframe::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
        border-radius: 6px;
        border: 2px solid #f3f4f6;
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
                resize: false,
                autoresize_bottom_margin: 0,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                    'codesample', 'quickbars', 'template', 'pagebreak', 'nonbreaking',
                    'paste', 'print', 'visualchars', 'save', 'directionality'
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

        // Toggle handler for TOC mode
        const tocModeToggle = document.getElementById('toc_mode');
        const tocModeText = document.getElementById('toc_mode_text');
        const tocAutoContainer = document.getElementById('toc_auto_container');
        
        if (tocModeToggle) {
            tocModeToggle.addEventListener('change', function() {
                if (this.checked) {
                    // Mode Auto
                    tocModeText.textContent = 'Otomatis';
                    tocAutoContainer.classList.remove('hidden');
                } else {
                    // Mode Manual
                    tocAutoContainer.classList.add('hidden');
                }
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
        
        // Jika slug dan judul sama, asumsikan bahwa slug belum diubah secara manual
        let slugManuallyChanged = '{{ $blog->slug }}' !== '{{ \Illuminate\Support\Str::slug($blog->title) }}';
        
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                // Hanya update slug otomatis jika belum diubah secara manual
                if (!slugManuallyChanged && titleInput.value) {
                    let slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/(^-|-$)/g, '');
                    slugInput.value = slug;
                }
            });
            
            // Tandai jika slug diubah secara manual
            slugInput.addEventListener('input', function() {
                slugManuallyChanged = true;
            });
        }

        // Character counter for description
        function updateCharacterCount() {
            const description = document.getElementById('description');
            const counter = document.getElementById('descriptionCounter');
            if (!description || !counter) return;
            
            const count = description.value.length;
            counter.textContent = count;
            
            if (count > 255) {
                counter.classList.add('text-red-500');
            } else {
                counter.classList.remove('text-red-500');
            }
        }
        
        // Initial character count update
        const descriptionEl = document.getElementById('description');
        if (descriptionEl) {
            descriptionEl.addEventListener('input', updateCharacterCount);
            updateCharacterCount();
        }
        
        // Form validation - PENTING! Validasi form sebelum submit
        const form = document.getElementById('blogForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Tambahkan konfirmasi sebelum submit untuk mencegah kehilangan data
                const submitButton = document.activeElement;
                const isUpdateAction = (submitButton && !submitButton.name) || 
                                      (submitButton && submitButton.name !== 'save_draft');
                                      
                if (isUpdateAction) {
                    // Konfirmasi untuk update yang bukan save draft
                    if (!confirm('Anda yakin ingin memperbarui artikel ini?')) {
                        e.preventDefault();
                        return false;
                    }
                }
                
                const description = document.getElementById('description').value;
                if (description.length > 255) {
                    e.preventDefault();
                    alert('Deskripsi tidak boleh lebih dari 255 karakter.');
                    return false;
                }
                
                // Set status based on button clicked
                if (submitButton && submitButton.name === 'save_draft') {
                    document.getElementById('status').value = 'draft';
                }
                
                // Prevent double submission
                if (submitButton) {
                    submitButton.disabled = true;
                    setTimeout(() => {
                        submitButton.disabled = false;
                    }, 3000);
                }
            });
        }
        
        // Image preview functions
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
        
        // Perbaikan fungsi confirmDeleteImage
        window.confirmDeleteImage = function(formElement) {
            if (!formElement || !formElement.classList.contains('image-delete-form')) {
                console.error('Form element not found or not valid');
                return;
            }
            
            // Gunakan konfirmasi sederhana daripada modal untuk menghindari konflik
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                formElement.submit();
            }
        };
        
        // Run initial TOC update
        setTimeout(updateTableOfContents, 1000);
    });
</script>
@endpush 