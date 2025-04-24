@php
    use Illuminate\Support\Facades\Storage;
    $metadata = json_decode($section->metadata ?? '{}', true) ?: [];
    $benefits = $metadata['benefits'] ?? ['', '', ''];
    $button2Text = $metadata['button2_text'] ?? '';
    $button2Url = $metadata['button2_url'] ?? '';
@endphp

<div class="space-y-6">
    <!-- Gambar -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar CTA</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-[#FF6000] transition-colors duration-200">
            <input type="file" name="image" id="image" class="hidden" accept="image/*">
            <label for="image" class="cursor-pointer block">
                <div class="space-y-1 text-center">
                    @if($section->image_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $section->image_path) }}" alt="Current image" class="mx-auto h-32 object-cover">
                        </div>
                    @endif
                    <div id="image-preview" class="mb-3 flex justify-center"></div>
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer rounded-md font-medium text-[#FF6000] hover:text-[#FF4000] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#FF6000]">
                            <span>Upload gambar</span>
                            <span class="text-gray-500"> atau drag and drop</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                </div>
            </label>
        </div>
        @error('image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Judul dan Deskripsi -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
            <i class="fas fa-file-alt text-[#FF6000] mr-2"></i> Konten CTA
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                    id="title" name="title" value="{{ old('title', $section->title) }}">
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                    id="subtitle" name="subtitle">{{ old('subtitle', $section->subtitle) }}</textarea>
                @error('subtitle')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Keuntungan / Benefit -->
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
            <i class="fas fa-check-circle text-[#FF6000] mr-2"></i> Keuntungan / Benefits
        </h3>
        <div class="space-y-3" id="benefits-container">
            @foreach($benefits as $index => $benefit)
                <div class="flex items-center">
                    <input type="text" name="benefits[]" value="{{ old('benefits.'.$index, $benefit) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" placeholder="Keuntungan {{ $index + 1 }}">
                    @if($index > 2)
                        <button type="button" class="ml-2 inline-flex items-center p-1 border border-transparent rounded-full text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-benefit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
        <button type="button" id="add-benefit" class="mt-4 inline-flex items-center px-3 py-2 border border-[#FF6000] text-[#FF6000] bg-white rounded-md hover:bg-[#FFF0E6] transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            Tambah Keuntungan
        </button>
    </div>
    
    <!-- Tombol CTA -->
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
            <i class="fas fa-link text-[#FF6000] mr-2"></i> Tombol Call-to-Action
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol Utama</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                    id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
                @error('button_text')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="button_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol Utama</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                    id="button_url" name="button_url" value="{{ old('button_url', $section->button_url) }}">
                @error('button_url')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="button2_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol Kedua</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                    id="button2_text" name="button2_text" value="{{ old('button2_text', $button2Text) }}">
                @error('button2_text')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="button2_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol Kedua</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                    id="button2_url" name="button2_url" value="{{ old('button2_url', $button2Url) }}">
                @error('button2_url')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Script untuk menambah/menghapus benefit
    document.addEventListener('DOMContentLoaded', function() {
        const addBenefitBtn = document.getElementById('add-benefit');
        const benefitsContainer = document.getElementById('benefits-container');
        
        // Tombol tambah benefit
        addBenefitBtn.addEventListener('click', function() {
            const benefitCount = benefitsContainer.children.length;
            const newBenefit = document.createElement('div');
            newBenefit.className = 'flex items-center';
            newBenefit.innerHTML = `
                <input type="text" name="benefits[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" placeholder="Keuntungan ${benefitCount + 1}">
                <button type="button" class="ml-2 inline-flex items-center p-1 border border-transparent rounded-full text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-benefit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            benefitsContainer.appendChild(newBenefit);
            
            // Event listener untuk tombol hapus
            const deleteBtn = newBenefit.querySelector('.delete-benefit');
            deleteBtn.addEventListener('click', function() {
                benefitsContainer.removeChild(newBenefit);
            });
        });
        
        // Event listener untuk tombol hapus benefit yang sudah ada
        document.querySelectorAll('.delete-benefit').forEach(btn => {
            btn.addEventListener('click', function() {
                const benefitItem = this.closest('.flex');
                benefitsContainer.removeChild(benefitItem);
            });
        });
        
        // Preview gambar saat diupload
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function() {
                imagePreview.innerHTML = '';
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const img = document.createElement('div');
                        img.className = 'relative group';
                        img.innerHTML = `
                            <img src="${e.target.result}" alt="Preview Image" class="h-24 object-cover rounded">
                            <div class="absolute inset-0 bg-black bg-opacity-40 rounded opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white text-xs">Preview</span>
                            </div>
                        `;
                        imagePreview.appendChild(img);
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
@endpush 