<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        <i class="fas fa-handshake text-[#FF6000] mr-2"></i> Partner
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
            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="subtitle" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}">
            @error('subtitle')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6 rounded">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
            <p class="text-yellow-700 text-sm">
                Logo partner diambil secara otomatis dari menu Partner yang telah Anda tambahkan. 
                Untuk menambah atau mengedit partner, silakan kunjungi halaman <a href="{{ route('admin.partners.index') }}" class="text-blue-600 hover:underline">Manajemen Partner</a>.
            </p>
        </div>
    </div>
</div> 