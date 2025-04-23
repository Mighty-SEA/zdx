@extends('layouts.admin')

@section('title', 'Edit ' . $section->section_name)

@section('styles')
@if($section->use_rich_editor)
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: 'textarea.tinymce',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300
        });
    });
</script>
@endif
@endsection

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit {{ $section->section_name }}</h2>
                <p class="text-gray-600 mt-1">Kelola konten yang ditampilkan pada bagian ini</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.home-content.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            <form action="{{ route('admin.home-content.update', $section->id) }}" method="POST" enctype="multipart/form-data" id="edit-section-form">
                @csrf
                @method('PUT')
                
                <!-- Status Switch -->
                <div class="flex items-center p-4 mb-6 bg-gray-50 rounded-lg">
                    <div class="mr-4">
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <input type="checkbox" id="is_active" name="is_active" {{ $section->is_active ? 'checked' : '' }} value="1"
                                class="absolute block w-6 h-6 bg-white border-4 border-gray-300 rounded-full appearance-none cursor-pointer checked:right-0 checked:border-[#FF6000] transition-all duration-200"
                            />
                            <label for="is_active" class="block h-6 overflow-hidden bg-gray-300 rounded-full cursor-pointer"></label>
                        </div>
                    </div>
                    
                    <div>
                        <p class="font-medium text-gray-800">{{ $section->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                        <p class="text-sm text-gray-600">Jika tidak diaktifkan, bagian ini tidak akan ditampilkan di halaman utama</p>
                    </div>
                </div>
                
                <!-- Section Info -->
                <div class="mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="flex items-start">
                            <div class="bg-gray-200 p-2 rounded-full mr-3">
                                <i class="fas fa-info-circle text-gray-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Informasi Bagian</p>
                                <p class="text-sm text-gray-600 mb-2">{{ $section->section_name }} ({{ $section->section_key }})</p>
                                <p class="text-xs text-gray-500">ID: {{ $section->id }} | Urutan: {{ $section->order }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @php
                    $metadata = json_decode($section->metadata ?? '{}', true) ?: [];
                @endphp
                
                <!-- Bagian form sesuai dengan section_key -->
                @if($section->section_key === 'hero')
                    @include('admin.home_content.partials.hero_form', ['section' => $section, 'metadata' => $metadata])
                @elseif($section->section_key === 'stats')
                    @include('admin.home_content.partials.stats_form', ['section' => $section, 'metadata' => $metadata])
                @elseif($section->section_key === 'services')
                    @include('admin.home_content.partials.services_form', ['section' => $section])
                @elseif($section->section_key === 'features')
                    @include('admin.home_content.partials.features_form', ['section' => $section, 'metadata' => $metadata])
                @elseif($section->section_key === 'service_cards')
                    @include('admin.home_content.partials.service_cards_form', ['section' => $section])
                @elseif($section->section_key === 'partners')
                    @include('admin.home_content.partials.partners_form', ['section' => $section])
                @elseif($section->section_key === 'cta')
                    @include('admin.home_content.partials.cta_form')
                @else
                    <!-- Default form untuk section yang tidak spesifik -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                            <i class="fas fa-edit text-[#FF6000] mr-2"></i> Konten
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                                    id="title" name="title" value="{{ old('title', $section->title) }}">
                                @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Subjudul</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                                    id="subtitle" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}">
                                @error('subtitle')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Submit Button -->
                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
                
                <!-- Loading indicator -->
                <div id="formSubmitting" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#FF6000] mx-auto mb-4"></div>
                        <p>Menyimpan perubahan...</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submit handler untuk menampilkan loading indicator
    const form = document.getElementById('edit-section-form');
    if (form) {
        form.addEventListener('submit', function() {
            document.getElementById('formSubmitting').classList.remove('hidden');
        });
    }
    
    // Drag and drop untuk upload gambar
    const dropAreas = document.querySelectorAll('.border-dashed');
    
    dropAreas.forEach(dropArea => {
        const fileInput = dropArea.querySelector('input[type="file"]');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('border-[#FF6000]', 'bg-orange-50');
        }
        
        function unhighlight() {
            dropArea.classList.remove('border-[#FF6000]', 'bg-orange-50');
        }
        
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            // Preview gambar
            handleFiles(files);
        }
        
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });
        
        function handleFiles(files) {
            if (files.length > 0) {
                const preview = dropArea.querySelector('img');
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                    } else {
                        const newPreview = document.createElement('div');
                        newPreview.className = 'mb-3';
                        newPreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="mx-auto h-32 object-cover">`;
                        dropArea.querySelector('.space-y-1').prepend(newPreview);
                    }
                }
                reader.readAsDataURL(files[0]);
            }
        }
    });
});
</script>
@endpush

@endsection 