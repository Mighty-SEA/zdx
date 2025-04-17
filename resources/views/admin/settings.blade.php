@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h2>
            <p class="text-gray-600 mt-1">Kelola pengaturan umum aplikasi ZDX Cargo.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Area with Flex Layout -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Column (Settings Navigation) - 1/4 width on large screens -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Menu Pengaturan</h3>
                </div>
                <nav class="p-2">
                    <a href="#analytics" id="nav-analytics" class="flex items-center px-4 py-3 rounded-lg text-indigo-600 bg-indigo-50 mb-1">
                        <i class="fas fa-chart-line w-5 mr-2"></i>
                        <span>Google Analytics</span>
                    </a>
                    <a href="#company" id="nav-company" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-building w-5 mr-2"></i>
                        <span>Informasi Perusahaan</span>
                    </a>
                    <a href="#api" id="nav-api" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-code w-5 mr-2"></i>
                        <span>API</span>
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Right Column (Settings Content) - 3/4 width on large screens -->
        <div class="lg:w-3/4">
            <!-- Settings Content Sections -->
            <div id="setting-content">
                <!-- Google Analytics Settings -->
                <div id="content-analytics" class="bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Google Analytics</h3>
                        <p class="text-sm text-gray-600">Konfigurasi integrasi Google Analytics untuk Dashboard</p>
                    </div>
                    
                    <x-analytics-alert />
                    
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.settings.analytics') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-6">
                                <label for="property_id" class="block font-medium text-gray-700 mb-2">
                                    Property ID Google Analytics
                                </label>
                                <input type="text" name="property_id" id="property_id" value="{{ $propertyId }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                       placeholder="Contoh: 123456789">
                                <p class="text-gray-500 text-sm mt-1">
                                    ID properti Google Analytics yang ingin ditampilkan. Bisa ditemukan di pengaturan Google Analytics Anda.
                                </p>
                                @error('property_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="credentials_file" class="block font-medium text-gray-700 mb-2">
                                    File Credentials Service Account (JSON)
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="file" name="credentials_file" id="credentials_file" accept=".json"
                                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    @if($hasCredentials)
                                        <div class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-sm">
                                            <i class="fas fa-check-circle mr-1"></i> Terinstal
                                        </div>
                                    @else
                                        <div class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-sm">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Belum ada
                                        </div>
                                    @endif
                                </div>
                                <p class="text-gray-500 text-sm mt-1">
                                    File kredensial service account dari Google Cloud Console. Dibutuhkan untuk otentikasi dengan API Google Analytics.
                                </p>
                                @error('credentials_file')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Panduan Pengaturan</h3>
                                <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                                    <li>Buat project di <a href="https://console.cloud.google.com/" target="_blank" class="text-indigo-600 hover:underline">Google Cloud Console</a></li>
                                    <li>Aktifkan Google Analytics API</li>
                                    <li>Buat Service Account dengan peran "Viewer" pada Google Analytics</li>
                                    <li>Buat kunci baru untuk Service Account dan download file JSON</li>
                                    <li>Upload file JSON tersebut di form ini</li>
                                    <li>Masukkan Property ID dari akun Google Analytics Anda</li>
                                </ol>
                            </div>
                            
                            <div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Simpan Pengaturan Analytics
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Company Information -->
                <div id="content-company" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Perusahaan</h3>
                        <p class="text-sm text-gray-600">Detail informasi perusahaan yang akan ditampilkan di website</p>
                    </div>
                    
                    <div class="max-w-4xl">
                        <form action="{{ route('admin.settings.company') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mt-4 flex items-center">
                                <div class="flex-1 mr-4">
                                    <div class="relative w-32 h-32 rounded-lg overflow-hidden bg-gray-100 border border-gray-300">
                                        @if(!empty($company->logo_path))
                                            <img id="company-logo-preview" src="{{ asset('storage/' . $company->logo_path) }}" class="w-full h-full object-cover" alt="Logo Perusahaan">
                                        @else
                                            <div id="company-logo-placeholder" class="flex items-center justify-center w-full h-full text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <img id="company-logo-preview" src="#" class="w-full h-full object-cover hidden" alt="Logo Perusahaan">
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo Perusahaan</label>
                                    <input type="file" name="logo" id="logo" class="mt-1 block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-medium
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100" onchange="previewCompanyLogo(this)" accept="image/*">
                                    <p class="mt-1 text-xs text-gray-500">Ukuran optimal 200x200 pixel (PNG, JPG)</p>
                                    @error('logo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Informasi Dasar Perusahaan -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-2">
                                <h4 class="font-medium text-gray-800 mb-3">Informasi Dasar</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                                            Nama Perusahaan <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="company_name" name="company_name" value="{{ $companyName }}" required 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        @error('company_name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="company_website" class="block text-sm font-medium text-gray-700 mb-1">
                                            Website
                                        </label>
                                        <input type="text" id="company_website" name="company_website" value="{{ $companyWebsite }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="www.contoh.com">
                                        @error('company_website')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="company_address" name="company_address" rows="3" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyAddress }}</textarea>
                                    @error('company_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                            Telepon <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="company_phone" name="company_phone" value="{{ $companyPhone }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        @error('company_phone')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="company_email" class="block text-sm font-medium text-gray-700 mb-1">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" id="company_email" name="company_email" value="{{ $companyEmail }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        @error('company_email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="company_tax_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        NPWP
                                    </label>
                                    <input type="text" id="company_tax_id" name="company_tax_id" value="{{ $companyTaxId }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    @error('company_tax_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Social Media -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-2">
                                <h4 class="font-medium text-gray-800 mb-3">Social Media</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="company_facebook" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fab fa-facebook text-blue-600 mr-1"></i> Facebook
                                        </label>
                                        <input type="text" id="company_facebook" name="company_facebook" value="{{ $companySocials['facebook'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="https://facebook.com/namahalaman">
                                    </div>
                                    
                                    <div>
                                        <label for="company_instagram" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fab fa-instagram text-pink-600 mr-1"></i> Instagram
                                        </label>
                                        <input type="text" id="company_instagram" name="company_instagram" value="{{ $companySocials['instagram'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="https://instagram.com/username">
                                    </div>
                                    
                                    <div>
                                        <label for="company_twitter" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fab fa-twitter text-blue-400 mr-1"></i> Twitter
                                        </label>
                                        <input type="text" id="company_twitter" name="company_twitter" value="{{ $companySocials['twitter'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="https://twitter.com/username">
                                    </div>
                                    
                                    <div>
                                        <label for="company_linkedin" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fab fa-linkedin text-blue-700 mr-1"></i> LinkedIn
                                        </label>
                                        <input type="text" id="company_linkedin" name="company_linkedin" value="{{ $companySocials['linkedin'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="https://linkedin.com/company/nama">
                                    </div>
                                    
                                    <div>
                                        <label for="company_youtube" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube
                                        </label>
                                        <input type="text" id="company_youtube" name="company_youtube" value="{{ $companySocials['youtube'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="https://youtube.com/channel/ID">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lokasi Pada Peta -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-2">
                                <h4 class="font-medium text-gray-800 mb-3">Lokasi Pada Peta</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                    <div>
                                        <label for="company_latitude" class="block text-sm font-medium text-gray-700 mb-1">
                                            Latitude
                                        </label>
                                        <input type="text" id="company_latitude" name="company_latitude" value="{{ $companyLocation['latitude'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="-6.2088">
                                    </div>
                                    
                                    <div>
                                        <label for="company_longitude" class="block text-sm font-medium text-gray-700 mb-1">
                                            Longitude
                                        </label>
                                        <input type="text" id="company_longitude" name="company_longitude" value="{{ $companyLocation['longitude'] }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="106.8456">
                                    </div>
                                </div>
                                
                                <p class="text-gray-500 text-xs mb-2">
                                    Koordinat ini akan digunakan untuk menampilkan lokasi kantor di Google Maps pada halaman kontak.
                                    Anda bisa mendapatkan koordinat dengan mengunjungi <a href="https://maps.google.com" target="_blank" class="text-indigo-600 hover:underline">Google Maps</a>.
                                </p>
                            </div>
                            
                            <!-- Deskripsi Perusahaan -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-2">
                                <h4 class="font-medium text-gray-800 mb-3">Deskripsi Perusahaan</h4>
                                
                                <div>
                                    <textarea id="company_description" name="company_description" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyDescription }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500">Deskripsi singkat tentang perusahaan Anda, akan ditampilkan di beberapa halaman website</p>
                                    @error('company_description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Simpan Informasi Perusahaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- API Settings -->
                <div id="content-api" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan API</h3>
                        <p class="text-sm text-gray-600">Konfigurasi akses API untuk integrasi dengan sistem lain</p>
                    </div>
                    
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.settings.api') }}" method="POST">
                            @csrf
                            
                            <div class="mb-6">
                                <label for="api_key" class="block font-medium text-gray-700 mb-2">
                                    API Key
                                </label>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-1 bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 font-mono text-sm">
                                        {{ $apiKey ?: 'Belum ada API key' }}
                                    </div>
                                    <button type="submit" name="generate_api_key" value="1"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded-lg text-sm font-medium transition-all duration-200">
                                        Generate Key Baru
                                    </button>
                                </div>
                                <p class="text-gray-500 text-sm mt-1">
                                    API key digunakan untuk otentikasi saat mengakses API. Jaga kerahasiaan key ini!
                                </p>
                            </div>
                            
                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input type="checkbox" name="api_enabled" id="api_enabled" value="1" {{ $apiEnabled ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <span class="ml-2 text-gray-700">Aktifkan akses API</span>
                                </label>
                                <p class="text-gray-500 text-sm mt-1 ml-6">
                                    Jika dinonaktifkan, semua permintaan API akan ditolak meskipun menggunakan API key yang valid.
                                </p>
                            </div>
                            
                            <div class="mb-6">
                                <label for="webhook_url" class="block font-medium text-gray-700 mb-2">
                                    Webhook URL
                                </label>
                                <input type="text" name="webhook_url" id="webhook_url" value="{{ $webhookUrl }}" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://example.com/webhook">
                                <p class="text-gray-500 text-sm mt-1">
                                    URL untuk menerima notifikasi webhook saat terjadi perubahan status pengiriman (opsional).
                                </p>
                                @error('webhook_url')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Dokumentasi API</h3>
                                <p class="text-gray-700 mb-3">
                                    Endpoint API tersedia untuk mengakses data tarif, melacak pengiriman, dan membuat pengiriman baru. 
                                    Semua permintaan memerlukan header otentikasi <code class="bg-gray-200 px-1 py-0.5 rounded">X-API-Key</code>.
                                </p>
                                <div class="space-y-3">
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="bg-gray-100 px-4 py-2 font-medium border-b border-gray-200">
                                            Cek Status Pengiriman
                                        </div>
                                        <div class="px-4 py-3">
                                            <div class="flex items-center mb-1">
                                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-medium">GET</span>
                                                <code class="ml-2 text-sm">/api/v1/shipments/{tracking_id}</code>
                                            </div>
                                            <p class="text-sm text-gray-600">Mendapatkan informasi status pengiriman berdasarkan nomor tracking.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="bg-gray-100 px-4 py-2 font-medium border-b border-gray-200">
                                            Hitung Tarif
                                        </div>
                                        <div class="px-4 py-3">
                                            <div class="flex items-center mb-1">
                                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-medium">POST</span>
                                                <code class="ml-2 text-sm">/api/v1/rates/calculate</code>
                                            </div>
                                            <p class="text-sm text-gray-600">Menghitung tarif pengiriman berdasarkan asal, tujuan, berat, dan layanan.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                                        Lihat Dokumentasi Lengkap →
                                    </a>
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Simpan Pengaturan API
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewCompanyLogo(input) {
        const preview = document.getElementById('company-logo-preview');
        const placeholder = document.getElementById('company-logo-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Tab navigation
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('[id^="nav-"]');
        const contentSections = document.querySelectorAll('[id^="content-"]');
        
        // Cek apakah ada hash di URL atau tab tersimpan di sessionStorage
        let activeTab = window.location.hash.substring(1) || sessionStorage.getItem('activeSettingsTab') || 'analytics';
        
        // Fungsi untuk mengaktifkan tab
        function activateTab(tabName) {
            // Simpan tab aktif ke sessionStorage
            sessionStorage.setItem('activeSettingsTab', tabName);
            
            // Remove active class from all links
            navLinks.forEach(navLink => {
                navLink.classList.remove('bg-indigo-50', 'text-indigo-600');
                navLink.classList.add('text-gray-700', 'hover:bg-gray-50');
            });
            
            // Add active class to selected tab link
            const activeLink = document.getElementById('nav-' + tabName);
            if (activeLink) {
                activeLink.classList.add('bg-indigo-50', 'text-indigo-600');
                activeLink.classList.remove('text-gray-700', 'hover:bg-gray-50');
            }
            
            // Hide all content sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show associated content section
            const targetContent = document.getElementById('content-' + tabName);
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
        }
        
        // Aktifkan tab yang sesuai saat halaman dimuat
        activateTab(activeTab);
        
        // Tambahkan event listener untuk klik pada tab
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Ambil nama tab dari atribut href
                const target = this.getAttribute('href').substring(1);
                
                // Aktifkan tab dan perbarui URL hash
                activateTab(target);
                window.location.hash = target;
            });
        });
    });
</script>
@endpush 