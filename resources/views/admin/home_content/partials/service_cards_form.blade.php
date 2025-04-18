<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        <i class="fas fa-th-large text-[#FF6000] mr-2"></i> Card Layanan
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Card</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="title" name="title" value="{{ old('title', $section->title) }}">
            @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="subtitle" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}">
            @error('subtitle')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="mb-6">
        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten Lengkap</label>
        <textarea class="tinymce w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
            id="content" name="content" rows="6">{{ old('content', $section->content) }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Gunakan rich editor untuk menambahkan format pada konten.</p>
        @error('content')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
            @error('button_text')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="button_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol</label>
            <div class="flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    {{ url('/') }}
                </span>
                <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-[#FF6000] focus:border-[#FF6000] border border-gray-300" 
                    id="button_url" name="button_url" value="{{ old('button_url', $section->button_url) }}">
            </div>
            @error('button_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Card</label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
                @if($section->image_path)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $section->image_path) }}" alt="Preview" class="mx-auto h-32 object-cover">
                </div>
                @endif
                
                <div class="flex text-sm text-gray-600">
                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#FF6000] hover:text-[#E65100]">
                        <span>Upload gambar</span>
                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                    </label>
                    <p class="pl-1">atau drag & drop</p>
                </div>
                <p class="text-xs text-gray-500">
                    PNG, JPG, GIF hingga 2MB (Disarankan ukuran 400x300px)
                </p>
            </div>
        </div>
        @error('image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div> 