<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        <i class="fas fa-bullhorn text-[#FF6000] mr-2"></i> Edit CTA Section
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul CTA</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="title" name="title" value="{{ old('title', $section->title) }}">
            <p class="text-xs text-gray-500 mt-1">Contoh: "Siap Mengirim Barang Anda?"</p>
            @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi CTA</label>
            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="subtitle" name="subtitle" rows="3">{{ old('subtitle', $section->subtitle) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Contoh: "Dapatkan penawaran terbaik untuk pengiriman barang Anda dengan layanan berkualitas prima dan jangkauan luas."</p>
            @error('subtitle')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="mb-6">
        <h4 class="font-medium text-gray-700 mb-2">Poin-Poin Keunggulan</h4>
        <div class="bg-gray-50 p-4 rounded mb-4">
            <p class="text-sm text-gray-600 mb-2">Masukkan poin-poin keunggulan yang ingin ditampilkan pada bagian ini (maksimal 3 poin).</p>
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poin 1</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]"
                        name="point1" value="{{ old('point1', $section->content ?? 'Tarif bersaing untuk semua jenis pengiriman') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poin 2</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]"
                        name="point2" value="{{ old('point2', $section->metadata ? (json_decode($section->metadata, true)['point2'] ?? 'Konsultasi gratis untuk kebutuhan logistik') : 'Konsultasi gratis untuk kebutuhan logistik') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poin 3</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]"
                        name="point3" value="{{ old('point3', $section->metadata ? (json_decode($section->metadata, true)['point3'] ?? 'Jaminan kepuasan untuk setiap pengiriman') : 'Jaminan kepuasan untuk setiap pengiriman') }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol Utama</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
            <p class="text-xs text-gray-500 mt-1">Contoh: "Hubungi Kami"</p>
            @error('button_text')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="button_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol Utama</label>
            <div class="flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    {{ url('/') }}
                </span>
                <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-[#FF6000] focus:border-[#FF6000] border border-gray-300" 
                    id="button_url" name="button_url" value="{{ old('button_url', $section->button_url) }}">
            </div>
            <p class="text-xs text-gray-500 mt-1">Contoh: "/contact" untuk mengarah ke halaman kontak</p>
            @error('button_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="secondary_button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol Sekunder</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="secondary_button_text" name="secondary_button_text" value="{{ old('secondary_button_text', $section->metadata ? (json_decode($section->metadata, true)['secondary_button_text'] ?? 'Lacak Kiriman') : 'Lacak Kiriman') }}">
            <p class="text-xs text-gray-500 mt-1">Contoh: "Lacak Kiriman"</p>
        </div>
        
        <div>
            <label for="secondary_button_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol Sekunder</label>
            <div class="flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    {{ url('/') }}
                </span>
                <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-[#FF6000] focus:border-[#FF6000] border border-gray-300" 
                    id="secondary_button_url" name="secondary_button_url" value="{{ old('secondary_button_url', $section->metadata ? (json_decode($section->metadata, true)['secondary_button_url'] ?? '/tracking') : '/tracking') }}">
            </div>
            <p class="text-xs text-gray-500 mt-1">Contoh: "/tracking" untuk mengarah ke halaman tracking</p>
        </div>
    </div>
    
    <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar CTA</label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
                @if($section->image_path)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $section->image_path) }}" alt="Preview" class="mx-auto h-32 object-contain">
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
                    PNG, JPG, GIF hingga 2MB (Disarankan ukuran 600x400px)
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Gambar ini akan ditampilkan di sebelah kanan teks CTA
                </p>
            </div>
        </div>
        @error('image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="quote_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Kutipan (Opsional)</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]"
            name="quote_text" value="{{ old('quote_text', $section->metadata ? (json_decode($section->metadata, true)['quote_text'] ?? '"Layanan terbaik yang pernah kami gunakan untuk logistik perusahaan kami."') : '"Layanan terbaik yang pernah kami gunakan untuk logistik perusahaan kami."') }}">
        <p class="text-xs text-gray-500 mt-1">Kutipan testimonial yang ditampilkan di bagian bawah gambar</p>
    </div>
</div> 