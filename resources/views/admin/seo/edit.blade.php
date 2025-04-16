@extends('layouts.admin')

@section('title', 'Edit SEO ' . $pageSeo->page_name)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit SEO {{ $pageSeo->page_name }}</h2>
            <p class="text-gray-600 mt-1">Edit pengaturan metadata untuk halaman {{ $pageSeo->page_name }}.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.seo') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- SEO Preview -->
    <div class="bg-gray-50 p-5 rounded-xl mb-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            <i class="fas fa-eye mr-2 text-indigo-600"></i> Preview Tampilan SEO
        </h3>
        <div class="max-w-3xl">
            <!-- Google Search Preview -->
            <div class="bg-white p-4 rounded-lg border border-gray-200 mb-4">
                <p class="text-sm text-gray-500 mb-1">Google Search Preview</p>
                <div id="googlePreview" class="border-t border-gray-200 pt-3">
                    <div class="text-blue-800 text-xl font-medium truncate">{{ $pageSeo->title ?? 'Judul Halaman' }}</div>
                    <div class="text-green-700 text-sm truncate">{{ url('/' . ($pageSeo->page_identifier == 'home' ? '' : $pageSeo->page_identifier)) }}</div>
                    <div class="text-gray-800 text-sm mt-1">{{ $pageSeo->description ?? 'Deskripsi halaman akan ditampilkan di sini...' }}</div>
                </div>
            </div>
            
            <!-- Facebook Share Preview -->
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-500 mb-1">Facebook Share Preview</p>
                <div id="fbPreview" class="border-t border-gray-200 pt-3">
                    <div class="flex">
                        <div class="w-1/3 h-24 mr-4 bg-gray-200 rounded flex items-center justify-center overflow-hidden">
                            @if($pageSeo->og_image)
                                <img src="{{ asset($pageSeo->og_image) }}" alt="OG Image" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            @endif
                        </div>
                        <div class="w-2/3">
                            <div class="text-gray-500 text-xs">{{ url('') }}</div>
                            <div class="text-gray-900 font-medium">{{ $pageSeo->og_title ?? $pageSeo->title ?? 'Judul OG Halaman' }}</div>
                            <div class="text-gray-700 text-sm line-clamp-2">{{ $pageSeo->og_description ?? $pageSeo->description ?? 'Deskripsi OG halaman akan ditampilkan di sini...' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.seo.update', $pageSeo->id) }}" method="POST" enctype="multipart/form-data" id="seoForm">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 gap-6">
            <!-- Pengaturan Global -->
            <div class="bg-white rounded-lg border border-gray-200 p-5">
                <div class="mb-4 pb-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-globe-asia mr-2 text-indigo-600"></i> Pengaturan Global
                    </h3>
                </div>
                
                <div class="mb-4">
                    <div class="flex items-center">
                        <input id="uses_global_settings" name="uses_global_settings" type="checkbox" value="1" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                            {{ $pageSeo->uses_global_settings ? 'checked' : '' }}>
                        <label for="uses_global_settings" class="ml-2 block text-sm text-gray-700">
                            Gunakan pengaturan global (akan mengabaikan pengaturan kustom di bawah)
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Tabs untuk navigasi antar section -->
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                    <button type="button" class="tab-button active border-indigo-600 text-indigo-700 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm" data-target="basicSEO">
                        <i class="fas fa-search mr-2 text-indigo-600"></i>
                        <span>Metadata Dasar</span>
                    </button>
                    <button type="button" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm" data-target="socialMedia">
                        <i class="fas fa-share-alt mr-2 text-gray-400"></i>
                        <span>Social Media</span>
                    </button>
                    <button type="button" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm" data-target="advanced">
                        <i class="fas fa-cog mr-2 text-gray-400"></i>
                        <span>Pengaturan Lanjutan</span>
                    </button>
                </nav>
            </div>
            
            <!-- Basic SEO -->
            <div id="basicSEO" class="tab-content bg-white rounded-lg border border-gray-200 p-5">
                <div class="mb-4 pb-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-search mr-2 text-indigo-600"></i> Metadata Dasar
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Pengaturan SEO dasar yang penting untuk mesin pencari</p>
                </div>
                
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Title <span class="text-xs text-gray-500">(maks. 100 karakter)</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="title" name="title" value="{{ old('title', $pageSeo->title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                            maxlength="100"
                            onkeyup="updatePreview()">
                        <span class="character-count absolute right-2 bottom-2 text-xs text-gray-500">
                            <span id="titleCount">0</span>/100
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Judul halaman yang akan tampil di tab browser & hasil pencarian</p>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Meta Description <span class="text-xs text-gray-500">(maks. 255 karakter)</span>
                    </label>
                    <div class="relative">
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                            maxlength="255"
                            onkeyup="updatePreview()">{{ old('description', $pageSeo->description) }}</textarea>
                        <span class="character-count absolute right-2 bottom-2 text-xs text-gray-500">
                            <span id="descriptionCount">0</span>/255
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Deskripsi singkat yang ditampilkan di hasil pencarian Google</p>
                </div>
                
                <div class="mb-4">
                    <label for="keywords" class="block text-sm font-medium text-gray-700 mb-1">
                        Meta Keywords <span class="text-xs text-gray-500">(pisahkan dengan koma)</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="keywords" name="keywords" value="{{ old('keywords', $pageSeo->keywords) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Kata kunci yang terkait dengan konten halaman (catatan: pengaruh terhadap SEO saat ini minimal)</p>
                </div>
            </div>
            
            <!-- Open Graph / Social Media -->
            <div id="socialMedia" class="tab-content bg-white rounded-lg border border-gray-200 p-5 hidden">
                <div class="mb-4 pb-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-share-alt mr-2 text-indigo-600"></i> Open Graph / Social Media
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Pengaturan untuk tampilan saat konten dibagikan di media sosial</p>
                </div>
                
                <div class="mb-4">
                    <label for="og_title" class="block text-sm font-medium text-gray-700 mb-1">
                        OG Title <span class="text-xs text-gray-500">(maks. 100 karakter)</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="og_title" name="og_title" value="{{ old('og_title', $pageSeo->og_title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                            maxlength="100"
                            onkeyup="updatePreview()">
                        <span class="character-count absolute right-2 bottom-2 text-xs text-gray-500">
                            <span id="ogTitleCount">0</span>/100
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Judul yang ditampilkan ketika dibagikan di media sosial (jika kosong, akan menggunakan Title)</p>
                </div>
                
                <div class="mb-4">
                    <label for="og_description" class="block text-sm font-medium text-gray-700 mb-1">
                        OG Description <span class="text-xs text-gray-500">(maks. 255 karakter)</span>
                    </label>
                    <div class="relative">
                        <textarea id="og_description" name="og_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                            maxlength="255"
                            onkeyup="updatePreview()">{{ old('og_description', $pageSeo->og_description) }}</textarea>
                        <span class="character-count absolute right-2 bottom-2 text-xs text-gray-500">
                            <span id="ogDescriptionCount">0</span>/255
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Deskripsi yang ditampilkan ketika dibagikan di media sosial (jika kosong, akan menggunakan Description)</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        OG Image <span class="text-xs text-gray-500">(Rekomendasi: 1200 x 630 pixel)</span>
                    </label>
                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="w-24 h-24 bg-gray-100 mr-4 rounded border border-gray-300 overflow-hidden flex items-center justify-center">
                                @if($pageSeo->og_image)
                                    <img id="ogImagePreview" src="{{ asset($pageSeo->og_image) }}" alt="OG Image" class="w-full h-full object-cover">
                                @else
                                    <img id="ogImagePreview" src="" alt="OG Image" class="w-full h-full object-cover hidden">
                                    <i id="ogImagePlaceholder" class="fas fa-image text-3xl text-gray-400"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <label for="og_image_file" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded transition-colors duration-200 cursor-pointer inline-block text-center">
                                        <i class="fas fa-upload mr-1"></i> Pilih Gambar
                                        <input type="file" id="og_image_file" name="og_image_file" 
                                            class="hidden" accept="image/*" onchange="previewImage(this)">
                                    </label>
                                    @if($pageSeo->og_image)
                                    <button type="button" id="removeImage" class="bg-red-100 text-red-700 hover:bg-red-200 text-sm font-medium py-2 px-4 rounded transition-colors duration-200">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus Gambar
                                    </button>
                                    @endif
                                </div>
                                <input type="hidden" name="og_image" value="{{ $pageSeo->og_image }}" id="ogImagePath">
                                <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG. Ukuran ideal: 1200x630px. Ukuran maksimal: 2MB.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Advanced SEO -->
            <div id="advanced" class="tab-content bg-white rounded-lg border border-gray-200 p-5 hidden">
                <div class="mb-4 pb-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-cog mr-2 text-indigo-600"></i> Pengaturan Lanjutan
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Pengaturan SEO tingkat lanjut</p>
                </div>
                
                <div class="mb-4">
                    <label for="custom_robots" class="block text-sm font-medium text-gray-700 mb-1">
                        Robots Meta Tag
                    </label>
                    <div class="relative">
                        <input type="text" id="custom_robots" name="custom_robots" value="{{ old('custom_robots', $pageSeo->custom_robots) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Contoh: index, follow atau noindex, nofollow (jika kosong, akan menggunakan pengaturan default: index, follow)</p>
                </div>
                
                <div class="mb-4">
                    <label for="custom_schema" class="block text-sm font-medium text-gray-700 mb-1">
                        Schema.org JSON-LD <span class="text-xs text-gray-500 ml-1">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <textarea id="custom_schema" name="custom_schema" rows="8"
                            class="font-mono text-sm w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ old('custom_schema', $pageSeo->custom_schema) }}</textarea>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Kode JSON-LD Schema.org untuk meningkatkan rich snippets di hasil pencarian</p>
                    <div class="mt-2 p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="text-xs font-medium text-gray-800 mb-1">Template yang bisa digunakan:</h4>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="schema-template text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded"
                                data-template="article">Artikel</button>
                            <button type="button" class="schema-template text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded"
                                data-template="local">Bisnis Lokal</button>
                            <button type="button" class="schema-template text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded"
                                data-template="faq">FAQ</button>
                            <button type="button" class="schema-template text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded"
                                data-template="product">Produk</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('border-indigo-600');
                btn.classList.remove('text-indigo-700');
                btn.classList.add('border-transparent');
                btn.classList.add('text-gray-500');
                btn.querySelector('i').classList.add('text-gray-400');
                btn.querySelector('i').classList.remove('text-indigo-600');
            });
            
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Add active class to clicked button and its content
            button.classList.add('active');
            button.classList.add('border-indigo-600');
            button.classList.add('text-indigo-700');
            button.classList.remove('border-transparent');
            button.classList.remove('text-gray-500');
            button.querySelector('i').classList.remove('text-gray-400');
            button.querySelector('i').classList.add('text-indigo-600');
            
            const target = button.getAttribute('data-target');
            document.getElementById(target).classList.remove('hidden');
        });
    });
    
    // Character counters
    const initCharCount = function(inputId, countId) {
        const input = document.getElementById(inputId);
        const count = document.getElementById(countId);
        
        if (input && count) {
            count.textContent = input.value.length;
            
            input.addEventListener('input', function() {
                count.textContent = this.value.length;
                
                // Change color when approaching limit
                if (this.value.length > (this.maxLength * 0.8)) {
                    count.classList.add('text-yellow-600');
                } else if (this.value.length > (this.maxLength * 0.9)) {
                    count.classList.remove('text-yellow-600');
                    count.classList.add('text-red-600');
                } else {
                    count.classList.remove('text-yellow-600');
                    count.classList.remove('text-red-600');
                }
            });
            
            // Trigger initial count
            input.dispatchEvent(new Event('input'));
        }
    };
    
    initCharCount('title', 'titleCount');
    initCharCount('description', 'descriptionCount');
    initCharCount('og_title', 'ogTitleCount');
    initCharCount('og_description', 'ogDescriptionCount');
    
    // Remove image button
    const removeImageBtn = document.getElementById('removeImage');
    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', function() {
            document.getElementById('ogImagePath').value = '';
            document.getElementById('ogImagePreview').classList.add('hidden');
            document.getElementById('ogImagePlaceholder').classList.remove('hidden');
            this.style.display = 'none';
            updatePreview();
        });
    }
    
    // Schema Templates
    const schemaTemplates = document.querySelectorAll('.schema-template');
    const schemaField = document.getElementById('custom_schema');
    
    const templates = {
        article: `{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Judul Artikel Anda",
  "description": "Deskripsi singkat artikel Anda",
  "image": "URL Gambar Artikel",
  "author": {
    "@type": "Person",
    "name": "Nama Penulis"
  },
  "publisher": {
    "@type": "Organization",
    "name": "ZDX Express",
    "logo": {
      "@type": "ImageObject",
      "url": "URL Logo ZDX"
    }
  },
  "datePublished": "2023-01-01T08:00:00+07:00",
  "dateModified": "2023-01-01T09:00:00+07:00"
}`,
        local: `{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "ZDX Express",
  "image": "URL Gambar Bisnis",
  "telephone": "+6221-1234567",
  "email": "info@zdxexpress.co.id",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Contoh No. 123",
    "addressLocality": "Jakarta",
    "postalCode": "12345",
    "addressCountry": "ID"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "08:00",
    "closes": "17:00"
  }
}`,
        faq: `{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Pertanyaan 1?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Jawaban untuk pertanyaan 1."
      }
    },
    {
      "@type": "Question",
      "name": "Pertanyaan 2?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Jawaban untuk pertanyaan 2."
      }
    }
  ]
}`,
        product: `{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Nama Produk",
  "image": "URL Gambar Produk",
  "description": "Deskripsi produk Anda",
  "brand": {
    "@type": "Brand",
    "name": "Nama Brand"
  },
  "offers": {
    "@type": "Offer",
    "price": "99.99",
    "priceCurrency": "IDR",
    "availability": "https://schema.org/InStock"
  }
}`
    };
    
    schemaTemplates.forEach(button => {
        button.addEventListener('click', function() {
            const templateName = this.getAttribute('data-template');
            schemaField.value = templates[templateName];
        });
    });
    
    // Initialize preview
    updatePreview();
});

// Preview Image
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const preview = document.getElementById('ogImagePreview');
            const placeholder = document.getElementById('ogImagePlaceholder');
            
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            
            // Create remove button if it doesn't exist
            let removeBtn = document.getElementById('removeImage');
            if (!removeBtn) {
                removeBtn = document.createElement('button');
                removeBtn.id = 'removeImage';
                removeBtn.className = 'bg-red-100 text-red-700 hover:bg-red-200 text-sm font-medium py-2 px-4 rounded transition-colors duration-200';
                removeBtn.innerHTML = '<i class="fas fa-trash-alt mr-1"></i> Hapus Gambar';
                removeBtn.addEventListener('click', function() {
                    document.getElementById('og_image_file').value = '';
                    preview.src = '';
                    preview.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    this.style.display = 'none';
                });
                
                input.parentNode.parentNode.appendChild(removeBtn);
            } else {
                removeBtn.style.display = 'inline-block';
            }
            
            updatePreview();
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Update previews
function updatePreview() {
    // Google Preview
    const titleEl = document.getElementById('title');
    const descriptionEl = document.getElementById('description');
    
    const googleTitle = document.querySelector('#googlePreview div:first-child');
    const googleDesc = document.querySelector('#googlePreview div:last-child');
    
    if (titleEl.value) {
        googleTitle.textContent = titleEl.value;
    } else {
        googleTitle.textContent = 'Judul Halaman';
    }
    
    if (descriptionEl.value) {
        googleDesc.textContent = descriptionEl.value;
    } else {
        googleDesc.textContent = 'Deskripsi halaman akan ditampilkan di sini...';
    }
    
    // Facebook Preview
    const ogTitleEl = document.getElementById('og_title');
    const ogDescriptionEl = document.getElementById('og_description');
    
    const fbTitle = document.querySelector('#fbPreview div.w-2/3 div:nth-child(2)');
    const fbDesc = document.querySelector('#fbPreview div.w-2/3 div:nth-child(3)');
    
    if (ogTitleEl.value) {
        fbTitle.textContent = ogTitleEl.value;
    } else if (titleEl.value) {
        fbTitle.textContent = titleEl.value;
    } else {
        fbTitle.textContent = 'Judul OG Halaman';
    }
    
    if (ogDescriptionEl.value) {
        fbDesc.textContent = ogDescriptionEl.value;
    } else if (descriptionEl.value) {
        fbDesc.textContent = descriptionEl.value;
    } else {
        fbDesc.textContent = 'Deskripsi OG halaman akan ditampilkan di sini...';
    }
}
</script>
@endpush 