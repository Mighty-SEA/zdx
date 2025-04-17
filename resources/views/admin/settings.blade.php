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
                    
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.settings.company') }}" method="POST">
                            @csrf
                            
                            <div class="grid grid-cols-1 gap-5">
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
                                    <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="company_address" name="company_address" rows="3" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyAddress }}</textarea>
                                    @error('company_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                
                                <div>
                                    <label for="company_tax_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        NPWP
                                    </label>
                                    <input type="text" id="company_tax_id" name="company_tax_id" value="{{ $companyTaxId }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    @error('company_tax_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Deskripsi Perusahaan
                                    </label>
                                    <textarea id="company_description" name="company_description" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyDescription }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500">Deskripsi singkat tentang perusahaan Anda, akan ditampilkan di beberapa halaman website</p>
                                    @error('company_description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                        <i class="fas fa-save mr-2"></i> Simpan Informasi Perusahaan
                                    </button>
                                </div>
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

@section('scripts')
<script>
    // Tab navigation functionality
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('a[id^="nav-"]');
        const contentSections = document.querySelectorAll('div[id^="content-"]');
        
        function showTab(tabId) {
            // Hide all content sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });
            
            // Remove active class from all nav links
            navLinks.forEach(link => {
                link.classList.remove('text-indigo-600', 'bg-indigo-50');
                link.classList.add('text-gray-700', 'hover:bg-gray-50');
            });
            
            // Show selected content section
            const contentId = 'content-' + tabId;
            document.getElementById(contentId).classList.remove('hidden');
            
            // Set active class on selected nav link
            const navId = 'nav-' + tabId;
            document.getElementById(navId).classList.remove('text-gray-700', 'hover:bg-gray-50');
            document.getElementById(navId).classList.add('text-indigo-600', 'bg-indigo-50');
            
            // Update URL fragment
            window.location.hash = tabId;
        }
        
        // Add click handlers to nav links
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tabId = this.id.replace('nav-', '');
                showTab(tabId);
            });
        });
        
        // Show tab based on URL hash or default to first tab
        const hash = window.location.hash.substring(1);
        if (hash && document.getElementById('content-' + hash)) {
            showTab(hash);
        } else {
            showTab('analytics'); // Default tab
        }
    });
</script>
@endsection 