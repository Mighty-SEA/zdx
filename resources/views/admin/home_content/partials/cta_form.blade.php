@php
    use Illuminate\Support\Facades\Storage;
    $metadata = json_decode($section->metadata ?? '{}', true) ?: [];
    $benefits = $metadata['benefits'] ?? ['', '', ''];
    $button2Text = $metadata['button2_text'] ?? '';
    $button2Url = $metadata['button2_url'] ?? '';
@endphp

<form action="{{ route('admin.home-content.update', $section->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Status Aktif -->
    <div class="mb-5">
        <label class="flex items-center">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">Aktifkan bagian ini</span>
        </label>
    </div>
    
    <!-- Judul -->
    <div class="mb-5">
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
        <input type="text" name="title" id="title" value="{{ old('title', $section->title) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Subtitle -->
    <div class="mb-5">
        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea name="subtitle" id="subtitle" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('subtitle', $section->subtitle) }}</textarea>
        @error('subtitle')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Keuntungan / Benefit -->
    <div class="mb-5">
        <label class="block text-sm font-medium text-gray-700 mb-2">Keuntungan / Benefits</label>
        <div class="space-y-3">
            @foreach($benefits as $index => $benefit)
                <div class="flex items-center">
                    <input type="text" name="benefits[]" value="{{ old('benefits.'.$index, $benefit) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Keuntungan {{ $index + 1 }}">
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
        <button type="button" id="add-benefit" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            Tambah Keuntungan
        </button>
    </div>
    
    <!-- Tombol Utama -->
    <div class="mb-5 grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol Utama</label>
            <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $section->button_text) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            @error('button_text')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="button_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol Utama</label>
            <input type="text" name="button_url" id="button_url" value="{{ old('button_url', $section->button_url) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            @error('button_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- Tombol Kedua -->
    <div class="mb-5 grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="button2_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol Kedua</label>
            <input type="text" name="button2_text" id="button2_text" value="{{ old('button2_text', $button2Text) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            @error('button2_text')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="button2_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol Kedua</label>
            <input type="text" name="button2_url" id="button2_url" value="{{ old('button2_url', $button2Url) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            @error('button2_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- Gambar -->
    <div class="mb-5">
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
        <div class="mt-1 flex items-center">
            @if($section->image_path)
                <div class="relative group mr-3">
                    <img src="{{ asset('storage/' . $section->image_path) }}" alt="Current Image" class="w-20 h-20 object-cover rounded">
                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <a href="{{ asset('storage/' . $section->image_path) }}" target="_blank" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
            <input type="file" name="image" id="image" class="hidden">
            <label for="image" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                Pilih Gambar
            </label>
        </div>
        <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG, GIF (Max 2MB)</p>
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Tombol Simpan -->
    <div class="mt-8 border-t border-gray-200 pt-5">
        <div class="flex justify-end">
            <a href="{{ route('admin.home-content.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Batal
            </a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Simpan Perubahan
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Script untuk menambah/menghapus benefit
    document.addEventListener('DOMContentLoaded', function() {
        const addBenefitBtn = document.getElementById('add-benefit');
        const benefitsContainer = addBenefitBtn.previousElementSibling;
        
        // Tombol tambah benefit
        addBenefitBtn.addEventListener('click', function() {
            const benefitCount = benefitsContainer.children.length;
            const newBenefit = document.createElement('div');
            newBenefit.className = 'flex items-center';
            newBenefit.innerHTML = `
                <input type="text" name="benefits[]" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Keuntungan ${benefitCount + 1}">
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
    });
</script>
@endpush 