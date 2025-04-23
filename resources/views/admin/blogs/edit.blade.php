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
                <!-- Kolom Kiri -->
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
                        <p class="text-gray-500 text-xs mt-1">Ringkasan singkat dari artikel yang akan tampil di halaman daftar blog (maksimal 255 karakter)</p>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="text-xs text-gray-500 mt-1"><span id="descriptionCounter">0</span>/255 karakter</div>
                    </div>

                    <!-- Konten -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" rows="12" class="form-textarea w-full rounded-md">{{ old('content', $blog->content) }}</textarea>
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
                            <h2 id="previewTitle" class="text-xl font-bold text-gray-800">{{ $blog->title }}</h2>
                            <div id="previewDescription" class="text-gray-600 mt-2 text-sm">{{ $blog->description }}</div>
                            @if($blog->image)
                            <div id="previewImage" class="mt-3">
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-32 object-cover rounded">
                            </div>
                            @else
                            <div id="previewImage" class="mt-3 hidden"></div>
                            @endif
                        </div>
                    </div>
                    
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
            </div>
            <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" id="cancelDeleteBtn" class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                    Ya, Hapus Gambar
                </button>
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
                height: 600,
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
                setup: function(editor) {
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
            textarea.style.minHeight = '400px';
            textarea.classList.add('p-3');
        }

        // Character counter for description
        const descriptionField = document.getElementById('description');
        const counter = document.getElementById('descriptionCounter');
        
        function updateCharacterCount() {
            const count = descriptionField.value.length;
            counter.textContent = count;
            
            if (count > 255) {
                counter.classList.add('text-red-500');
            } else {
                counter.classList.remove('text-red-500');
            }
        }
        
        descriptionField.addEventListener('input', function() {
            updatePreview();
            updateCharacterCount();
        });
        
        // Initial count
        updateCharacterCount();
        
        // Preview functionality
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
        
        document.getElementById('refreshPreview').addEventListener('click', updatePreview);
        
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
        
        // Delete image modal
        const modal = document.getElementById('deleteImageModal');
        const backdrop = document.getElementById('deleteImageBackdrop');
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        
        // Close modal handlers
        cancelBtn.addEventListener('click', hideDeleteModal);
        backdrop.addEventListener('click', hideDeleteModal);
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                hideDeleteModal();
            }
        });
    });
    
    // Update preview 
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
            
            // Also update the preview in the preview box
            const previewImg = previewContainer.querySelector('img') || document.createElement('img');
            previewImg.src = reader.result;
            previewImg.alt = document.getElementById('image_alt').value || 'Preview';
            previewImg.className = 'w-full h-32 object-cover rounded';
            
            if (!previewContainer.contains(previewImg)) {
                previewContainer.appendChild(previewImg);
            }
            
            previewContainer.classList.remove('hidden');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }
    
    // Delete image modal
    let currentDeleteForm;
    
    function confirmDeleteImage(button) {
        currentDeleteForm = button.closest('form');
        document.getElementById('deleteImageModal').classList.remove('hidden');
        document.getElementById('confirmDeleteBtn').addEventListener('click', executeDelete);
    }
    
    function executeDelete() {
        if (currentDeleteForm) {
            currentDeleteForm.submit();
        }
        hideDeleteModal();
    }
    
    function hideDeleteModal() {
        document.getElementById('deleteImageModal').classList.add('hidden');
        document.getElementById('confirmDeleteBtn').removeEventListener('click', executeDelete);
        currentDeleteForm = null;
    }
</script>
@endpush 