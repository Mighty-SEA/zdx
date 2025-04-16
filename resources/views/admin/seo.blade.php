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
                    <div class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">
                        Diperbarui hari ini
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-indigo-50 p-3 rounded-lg border border-indigo-100 hover:border-indigo-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-indigo-700 font-medium text-sm">Skor SEO</div>
                            <div class="text-indigo-700"><i class="fas fa-chart-line"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800">85/100</div>
                        <div class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +5
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 hover:border-blue-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-blue-700 font-medium text-sm">Kata Kunci</div>
                            <div class="text-blue-700"><i class="fas fa-key"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800">24</div>
                        <div class="text-xs text-gray-600">Peringkat</div>
                    </div>
                    
                    <div class="bg-green-50 p-3 rounded-lg border border-green-100 hover:border-green-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-green-700 font-medium text-sm">Backlinks</div>
                            <div class="text-green-700"><i class="fas fa-link"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800">145</div>
                        <div class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +12
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100 hover:border-yellow-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-yellow-700 font-medium text-sm">Page Speed</div>
                            <div class="text-yellow-700"><i class="fas fa-tachometer-alt"></i></div>
                        </div>
                        <div class="text-xl font-bold text-gray-800">92/100</div>
                        <div class="text-green-600 text-xs flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> +3
                        </div>
                    </div>
                </div>
                
                <div class="mt-3 text-center">
                    <a href="#" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 flex items-center justify-center transition-colors duration-200">
                        <span>Lihat laporan lengkap</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
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
                                <a href="#pages" id="tab-pages" data-toggle="tab" role="tab" aria-controls="pages" aria-selected="false" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-file-alt mr-1"></i> Halaman
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
                        
                        <!-- Page-specific SEO Settings -->
                        <div id="page-seo-settings" class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200 hidden">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Pengaturan Halaman <span id="selected-page-name" class="text-indigo-600"></span></h4>
                                <button type="button" id="restore-defaults" class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded hover:bg-gray-200 transition-colors duration-200">
                                    <i class="fas fa-undo mr-1"></i> Kembalikan Default
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
                                    <input type="text" id="page_title" name="title" 
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
                                    <textarea id="page_description" name="description" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"></textarea>
                                    <div class="flex justify-between mt-1">
                                        <p class="text-xs text-gray-500">Deskripsi halaman pada hasil pencarian</p>
                                        <p class="text-xs text-gray-500"><span id="page_description_count">0</span>/160 karakter</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="page_keywords" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                                    <input type="text" id="page_keywords" name="keywords"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <p class="text-xs text-gray-500 mt-1">Pisahkan kata kunci dengan koma</p>
                                </div>
                                
                                <div>
                                    <label for="page_canonical" class="block text-sm font-medium text-gray-700 mb-1">URL Kanonik</label>
                                    <input type="text" id="page_canonical" name="canonical_url" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" 
                                        placeholder="https://zdx.com/halaman-asli">
                                    <p class="text-xs text-gray-500 mt-1">Alamat URL kanonik untuk menghindari konten duplikat</p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="is_indexed" id="page_indexed" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="page_indexed" class="ml-2 block text-sm text-gray-700">
                                            Halaman dapat diindeks
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="is_followed" id="page_followed" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="page_followed" class="ml-2 block text-sm text-gray-700">
                                            Link dapat diikuti
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="page_custom_robots" class="block text-sm font-medium text-gray-700 mb-1">Custom Robots Tag</label>
                                    <input type="text" id="page_custom_robots" name="custom_robots" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <p class="text-xs text-gray-500 mt-1">Contoh: index, follow atau noindex, nofollow</p>
                                </div>
                                
                                <div>
                                    <label for="page_custom_schema" class="block text-sm font-medium text-gray-700 mb-1">Custom Schema Markup (JSON-LD)</label>
                                    <textarea id="page_custom_schema" name="custom_schema" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 font-mono"></textarea>
                                    <p class="text-xs text-gray-500 mt-1">Masukkan kode schema JSON-LD khusus untuk halaman ini</p>
                                </div>
                                
                                <div class="pt-2">
                                    <input type="hidden" id="current_page_id" name="page_id" value="">
                                    <button type="button" id="save-page-seo" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                                        <i class="fas fa-save mr-2"></i> Simpan Pengaturan Halaman
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Advanced SEO Settings -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Pengaturan Lanjutan</h4>
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
                                    <label for="schema_markup" class="block text-sm font-medium text-gray-700 mb-1">Schema Markup</label>
                                    <textarea id="schema_markup" name="schema_markup" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder='<script type="application/ld+json">{ ... }</script>'>{{ $seoSettings->schema_markup }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">Masukkan kode schema markup JSON-LD</p>
                                </div>
                                
                                <div>
                                    <label for="custom_head_tags" class="block text-sm font-medium text-gray-700 mb-1">Custom Head Tags</label>
                                    <textarea id="custom_head_tags" name="custom_head_tags" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="<meta name=... ><link ...>">{{ $seoSettings->custom_head_tags }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">Tag HTML tambahan untuk bagian head</p>
                                </div>
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
                        
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Open Graph (Facebook)</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="og_title" class="block text-sm font-medium text-gray-700 mb-1">OG Title</label>
                                    <input type="text" id="og_title" name="og_title" value="{{ $seoSettings->og_title ?? '' }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <div class="flex justify-between mt-1">
                                        <p class="text-xs text-gray-500">Judul untuk dibagikan di social media</p>
                                        <p class="text-xs text-gray-500"><span id="og_title_count">{{ strlen($seoSettings->og_title ?? '') }}</span>/60 karakter</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="og_description" class="block text-sm font-medium text-gray-700 mb-1">OG Description</label>
                                    <textarea id="og_description" name="og_description" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $seoSettings->og_description ?? '' }}</textarea>
                                    <div class="flex justify-between mt-1">
                                        <p class="text-xs text-gray-500">Deskripsi untuk dibagikan di social media</p>
                                        <p class="text-xs text-gray-500"><span id="og_description_count">{{ strlen($seoSettings->og_description ?? '') }}</span>/160 karakter</p>
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
                                    
                                    @if($seoSettings->og_image)
                                    <div class="mt-2">
                                        <div class="bg-gray-100 p-2 rounded-lg inline-block">
                                            <img src="{{ url($seoSettings->og_image) }}" alt="OG Image" class="h-20 rounded">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Twitter Card</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="twitter_card" class="block text-sm font-medium text-gray-700 mb-1">Twitter Card Type</label>
                                    <select name="twitter_card" id="twitter_card" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <option value="summary" {{ $seoSettings->twitter_card == 'summary' ? 'selected' : '' }}>Summary Card</option>
                                        <option value="summary_large_image" {{ $seoSettings->twitter_card == 'summary_large_image' ? 'selected' : '' }}>Summary Card with Large Image</option>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Jenis tampilan Twitter Card</p>
                                </div>
                                
                                <div>
                                    <label for="twitter_site" class="block text-sm font-medium text-gray-700 mb-1">Twitter Username</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">@</span>
                                        </div>
                                        <input type="text" id="twitter_site" name="twitter_site" value="{{ str_replace('@', '', $seoSettings->twitter_site) }}"
                                            class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" 
                                            placeholder="username">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Akun Twitter bisnis Anda tanpa @</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pages Tab -->
                    <div id="content-pages" class="tab-pane hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pengaturan SEO Per Halaman</h3>
                            <div class="mt-2 md:mt-0">
                                <div class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                    <i class="fas fa-info-circle mr-1"></i> Sesuaikan SEO untuk setiap halaman
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pages List Card -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-800">Daftar Halaman</h4>
                                <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">
                                    <i class="fas fa-file-alt mr-1"></i> {{ count($pageSettings) }} Halaman
                                </span>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama Halaman
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                URL
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status SEO
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($pageSettings as $page)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-900">
                                                {{ ucwords(str_replace(['-', '/'], [' ', ' > '], $page->route ?: 'Home')) }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                                                {{ $page->route ? '/'.$page->route : '/' }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm">
                                                @if($page->title && $page->description)
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i> Lengkap
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-exclamation-circle mr-1"></i> Belum Lengkap
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-right">
                                                <a href="#" onclick="openPageEditModal('{{ $page->id }}'); return false;" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 py-1 px-3 rounded-md transition-colors duration-200">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Page Edit Modal -->
                        <div id="pageEditModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <!-- Background overlay -->
                                <div id="pageEditModalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                
                                <!-- Modal panel -->
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <!-- Form untuk edit halaman -->
                                    <form id="pageEditForm" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                        Edit SEO Halaman <span id="pageName" class="font-bold"></span>
                                                    </h3>
                                                    <div class="mt-4 space-y-4">
                                                        <!-- Basic SEO Settings -->
                                                        <div>
                                                            <label for="page_title" class="block text-sm font-medium text-gray-700">Judul Halaman</label>
                                                            <input type="text" name="title" id="page_title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <p class="mt-1 text-xs text-gray-500">Judul halaman, penting untuk SEO (maks. 100 karakter)</p>
                                                        </div>
                                                        
                                                        <div>
                                                            <label for="page_description" class="block text-sm font-medium text-gray-700">Deskripsi Halaman</label>
                                                            <textarea name="description" id="page_description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                                            <p class="mt-1 text-xs text-gray-500">Deskripsi untuk mesin pencari (maks. 255 karakter)</p>
                                                        </div>
                                                        
                                                        <div>
                                                            <label for="page_keywords" class="block text-sm font-medium text-gray-700">Kata Kunci</label>
                                                            <input type="text" name="keywords" id="page_keywords" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <p class="mt-1 text-xs text-gray-500">Kata kunci yang relevan, pisahkan dengan koma</p>
                                                        </div>

                                                        <div>
                                                            <label for="page_canonical" class="block text-sm font-medium text-gray-700">URL Kanonik</label>
                                                            <input type="text" name="canonical_url" id="page_canonical" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="https://zdx.com/halaman-asli">
                                                            <p class="mt-1 text-xs text-gray-500">Alamat URL kanonik untuk menghindari konten duplikat</p>
                                                        </div>

                                                        <div class="flex space-x-4">
                                                            <div class="flex items-center">
                                                                <input type="checkbox" name="is_indexed" id="page_indexed" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <label for="page_indexed" class="ml-2 block text-sm text-gray-700">
                                                                    Halaman dapat diindeks
                                                                </label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input type="checkbox" name="is_followed" id="page_followed" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <label for="page_followed" class="ml-2 block text-sm text-gray-700">
                                                                    Link dapat diikuti
                                                                </label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Social Media Settings -->
                                                        <div class="mt-6 pt-6 border-t border-gray-200">
                                                            <h4 class="font-medium text-gray-800 mb-3">Pengaturan Social Media</h4>
                                                            
                                                            <div>
                                                                <label for="page_og_title" class="block text-sm font-medium text-gray-700">OG Title (Facebook/Twitter)</label>
                                                                <input type="text" name="og_title" id="page_og_title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <p class="mt-1 text-xs text-gray-500">Judul khusus untuk share di social media</p>
                                                            </div>
                                                            
                                                            <div class="mt-4">
                                                                <label for="page_og_description" class="block text-sm font-medium text-gray-700">OG Description</label>
                                                                <textarea name="og_description" id="page_og_description" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                                                <p class="mt-1 text-xs text-gray-500">Deskripsi khusus untuk share di social media</p>
                                                            </div>

                                                            <div class="mt-4">
                                                                <label for="page_og_image" class="block text-sm font-medium text-gray-700">OG Image</label>
                                                                <div class="flex">
                                                                    <input type="file" name="og_image_file" id="page_og_image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                </div>
                                                                <p class="mt-1 text-xs text-gray-500">Gambar untuk dibagikan di social media (ideal: 1200 x 630 px)</p>
                                                                <div id="page_og_image_preview" class="mt-2 hidden">
                                                                    <img src="" alt="OG Image Preview" class="h-20 rounded">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Advanced Settings -->
                                                        <div class="mt-6 pt-6 border-t border-gray-200">
                                                            <h4 class="font-medium text-gray-800 mb-3">Pengaturan Lanjutan</h4>
                                                            
                                                            <div>
                                                                <label for="page_custom_robots" class="block text-sm font-medium text-gray-700">Custom Robots Tag</label>
                                                                <input type="text" name="custom_robots" id="page_custom_robots" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <p class="mt-1 text-xs text-gray-500">Contoh: index, follow atau noindex, nofollow</p>
                                                            </div>
                                                            
                                                            <div class="mt-4">
                                                                <label for="page_custom_schema" class="block text-sm font-medium text-gray-700">Custom Schema Markup (JSON-LD)</label>
                                                                <textarea name="custom_schema" id="page_custom_schema" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm font-mono"></textarea>
                                                                <p class="mt-1 text-xs text-gray-500">Masukkan kode schema JSON-LD khusus untuk halaman ini</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Simpan Perubahan
                                            </button>
                                            <button type="button" id="closePageEditModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
        
        // Page Selector functionality
        const pageSelector = document.getElementById('page-selector');
        const globalSeoSettings = document.getElementById('global-seo-settings');
        const pageSeoSettings = document.getElementById('page-seo-settings');
        const selectedPageName = document.getElementById('selected-page-name');
        const currentPageId = document.getElementById('current_page_id');
        const savePageSeoBtn = document.getElementById('save-page-seo');
        
        // Page selector change event
        if (pageSelector) {
            pageSelector.addEventListener('change', function() {
                const pageId = this.value;
                
                if (pageId === 'global') {
                    // Show global settings, hide page settings
                    globalSeoSettings.classList.remove('hidden');
                    pageSeoSettings.classList.add('hidden');
                } else {
                    // Hide global settings, show page settings
                    globalSeoSettings.classList.add('hidden');
                    pageSeoSettings.classList.remove('hidden');
                    
                    // Set current page ID
                    currentPageId.value = pageId;
                    
                    // Update page name in the UI
                    const selectedOption = this.options[this.selectedIndex];
                    selectedPageName.textContent = selectedOption.text;
                    
                    // Fetch page SEO data
                    fetchPageSeoData(pageId);
                }
            });
        }
        
        // Save page SEO button click
        if (savePageSeoBtn) {
            savePageSeoBtn.addEventListener('click', function() {
                const pageId = currentPageId.value;
                if (!pageId) {
                    alert('Pilih halaman terlebih dahulu');
                    return;
                }
                
                savePageSeoData(pageId);
            });
        }
        
        // Restore defaults button
        const restoreDefaultsBtn = document.getElementById('restore-defaults');
        if (restoreDefaultsBtn) {
            restoreDefaultsBtn.addEventListener('click', function() {
                if (confirm('Yakin ingin mengembalikan pengaturan halaman ini ke default?')) {
                    const pageId = currentPageId.value;
                    // Reset form without saving
                    resetPageForm();
                    // Re-fetch data to show current values from database
                    fetchPageSeoData(pageId);
                }
            });
        }
        
        // Function to fetch page SEO data
        function fetchPageSeoData(pageId) {
            fetch('{{ url("/admin/seo/page") }}/' + pageId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Fill the form with page data
                    document.getElementById('page_title').value = data.title || '';
                    document.getElementById('page_description').value = data.description || '';
                    document.getElementById('page_keywords').value = data.keywords || '';
                    document.getElementById('page_canonical').value = data.canonical_url || '';
                    document.getElementById('page_indexed').checked = data.is_indexed || false;
                    document.getElementById('page_followed').checked = data.is_followed || false;
                    document.getElementById('page_custom_robots').value = data.custom_robots || '';
                    document.getElementById('page_custom_schema').value = data.custom_schema || '';
                    
                    // Update character counters
                    updateCharCount('page_title', 'page_title_count');
                    updateCharCount('page_description', 'page_description_count');
                })
                .catch(error => {
                    console.error('Error fetching page SEO data:', error);
                    alert('Gagal memuat data SEO halaman: ' + error.message);
                });
        }
        
        // Function to save page SEO data
        function savePageSeoData(pageId) {
            // Tampilkan pesan loading
            const saveBtn = document.getElementById('save-page-seo');
            const originalBtnText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
            saveBtn.disabled = true;
            
            const formData = new FormData();
            // CSRF token akan secara otomatis ditambahkan oleh Laravel pada header X-CSRF-TOKEN
            
            formData.append('title', document.getElementById('page_title').value);
            formData.append('description', document.getElementById('page_description').value);
            formData.append('keywords', document.getElementById('page_keywords').value);
            formData.append('canonical_url', document.getElementById('page_canonical').value);
            formData.append('is_indexed', document.getElementById('page_indexed').checked ? 1 : 0);
            formData.append('is_followed', document.getElementById('page_followed').checked ? 1 : 0);
            formData.append('custom_robots', document.getElementById('page_custom_robots').value);
            formData.append('custom_schema', document.getElementById('page_custom_schema').value);
            
            console.log('Sending data to API:', {
                url: '{{ route("admin.seo.page.api.save", ["id" => ":id"]) }}'.replace(':id', pageId),
                pageId: pageId,
                title: document.getElementById('page_title').value
            });
            
            // Debug form data
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            fetch('{{ route("admin.seo.page.api.save", ["id" => ":id"]) }}'.replace(':id', pageId), {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', [...response.headers.entries()]);
                
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                
                const contentType = response.headers.get('content-type');
                console.log('Content-Type:', contentType);
                
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // Debug response text if not json
                    return response.text().then(text => {
                        console.error('Unexpected response:', text);
                        throw new Error('Respons dari server bukan JSON yang valid');
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    // Show success message
                    showMessage('success', 'Pengaturan SEO halaman berhasil disimpan');
                } else {
                    throw new Error(data.message || 'Gagal menyimpan data');
                }
            })
            .catch(error => {
                console.error('Error saving page SEO data:', error);
                showMessage('error', 'Gagal menyimpan data SEO halaman: ' + error.message);
            })
            .finally(() => {
                // Kembalikan tombol ke keadaan semula
                saveBtn.innerHTML = originalBtnText;
                saveBtn.disabled = false;
            });
        }
        
        // Function to show message
        function showMessage(type, message) {
            const alertEl = document.createElement('div');
            alertEl.className = type === 'success' 
                ? 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded z-50'
                : 'fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded z-50';
            alertEl.innerHTML = message;
            document.body.appendChild(alertEl);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                alertEl.remove();
            }, 3000);
        }
        
        // Function to reset page form
        function resetPageForm() {
            document.getElementById('page_title').value = '';
            document.getElementById('page_description').value = '';
            document.getElementById('page_keywords').value = '';
            document.getElementById('page_canonical').value = '';
            document.getElementById('page_indexed').checked = true;
            document.getElementById('page_followed').checked = true;
            document.getElementById('page_custom_robots').value = '';
            document.getElementById('page_custom_schema').value = '';
            
            // Update character counters
            updateCharCount('page_title', 'page_title_count');
            updateCharCount('page_description', 'page_description_count');
        }
        
        // Character counters for text fields
        const countFields = [
            { field: 'site_title', counter: 'site_title_count', maxLength: 60 },
            { field: 'site_description', counter: 'site_description_count', maxLength: 160 },
            { field: 'og_title', counter: 'og_title_count', maxLength: 60 },
            { field: 'og_description', counter: 'og_description_count', maxLength: 160 },
            { field: 'page_title', counter: 'page_title_count', maxLength: 60 },
            { field: 'page_description', counter: 'page_description_count', maxLength: 160 }
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
        
        // Close modal
        const closePageEditModalBtn = document.getElementById('closePageEditModal');
        if (closePageEditModalBtn) {
            closePageEditModalBtn.addEventListener('click', closePageEditModal);
        }
        
        const pageEditModalOverlay = document.getElementById('pageEditModalOverlay');
        if (pageEditModalOverlay) {
            pageEditModalOverlay.addEventListener('click', closePageEditModal);
        }
        
        // Handle file input preview for OG image
        const pageOgImageInput = document.getElementById('page_og_image');
        if (pageOgImageInput) {
            pageOgImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const previewElement = document.getElementById('page_og_image_preview');
                    previewElement.classList.remove('hidden');
                    const imgElement = previewElement.querySelector('img');
                    imgElement.src = URL.createObjectURL(this.files[0]);
                }
            });
        }
        
        // Handle Escape key press
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !pageEditModal.classList.contains('hidden')) {
                closePageEditModal();
            }
        });
    });
    
    // Global function to open edit modal
    function openPageEditModal(pageId) {
        console.log('Opening edit modal for page ID:', pageId);
        
        const pageEditModal = document.getElementById('pageEditModal');
        const pageEditForm = document.getElementById('pageEditForm');
        const pageName = document.getElementById('pageName');
        
        // Reset form
        pageEditForm.reset();
        
        // Set form action URL with correct Laravel URL
        pageEditForm.action = '{{ url("/admin/seo/page") }}/' + pageId + '/save';
        console.log('Form action set to:', pageEditForm.action);
        
        // Fetch page data
        fetch('{{ url("/admin/seo/page") }}/' + pageId)
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                // Fill form with data
                pageName.textContent = data.page_name;
                
                document.getElementById('page_title').value = data.title || '';
                document.getElementById('page_description').value = data.description || '';
                document.getElementById('page_keywords').value = data.keywords || '';
                document.getElementById('page_canonical').value = data.canonical_url || '';
                document.getElementById('page_indexed').checked = data.is_indexed || false;
                document.getElementById('page_followed').checked = data.is_followed || false;
                document.getElementById('page_og_title').value = data.og_title || '';
                document.getElementById('page_og_description').value = data.og_description || '';
                document.getElementById('page_custom_robots').value = data.custom_robots || '';
                document.getElementById('page_custom_schema').value = data.custom_schema || '';
                
                // Handle OG image preview if exists
                if (data.og_image) {
                    const previewElement = document.getElementById('page_og_image_preview');
                    previewElement.classList.remove('hidden');
                    const imgElement = previewElement.querySelector('img');
                    imgElement.src = '/' + data.og_image;
                } else {
                    document.getElementById('page_og_image_preview').classList.add('hidden');
                }
                
                // Show modal
                pageEditModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data halaman. Error: ' + error);
            });
    }
    
    function closePageEditModal() {
        const pageEditModal = document.getElementById('pageEditModal');
        pageEditModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endpush 