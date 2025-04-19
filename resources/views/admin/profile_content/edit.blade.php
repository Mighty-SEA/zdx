@extends('layouts.admin')

@section('title', 'Edit Informasi Perusahaan')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Edit Informasi Perusahaan - {{ $content->title }}
    </h2>

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="ml-3">
                <p>{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <form action="{{ route('admin.profile-content.update', $content->id) }}" method="POST" id="editForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700" for="section">
                    Bagian
                </label>
                <div class="mt-1">
                    <input type="text" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                           value="{{ ucfirst(str_replace('_', ' ', $content->section)) }}" disabled>
                    <p class="text-xs text-gray-500 mt-1">Bagian konten tidak dapat diubah</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700" for="title">
                    Judul
                </label>
                <div class="mt-1">
                    <input type="text" name="title" id="title" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input @error('title') border-red-500 @enderror" 
                           value="{{ old('title', $content->title) }}" required>
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            @if($content->section == 'about')
            <div class="bg-purple-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-medium text-purple-700 mb-3">Informasi Perusahaan</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="company_name">
                        Nama Perusahaan
                    </label>
                    <div class="mt-1">
                        <input type="text" name="company_name" id="company_name" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                               value="{{ old('company_name', $content->company_name ?? 'PT. Zindan Diantar Express') }}">
                        <p class="text-xs text-gray-500 mt-1">Nama lengkap perusahaan yang akan ditampilkan di halaman profil</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="company_slogan">
                        Slogan Perusahaan
                    </label>
                    <div class="mt-1">
                        <input type="text" name="company_slogan" id="company_slogan" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                               value="{{ old('company_slogan', $content->company_slogan ?? 'Solusi Tepat Pengiriman Cepat') }}">
                        <p class="text-xs text-gray-500 mt-1">Slogan atau tagline perusahaan</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="company_description">
                        Deskripsi Singkat Perusahaan
                    </label>
                    <div class="mt-1">
                        <textarea name="company_description" id="company_description" rows="3" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input">{{ old('company_description', $content->company_description ?? 'Perusahaan jasa pengiriman barang terpercaya di Indonesia yang menyediakan layanan pengiriman via darat, laut, dan udara.') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Deskripsi singkat tentang perusahaan (1-2 kalimat)</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="org_structure_image">
                        Struktur Organisasi
                    </label>
                    <div class="mt-1">
                        <input type="file" name="org_structure_image" id="org_structure_image" class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Upload gambar struktur organisasi (JPG, PNG, GIF maks. 2MB)</p>
                        
                        @if($content->org_structure_path)
                        <div class="mt-3">
                            <p class="text-sm text-gray-500 mb-2">Gambar struktur organisasi saat ini:</p>
                            <img src="{{ asset($content->org_structure_path) }}?v={{ time() }}" alt="Struktur Organisasi" class="w-full max-w-md rounded border">
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Bagian Kontak Perusahaan -->
                <h3 class="text-lg font-medium text-purple-700 mb-3 mt-6 pt-4 border-t border-purple-200">Kontak Perusahaan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="contact_phone">
                            <i class="fas fa-phone-alt mr-1"></i> Nomor Telepon
                        </label>
                        <div class="mt-1">
                            <input type="text" name="contact_phone" id="contact_phone" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                value="{{ old('contact_phone', $content->contact_phone) }}">
                            <p class="text-xs text-gray-500 mt-1">Contoh: +62 812 3456 7890</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="contact_email">
                            <i class="fas fa-envelope mr-1"></i> Email
                        </label>
                        <div class="mt-1">
                            <input type="email" name="contact_email" id="contact_email" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                value="{{ old('contact_email', $content->contact_email) }}">
                            <p class="text-xs text-gray-500 mt-1">Contoh: info@zdx.co.id</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="contact_address">
                        <i class="fas fa-map-marker-alt mr-1"></i> Alamat
                    </label>
                    <div class="mt-1">
                        <textarea name="contact_address" id="contact_address" rows="3" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input">{{ old('contact_address', $content->contact_address) }}</textarea>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="contact_maps_link">
                        <i class="fas fa-map mr-1"></i> Link Google Maps
                    </label>
                    <div class="mt-1">
                        <input type="url" name="contact_maps_link" id="contact_maps_link" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                            value="{{ old('contact_maps_link', $content->contact_maps_link) }}">
                        <p class="text-xs text-gray-500 mt-1">Contoh: https://goo.gl/maps/xxxxx</p>
                    </div>
                </div>
                
                <h3 class="text-lg font-medium text-purple-700 mb-3 mt-6 pt-4 border-t border-purple-200">Media Sosial</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="contact_facebook">
                            <i class="fab fa-facebook mr-1"></i> Facebook
                        </label>
                        <div class="mt-1">
                            <input type="url" name="contact_facebook" id="contact_facebook" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                value="{{ old('contact_facebook', $content->contact_facebook) }}">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="contact_instagram">
                            <i class="fab fa-instagram mr-1"></i> Instagram
                        </label>
                        <div class="mt-1">
                            <input type="url" name="contact_instagram" id="contact_instagram" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                value="{{ old('contact_instagram', $content->contact_instagram) }}">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="contact_twitter">
                            <i class="fab fa-twitter mr-1"></i> Twitter
                        </label>
                        <div class="mt-1">
                            <input type="url" name="contact_twitter" id="contact_twitter" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                value="{{ old('contact_twitter', $content->contact_twitter) }}">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="contact_youtube">
                            <i class="fab fa-youtube mr-1"></i> YouTube
                        </label>
                        <div class="mt-1">
                            <input type="url" name="contact_youtube" id="contact_youtube" class="block w-full mt-1 text-sm border-gray-300 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                value="{{ old('contact_youtube', $content->contact_youtube) }}">
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700" for="editor">
                    Konten
                </label>
                <div class="mt-1">
                    <div id="editor">{!! old('content', $content->content) !!}</div>
                    <textarea name="content" id="content-textarea" class="hidden">{{ old('content', $content->content) }}</textarea>
                    @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center mt-4">
                <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                       {{ old('is_active', $content->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 block text-sm text-gray-700">
                    Aktif
                </label>
            </div>

            <div class="mt-6 flex items-center justify-end">
                <a href="{{ route('admin.profile-content.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Batal
                </a>
                <button type="submit" id="saveButton" class="ml-3 px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Debug Box -->
    <div class="mt-6 p-4 bg-gray-50 rounded-lg shadow-inner">
        <h3 class="text-lg font-semibold mb-2">Debug Info:</h3>
        <div class="text-sm font-mono">
            <p>Konten Saat Ini: <br><code class="text-xs break-all bg-gray-100 p-2 rounded block max-h-32 overflow-auto">{{ $content->content }}</code></p>
            <p class="mt-2">Nilai Old: <br><code class="text-xs break-all bg-gray-100 p-2 rounded block max-h-32 overflow-auto">{{ old('content', '[tidak ada old data]') }}</code></p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Include CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let editor;
        
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo']
            })
            .then(newEditor => {
                editor = newEditor;
                
                // Update hidden textarea when editor content changes
                editor.model.document.on('change:data', () => {
                    document.getElementById('content-textarea').value = editor.getData();
                });
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
            
        // Form submit handling
        document.getElementById('editForm').addEventListener('submit', function(e) {
            // Prevent form submission if editor is not initialized
            if (!editor) {
                e.preventDefault();
                alert('Editor belum siap. Silakan tunggu sebentar dan coba lagi.');
                return false;
            }
            
            // Double check content is in the textarea
            document.getElementById('content-textarea').value = editor.getData();
            
            // Log form data
            console.log('Submitting form with data:');
            console.log('Title:', document.getElementById('title').value);
            console.log('Content:', document.getElementById('content-textarea').value);
            console.log('Is Active:', document.getElementById('is_active').checked);
            
            // Allow form submission
            return true;
        });
    });
</script>
@endpush 