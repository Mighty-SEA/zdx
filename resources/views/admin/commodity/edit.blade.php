@extends('layouts.admin')

@section('title', 'Edit Komoditas')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Edit Komoditas</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Perbarui informasi komoditas yang ditampilkan di halaman website
                </p>
            </div>
            <div>
                <a href="{{ route('admin.commodity.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Status -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <span class="font-medium"><i class="fas fa-check-circle mr-2"></i></span> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium"><i class="fas fa-exclamation-circle mr-2"></i></span> {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <form action="{{ route('admin.commodity.update', $commodity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Komoditas <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $commodity->name) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-50">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="4" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-50">{{ old('description', $commodity->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        
                        <div class="mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-32 h-32 rounded-md overflow-hidden bg-gray-100">
                                    <img src="{{ $commodity->image_url }}" alt="{{ $commodity->name }}" id="current-image" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Gambar saat ini</p>
                                    <p class="text-xs text-gray-500">Unggah gambar baru untuk mengganti</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <div id="preview-container" class="hidden mb-3">
                                    <img id="preview-image" class="mx-auto h-32 object-cover rounded" alt="Preview gambar">
                                </div>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#FF6000] hover:text-[#E65100] focus-within:outline-none">
                                        <span>Upload gambar baru</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag & drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    Format: JPG, PNG. Ukuran maks: 2MB
                                </p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end px-6 py-3 bg-gray-50 text-right space-x-3">
                <a href="{{ route('admin.commodity.index') }}" class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-[#FF6000] hover:bg-[#E65100] text-white rounded-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const currentImage = document.getElementById('current-image');
            
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewContainer.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
@endsection 