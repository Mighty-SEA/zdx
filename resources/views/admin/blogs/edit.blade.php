@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Blog</h2>
                <p class="text-gray-600 mt-1">Ubah artikel blog Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.blogs.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Pesan Error -->
    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <!-- Form Content -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Form Header dengan Step -->
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

        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Bagian 1: Informasi Dasar -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    <i class="fas fa-info-circle text-[#FF6000] mr-2"></i> Informasi Dasar
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="title" class="form-label flex items-center">
                            Judul Blog <span class="text-red-500 ml-1">*</span>
                            <span class="ml-1 group relative">
                                <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                                <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                    Judul blog yang akan ditampilkan di website
                                </div>
                            </span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" 
                            class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all" 
                            placeholder="Contoh: Tips Pengiriman Barang yang Aman" required>
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
                                    URL unik untuk blog ini. Dibuat otomatis jika dikosongkan.
                                </div>
                            </span>
                        </label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border-2 border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                {{ url('/') }}/
                            </span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}" data-auto="false"
                                class="flex-1 min-w-0 block w-full rounded-none rounded-r-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all"
                                placeholder="tips-pengiriman-barang-yang-aman">
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
                                Deskripsi singkat yang akan muncul di halaman daftar blog
                            </div>
                        </span>
                    </label>
                    <textarea name="description" id="description" rows="3" 
                        class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all" 
                        placeholder="Masukkan deskripsi singkat tentang artikel blog ini..." required>{{ old('description', $blog->description) }}</textarea>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-xs text-gray-500">Ringkasan singkat yang akan tampil di halaman daftar blog</p>
                        <p class="text-xs text-gray-500"><span id="description-count">0</span>/255 karakter</p>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="form-label flex items-center">
                            Kategori
                            <span class="ml-1 group relative">
                                <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                                <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                    Kategori untuk mengelompokkan blog
                                </div>
                            </span>
                        </label>
                        <input type="text" name="category" id="category" value="{{ old('category', $blog->category) }}" 
                            class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all" 
                            placeholder="Contoh: Logistik, Pengiriman, Tips">
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tags" class="form-label flex items-center">
                            Tags
                            <span class="ml-1 group relative">
                                <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                                <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                    Tag untuk membantu pengelompokan dan pencarian
                                </div>
                            </span>
                        </label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags', is_array($blog->tags) ? implode(', ', $blog->tags) : $blog->tags) }}" 
                            class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all" 
                            placeholder="kargo, logistik, ekspedisi">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan tag dengan koma</p>
                        @error('tags')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Konten -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    <i class="fas fa-file-alt text-[#FF6000] mr-2"></i> Konten Blog
                </h3>
                
                <!-- Table of Contents -->
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-sm font-medium text-gray-700">Table of Contents</label>
                        <span class="text-xs text-gray-600">Otomatis dari heading (H2, H3)</span>
                    </div>
                    <div id="toc_auto_container" class="bg-gray-50 border border-gray-200 rounded-md p-3">
                        <div class="text-sm text-gray-700">TOC akan dibuat otomatis dari heading (H2, H3) dalam konten.</div>
                        <div id="toc_preview" class="mt-2 text-sm">
                            <div class="text-gray-500 italic text-xs">Preview akan muncul setelah konten artikel ditulis dengan heading.</div>
                        </div>
                    </div>
                    <input type="hidden" name="toc_mode" value="auto">
                </div>
                
                <div class="mb-6">
                    <label for="content" class="form-label flex items-center">
                        Konten <span class="text-red-500 ml-1">*</span>
                        <span class="ml-1 group relative">
                            <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                            <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                                Konten lengkap artikel blog
                            </div>
                        </span>
                    </label>
                    <textarea name="content" id="content" rows="10" class="w-full rounded-md border-2 border-gray-300 focus:border-[#FF6000] focus:ring focus:ring-[#FF6000] focus:ring-opacity-20 shadow-sm transition-all">{{ old('content', $blog->content) }}</textarea>
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
                        <label for="image" class="form-label">Gambar Blog</label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" id="dropzone-upload">
                            <div class="space-y-1 text-center">
                                <div id="preview-container" class="{{ $blog->image ? '' : 'hidden' }} mb-3">
                                    <img id="preview-image" src="{{ $blog->image ? asset($blog->image) : '' }}" class="mx-auto h-32 object-cover rounded" alt="Preview gambar">
                                    <button type="button" id="delete-image-completely" class="mt-2 text-sm text-red-600 hover:text-red-700">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus Gambar
                                    </button>
                                </div>
                                <div id="upload-prompt" class="{{ $blog->image ? 'hidden' : '' }}">
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
                        
                        <div id="image-meta-fields" class="mt-3 space-y-3 {{ $blog->image ? '' : 'hidden' }}">
                            <div class="mb-4">
                                <label for="image_alt" class="block text-sm font-medium text-gray-700">Alt Text <span class="text-red-500">*</span></label>
                                <input type="text" name="image_alt" id="image_alt" data-auto="true" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Deskripsi gambar untuk aksesibilitas" value="{{ old('image_alt', $blog->image_alt ?? '') }}" required>
                                @error('image_alt')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image_name" class="block text-sm font-medium text-gray-700">Nama File <span class="text-gray-400 text-xs">(opsional)</span></label>
                                <input type="text" name="image_name" id="image_name" data-auto="true" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Kosongkan untuk penamaan otomatis" value="{{ old('image_name', $blog->image_name ?? '') }}">
                                @error('image_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="status" class="form-label">Status Publikasi <span class="text-red-500">*</span></label>
                        <div class="mt-2 space-y-3">
                            <div class="relative flex items-start p-3 border border-gray-200 rounded-md hover:border-[#FF6000] transition-all">
                                <div class="flex items-center h-5">
                                    <input id="status-published" name="status" value="published" type="radio" {{ (old('status', $blog->status) == 'published' || !old('status', $blog->status)) ? 'checked' : '' }} class="focus:ring-[#FF6000] h-4 w-4 text-[#FF6000] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="status-published" class="font-medium text-gray-700">Publikasikan</label>
                                    <p class="text-gray-500">Publikasikan sekarang di website</p>
                                </div>
                            </div>
                            <div class="relative flex items-start p-3 border border-gray-200 rounded-md hover:border-[#FF6000] transition-all">
                                <div class="flex items-center h-5">
                                    <input id="status-draft" name="status" value="draft" type="radio" {{ (old('status', $blog->status) == 'draft') ? 'checked' : '' }} class="focus:ring-[#FF6000] h-4 w-4 text-[#FF6000] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="status-draft" class="font-medium text-gray-700">Draft</label>
                                    <p class="text-gray-500">Simpan sebagai draft (tidak akan ditampilkan)</p>
                                </div>
                            </div>
                        </div>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        
                        <!-- Jika sudah dipublikasikan, tampilkan tombol lihat -->
                        @if($blog->status == 'published')
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="/{{ $blog->slug }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt mr-2"></i> Lihat di Website
                            </a>
                        </div>
                        @endif
                        
                        <!-- Informasi tambahan -->
                        <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-600">
                            <p class="mb-2">
                                <span class="font-medium">Penulis:</span>
                                <input type="text" name="author" id="author" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm" value="{{ old('author', $blog->author) }}">
                            </p>
                            <p class="mb-2">
                                <span class="font-medium">Dibuat Pada:</span> 
                                {{ $blog->created_at->format('d M Y H:i') }}
                            </p>
                            <p class="mb-2">
                                <span class="font-medium">Terakhir Diperbarui:</span> 
                                {{ $blog->updated_at->format('d M Y H:i') }}
                            </p>
                            @if($blog->published_at)
                            <p>
                                <span class="font-medium">Tanggal Publikasi:</span> 
                                {{ $blog->published_at->format('d M Y H:i') }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bagian SEO Optimization -->
            <div class="mt-8 border-t pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Panel SEO Optimization - Kiri -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-800 mb-4 flex items-center justify-between">
                            <span><i class="fas fa-chart-line text-blue-500 mr-1"></i> SEO Optimization</span>
                            <span class="text-sm bg-gray-200 text-gray-700 py-1 px-2 rounded-full" id="seo-score">0%</span>
                        </h3>
                        
                        <!-- Focus Keyword -->
                        <div class="mb-4">
                            <label for="focus_keyword" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-key text-blue-500 mr-1"></i> Focus Keyword
                            </label>
                            @php
                                $blogSeo = \App\Models\PageSeoSetting::where('page_identifier', 'blog-' . $blog->slug)->first();
                                $focusKeyword = $blogSeo ? $blogSeo->focus_keyword : '';
                            @endphp
                            <input type="text" name="focus_keyword" id="focus_keyword" class="form-input w-full rounded-md" value="{{ old('focus_keyword', $focusKeyword) }}" placeholder="keyword utama artikel">
                            <p class="text-gray-500 text-xs mt-1">Kata kunci yang menjadi fokus optimasi SEO artikel ini</p>
                        </div>
                        
                        <!-- Metadata Dasar -->
                        <div class="mb-4 pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-search text-blue-500 mr-2"></i> Metadata Dasar:
                            </h4>
                            
                            <!-- SEO Title -->
                            <div class="mb-3">
                                <label for="seo_title" class="block text-xs font-medium text-gray-700 mb-1">
                                    Title <span class="text-xs text-gray-500">(maks. 60 karakter)</span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="seo_title" name="seo_title" 
                                        value="{{ old('seo_title', $blogSeo ? $blogSeo->title : '') }}"
                                        class="form-input w-full rounded-md text-sm"
                                        maxlength="100"
                                        placeholder="Judul untuk mesin pencari (kosongkan untuk gunakan judul artikel)">
                                    <span class="absolute right-2 bottom-2 text-xs text-gray-500">
                                        <span id="seoTitleCount">0</span>/60
                                    </span>
                                </div>
                            </div>
                            
                            <!-- SEO Description -->
                            <div class="mb-3">
                                <label for="seo_description" class="block text-xs font-medium text-gray-700 mb-1">
                                    Meta Description <span class="text-xs text-gray-500">(maks. 160 karakter)</span>
                                </label>
                                <div class="relative">
                                    <textarea id="seo_description" name="seo_description" rows="2"
                                        class="form-textarea w-full rounded-md text-sm"
                                        maxlength="255"
                                        placeholder="Deskripsi singkat untuk mesin pencari (kosongkan untuk gunakan deskripsi artikel)">{{ old('seo_description', $blogSeo ? $blogSeo->description : '') }}</textarea>
                                    <span class="absolute right-2 bottom-2 text-xs text-gray-500">
                                        <span id="seoDescriptionCount">0</span>/160
                                    </span>
                                </div>
                            </div>
                            
                            <!-- SEO Keywords -->
                            <div class="mb-3">
                                <label for="seo_keywords" class="block text-xs font-medium text-gray-700 mb-1">
                                    Meta Keywords <span class="text-xs text-gray-500">(pisahkan dengan koma)</span>
                                </label>
                                <input type="text" id="seo_keywords" name="seo_keywords" 
                                    value="{{ old('seo_keywords', $blogSeo ? $blogSeo->keywords : '') }}"
                                    class="form-input w-full rounded-md text-sm"
                                    placeholder="kata-kunci, seo, artikel, blog">
                            </div>
                        </div>
                        
                        <!-- Preview SERP Google -->
                        <div class="mb-4 pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-search text-blue-500 mr-2"></i> Preview di Google:
                            </h4>
                            <div class="p-3 bg-white rounded border border-gray-300">
                                <h5 id="seo-preview-title" class="text-blue-600 font-medium text-base line-clamp-1">{{ $blog->title }}</h5>
                                <div class="text-green-600 text-xs mt-1">{{ url('/') }}/<span id="seo-preview-slug">{{ $blog->slug }}</span></div>
                                <p id="seo-preview-desc" class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $blog->description }}</p>
                            </div>
                        </div>
                        
                        <!-- SEO Tips -->
                        <div class="pt-3 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Tips:
                            </h4>
                            <div id="seo-tips" class="text-xs text-gray-600 bg-yellow-50 p-3 rounded">
                                Masukkan focus keyword untuk mulai analisis SEO.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Panel SEO Checklist - Kanan -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-blue-500 mr-2"></i> SEO Checklist:
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <!-- Kolom Checklist Kiri -->
                            <div class="space-y-3">
                                <div class="flex items-center" id="keyword-presence">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Keyword dalam konten</span>
                                </div>
                                
                                <div class="flex items-center" id="keyword-title">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Keyword dalam judul</span>
                                </div>
                                
                                <div class="flex items-center" id="keyword-desc">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Keyword dalam deskripsi</span>
                                </div>
                                
                                <div class="flex items-center" id="keyword-density">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Kepadatan keyword (1-3%)</span>
                                </div>
                                
                                <div class="flex items-center" id="content-length">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Panjang konten (min. 300 kata)</span>
                                </div>
                            </div>
                            
                            <!-- Kolom Checklist Kanan -->
                            <div class="space-y-3">
                                <div class="flex items-center" id="seo-title-length">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Panjang judul (50-60 karakter)</span>
                                </div>
                                
                                <div class="flex items-center" id="seo-desc-length">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Panjang deskripsi (120-160 karakter)</span>
                                </div>
                                
                                <div class="flex items-center" id="header-presence">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Heading (H2, H3) dengan keyword</span>
                                </div>

                                <div class="flex items-center" id="image-alt">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">Alt text pada gambar</span>
                                </div>
                                
                                <div class="flex items-center" id="url-friendly">
                                    <i class="fas fa-circle-check text-gray-300 mr-2"></i>
                                    <span class="text-gray-500">URL yang SEO friendly</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.blogs.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" name="save_draft" value="1" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-save mr-1"></i> Simpan Draft
                </button>
                <button type="submit" class="btn-primary flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> {{ $blog->status == 'published' ? 'Update Blog' : 'Publikasikan' }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Gambar -->
<div id="deleteImageModal" class="fixed inset-0 hidden z-50">
    <div class="fixed inset-0 bg-black bg-opacity-50" id="deleteImageBackdrop"></div>
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 z-50">
            <div class="p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus Gambar</h3>
                        <p class="mt-2 text-sm text-gray-500">Apakah Anda yakin ingin menghapus gambar ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="cancelDeleteImage" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">Batal</button>
                    <button type="button" id="confirmDeleteImage" class="px-4 py-2 border border-transparent rounded-md text-white bg-red-600 hover:bg-red-700">Hapus Gambar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    /* Style untuk TinyMCE */
    .tox-tinymce {
        border-radius: 0.375rem !important;
    }
    
    .tox-statusbar {
        border-top: 1px solid #e5e7eb !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // TinyMCE initialization
        if (document.getElementById('content')) {
            tinymce.init({
                selector: '#content',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                height: 500,
                menubar: false,
                setup: function(editor) {
                    editor.on('change', function() {
                        updateTableOfContents();
                    });
                    editor.on('keyup', function() {
                        updateTableOfContents();
                    });
                }
            });
        }

        // Function to update the TOC automatically
        function updateTableOfContents() {
            const tocPreview = document.getElementById('toc_preview');
            if (!tocPreview) return;
            
            let content = '';
            
            if (tinymce.get('content')) {
                content = tinymce.get('content').getContent();
            } else {
                const contentEl = document.getElementById('content');
                if (!contentEl) return;
                content = contentEl.value;
            }
            
            // Parse the content to find headings
            const parser = new DOMParser();
            const doc = parser.parseFromString(content, 'text/html');
            const h2Elements = Array.from(doc.querySelectorAll('h2'));
            const h3Elements = Array.from(doc.querySelectorAll('h3'));
            
            if (h2Elements.length === 0 && h3Elements.length === 0) {
                tocPreview.innerHTML = '<div class="text-gray-500 italic text-xs">Tidak ada heading yang ditemukan. Tambahkan heading H2 atau H3 ke konten untuk membuat TOC.</div>';
                return;
            }
            
            // Create TOC structure
            let tocHtml = '<ul class="list-disc pl-5 space-y-1">';
            
            // Process H2 headings first
            h2Elements.forEach((h2, index) => {
                const headingText = h2.textContent.trim();
                if (!headingText) return;
                
                // Buat ID yang konsisten dari teks heading
                const headingSlug = headingText.toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                const headingId = `h2-${headingSlug}`;
                
                // Set ID untuk heading
                h2.id = headingId;
                
                tocHtml += `<li><a href="#${headingId}" class="text-blue-600 hover:underline">${headingText}</a>`;
                
                // Check for H3 headings that follow this H2
                const nextH2 = h2Elements[index + 1];
                const h3Subset = h3Elements.filter(h3 => {
                    if (!nextH2) return h2.compareDocumentPosition(h3) & Node.DOCUMENT_POSITION_FOLLOWING;
                    return (h2.compareDocumentPosition(h3) & Node.DOCUMENT_POSITION_FOLLOWING) && 
                           (nextH2.compareDocumentPosition(h3) & Node.DOCUMENT_POSITION_PRECEDING);
                });
                
                if (h3Subset.length > 0) {
                    tocHtml += '<ul class="pl-4 mt-1 space-y-1">';
                    h3Subset.forEach((h3) => {
                        const subHeadingText = h3.textContent.trim();
                        if (!subHeadingText) return;
                        
                        // Buat ID yang konsisten untuk sub-heading
                        const subHeadingSlug = subHeadingText.toLowerCase()
                            .replace(/[^a-z0-9]+/g, '-')
                            .replace(/(^-|-$)/g, '');
                        const subHeadingId = `h3-${headingSlug}-${subHeadingSlug}`;
                        
                        // Set ID untuk heading
                        h3.id = subHeadingId;
                        
                        tocHtml += `<li><a href="#${subHeadingId}" class="text-blue-600 hover:underline">${subHeadingText}</a></li>`;
                    });
                    tocHtml += '</ul>';
                }
                
                tocHtml += '</li>';
            });
            
            tocHtml += '</ul>';
            
            // Update the preview
            tocPreview.innerHTML = tocHtml;
            
            // Update content with IDs
            if (tinymce.get('content')) {
                const editor = tinymce.get('content');
                const editorData = editor.getContent();
                const updatedContent = doc.body.innerHTML;
                
                // Hanya update jika ada perubahan
                if (editorData !== updatedContent) {
                    // Simpan posisi cursor saat ini
                    const bookmarkManager = editor.selection.getBookmark(2, true, true);
                    
                    // Set content dengan ID yang sudah dibuat
                    editor.setContent(updatedContent, {format: 'html'});
                    
                    // Pulihkan posisi cursor
                    editor.selection.moveToBookmark(bookmarkManager);
                }
            }
        }

        // Slug generator
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        const imageAltInput = document.getElementById('image_alt');
        const imageNameInput = document.getElementById('image_name');
        
        // Cek apakah slug sudah diubah secara manual
        let slugManuallyChanged = slugInput.dataset.auto === 'false';
        
        // Function to convert title to slug
        function generateSlug(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word characters
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start
                .replace(/-+$/, '');            // Trim - from end
        }
        
        // Generate slug when title changes
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                const titleValue = titleInput.value.trim();
                
                // Update slug
                if (!slugInput.value || slugInput.dataset.auto === 'true') {
                    slugInput.value = generateSlug(titleValue);
                    slugInput.dataset.auto = 'true';
                }
                
                // Update alt text if empty or auto-generated
                if (imageAltInput && (!imageAltInput.value || imageAltInput.dataset.auto === 'true')) {
                    imageAltInput.value = titleValue ? `Gambar ${titleValue}` : '';
                    imageAltInput.dataset.auto = 'true';
                }
                
                // Update image name if empty or auto-generated
                if (imageNameInput && (!imageNameInput.value || imageNameInput.dataset.auto === 'true')) {
                    imageNameInput.value = generateSlug(titleValue);
                    imageNameInput.dataset.auto = 'true';
                }
            });
            
            // When slug is manually edited, stop automatic updates
            slugInput.addEventListener('input', function() {
                slugInput.dataset.auto = 'false';
            });
        }
        
        // Jika alt text diubah manual, hapus flag auto
        if (imageAltInput) {
            imageAltInput.addEventListener('input', function() {
                imageAltInput.dataset.auto = 'false';
            });
        }
        
        // Jika image name diubah manual, hapus flag auto
        if (imageNameInput) {
            imageNameInput.addEventListener('input', function() {
                imageNameInput.dataset.auto = 'false';
            });
        }
        
        // Character counter for description
        const descriptionTextarea = document.getElementById('description');
        const descriptionCount = document.getElementById('description-count');
        
        if (descriptionTextarea && descriptionCount) {
            descriptionTextarea.addEventListener('input', function() {
                const count = this.value.length;
                descriptionCount.textContent = count;
                
                if (count > 255) {
                    descriptionCount.classList.add('text-red-500');
                } else {
                    descriptionCount.classList.remove('text-red-500');
                }
            });
            
            // Trigger the input event to initialize the count
            const descriptionEvent = new Event('input');
            descriptionTextarea.dispatchEvent(descriptionEvent);
        }
        
        // Image Upload Preview
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const removeButton = document.getElementById('delete-image-completely');
        const dropzoneUpload = document.getElementById('dropzone-upload');
        const imageMetaFields = document.getElementById('image-meta-fields');
        
        function updateImagePreview() {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    removeButton.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                    imageMetaFields.classList.remove('hidden');
                    
                    // Hapus flag delete_image jika ada
                    const deleteImageInput = document.getElementById('delete_image');
                    if (deleteImageInput) {
                        deleteImageInput.parentNode.removeChild(deleteImageInput);
                    }
                    
                    // Selalu isi alt text dengan judul blog jika gambar baru ditambahkan
                    if (imageAltInput) {
                        const titleValue = titleInput.value.trim();
                        imageAltInput.value = titleValue ? `Gambar ${titleValue}` : '';
                        imageAltInput.dataset.auto = 'true';
                    }
                    
                    // Prefill image name field with sanitized filename (without extension) if empty
                    if (imageNameInput) {
                        const fileName = file.name.replace(/\.[^/.]+$/, ""); // Remove extension
                        imageNameInput.value = sanitizeFileName(fileName);
                        imageNameInput.dataset.auto = 'true';
                    }
                }
                
                reader.readAsDataURL(file);
            }
        }
        
        if (imageInput) {
            imageInput.addEventListener('change', updateImagePreview);
        }
        
        if (removeButton) {
            removeButton.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                    // Bersihkan input gambar
                    imageInput.value = '';
                    // Sembunyikan preview dan tampilkan form upload
                    previewContainer.classList.add('hidden');
                    uploadPrompt.classList.remove('hidden');
                    imageMetaFields.classList.add('hidden');
                    
                    // Reset nilai input gambar
                    if (imageNameInput) imageNameInput.value = '';
                    if (imageAltInput) imageAltInput.value = '';
                    
                    // Tambahkan input tersembunyi untuk menandai gambar untuk dihapus saat form disubmit
                    if (!document.getElementById('delete_image')) {
                        const deleteInput = document.createElement('input');
                        deleteInput.type = 'hidden';
                        deleteInput.name = 'delete_image';
                        deleteInput.id = 'delete_image';
                        deleteInput.value = '1';
                        document.querySelector('#blogForm').appendChild(deleteInput);
                    } else {
                        document.getElementById('delete_image').value = '1';
                    }
                    
                    // Tampilkan notifikasi
                    const flashMessage = document.createElement('div');
                    flashMessage.classList.add('bg-blue-100', 'border', 'border-blue-400', 'text-blue-700', 'px-4', 'py-3', 'rounded', 'mb-4');
                    flashMessage.innerHTML = '<span class="font-bold">Info!</span> Gambar akan dihapus saat Anda menyimpan perubahan.';
                    document.querySelector('#blogForm').prepend(flashMessage);
                    
                    // Hapus notifikasi setelah 5 detik
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 5000);
                }
            });
        }
        
        // Drag and drop handling
        if (dropzoneUpload) {
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
                e.preventDefault();
                e.stopPropagation();
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length && imageInput) {
                    imageInput.files = files;
                    updateImagePreview();
                }
            }
        }
        
        // Function to sanitize filename for URL
        function sanitizeFileName(name) {
            return name
                .toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special chars except spaces and hyphens
                .replace(/\s+/g, '-')     // Replace spaces with hyphens
                .replace(/-+/g, '-')      // Remove consecutive hyphens
                .trim();
        }
        
        // Validasi form
        const form = document.getElementById('blogForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitButton = document.activeElement;
                const isDraft = (submitButton && submitButton.name === 'save_draft');
                
                // Validasi deskripsi
                if (descriptionTextarea && descriptionTextarea.value.length > 255) {
                    e.preventDefault();
                    alert('Deskripsi tidak boleh lebih dari 255 karakter.');
                    descriptionTextarea.focus();
                    return false;
                }
                
                // Set status draft jika tombol simpan draft ditekan
                if (isDraft) {
                    const statusEl = document.getElementById('status-draft');
                    if (statusEl) {
                        statusEl.checked = true;
                    }
                }
                
                // Nonaktifkan tombol setelah submit untuk mencegah double submission
                if (submitButton) {
                    submitButton.disabled = true;
                    
                    // Re-enable setelah 3 detik untuk jaga-jaga jika ada error
                    setTimeout(() => {
                        submitButton.disabled = false;
                    }, 3000);
                }
            });
        }
        
        // Update awal TOC
        setTimeout(updateTableOfContents, 1000);
    });
</script>
@endpush