@extends('layouts.admin')

@section('title', 'SEO Management')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">SEO Management</h2>
            <p class="text-gray-600 mt-1">Kelola pengaturan SEO untuk meningkatkan peringkat website Anda di mesin pencari.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button form="seoForm" type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> Simpan Semua Perubahan
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Main Content Area with Flex Layout -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Column (Reports & Tips) - 1/3 width on large screens -->
        <div class="lg:w-1/3">
            <!-- SEO Reports -->
            <div class="mb-6 bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Laporan SEO</h3>
                    <button type="button" id="refresh-report" class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full hover:bg-indigo-200 transition-colors duration-200">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh Laporan
                    </button>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-indigo-50 p-3 rounded-lg border border-indigo-100 hover:border-indigo-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-indigo-700 font-medium text-sm">Skor SEO</div>
                            <div class="text-indigo-700"><i class="fas fa-chart-line"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800"><span id="seo-score">0</span>/100</div>
                        <div id="seo-score-change" class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +<span>0</span>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 hover:border-blue-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-blue-700 font-medium text-sm">Kata Kunci</div>
                            <div class="text-blue-700"><i class="fas fa-key"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800"><span id="keywords-count">0</span></div>
                        <div id="keywords-change" class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +<span>0</span>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-3 rounded-lg border border-green-100 hover:border-green-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-green-700 font-medium text-sm">Backlinks</div>
                            <div class="text-green-700"><i class="fas fa-link"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800"><span id="backlinks-count">0</span></div>
                        <div id="backlinks-change" class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +<span>0</span>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100 hover:border-yellow-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-yellow-700 font-medium text-sm">Page Speed</div>
                            <div class="text-yellow-700"><i class="fas fa-tachometer-alt"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800"><span id="page-speed">0</span>/100</div>
                        <div id="page-speed-change" class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +<span>0</span>
                        </div>
                    </div>
                </div>
                
                <!-- SEO Tips -->
                <div class="mt-4" id="seo-tips">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Tips Optimasi:</h4>
                    <div class="space-y-2">
                        <!-- Tips will be inserted here -->
                    </div>
                </div>
            </div>
            
            <!-- SEO Tips -->
            <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Tips SEO</h3>
                    <button class="text-gray-400 hover:text-indigo-600 focus:outline-none transition-colors duration-200">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                
                <div class="space-y-3">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded-r-lg hover:bg-blue-100 transition-colors duration-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-lightbulb text-blue-500"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-blue-800">Optimalkan Meta</h4>
                                <p class="text-xs text-blue-700 mt-1">Pastikan deskripsi meta unik dan berisi kata kunci relevan (maks 160 karakter).</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-r-lg hover:bg-green-100 transition-colors duration-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-green-800">URL SEO-friendly</h4>
                                <p class="text-xs text-green-700 mt-1">Gunakan URL singkat dan deskriptif dengan kata kunci utama.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-3 rounded-r-lg hover:bg-yellow-100 transition-colors duration-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-yellow-800">Waktu Muat Halaman</h4>
                                <p class="text-xs text-yellow-700 mt-1">Kompres gambar, minify CSS/JS, dan gunakan caching untuk meningkatkan kecepatan website.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3 pt-3 border-t border-gray-100 text-center">
                    <a href="#" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 inline-block transition-colors duration-200">
                        Lihat semua tips
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Right Column (SEO Settings) - 2/3 width on large screens -->
        <div class="lg:w-2/3">
            <form id="seoForm" action="{{ route('admin.seo.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- Tabs Navigation -->
            <div class="bg-white rounded-lg shadow-sm mb-6 border border-gray-200">
                <div class="border-b border-gray-200">
                        <ul class="flex flex-wrap" id="seoTabs" role="tablist">
                        <li class="mr-1">
                                <a href="#meta" id="tab-meta" data-toggle="tab" role="tab" aria-controls="meta" aria-selected="true" class="inline-block py-3 px-4 text-indigo-600 border-b-2 border-indigo-600 font-medium text-sm rounded-t-lg hover:bg-indigo-50 transition-colors duration-200">
                                <i class="fas fa-tags mr-1"></i> Meta Tags
                            </a>
                        </li>
                        <li class="mr-1">
                                <a href="#sitemap" id="tab-sitemap" data-toggle="tab" role="tab" aria-controls="sitemap" aria-selected="false" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-sitemap mr-1"></i> Sitemap
                            </a>
                        </li>
                        <li class="mr-1">
                                <a href="#social" id="tab-social" data-toggle="tab" role="tab" aria-controls="social" aria-selected="false" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-share-alt mr-1"></i> Social Media
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#analytics" id="tab-analytics" data-toggle="tab" role="tab" aria-controls="analytics" aria-selected="false" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-chart-bar mr-1"></i> Analytics
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#advanced" id="tab-advanced" data-toggle="tab" role="tab" aria-controls="advanced" aria-selected="false" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-cogs mr-1"></i> Advanced
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- SEO Content Tabs -->
            <div class="tab-content">
                <!-- Meta Tags Form -->
                    <div id="content-meta" class="tab-pane active bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Meta Tags</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                <i class="fas fa-info-circle mr-1"></i> Dioptimalkan 85%
                            </div>
                        </div>
                    </div>
                        
                        <!-- Page Selector -->
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 mb-5 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                <div>
                                    <h4 class="font-medium text-indigo-800 mb-1">Pilih Halaman</h4>
                                    <p class="text-sm text-indigo-700">Edit pengaturan SEO untuk halaman tertentu atau global</p>
                                </div>
                                <div class="w-full md:w-72">
                                    <select id="page-selector" class="w-full px-3 py-2 border border-indigo-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <option value="global">Pengaturan Global (Semua Halaman)</option>
                                        <optgroup label="Halaman Website">
                                            @foreach($pageSettings as $page)
                                            <option value="{{ $page->id }}">{{ ucwords(str_replace(['-', '/'], [' ', ' > '], $page->route ?: 'Home')) }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div>
                                    <button type="button" id="edit-selected-page" class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i> Edit Halaman
                                    </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Global SEO Settings Card -->
                        <div id="global-seo-settings" class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Pengaturan Global</h4>
                                <button type="button" class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
                                <i class="fas fa-magic mr-1"></i> Auto Optimize
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="site_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    <div class="flex items-center">
                                        <span>Judul Website</span>
                                        <span class="ml-1 text-green-600"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </label>
                                    <input type="text" id="site_title" name="site_title" value="{{ $seoSettings->site_title ?? '' }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Judul website pada hasil pencarian</p>
                                        <p class="text-xs text-gray-500"><span id="site_title_count">{{ strlen($seoSettings->site_title ?? '') }}</span>/60 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="site_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    <div class="flex items-center">
                                        <span>Deskripsi Website</span>
                                        <span class="ml-1 text-green-600"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </label>
                                <textarea id="site_description" name="site_description" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $seoSettings->site_description ?? '' }}</textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Deskripsi singkat website</p>
                                        <p class="text-xs text-gray-500"><span id="site_description_count">{{ strlen($seoSettings->site_description ?? '') }}</span>/160 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="site_keywords" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                                    <input type="text" id="site_keywords" name="site_keywords" value="{{ $seoSettings->site_keywords ?? '' }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <p class="text-xs text-gray-500 mt-1">Pisahkan kata kunci dengan koma</p>
                        </div>
                        
                                <div>
                                    <label for="meta_robots" class="block text-sm font-medium text-gray-700 mb-1">Robot Settings</label>
                                    <select name="meta_robots" id="meta_robots" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <option value="index, follow" {{ ($seoSettings->meta_robots ?? '') == 'index, follow' ? 'selected' : '' }}>index, follow (Recommended)</option>
                                        <option value="noindex, follow" {{ ($seoSettings->meta_robots ?? '') == 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
                                        <option value="index, nofollow" {{ ($seoSettings->meta_robots ?? '') == 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option>
                                        <option value="noindex, nofollow" {{ ($seoSettings->meta_robots ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Atur bagaimana robot pencari memperlakukan situs Anda</p>
                        </div>
                    </div>
                        </div>
                        
                    <!-- Page Specific SEO Settings Card -->
                        <div id="page-seo-settings" class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200 hidden">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Pengaturan Halaman Spesifik</h4>
                            <button type="button" class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
                                <i class="fas fa-magic mr-1"></i> Auto Optimize
                                </button>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="page_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    <div class="flex items-center">
                                        <span>Judul Halaman</span>
                                        <span class="ml-1 text-green-600"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </label>
                                <input type="text" id="page_title" name="page_title" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                        <p class="text-xs text-gray-500">Judul halaman pada hasil pencarian</p>
                                        <p class="text-xs text-gray-500"><span id="page_title_count">0</span>/60 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                    <label for="page_description" class="block text-sm font-medium text-gray-700 mb-1">
                                        <div class="flex items-center">
                                            <span>Deskripsi Halaman</span>
                                            <span class="ml-1 text-green-600"><i class="fas fa-check-circle"></i></span>
                                        </div>
                                    </label>
                                <textarea id="page_description" name="page_description" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"></textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Deskripsi singkat halaman</p>
                                        <p class="text-xs text-gray-500"><span id="page_description_count">0</span>/160 karakter</p>
                                </div>
                            </div>
                                
                                <div>
                                    <label for="page_keywords" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                                <input type="text" id="page_keywords" name="page_keywords"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <p class="text-xs text-gray-500 mt-1">Pisahkan kata kunci dengan koma</p>
                        </div>
                                
                                <div>
                                <label for="page_robots" class="block text-sm font-medium text-gray-700 mb-1">Robot Settings</label>
                                <select name="page_robots" id="page_robots" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="index, follow">index, follow (Recommended)</option>
                                    <option value="noindex, follow">noindex, follow</option>
                                    <option value="index, nofollow">index, nofollow</option>
                                    <option value="noindex, nofollow">noindex, nofollow</option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Atur bagaimana robot pencari memperlakukan halaman ini</p>
                </div>
                        </div>
                    </div>
                    
                    <!-- SEO Preview Card -->
                    <div class="bg-white p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Preview SEO Google</h4>
                            <button type="button" id="refresh-preview" class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
                                <i class="fas fa-sync-alt mr-1"></i> Refresh Preview
                            </button>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <div id="preview-title" class="text-xl text-blue-600 font-medium mb-1 hover:underline cursor-pointer">
                                Lorem Ipsum Dolor Sit Amet
                            </div>
                            <div id="preview-url" class="text-green-700 text-sm mb-1">
                                https://example.com/lorem-ipsum-dolor-sit-amet
                                </div>
                            <div id="preview-description" class="text-gray-700 text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </div>
                    </div>
                    
                        <div class="flex items-center text-sm text-gray-500 mt-3">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Preview ini menunjukkan bagaimana halaman Anda akan muncul di hasil pencarian Google</span>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Sitemap Tab -->
                    <div id="content-sitemap" class="tab-pane hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pengaturan Sitemap</h3>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                            <div class="mb-4">
                                <p class="text-gray-700 mb-2">Sitemap membantu mesin pencari menemukan semua halaman di situs Anda.</p>
                                
                        <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-700">Status: 
                                        @if(file_exists(public_path('sitemap.xml')))
                                            <span class="text-green-600 font-medium">Aktif</span>
                                        @else
                                            <span class="text-red-600 font-medium">Tidak Aktif</span>
                                        @endif
                                    </div>
                                    <div class="text-sm text-gray-700">
                                        @if(file_exists(public_path('sitemap.xml')))
                                            Terakhir diperbarui: {{ date('d M Y H:i', filemtime(public_path('sitemap.xml'))) }}
                                        @endif
                                    </div>
                                </div>
                        </div>
                        
                            <div class="flex items-center mb-4">
                                <div class="flex">
                                    <button type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-l-lg flex items-center transition-all duration-200">
                                        <i class="fas fa-sync-alt mr-2"></i> Generate Sitemap
                                            </button>
                                    <input type="hidden" name="generate_sitemap" id="generate_sitemap" value="0">
                                    <button type="button" onclick="document.getElementById('generate_sitemap').value='1'; document.getElementById('seoForm').submit();" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-r-lg flex items-center transition-all duration-200">
                                        <i class="fas fa-save mr-2"></i> Simpan & Generate
                                            </button>
                        </div>
                        
                                @if(file_exists(public_path('sitemap.xml')))
                                <a href="{{ url('sitemap.xml') }}" target="_blank" class="ml-2 px-3 py-2 text-indigo-600 hover:text-indigo-800 font-medium">
                                    <i class="fas fa-external-link-alt mr-1"></i> Lihat Sitemap
                                </a>
                                @endif
                            </div>
                            
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded-r-lg">
                                <p class="text-sm text-blue-800">
                                    <i class="fas fa-info-circle mr-1"></i> 
                                    Sitemap Anda akan otomatis mencakup semua halaman utama website.
                                </p>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Robots.txt</h4>
                </div>

                            <div class="mb-4">
                                <p class="text-gray-700 mb-2">File robots.txt memberi tahu mesin pencari bagian mana dari situs yang boleh diakses.</p>
                                
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-700">Status: 
                                        @if(file_exists(public_path('robots.txt')))
                                            <span class="text-green-600 font-medium">Aktif</span>
                                        @else
                                            <span class="text-red-600 font-medium">Tidak Aktif</span>
                                        @endif
                            </div>
                        </div>
                    </div>
                    
                            <div class="flex items-center mb-4">
                                <div class="flex">
                                    <input type="hidden" name="generate_robots" id="generate_robots" value="0">
                                    <button type="button" onclick="document.getElementById('generate_robots').value='1'; document.getElementById('seoForm').submit();" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200">
                                        <i class="fas fa-sync-alt mr-2"></i> Generate Robots.txt
                                </button>
                        </div>
                        
                                @if(file_exists(public_path('robots.txt')))
                                <a href="{{ url('robots.txt') }}" target="_blank" class="ml-2 px-3 py-2 text-indigo-600 hover:text-indigo-800 font-medium">
                                    <i class="fas fa-external-link-alt mr-1"></i> Lihat Robots.txt
                                </a>
                                @endif
                            </div>
                            </div>
                        </div>
                    
                    <!-- Social Media Tab -->
                    <div id="content-social" class="tab-pane hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pengaturan Social Media</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Social Media Settings -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Open Graph (Facebook)</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                    <label for="og_title" class="block text-sm font-medium text-gray-700 mb-1">OG Title</label>
                                    <input type="text" id="og_title" name="og_title" value="{{ $seoSettings->og_title }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                        <p class="text-xs text-gray-500">Judul untuk dibagikan di social media</p>
                                        <p class="text-xs text-gray-500"><span id="og_title_count">{{ strlen($seoSettings->og_title) }}</span>/60 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                    <label for="og_description" class="block text-sm font-medium text-gray-700 mb-1">OG Description</label>
                                <textarea id="og_description" name="og_description" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $seoSettings->og_description }}</textarea>
                                <div class="flex justify-between mt-1">
                                        <p class="text-xs text-gray-500">Deskripsi untuk dibagikan di social media</p>
                                        <p class="text-xs text-gray-500"><span id="og_description_count">{{ strlen($seoSettings->og_description) }}</span>/160 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                    <label for="og_image" class="block text-sm font-medium text-gray-700 mb-1">OG Image</label>
                                <div class="flex items-center">
                                        <input type="text" id="og_image" name="og_image" value="{{ $seoSettings->og_image }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <label for="og_image_file" class="cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-r-md flex items-center transition-all duration-200">
                                            <i class="fas fa-upload mr-1"></i> Browse
                                        </label>
                                        <input type="file" id="og_image_file" name="og_image_file" class="hidden" accept="image/*">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Gambar untuk dibagikan di social media (ideal: 1200 x 630 px)</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media Preview -->
                        <div class="bg-white p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Preview Social Media</h4>
                                <button type="button" id="refresh-social-preview" class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
                                    <i class="fas fa-sync-alt mr-1"></i> Refresh Preview
                                </button>
                                        </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <div class="text-sm text-gray-500 mb-2">Facebook Preview:</div>
                                <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <div id="preview-og-image" class="bg-gray-200 h-24 rounded flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                    </div>
                            </div>
                                        <div class="w-2/3 pl-3">
                                            <div id="preview-og-title" class="text-blue-700 font-medium text-sm mb-1 truncate">Judul untuk Social Media</div>
                                            <div id="preview-og-description" class="text-gray-600 text-xs line-clamp-2">Deskripsi untuk social media...</div>
                                            <div id="preview-og-url" class="text-gray-500 text-xs mt-1 truncate">example.com</div>
                        </div>
                    </div>
                        </div>
                        
                                <div class="mt-4">
                                    <div class="text-sm text-gray-500 mb-2">Twitter Preview:</div>
                                    <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                        <div class="flex">
                                            <div class="w-1/3">
                                                <div id="preview-twitter-image" class="bg-gray-200 h-24 rounded flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400"></i>
                                                </div>
                                            </div>
                                            <div class="w-2/3 pl-3">
                                                <div id="preview-twitter-title" class="text-blue-700 font-medium text-sm mb-1 truncate">Judul untuk Twitter</div>
                                                <div id="preview-twitter-description" class="text-gray-600 text-xs line-clamp-2">Deskripsi untuk Twitter...</div>
                                                <div id="preview-twitter-url" class="text-gray-500 text-xs mt-1 truncate">example.com</div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                                <div class="mt-4 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <span>Preview ini menunjukkan bagaimana konten Anda akan muncul saat dibagikan di social media</span>
                                </div>
                            </div>
                                </div>
                            </div>
                    </div>
                    
                <!-- Analytics Tab -->
                <div id="content-analytics" class="tab-pane hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Analytics</h3>
                                            </div>
                                                        
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Google Analytics</h4>
                                            </div>
                                                        
                        <div class="grid grid-cols-1 gap-4">
                                                        <div>
                                <label for="google_analytics_id" class="block text-sm font-medium text-gray-700 mb-1">Google Analytics ID</label>
                                <input type="text" id="google_analytics_id" name="google_analytics_id" value="{{ $seoSettings->google_analytics_id }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" 
                                    placeholder="GA-XXXXXXXXXX">
                                <p class="text-xs text-gray-500 mt-1">Contoh: GA-12345678 atau G-XXXXXX</p>
                                        </div>

                                                        <div>
                                <label for="google_tag_manager" class="block text-sm font-medium text-gray-700 mb-1">Google Tag Manager ID</label>
                                <input type="text" id="google_tag_manager" name="google_tag_manager" value="{{ $seoSettings->google_tag_manager }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" 
                                    placeholder="GTM-XXXXXX">
                                <p class="text-xs text-gray-500 mt-1">ID Google Tag Manager Anda</p>
                            </div>
                                    </div>
                                                            </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Facebook Pixel</h4>
                                                        </div>
                                                        
                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                <label for="facebook_pixel_id" class="block text-sm font-medium text-gray-700 mb-1">Facebook Pixel ID</label>
                                <input type="text" id="facebook_pixel_id" name="facebook_pixel_id" value="{{ $seoSettings->facebook_pixel_id }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" 
                                    placeholder="XXXXXXXXXXXXXXX">
                                <p class="text-xs text-gray-500 mt-1">ID Facebook Pixel Anda</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                
                <!-- Advanced Tab -->
                <div id="content-advanced" class="tab-pane hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Lanjutan</h3>
                                </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Schema Markup</h4>
                            </div>
                            
                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                <label for="schema_markup" class="block text-sm font-medium text-gray-700 mb-1">Schema Markup</label>
                                <textarea id="schema_markup" name="schema_markup" rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder='<script type="application/ld+json">{ ... }</script>'>{{ $seoSettings->schema_markup }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan kode schema markup JSON-LD</p>
                                            </div>
                                            </div>
                                        </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Custom Head Tags</h4>
                                    </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="custom_head_tags" class="block text-sm font-medium text-gray-700 mb-1">Custom Head Tags</label>
                                <textarea id="custom_head_tags" name="custom_head_tags" rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="<meta name=... ><link ...>">{{ $seoSettings->custom_head_tags }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Tag HTML tambahan untuk bagian head</p>
                                </div>
                            </div>
                        </div>
                                        
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Canonical URLs</h4>
                    </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="canonical_urls" class="block text-sm font-medium text-gray-700 mb-1">Canonical URLs</label>
                                <textarea id="canonical_urls" name="canonical_urls" rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                    placeholder="URL asli,URL kanonik">{{ $seoSettings->canonical_urls }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan URL asli dan URL kanonik, dipisahkan dengan koma</p>
                            </div>
                </div>
            </div>
        </div>
                </div>
            </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        const tabLinks = document.querySelectorAll('[data-toggle="tab"]');
        const tabContents = document.querySelectorAll('.tab-pane');
        
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                    e.preventDefault();
                
                // Remove active class from all tabs
                tabLinks.forEach(l => {
                    l.classList.remove('text-indigo-600', 'border-indigo-600');
                    l.classList.add('text-gray-500', 'border-transparent');
                });
                
                // Add active class to current tab
                this.classList.remove('text-gray-500', 'border-transparent');
                this.classList.add('text-indigo-600', 'border-indigo-600');
                    
                    // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });
                
                // Show current tab content
                const target = this.getAttribute('href').substring(1);
                const activeContent = document.getElementById('content-' + target);
                activeContent.classList.remove('hidden');
                activeContent.classList.add('active');
            });
        });
        
        // Edit Page Button Handler
        const editPageButton = document.getElementById('edit-selected-page');
        const pageSelector = document.getElementById('page-selector');

        if (editPageButton && pageSelector) {
            editPageButton.addEventListener('click', function() {
                const selectedPageId = pageSelector.value;
                
                if (selectedPageId === 'global') {
                    // Show global settings
                    document.getElementById('global-seo-settings').classList.remove('hidden');
                    document.getElementById('page-seo-settings').classList.add('hidden');
                    
                    // Update preview with global settings
                    const globalTitle = document.getElementById('site_title').value;
                    const globalDescription = document.getElementById('site_description').value;
                    
                    document.getElementById('preview-title').textContent = globalTitle;
                    document.getElementById('preview-description').textContent = globalDescription;
                    document.getElementById('preview-url').textContent = window.location.origin;
                } else {
                    // Show page-specific settings
                    document.getElementById('global-seo-settings').classList.add('hidden');
                    document.getElementById('page-seo-settings').classList.remove('hidden');
                    
                    // Load page-specific data via AJAX
                    fetch(`/admin/seo/page/${selectedPageId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Update form fields with page-specific data
                            document.getElementById('page_title').value = data.title || '';
                            document.getElementById('page_description').value = data.description || '';
                            document.getElementById('page_keywords').value = data.keywords || '';
                            document.getElementById('page_robots').value = data.meta_robots || 'index, follow';
                            
                            // Update preview with page-specific data
                            document.getElementById('preview-title').textContent = data.title || 'Judul Halaman';
                            document.getElementById('preview-description').textContent = data.description || 'Deskripsi halaman akan muncul di sini...';
                            
                            // Update URL preview
                            const selectedPageText = pageSelector.options[pageSelector.selectedIndex].text;
                            const pagePath = selectedPageText.toLowerCase()
                                .replace(/\s+/g, '-')
                                .replace(/\s>\s/g, '/')
                                .replace(/^home$/i, '');
                            document.getElementById('preview-url').textContent = window.location.origin + (pagePath ? '/' + pagePath : '');
                        })
                        .catch(error => {
                            console.error('Error loading page data:', error);
                            alert('Gagal memuat data halaman. Silakan coba lagi.');
                        });
                }
            });
        }

        // Page Selector Change Handler
        if (pageSelector) {
            pageSelector.addEventListener('change', function() {
                // Trigger click on edit button when page is selected
                if (editPageButton) {
                    editPageButton.click();
                }
            });
        }
        
        // Character counters for text fields
        const countFields = [
            { field: 'site_title', counter: 'site_title_count', maxLength: 60 },
            { field: 'site_description', counter: 'site_description_count', maxLength: 160 },
            { field: 'og_title', counter: 'og_title_count', maxLength: 60 },
            { field: 'og_description', counter: 'og_description_count', maxLength: 160 }
        ];
        
        countFields.forEach(item => {
            const field = document.getElementById(item.field);
            const counter = document.getElementById(item.counter);
            
            if (field && counter) {
                field.addEventListener('input', function() {
                    updateCharCount(item.field, item.counter);
                });
            }
        });
        
        // Function to update character count
        function updateCharCount(fieldId, counterId) {
            const field = document.getElementById(fieldId);
            const counter = document.getElementById(counterId);
            
            if (field && counter) {
                const length = field.value.length;
                counter.textContent = length;
                
                // Get max length from field attributes
                const maxLength = field.getAttribute('data-max-length') || 
                    countFields.find(item => item.field === fieldId)?.maxLength || 60;
                
                if (length > maxLength) {
                    counter.classList.add('text-red-600');
                } else {
                    counter.classList.remove('text-red-600');
                }
            }
        }
        
        // File input preview
        const fileInput = document.getElementById('og_image_file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const fileName = this.files[0].name;
                    document.getElementById('og_image').value = 'images/seo/' + fileName;
                }
            });
        }
        
        // SEO Preview Update
        function updateSEOPreview() {
            const pageSelector = document.getElementById('page-selector');
            const selectedPageId = pageSelector.value;
            
            // Get current form values
            const title = document.getElementById('page_title').value || document.getElementById('site_title').value || 'Lorem Ipsum Dolor Sit Amet';
            const description = document.getElementById('page_description').value || document.getElementById('site_description').value || 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            
            // Update preview elements
            document.getElementById('preview-title').textContent = title;
            document.getElementById('preview-description').textContent = description;
            
            // Update URL based on selected page
            const baseUrl = window.location.origin;
            let pagePath = '';
            
            if (selectedPageId === 'global') {
                pagePath = '';
            } else {
                const selectedPageText = pageSelector.options[pageSelector.selectedIndex].text;
                pagePath = '/' + selectedPageText.toLowerCase().replace(/\s+/g, '-').replace(/\s>\s/g, '/');
            }
            
            const pageUrl = baseUrl + pagePath;
            document.getElementById('preview-url').textContent = pageUrl;
        }

        // Social Media Preview Update
        function updateSocialPreview() {
            const pageSelector = document.getElementById('page-selector');
            const selectedPageId = pageSelector.value;
            
            // Get current form values
            const ogTitle = document.getElementById('og_title').value;
            const ogDescription = document.getElementById('og_description').value;
            const ogImage = document.getElementById('og_image').value;
            
            // Update preview elements
            document.getElementById('preview-og-title').textContent = ogTitle;
            document.getElementById('preview-og-description').textContent = ogDescription;
            document.getElementById('preview-twitter-title').textContent = ogTitle;
            document.getElementById('preview-twitter-description').textContent = ogDescription;
            
            // Update URL based on selected page
            const baseUrl = window.location.origin;
            const pageUrl = selectedPageId === 'global' ? baseUrl : `${baseUrl}/${pageSelector.options[pageSelector.selectedIndex].text.toLowerCase().replace(/\s+/g, '-')}`;
            document.getElementById('preview-og-url').textContent = pageUrl.replace(/^https?:\/\//, '');
            document.getElementById('preview-twitter-url').textContent = pageUrl.replace(/^https?:\/\//, '');
            
            // Update OG image preview
            const ogImagePreview = document.getElementById('preview-og-image');
            const twitterImagePreview = document.getElementById('preview-twitter-image');
            
            if (ogImage) {
                ogImagePreview.style.backgroundImage = `url(${ogImage})`;
                ogImagePreview.style.backgroundSize = 'cover';
                ogImagePreview.style.backgroundPosition = 'center';
                ogImagePreview.innerHTML = '';
                
                twitterImagePreview.style.backgroundImage = `url(${ogImage})`;
                twitterImagePreview.style.backgroundSize = 'cover';
                twitterImagePreview.style.backgroundPosition = 'center';
                twitterImagePreview.innerHTML = '';
                } else {
                ogImagePreview.style.backgroundImage = 'none';
                ogImagePreview.innerHTML = '<i class="fas fa-image text-gray-400"></i>';
                
                twitterImagePreview.style.backgroundImage = 'none';
                twitterImagePreview.innerHTML = '<i class="fas fa-image text-gray-400"></i>';
            }
        }

        // Add event listeners for preview updates
        const seoPreviewFields = [
            'page_title', 'site_title',
            'page_description', 'site_description',
            'page-selector'
        ];

        const socialPreviewFields = [
            'og_title', 'og_description',
            'og_image', 'page-selector'
        ];

        seoPreviewFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', updateSEOPreview);
                field.addEventListener('change', updateSEOPreview);
            }
        });

        socialPreviewFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', updateSocialPreview);
                field.addEventListener('change', updateSocialPreview);
            }
        });

        // Add event listeners for refresh buttons
        const refreshButton = document.getElementById('refresh-preview');
        if (refreshButton) {
            refreshButton.addEventListener('click', updateSEOPreview);
        }

        const refreshSocialButton = document.getElementById('refresh-social-preview');
        if (refreshSocialButton) {
            refreshSocialButton.addEventListener('click', updateSocialPreview);
        }

        // Initial preview updates
        updateSEOPreview();
        updateSocialPreview();

        // SEO Report Update
        function updateSeoReport() {
            fetch('/admin/seo/report')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const report = data.data;
                        
                        // Update scores
                        document.getElementById('seo-score').textContent = report.seo_score;
                        document.getElementById('seo-score-change').innerHTML = `
                            <i class="fas fa-arrow-${report.score_change > 0 ? 'up' : 'down'} mr-1"></i>
                            ${report.score_change > 0 ? '+' : ''}${report.score_change}
                        `;
                        
                        document.getElementById('keywords-count').textContent = report.keywords_ranking;
                        document.getElementById('keywords-change').innerHTML = `
                            <i class="fas fa-arrow-${report.keywords_change > 0 ? 'up' : 'down'} mr-1"></i>
                            ${report.keywords_change > 0 ? '+' : ''}${report.keywords_change}
                        `;
                        
                        document.getElementById('backlinks-count').textContent = report.backlinks;
                        document.getElementById('backlinks-change').innerHTML = `
                            <i class="fas fa-arrow-${report.backlinks_change > 0 ? 'up' : 'down'} mr-1"></i>
                            ${report.backlinks_change > 0 ? '+' : ''}${report.backlinks_change}
                        `;
                        
                        document.getElementById('page-speed').textContent = report.page_speed;
                        document.getElementById('page-speed-change').innerHTML = `
                            <i class="fas fa-arrow-${report.page_speed_change > 0 ? 'up' : 'down'} mr-1"></i>
                            ${report.page_speed_change > 0 ? '+' : ''}${report.page_speed_change}
                        `;
                        
                        // Update tips
                        const tipsContainer = document.querySelector('#seo-tips .space-y-2');
                        tipsContainer.innerHTML = '';
                        
                        report.optimization_tips.forEach(tip => {
                            const tipElement = document.createElement('div');
                            let bgColor, borderColor, textColor, icon;
                            
                            switch(tip.type) {
                                case 'error':
                                    bgColor = 'bg-red-50';
                                    borderColor = 'border-red-500';
                                    textColor = 'text-red-800';
                                    icon = 'exclamation-circle';
                                    break;
                                case 'warning':
                                    bgColor = 'bg-yellow-50';
                                    borderColor = 'border-yellow-500';
                                    textColor = 'text-yellow-800';
                                    icon = 'exclamation-triangle';
                                    break;
                                default:
                                    bgColor = 'bg-blue-50';
                                    borderColor = 'border-blue-500';
                                    textColor = 'text-blue-800';
                                    icon = 'info-circle';
                            }
                            
                            tipElement.className = `${bgColor} border-l-4 ${borderColor} p-3 rounded-r-lg`;
                            tipElement.innerHTML = `
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-${icon} ${textColor}"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm ${textColor}">${tip.message}</p>
                                    </div>
                                </div>
                            `;
                            
                            tipsContainer.appendChild(tipElement);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating SEO report:', error);
                });
        }

        // Add event listener for refresh button
        const refreshReportButton = document.getElementById('refresh-report');
        if (refreshReportButton) {
            refreshReportButton.addEventListener('click', updateSeoReport);
        }

        // Initial report update
        updateSeoReport();

        // Update report every 5 minutes
        setInterval(updateSeoReport, 300000);
    });
</script>
@endpush