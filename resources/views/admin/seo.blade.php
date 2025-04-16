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
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> Simpan Semua Perubahan
            </button>
        </div>
    </div>

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
            <!-- Tabs Navigation -->
            <div class="bg-white rounded-lg shadow-sm mb-6 border border-gray-200">
                <div class="border-b border-gray-200">
                    <ul class="flex flex-wrap">
                        <li class="mr-1">
                            <a href="#meta" id="tab-meta" class="inline-block py-3 px-4 text-indigo-600 border-b-2 border-indigo-600 font-medium text-sm rounded-t-lg hover:bg-indigo-50 transition-colors duration-200">
                                <i class="fas fa-tags mr-1"></i> Meta Tags
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#sitemap" id="tab-sitemap" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-sitemap mr-1"></i> Sitemap
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#social" id="tab-social" class="inline-block py-3 px-4 text-gray-500 hover:text-gray-700 border-b-2 border-transparent font-medium text-sm rounded-t-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-share-alt mr-1"></i> Social Media
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- SEO Content Tabs -->
            <div class="tab-content">
                <!-- Meta Tags Form -->
                <div id="content-meta" class="bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Meta Tags</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                <i class="fas fa-info-circle mr-1"></i> Dioptimalkan 85%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Global SEO Settings Card -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Pengaturan Global</h4>
                            <button class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
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
                                <input type="text" id="site_title" name="site_title" value="ZDX Cargo - Jasa Pengiriman Terpercaya"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Judul website pada hasil pencarian</p>
                                    <p class="text-xs text-gray-500">42/60 karakter</p>
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
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">ZDX Cargo adalah penyedia jasa pengiriman terpercaya untuk kebutuhan logistik bisnis dan pribadi Anda dengan jangkauan nasional dan internasional.</textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Deskripsi singkat website</p>
                                    <p class="text-xs text-gray-500">138/160 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="site_keywords" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                                <div class="flex flex-wrap gap-2 p-2 bg-white border border-gray-300 rounded-md">
                                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-xs flex items-center">
                                        jasa pengiriman
                                        <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                                    </span>
                                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-xs flex items-center">
                                        cargo
                                        <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                                    </span>
                                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-xs flex items-center">
                                        ekspedisi
                                        <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                                    </span>
                                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-xs flex items-center">
                                        logistik
                                        <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                                    </span>
                                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-xs flex items-center">
                                        pengiriman barang
                                        <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                                    </span>
                                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-xs flex items-center">
                                        kurir
                                        <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                                    </span>
                                    <input type="text" placeholder="Tambah kata kunci..." class="border-none outline-none text-sm flex-grow min-w-[50px]">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Pisahkan kata kunci dengan Enter</p>
                            </div>
                        </div>
                        
                        <!-- Advanced Settings Toggle -->
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <button class="flex items-center text-indigo-600 hover:text-indigo-800 text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-cog mr-1"></i>
                                <span>Pengaturan lanjutan</span>
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- SEO Preview Card -->
                    <div class="mb-5 bg-white border border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Preview di Google</h4>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                <i class="fas fa-eye mr-1"></i> Tampilan bagus
                            </span>
                        </div>
                        
                        <div class="border border-gray-100 rounded-md p-3 bg-gray-50">
                            <div class="text-blue-600 text-base font-medium mb-1 hover:underline cursor-pointer">ZDX Cargo - Jasa Pengiriman Terpercaya di Indonesia</div>
                            <div class="text-green-700 text-xs mb-1">https://zdxcargo.com</div>
                            <div class="text-gray-600 text-sm">ZDX Cargo menyediakan jasa pengiriman terpercaya untuk kebutuhan logistik anda dengan jangkauan nasional dan internasional. Pengiriman cepat, aman, dan terjangkau.</div>
                        </div>
                    </div>
                    
                    <!-- Per Page SEO Settings -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Pengaturan Per Halaman</h4>
                            <div class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                                <i class="fas fa-exclamation-circle mr-1"></i> 5 halaman perlu perbaikan
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="page_select" class="block text-sm font-medium text-gray-700 mb-1">Pilih Halaman</label>
                            <div class="relative">
                                <select id="page_select" name="page_select" 
                                    class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white transition-all duration-200">
                                    <option value="home">Beranda</option>
                                    <option value="services">Layanan</option>
                                    <option value="rates">Tarif</option>
                                    <option value="tracking">Tracking</option>
                                    <option value="customer">Customer</option>
                                    <option value="profile">Profil</option>
                                    <option value="contact">Kontak</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="page_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    <div class="flex items-center">
                                        <span>Judul Halaman</span>
                                        <span class="ml-1 text-green-600"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </label>
                                <input type="text" id="page_title" name="page_title" value="ZDX Cargo - Jasa Pengiriman Terpercaya di Indonesia"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Judul untuk halaman ini</p>
                                    <p class="text-xs text-gray-500">53/60 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="page_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Halaman</label>
                                <textarea id="page_description" name="page_description" rows="2"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">ZDX Cargo menyediakan jasa pengiriman terpercaya untuk kebutuhan logistik anda dengan jangkauan nasional dan internasional. Pengiriman cepat, aman, dan terjangkau.</textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Deskripsi singkat halaman</p>
                                    <p class="text-xs text-gray-500">146/160 karakter</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sitemap Settings -->
                <div id="content-sitemap" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Sitemap</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                <i class="fas fa-info-circle mr-1"></i> Terakhir diperbarui: 3 hari lalu
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sitemap Status Card -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Status Sitemap</h4>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white p-3 rounded-lg border border-gray-100 hover:border-indigo-200 transition-colors duration-200">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Sitemap URL</span>
                                    <button class="text-indigo-600 hover:text-indigo-800 focus:outline-none text-sm">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <div class="text-sm text-gray-800 break-all bg-gray-50 p-2 rounded">
                                    https://zdxcargo.com/sitemap.xml
                                </div>
                                <div class="mt-2 flex items-center space-x-2">
                                    <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Lihat</a>
                                    <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Kirim ke Google</a>
                                </div>
                            </div>
                            
                            <div class="bg-white p-3 rounded-lg border border-gray-100 hover:border-indigo-200 transition-colors duration-200">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Robots.txt</span>
                                    <button class="text-indigo-600 hover:text-indigo-800 focus:outline-none text-sm">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <div class="text-sm text-gray-800 break-all bg-gray-50 p-2 rounded">
                                    https://zdxcargo.com/robots.txt
                                </div>
                                <div class="mt-2 flex items-center space-x-2">
                                    <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Lihat</a>
                                    <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sitemap Configuration -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Konfigurasi Sitemap</h4>
                            <button class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
                                <i class="fas fa-sync-alt mr-1"></i> Regenerate
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="flex items-center mb-1">
                                    <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4" checked>
                                    <span class="ml-2 text-sm text-gray-700">Buat sitemap otomatis</span>
                                </label>
                                <p class="text-xs text-gray-500 ml-6">Sitemap akan dibuat ulang setiap kali konten website diperbarui</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Frekuensi Pembaruan</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option>Setiap hari</option>
                                    <option selected>Setiap minggu</option>
                                    <option>Setiap bulan</option>
                                    <option>Manual</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prioritas URL Default</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option>0.1 (Sangat Rendah)</option>
                                    <option>0.3 (Rendah)</option>
                                    <option>0.5 (Sedang)</option>
                                    <option selected>0.7 (Tinggi)</option>
                                    <option>0.9 (Sangat Tinggi)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Included Pages -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Halaman yang Disertakan</h4>
                            <span class="text-xs text-gray-500">48 halaman</span>
                        </div>
                        
                        <div class="overflow-y-auto max-h-60 mb-3 bg-white border border-gray-100 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            URL
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prioritas
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Frekuensi
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            /
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            0.9
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            Harian
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            <button class="text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            /layanan
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            0.8
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            Mingguan
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            <button class="text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            /tarif
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            0.8
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            Mingguan
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            <button class="text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            /profil
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            0.7
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            Mingguan
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            <button class="text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            /kontak
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            0.7
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                            Mingguan
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            <button class="text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3 flex justify-between items-center">
                            <button class="text-xs bg-white border border-gray-200 text-gray-700 px-2 py-1 rounded hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-plus mr-1"></i> Tambah URL
                            </button>
                            
                            <div class="flex text-sm text-gray-500">
                                <button class="hover:bg-gray-100 w-7 h-7 flex items-center justify-center rounded">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span class="mx-2 text-xs flex items-center">Hal 1 dari 5</span>
                                <button class="hover:bg-gray-100 w-7 h-7 flex items-center justify-center rounded">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Settings -->
                <div id="content-social" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Social Media</h3>
                        <div class="mt-2 md:mt-0">
                            <div class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                <i class="fas fa-info-circle mr-1"></i> Open Graph & Twitter Cards
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Preview -->
                    <div class="mb-5 bg-white border border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Preview di Media Sosial</h4>
                            <div class="flex space-x-2">
                                <button class="bg-blue-100 text-blue-800 p-1 rounded hover:bg-blue-200 transition-colors duration-200">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button class="bg-blue-100 text-blue-800 p-1 rounded hover:bg-blue-200 transition-colors duration-200">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button class="bg-blue-100 text-blue-800 p-1 rounded hover:bg-blue-200 transition-colors duration-200">
                                    <i class="fab fa-linkedin-in"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="h-40 bg-gray-200 flex items-center justify-center">
                                <img src="https://via.placeholder.com/600x315" alt="Social Preview" class="w-full h-full object-cover">
                            </div>
                            <div class="p-3 bg-white">
                                <div class="text-xs text-gray-500 mb-1">zdxcargo.com</div>
                                <div class="text-base font-medium text-gray-800 mb-1">ZDX Cargo - Jasa Pengiriman Terpercaya di Indonesia</div>
                                <div class="text-sm text-gray-600">ZDX Cargo menyediakan jasa pengiriman terpercaya untuk kebutuhan logistik anda dengan jangkauan nasional dan internasional.</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Open Graph Settings -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Pengaturan Open Graph</h4>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                <i class="fab fa-facebook mr-1"></i> Facebook & LinkedIn
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="og_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Judul Open Graph
                                </label>
                                <input type="text" id="og_title" name="og_title" value="ZDX Cargo - Jasa Pengiriman Terpercaya di Indonesia"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Judul yang ditampilkan saat dishare di Facebook</p>
                                    <p class="text-xs text-gray-500">53/90 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="og_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Open Graph</label>
                                <textarea id="og_description" name="og_description" rows="2"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">ZDX Cargo menyediakan jasa pengiriman terpercaya untuk kebutuhan logistik anda dengan jangkauan nasional dan internasional. Pengiriman cepat, aman, dan terjangkau.</textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Deskripsi yang muncul saat dishare di Facebook</p>
                                    <p class="text-xs text-gray-500">146/200 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="og_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Open Graph</label>
                                <div class="flex items-center">
                                    <div class="w-24 h-24 bg-gray-100 mr-3 rounded-md border border-gray-200 overflow-hidden">
                                        <img src="https://via.placeholder.com/600x315" alt="OG Image" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col space-y-2">
                                            <button class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-sm font-medium py-1 px-3 rounded transition-colors duration-200">
                                                <i class="fas fa-upload mr-1"></i> Upload Gambar
                                            </button>
                                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-1 px-3 rounded transition-colors duration-200">
                                                <i class="fas fa-times mr-1"></i> Hapus
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Rekomendasi ukuran: 1200 x 630 pixel</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Twitter Card Settings -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-5 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Pengaturan Twitter Card</h4>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                <i class="fab fa-twitter mr-1"></i> Twitter
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Card</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="twitter_card_type" value="summary" class="form-radio text-indigo-600">
                                        <span class="ml-2 text-sm text-gray-700">Summary</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="twitter_card_type" value="summary_large_image" class="form-radio text-indigo-600" checked>
                                        <span class="ml-2 text-sm text-gray-700">Summary dengan Gambar Besar</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label for="twitter_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Judul Twitter Card
                                </label>
                                <input type="text" id="twitter_title" name="twitter_title" value="ZDX Cargo - Jasa Pengiriman Terpercaya"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Judul yang ditampilkan saat dishare di Twitter</p>
                                    <p class="text-xs text-gray-500">42/70 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="twitter_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Twitter Card</label>
                                <textarea id="twitter_description" name="twitter_description" rows="2"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">Jasa pengiriman terpercaya dengan jangkauan nasional dan internasional. Pengiriman cepat, aman, dan terjangkau.</textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Deskripsi yang muncul saat dishare di Twitter</p>
                                    <p class="text-xs text-gray-500">116/200 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label for="twitter_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Twitter Card</label>
                                <div class="flex items-center">
                                    <div class="w-24 h-24 bg-gray-100 mr-3 rounded-md border border-gray-200 overflow-hidden">
                                        <img src="https://via.placeholder.com/600x315" alt="Twitter Card Image" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col space-y-2">
                                            <button class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-sm font-medium py-1 px-3 rounded transition-colors duration-200">
                                                <i class="fas fa-upload mr-1"></i> Upload Gambar
                                            </button>
                                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-1 px-3 rounded transition-colors duration-200">
                                                <i class="fas fa-times mr-1"></i> Hapus
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Rekomendasi ukuran: 800 x 418 pixel</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Profiles -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800">Profil Media Sosial</h4>
                            <button class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded hover:bg-indigo-200 transition-colors duration-200">
                                <i class="fas fa-plus mr-1"></i> Tambah Profil
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-3">
                            <div class="bg-white p-3 rounded-lg border border-gray-100 hover:border-blue-200 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                        <i class="fab fa-facebook-f"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-medium text-gray-800">Facebook</div>
                                                <div class="text-xs text-gray-500">facebook.com/zdxcargo</div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button class="text-gray-400 hover:text-indigo-600">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-400 hover:text-red-600">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white p-3 rounded-lg border border-gray-100 hover:border-blue-200 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-400 mr-3">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-medium text-gray-800">Twitter</div>
                                                <div class="text-xs text-gray-500">twitter.com/zdxcargo</div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button class="text-gray-400 hover:text-indigo-600">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-400 hover:text-red-600">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white p-3 rounded-lg border border-gray-100 hover:border-blue-200 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 mr-3">
                                        <i class="fab fa-instagram"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-medium text-gray-800">Instagram</div>
                                                <div class="text-xs text-gray-500">instagram.com/zdxcargo</div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button class="text-gray-400 hover:text-indigo-600">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-400 hover:text-red-600">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="mt-6 flex justify-end">
        <div class="flex space-x-3">
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg transition-all duration-200">
                Batal
            </button>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg flex items-center shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = ['meta', 'sitemap', 'social'];
        
        tabs.forEach(tab => {
            const tabEl = document.getElementById(`tab-${tab}`);
            if (tabEl) {
                tabEl.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Hide all tab contents
                    tabs.forEach(t => {
                        const contentEl = document.getElementById(`content-${t}`);
                        if (contentEl) {
                            contentEl.classList.add('hidden');
                        }
                        
                        const tabButton = document.getElementById(`tab-${t}`);
                        if (tabButton) {
                            tabButton.classList.remove('text-indigo-600', 'border-indigo-600');
                            tabButton.classList.add('text-gray-500', 'border-transparent');
                        }
                    });
                    
                    // Show selected tab content
                    const currentContent = document.getElementById(`content-${tab}`);
                    if (currentContent) {
                        currentContent.classList.remove('hidden');
                    }
                    
                    // Update tab button style
                    tabEl.classList.remove('text-gray-500', 'border-transparent');
                    tabEl.classList.add('text-indigo-600', 'border-indigo-600');
                });
            }
        });
        
        // Initialize with meta tab open
        const metaContent = document.getElementById('content-meta');
        if (metaContent) {
            metaContent.classList.remove('hidden');
        }
    });
</script>
@endpush
@endsection 