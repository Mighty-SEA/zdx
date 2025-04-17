@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Layanan Baru</h2>
                <p class="text-gray-600 mt-1">Tambahkan layanan baru untuk ditampilkan di website</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.services') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Form Header dengan Langkah -->
        <div class="bg-gray-50 border-b border-gray-200 py-4">
            <div class="flex justify-center px-6">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-medium">1</div>
                        <span class="ml-2 text-sm font-medium text-gray-700">Informasi</span>
                    </div>
                    <div class="h-1 w-10 bg-[#FF6000]"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-medium">2</div>
                        <span class="ml-2 text-sm font-medium text-gray-700">Konten</span>
                    </div>
                    <div class="h-1 w-10 bg-[#FF6000]"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-medium">3</div>
                        <span class="ml-2 text-sm font-medium text-gray-700">Media</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <!-- Bagian 1: Informasi Dasar -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    <i class="fas fa-info-circle text-[#FF6000] mr-2"></i> Informasi Dasar
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="title" class="form-label flex items-center">
                            Judul Layanan <span class="text-red-500 ml-1">*</span>
                            <span class="ml-1 group relative">
                                <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                                <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                    Judul layanan yang akan ditampilkan di website
                                </div>
                            </span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" 
                            class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all" 
                            placeholder="Contoh: Layanan Pengiriman Ekspres" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="slug" class="form-label flex items-center">
                            Slug URL
                            <span class="ml-1 group relative">
                                <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                                <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                    URL unik untuk layanan ini. Dibuat otomatis jika dikosongkan.
                                </div>
                            </span>
                        </label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border-2 border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                /layanan/
                            </span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                                class="flex-1 min-w-0 block w-full rounded-none rounded-r-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all"
                                placeholder="layanan-pengiriman-ekspres">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk membuat slug otomatis dari judul</p>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="description" class="form-label flex items-center">
                        Deskripsi Singkat <span class="text-red-500 ml-1">*</span>
                        <span class="ml-1 group relative">
                            <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                            <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                Deskripsi singkat yang akan muncul di halaman daftar layanan
                            </div>
                        </span>
                    </label>
                    <textarea name="description" id="description" rows="3" 
                        class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all" 
                        placeholder="Masukkan deskripsi singkat tentang layanan ini..." required>{{ old('description') }}</textarea>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-xs text-gray-500">Penjelasan singkat tentang layanan ini</p>
                        <p class="text-xs text-gray-500"><span id="description-count">0</span>/255 karakter</p>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Bagian 2: Konten -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    <i class="fas fa-file-alt text-[#FF6000] mr-2"></i> Konten Layanan
                </h3>
                
                <div class="mb-6">
                    <label for="content" class="form-label flex items-center">
                        Konten <span class="text-red-500 ml-1">*</span>
                        <span class="ml-1 group relative">
                            <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                            <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                Konten lengkap tentang layanan ini
                            </div>
                        </span>
                    </label>
                    <textarea name="content" id="content" rows="10" class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Bagian 3: Media dan Publikasi -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    <i class="fas fa-images text-[#FF6000] mr-2"></i> Media & Publikasi
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="image" class="form-label">Gambar Layanan</label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" id="dropzone-upload">
                            <div class="space-y-1 text-center">
                                <div id="preview-container" class="hidden mb-3">
                                    <img id="preview-image" class="mx-auto h-32 object-cover rounded" alt="Preview gambar">
                                    <button type="button" id="remove-image" class="mt-2 text-sm text-red-600 hover:text-red-700">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus Gambar
                                    </button>
                                </div>
                                <div id="upload-prompt">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#FF6000] hover:text-[#E65100]">
                                            <span>Upload gambar</span>
                                            <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                        </label>
                                        <p class="pl-1">atau drag & drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="form-label">Status Publikasi <span class="text-red-500">*</span></label>
                        <div class="mt-2 space-y-3">
                            <div class="relative flex items-start p-3 border border-gray-200 rounded-md hover:border-[#FF6000] transition-all">
                                <div class="flex items-center h-5">
                                    <input id="status-draft" name="status" value="draft" type="radio" {{ old('status') == 'draft' || !old('status') ? 'checked' : '' }} class="focus:ring-[#FF6000] h-4 w-4 text-[#FF6000] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="status-draft" class="font-medium text-gray-700">Draft</label>
                                    <p class="text-gray-500">Simpan sebagai draft (tidak akan ditampilkan)</p>
                                </div>
                            </div>
                            <div class="relative flex items-start p-3 border border-gray-200 rounded-md hover:border-[#FF6000] transition-all">
                                <div class="flex items-center h-5">
                                    <input id="status-published" name="status" value="published" type="radio" {{ old('status') == 'published' ? 'checked' : '' }} class="focus:ring-[#FF6000] h-4 w-4 text-[#FF6000] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="status-published" class="font-medium text-gray-700">Publikasikan</label>
                                    <p class="text-gray-500">Publikasikan sekarang di website</p>
                                </div>
                            </div>
                        </div>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.services') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // TinyMCE Initialization
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
            language: 'id',
            placeholder: 'Mulai mengetik konten layanan Anda di sini...'
        });
            
        // Auto-generate slug from title
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        titleInput.addEventListener('input', function() {
            if (!slugInput.value) {
                slugInput.value = createSlug(titleInput.value);
            }
        });
        
        function createSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')        // Replace spaces with -
                .replace(/[^\w\-]+/g, '')    // Remove all non-word chars
                .replace(/\-\-+/g, '-')      // Replace multiple - with single -
                .replace(/^-+/, '')          // Trim - from start of text
                .replace(/-+$/, '');         // Trim - from end of text
        }
        
        // Character counter for description
        const descriptionTextarea = document.getElementById('description');
        const descriptionCount = document.getElementById('description-count');
        
        descriptionTextarea.addEventListener('input', function() {
            const count = this.value.length;
            descriptionCount.textContent = count;
            
            if (count > 255) {
                descriptionCount.classList.add('text-red-500');
                descriptionCount.classList.remove('text-gray-500');
            } else {
                descriptionCount.classList.remove('text-red-500');
                descriptionCount.classList.add('text-gray-500');
            }
        });
        
        // Trigger input event to update counter on page load
        descriptionTextarea.dispatchEvent(new Event('input'));
        
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const previewImage = document.getElementById('preview-image');
        const previewContainer = document.getElementById('preview-container');
        const uploadPrompt = document.getElementById('upload-prompt');
        const removeImageBtn = document.getElementById('remove-image');
        const dropzoneUpload = document.getElementById('dropzone-upload');
        
        imageInput.addEventListener('change', updateImagePreview);
        
        function updateImagePreview() {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
        
        removeImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            previewContainer.classList.add('hidden');
            uploadPrompt.classList.remove('hidden');
        });
        
        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzoneUpload.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzoneUpload.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropzoneUpload.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropzoneUpload.classList.add('border-[#FF6000]', 'bg-[#FFF0E6]');
        }
        
        function unhighlight() {
            dropzoneUpload.classList.remove('border-[#FF6000]', 'bg-[#FFF0E6]');
        }
        
        dropzoneUpload.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                imageInput.files = files;
                updateImagePreview();
            }
        }
    });
</script>
@endpush 