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

                    <!-- Konten dengan tinggi statis -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" class="form-textarea w-full rounded-md" style="height: 500px; min-height: 500px; max-height: 500px;">{{ old('content', $blog->content) }}</textarea>
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
                                        <form action="{{ route('admin.blogs.delete-image', $blog->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-red-500 text-white rounded-full p-2 hover:bg-red-600" onclick="confirmDeleteImage(this)">
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
                                <h5 id="seo-preview-title" class="text-blue-600 font-medium text-base line-clamp-1">{{ $blog->title }} - ZDX Cargo</h5>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // TinyMCE initialization - fallback to basic if API key not set
        if ('{{ env('TINYMCE_API_KEY', '') }}' !== 'no-api-key') {
            tinymce.init({
                selector: '#content',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | formatselect | ' +
                        'bold italic forecolor backcolor | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image media table | ' +
                        'removeformat help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
        } else {
            // Fallback to basic editor if no API key
            const textarea = document.getElementById('content');
            textarea.style.minHeight = '500px';
            textarea.classList.add('p-3');
        }

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
        
        updateCharacterCount();
        document.getElementById('description').addEventListener('input', updateCharacterCount);
        
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
        
        // Confirm image delete
        window.confirmDeleteImage = function(btn) {
            document.getElementById('deleteImageModal').classList.remove('hidden');
            
            // Set the form to be submitted when confirmed
            const form = btn.closest('form');
            document.getElementById('confirmDeleteImage').onclick = function() {
                form.submit();
            };
            
            document.getElementById('cancelDeleteImage').onclick = function() {
                document.getElementById('deleteImageModal').classList.add('hidden');
            };
            
            document.getElementById('deleteImageBackdrop').onclick = function() {
                document.getElementById('deleteImageModal').classList.add('hidden');
            };
        };
        
        // SEO Preview
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
        
        // Event listeners
        document.getElementById('title').addEventListener('input', updateSeoPreview);
        document.getElementById('slug').addEventListener('input', updateSeoPreview);
        document.getElementById('description').addEventListener('input', updateSeoPreview);
        
        // Update karakter metadata dasar dan preview Google
        if (document.getElementById('seo_title')) {
            document.getElementById('seo_title').addEventListener('input', function() {
                document.getElementById('seoTitleCount').textContent = this.value.length;
                updateSeoPreview();
            });
            document.getElementById('seo_title').dispatchEvent(new Event('input'));
        }
        
        if (document.getElementById('seo_description')) {
            document.getElementById('seo_description').addEventListener('input', function() {
                document.getElementById('seoDescriptionCount').textContent = this.value.length;
                updateSeoPreview();
            });
            document.getElementById('seo_description').dispatchEvent(new Event('input'));
        }
        
        // Initial SEO preview update
        updateSeoPreview();
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
            });
            seoTitleInput.dispatchEvent(new Event('input'));
        }
        
        if (seoDescriptionInput) {
            seoDescriptionInput.addEventListener('input', function() {
                seoDescriptionCount.textContent = this.value.length;
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
            
            // Reset class
            element.querySelector('i').className = 'fas fa-circle-check mr-2';
            
            if (status === 'good') {
                element.querySelector('i').classList.add('text-green-500');
                element.querySelector('span').classList.add('text-green-700');
                element.querySelector('span').classList.remove('text-gray-500', 'text-red-500', 'text-yellow-500');
            } else if (status === 'warning') {
                element.querySelector('i').className = 'fas fa-exclamation-circle text-yellow-500 mr-2';
                element.querySelector('span').classList.add('text-yellow-700');
                element.querySelector('span').classList.remove('text-gray-500', 'text-red-500', 'text-green-700');
            } else if (status === 'bad') {
                element.querySelector('i').className = 'fas fa-times-circle text-red-500 mr-2';
                element.querySelector('span').classList.add('text-red-500');
                element.querySelector('span').classList.remove('text-gray-500', 'text-green-700', 'text-yellow-700');
            } else {
                element.querySelector('i').classList.add('text-gray-300');
                element.querySelector('span').classList.add('text-gray-500');
                element.querySelector('span').classList.remove('text-green-700', 'text-red-500', 'text-yellow-700');
            }
        }
        
        // Initial SEO update
        updateSeoAnalysis();
    });
</script>
@endpush 