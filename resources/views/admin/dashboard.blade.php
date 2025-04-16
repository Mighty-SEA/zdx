@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
        <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                <h2 class="text-2xl font-bold text-gray-800">Dashboard Analytics</h2>
                <p class="text-gray-600 mt-1">Pantau statistik dan performa website Anda secara real-time.</p>
            </div>
        </div>
        
        <!-- Analytics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-indigo-50 p-5 rounded-lg border border-indigo-100 hover:border-indigo-300 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-indigo-800 text-sm font-medium">Pengunjung</div>
                    <div class="text-indigo-700"><i class="fas fa-users"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">5,842</div>
                <div class="text-green-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +12.5%
            </div>
        </div>
        
            <div class="bg-blue-50 p-5 rounded-lg border border-blue-100 hover:border-blue-300 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-blue-800 text-sm font-medium">Pageviews</div>
                    <div class="text-blue-700"><i class="fas fa-eye"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">18,397</div>
                <div class="text-green-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +8.2%
                </div>
            </div>
            
            <div class="bg-green-50 p-5 rounded-lg border border-green-100 hover:border-green-300 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-green-800 text-sm font-medium">Bounce Rate</div>
                    <div class="text-green-700"><i class="fas fa-undo"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">42.3%</div>
                <div class="text-red-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +2.1%
            </div>
        </div>
        
            <div class="bg-yellow-50 p-5 rounded-lg border border-yellow-100 hover:border-yellow-300 transition-colors duration-200">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-yellow-800 text-sm font-medium">Durasi Rata-rata</div>
                    <div class="text-yellow-700"><i class="fas fa-clock"></i></div>
                </div>
                <div class="text-2xl font-bold text-gray-800">2:48</div>
                <div class="text-green-600 text-xs flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> +18.5%
            </div>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Traffic Chart Area (2/3 width on large screens) -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Traffic Website</h2>
                    <div class="flex space-x-2">
                        <button class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full hover:bg-indigo-200 transition-colors duration-200">
                            7 Hari
                        </button>
                        <button class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full hover:bg-gray-200 transition-colors duration-200">
                            30 Hari
                        </button>
                        <button class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full hover:bg-gray-200 transition-colors duration-200">
                            90 Hari
                        </button>
                </div>
            </div>
            
            <!-- Chart Placeholder -->
            <div class="h-80 bg-gray-50 rounded-lg flex items-center justify-center">
                <div class="text-center">
                        <i class="fas fa-chart-line text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Grafik traffic website akan ditampilkan di sini</p>
                </div>
            </div>
            
            <!-- Chart Legend -->
            <div class="flex justify-center mt-4 space-x-6">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-indigo-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Direct</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Organic</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Referral</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Social</span>
                </div>
            </div>
        </div>
        
        <!-- Right Side (1/3 width on large screens) -->
        <div class="space-y-6">
                <!-- Top Pages -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Halaman Terpopuler</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">/</p>
                                <p class="text-xs text-gray-500">Beranda</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">4,827</p>
                                <p class="text-xs text-gray-500">views</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">/layanan</p>
                                <p class="text-xs text-gray-500">Layanan</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">2,356</p>
                                <p class="text-xs text-gray-500">views</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">/tarif</p>
                                <p class="text-xs text-gray-500">Tarif</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">1,843</p>
                                <p class="text-xs text-gray-500">views</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">/kontak</p>
                                <p class="text-xs text-gray-500">Kontak</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">1,204</p>
                                <p class="text-xs text-gray-500">views</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                        <a href="#" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 inline-block transition-colors duration-200">
                            Lihat semua halaman
                        </a>
                    </div>
                </div>
                
                <!-- Traffic Sources -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Sumber Traffic</h2>
                    
                    <!-- Organic -->
                <div class="mb-4">
                    <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-600">Organic Search</span>
                            <span class="text-sm font-medium text-gray-600">38%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 38%"></div>
                        </div>
                    </div>
                    
                    <!-- Direct -->
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-600">Direct</span>
                            <span class="text-sm font-medium text-gray-600">32%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width: 32%"></div>
                        </div>
                    </div>
                    
                    <!-- Referral -->
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-600">Referral</span>
                            <span class="text-sm font-medium text-gray-600">18%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 18%"></div>
                    </div>
                </div>
                
                    <!-- Social -->
                <div>
                    <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-600">Social Media</span>
                            <span class="text-sm font-medium text-gray-600">12%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 12%"></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
        <!-- Analytics Configuration -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Google Analytics -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="https://www.google.com/images/branding/product/1x/analytics_48dp.png" alt="Google Analytics" class="w-8 h-8 mr-3">
                        <h3 class="font-medium text-gray-800 text-lg">Google Analytics</h3>
                    </div>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                        <i class="fas fa-check-circle mr-1"></i> Terhubung
                    </span>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                        <div>
                        <label for="ga_tracking_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Google Analytics Tracking ID (GA4)
                        </label>
                        <div class="flex">
                            <input type="text" id="ga_tracking_id" name="ga_tracking_id" value="G-XYZ123456"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            <button class="bg-gray-100 px-3 py-2 border border-gray-300 border-l-0 rounded-r-md hover:bg-gray-200 transition-colors duration-200">
                                <i class="fas fa-paste"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">ID pelacakan untuk Google Analytics 4</p>
                    </div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Posisi Kode Tracking
                            </label>
                            <span class="text-xs text-gray-500">Direkomendasikan: Header</span>
                        </div>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="ga_position" value="header" class="form-radio text-indigo-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Header</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="ga_position" value="footer" class="form-radio text-indigo-600">
                                <span class="ml-2 text-sm text-gray-700">Footer</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4">
                        <label class="flex items-center mb-1">
                            <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4" checked>
                            <span class="ml-2 text-sm text-gray-700">Aktifkan Peningkatan Tautan</span>
                        </label>
                        
                        <label class="flex items-center mb-1">
                            <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4" checked>
                            <span class="ml-2 text-sm text-gray-700">Anonymize IP</span>
                        </label>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-200">
                    <a href="https://analytics.google.com/" target="_blank" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 flex items-center transition-colors duration-200">
                        <span>Buka Google Analytics</span>
                        <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
            
            <!-- Facebook Pixel -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center text-white mr-3">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <h3 class="font-medium text-gray-800 text-lg">Facebook Pixel</h3>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <span class="text-xs text-gray-700 mr-2">Nonaktif</span>
                        <div class="relative">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                        </div>
                        <span class="text-xs text-gray-700 ml-2">Aktif</span>
                    </label>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                        <div>
                        <label for="fb_pixel_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Facebook Pixel ID
                        </label>
                        <div class="flex">
                            <input type="text" id="fb_pixel_id" name="fb_pixel_id" placeholder="Contoh: 123456789012345"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            <button class="bg-gray-100 px-3 py-2 border border-gray-300 border-l-0 rounded-r-md hover:bg-gray-200 transition-colors duration-200">
                                <i class="fas fa-paste"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">ID untuk pelacakan konversi Facebook</p>
                    </div>
                    
                        <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Event yang Dilacak
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4" checked>
                                <span class="ml-2 text-sm text-gray-700">PageView</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4" checked>
                                <span class="ml-2 text-sm text-gray-700">ViewContent</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4">
                                <span class="ml-2 text-sm text-gray-700">Konversi</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox rounded text-indigo-600 h-4 w-4">
                                <span class="ml-2 text-sm text-gray-700">CustAction</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-200">
                    <a href="https://business.facebook.com/events_manager/" target="_blank" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 flex items-center transition-colors duration-200">
                        <span>Buka Facebook Business Manager</span>
                        <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Save Button -->
        <div class="mt-6 flex justify-end">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg flex items-center shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </div>
@endsection