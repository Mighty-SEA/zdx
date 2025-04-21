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
                <!-- Kolom Kiri -->
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
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="3" class="form-textarea w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('description') }}</textarea>
                        <p class="text-gray-500 text-xs mt-1">Ringkasan singkat dari artikel yang akan tampil di halaman daftar blog (maksimal 255 karakter)</p>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="text-xs text-gray-500 mt-1"><span id="descriptionCounter">0</span>/255 karakter</div>
                    </div>

                    <!-- Konten -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" rows="12" class="form-textarea w-full rounded-md">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-span-1 space-y-6">
                    <!-- Preview -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-3 flex items-center justify-between">
                            <span>Preview</span>
                            <button type="button" id="refreshPreview" class="text-blue-500 hover:text-blue-700 text-sm">
                                <i class="fas fa-sync-alt mr-1"></i> Refresh
                            </button>
                        </h3>
                        <div class="border rounded-lg bg-white p-4">
                            <h2 id="previewTitle" class="text-xl font-bold text-gray-800">Judul Blog</h2>
                            <div id="previewDescription" class="text-gray-600 mt-2 text-sm">Deskripsi singkat akan muncul di sini...</div>
                            <div id="previewImage" class="mt-3 hidden">
                                <img src="" alt="Preview" class="w-full h-32 object-cover rounded">
                            </div>
                        </div>
                    </div>
                    
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
        </form>
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
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
                ],
                toolbar: 'undo redo | styles | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image media table emoticons | removeformat help',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 16px; line-height: 1.6; }',
                branding: false,
                promotion: false,
                images_upload_url: '/admin/upload/tinymce',
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
            });
        } else {
            // Fallback to basic editor if no API key
            const textarea = document.getElementById('content');
            textarea.style.minHeight = '400px';
            textarea.classList.add('p-3');
        }

        // Slug generator
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        // Variable untuk melacak apakah user sudah mengedit slug secara manual
        let slugManuallyChanged = false;
        
        titleInput.addEventListener('input', function() {
            updatePreview();
            
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
        });

        document.getElementById('description').addEventListener('input', function() {
            updatePreview();
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
        
        // Refresh preview button
        document.getElementById('refreshPreview').addEventListener('click', updatePreview);
        
        // Initial update
        updatePreview();
        updateCharacterCount();
    });

    // Preview function
    function updatePreview() {
        const title = document.getElementById('title').value || 'Judul Blog';
        const description = document.getElementById('description').value || 'Deskripsi singkat akan muncul di sini...';
        
        document.getElementById('previewTitle').textContent = title;
        document.getElementById('previewDescription').textContent = description;
    }

    // Image preview function
    function previewImage() {
        const preview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('previewImage');
        const file = document.getElementById('image').files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            preview.classList.remove('hidden');
            previewContainer.classList.remove('hidden');
            
            // Also update the preview in the preview box
            const previewImg = previewContainer.querySelector('img') || document.createElement('img');
            previewImg.src = reader.result;
            previewImg.alt = document.getElementById('image_alt').value || 'Preview';
            previewImg.className = 'w-full h-32 object-cover rounded';
            
            if (!previewContainer.contains(previewImg)) {
                previewContainer.appendChild(previewImg);
            }
        }

        if (file) {
            reader.readAsDataURL(file);
            document.getElementById('previewImage').classList.remove('hidden');
        } else {
            preview.src = '';
            preview.classList.add('hidden');
            document.getElementById('previewImage').classList.add('hidden');
        }
    }
</script>
@endpush 