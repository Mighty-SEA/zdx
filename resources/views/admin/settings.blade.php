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
                    <a href="#tracking" id="nav-tracking" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-truck w-5 mr-2"></i>
                        <span>API Tracking</span>
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
                            
                            <!-- Tabs di dalam konten perusahaan -->
                            <div class="mb-6 border-b border-gray-200">
                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                                    <li class="mr-2">
                                        <a href="#" id="tab-general" class="inline-block p-3 border-b-2 border-indigo-600 rounded-t-lg text-indigo-600 active">Informasi Dasar</a>
                                    </li>
                                    <li class="mr-2">
                                        <a href="#" id="tab-logos" class="inline-block p-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Logo & Media</a>
                                    </li>
                                    <li class="mr-2">
                                        <a href="#" id="tab-about" class="inline-block p-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Profil Lengkap</a>
                                    </li>
                                    <li class="mr-2">
                                        <a href="#" id="tab-mission" class="inline-block p-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Visi & Misi</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- INFORMASI DASAR PANEL -->
                            <div id="panel-general" class="company-panel">
                            <div class="mt-4 flex items-center">
                                    {{-- <div class="flex-1 mr-4">
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
                                    </div> --}}
                                    {{-- <div class="flex-1">
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
                                    </div> --}}
                            </div>
                            
                            <!-- Informasi Dasar Perusahaan -->
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4">
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
                                        <label for="company_slogan" class="block text-sm font-medium text-gray-700 mb-1">
                                            Slogan Perusahaan
                                        </label>
                                        <input type="text" id="company_slogan" name="company_slogan" value="{{ $companySlogan ?? '' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                            placeholder="Masukkan slogan perusahaan">
                                        <p class="text-gray-500 text-xs mt-1">Slogan akan ditampilkan di website dan dokumen perusahaan</p>
                                        @error('company_slogan')
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
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4">
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
                            </div>
                            
                            <!-- LOGO & MEDIA PANEL -->
                            <div id="panel-logos" class="company-panel hidden">
                                <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-200 mb-4">
                                    <h4 class="font-medium text-indigo-800 mb-3">Logo Perusahaan</h4>
                                    
                                    <div class="grid grid-cols-3 gap-4">
                                        <!-- Logo 1 -->
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img src="{{ asset('asset/logo1.png') }}?v={{ time() }}" alt="Logo 1" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Logo 1 <span class="text-xs text-indigo-600">(Utama)</span></span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="1">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Logo 2 -->
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img src="{{ asset('asset/logo2.png') }}?v={{ time() }}" alt="Logo 2" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Logo 2</span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="2">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Logo 3 -->
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img src="{{ asset('asset/logo3.png') }}?v={{ time() }}" alt="Logo 3" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Logo 3</span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="3">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-2">
                                        <i class="fas fa-info-circle mr-1"></i> Logo 1 akan digunakan sebagai logo utama di halaman profil dan favicon.
                                    </div>
                                </div>
                                
                                <!-- Gambar Logistik -->
                                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                                    <h4 class="font-medium text-red-800 mb-3">Gambar Logistik</h4>
                                    
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="font-medium text-gray-700">Gambar Operasi Logistik</h4>
                                            <button id="changeLogisticsBtn" type="button" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring">
                                                Ubah Gambar
                                            </button>
                                        </div>
                                        <div class="border rounded-lg p-2">
                                            <img src="{{ asset('asset/logistics.jpg') }}?v={{ time() }}" alt="Operasi Logistik" class="w-full h-48 object-cover rounded">
                                        </div>
                                        <div class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-info-circle mr-1"></i> Gambar ini ditampilkan di bawah logo pada halaman profil perusahaan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- PROFIL LENGKAP PANEL -->
                            <div id="panel-about" class="company-panel hidden">
                                <div class="bg-purple-50 p-4 rounded-lg mb-4">
                                    <h4 class="font-medium text-purple-800 mb-3">Tentang Perusahaan</h4>
                                    
                                    @php
                                        $aboutContent = isset($aboutContents) && !empty($aboutContents) ? $aboutContents->first() : null;
                                    @endphp
                                    
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Judul Profil
                                            </label>
                                            <input type="text" name="about_title" value="{{ $aboutContent ? $aboutContent->title : 'Tentang ZDX Cargo' }}" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Konten Profil
                                            </label>
                                            <textarea name="about_content" id="about_content" rows="10" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">{{ $aboutContent ? $aboutContent->content : '' }}</textarea>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Struktur Organisasi
                                            </label>
                                            <input type="file" name="org_structure_image" accept="image/*" 
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                            
                                            @if($aboutContent && $aboutContent->org_structure_path)
                                            <div class="mt-3 border p-2 rounded">
                                                <img src="{{ asset($aboutContent->org_structure_path) }}?v={{ time() }}" alt="Struktur Organisasi" class="max-h-40 max-w-full">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
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
                            </div>
                            
                            <!-- VISI & MISI PANEL -->
                            <div id="panel-mission" class="company-panel hidden">
                                <div class="bg-blue-50 p-4 rounded-lg mb-4">
                                    <h4 class="font-medium text-blue-800 mb-3">Visi & Misi Perusahaan</h4>
                                    
                                    @php
                                        $visionContent = isset($visionContents) && !empty($visionContents) ? $visionContents->first() : null;
                                        $missionContent = isset($missionContents) && !empty($missionContents) ? $missionContents->first() : null;
                                    @endphp
                                    
                                    <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
                                        <div class="mb-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Judul Visi
                                            </label>
                                            <input type="text" name="vision_title" value="{{ $visionContent ? $visionContent->title : 'Visi Perusahaan' }}" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Konten Visi
                                            </label>
                                            <textarea name="vision_content" id="vision_content" rows="6" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">{{ $visionContent ? $visionContent->content : '' }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="mb-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Judul Misi
                                            </label>
                                            <input type="text" name="mission_title" value="{{ $missionContent ? $missionContent->title : 'Misi Perusahaan' }}" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Konten Misi
                                            </label>
                                            <textarea name="mission_content" id="mission_content" rows="6" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">{{ $missionContent ? $missionContent->content : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lokasi Pada Peta -->
                            {{-- <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4">
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
                            </div> --}}
                            
                            <div class="mt-6">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Simpan Informasi Perusahaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Tracking API Settings -->
                <div id="content-tracking" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan API Tracking</h3>
                        <p class="text-sm text-gray-600">Konfigurasi integrasi dengan API Tracking eksternal</p>
                    </div>
                    
                    @if(session('validation_error') || $errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                        <p class="font-medium">Terdapat kesalahan pada pengaturan tracking:</p>
                        <ul class="list-disc list-inside ml-2 mt-1 text-sm">
                            @if(session('validation_error'))
                                <li>{{ session('validation_error') }}</li>
                            @endif
                            @if($errors->has('tracking_api_url'))
                                <li>{{ $errors->first('tracking_api_url') }}</li>
                            @endif
                            @if($errors->has('tracking_request_headers'))
                                <li>{{ $errors->first('tracking_request_headers') }}</li>
                            @endif
                            @if($errors->has('tracking_response_mapping'))
                                <li>{{ $errors->first('tracking_response_mapping') }}</li>
                            @endif
                            @if($errors->has('general'))
                                <li>{{ $errors->first('general') }}</li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    
                    <div class="max-w-4xl">
                        <form action="{{ route('admin.settings.tracking') }}" method="POST">
                            @csrf
                            
                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input type="checkbox" name="use_external_tracking" id="use_external_tracking" value="1" {{ $useExternalTracking ?? false ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <span class="ml-2 text-gray-700">Gunakan API Tracking Eksternal</span>
                                </label>
                                <p class="text-gray-500 text-sm mt-1 ml-6">
                                    Jika diaktifkan, sistem akan menggunakan API pihak ketiga untuk pelacakan pengiriman.
                                </p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                                <h4 class="font-medium text-gray-800 mb-3">Penyedia Layanan API</h4>
                                
                                <div class="mb-4">
                                    <label for="tracking_provider" class="block text-sm font-medium text-gray-700 mb-1">
                                        Pilih Penyedia
                                    </label>
                                    <select id="tracking_provider" name="tracking_provider" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <option value="" disabled {{ empty($trackingProvider) ? 'selected' : '' }}>-- Pilih Penyedia API --</option>
                                        <option value="zdx_internal" {{ ($trackingProvider ?? '') == 'zdx_internal' ? 'selected' : '' }}>ZDX Internal (Default)</option>
                                        <option value="wahana" {{ ($trackingProvider ?? '') == 'wahana' ? 'selected' : '' }}>Wahana Express</option>
                                        <option value="jne" {{ ($trackingProvider ?? '') == 'jne' ? 'selected' : '' }}>JNE</option>
                                        <option value="sicepat" {{ ($trackingProvider ?? '') == 'sicepat' ? 'selected' : '' }}>SiCepat</option>
                                        <option value="pos_indonesia" {{ ($trackingProvider ?? '') == 'pos_indonesia' ? 'selected' : '' }}>Pos Indonesia</option>
                                        <option value="custom" {{ ($trackingProvider ?? '') == 'custom' ? 'selected' : '' }}>Custom API</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                                <h4 class="font-medium text-gray-800 mb-3">Konfigurasi API</h4>
                                
                                <div class="mb-4">
                                    <label for="tracking_api_url" class="block text-sm font-medium text-gray-700 mb-1">
                                        URL Endpoint API Tracking
                                    </label>
                                    <input type="text" id="tracking_api_url" name="tracking_api_url" value="{{ $trackingApiUrl ?? '' }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 @error('tracking_api_url') border-red-500 @enderror"
                                        placeholder="https://api.example.com/tracking/{tracking_number}">
                                    <p class="text-xs text-gray-500 mt-1">Gunakan {tracking_number} sebagai placeholder untuk nomor resi</p>
                                    @error('tracking_api_url')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="tracking_api_key" class="block text-sm font-medium text-gray-700 mb-1">
                                            API Key / Token
                                        </label>
                                        <input type="password" id="tracking_api_key" name="tracking_api_key" value="{{ $trackingApiKey ?? '' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    </div>
                                    
                                    <div>
                                        <label for="tracking_api_secret" class="block text-sm font-medium text-gray-700 mb-1">
                                            API Secret (opsional)
                                        </label>
                                        <input type="password" id="tracking_api_secret" name="tracking_api_secret" value="{{ $trackingApiSecret ?? '' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="tracking_request_method" class="block text-sm font-medium text-gray-700 mb-1">
                                        HTTP Method
                                    </label>
                                    <select id="tracking_request_method" name="tracking_request_method"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <option value="GET" {{ ($trackingRequestMethod ?? 'GET') == 'GET' ? 'selected' : '' }}>GET</option>
                                        <option value="POST" {{ ($trackingRequestMethod ?? '') == 'POST' ? 'selected' : '' }}>POST</option>
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="tracking_request_headers" class="block text-sm font-medium text-gray-700 mb-1">
                                        Headers Tambahan (JSON format)
                                    </label>
                                    <textarea id="tracking_request_headers" name="tracking_request_headers" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder='{"Content-Type": "application/json", "X-Custom-Header": "value"}'>{{ $trackingRequestHeaders ?? '' }}</textarea>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                                <h4 class="font-medium text-gray-800 mb-3">Konfigurasi Response</h4>
                                
                                <div class="mb-4">
                                    <label for="tracking_response_mapping" class="block text-sm font-medium text-gray-700 mb-1">
                                        Pemetaan Response JSON (opsional)
                                    </label>
                                    <textarea id="tracking_response_mapping" name="tracking_response_mapping" rows="6"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 font-mono text-sm"
                                        placeholder='{"tracking_number": "data.awb", "status": "data.delivery_status", "shipper": "data.origin", "receiver": "data.destination", "timeline": "data.history"}'
                                    >{{ $trackingResponseMapping ?? '' }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">Tentukan pemetaan field dari response API ke format yang digunakan oleh ZDX</p>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="tracking_test_number" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Resi untuk Testing
                                </label>
                                <div class="flex">
                                    <input type="text" id="tracking_test_number" name="tracking_test_number"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                                        placeholder="Masukkan nomor resi untuk testing">
                                    <button type="button" id="test_tracking_api" 
                                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-r-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Test API
                                    </button>
                                </div>
                            </div>
                            
                            <div id="tracking_api_test_result" class="mb-6 hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Hasil Test API
                                </label>
                                <div class="bg-gray-100 p-3 rounded-md border border-gray-200 max-h-80 overflow-auto">
                                    <pre id="tracking_test_response" class="text-xs font-mono whitespace-pre-wrap"></pre>
                                </div>
                                <div id="tracking_request_details" class="mt-2 text-xs text-gray-500 hidden">
                                    <p><strong>URL Request:</strong> <span id="request_url"></span></p>
                                    <p><strong>Method:</strong> <span id="request_method"></span></p>
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Simpan Pengaturan Tracking
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
        
        // Company tab navigation
        const companyTabs = document.querySelectorAll('[id^="tab-"]');
        const companyPanels = document.querySelectorAll('.company-panel');
        
        // Fungsi untuk mengaktifkan tab perusahaan
        function activateCompanyTab(tabId) {
            // Nonaktifkan semua tab
            companyTabs.forEach(tab => {
                tab.classList.remove('border-indigo-600', 'text-indigo-600');
                tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
            });
            
            // Aktifkan tab yang dipilih
            const activeTab = document.getElementById(tabId);
            if (activeTab) {
                activeTab.classList.add('border-indigo-600', 'text-indigo-600');
                activeTab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
            }
            
            // Sembunyikan semua panel
            companyPanels.forEach(panel => {
                panel.classList.add('hidden');
            });
            
            // Tampilkan panel yang sesuai dengan tab
            const panelId = tabId.replace('tab-', 'panel-');
            const activePanel = document.getElementById(panelId);
            if (activePanel) {
                activePanel.classList.remove('hidden');
            }
        }
        
        // Tambahkan event listener untuk klik pada tab perusahaan
        companyTabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                activateCompanyTab(this.id);
            });
        });
        
        // Tracking API Test
        const testTrackingApiBtn = document.getElementById('test_tracking_api');
        if (testTrackingApiBtn) {
            testTrackingApiBtn.addEventListener('click', function() {
                const trackingNumber = document.getElementById('tracking_test_number').value.trim();
                const apiUrl = document.getElementById('tracking_api_url').value.trim();
                const apiKey = document.getElementById('tracking_api_key').value.trim();
                const provider = document.getElementById('tracking_provider').value;
                const method = document.getElementById('tracking_request_method').value;
                const headersText = document.getElementById('tracking_request_headers').value.trim();
                
                // Validasi input dasar
                if (!trackingNumber) {
                    alert('Silakan masukkan nomor resi untuk testing');
                    return;
                }
                
                if (!apiUrl) {
                    alert('URL API harus diisi');
                    return;
                }
                
                // Tampilkan area hasil dan loading state
                const resultArea = document.getElementById('tracking_api_test_result');
                const responseElement = document.getElementById('tracking_test_response');
                resultArea.classList.remove('hidden');
                responseElement.textContent = 'Memuat data...';
                
                // Siapkan data untuk dikirim ke backend
                const testData = {
                    tracking_number: trackingNumber,
                    api_url: apiUrl,
                    api_key: apiKey,
                    provider: provider,
                    method: method
                };
                
                // Tambahkan headers jika ada
                if (headersText) {
                    try {
                        testData.headers = JSON.parse(headersText);
                    } catch (e) {
                        responseElement.textContent = 'Error: Format JSON headers tidak valid. ' + e.message;
                        return;
                    }
                }
                
                // Kirim request ke endpoint testing
                fetch('/admin/settings/tracking/test', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(testData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        responseElement.textContent = JSON.stringify(data.response, null, 2);
                    } else {
                        responseElement.textContent = 'Error: ' + data.message + '\n\n' + JSON.stringify(data.response || {}, null, 2);
                    }
                    
                    // Tampilkan detail request jika tersedia
                    const requestDetails = document.getElementById('tracking_request_details');
                    const requestUrl = document.getElementById('request_url');
                    const requestMethod = document.getElementById('request_method');
                    
                    if (data.request_url && data.request_method) {
                        requestUrl.textContent = data.request_url;
                        requestMethod.textContent = data.request_method;
                        requestDetails.classList.remove('hidden');
                    } else {
                        requestDetails.classList.add('hidden');
                    }
                })
                .catch(error => {
                    responseElement.textContent = 'Error saat menghubungi API: ' + error.message;
                });
            });
        }
        
        // Show/hide penyedia custom fields based on provider selection
        const trackingProviderSelect = document.getElementById('tracking_provider');
        if (trackingProviderSelect) {
            const toggleCustomFields = function() {
                const customFields = document.querySelectorAll('.custom-provider-fields');
                if (trackingProviderSelect.value === 'custom') {
                    customFields.forEach(field => field.classList.remove('hidden'));
                } else {
                    customFields.forEach(field => field.classList.add('hidden'));
                }
            };
            
            trackingProviderSelect.addEventListener('change', toggleCustomFields);
            toggleCustomFields(); // Run once on init
        }
        
        // Logo edit buttons
        const logoEditButtons = document.querySelectorAll('.logo-edit');
        const logoUploadModal = document.getElementById('logoUploadModal');
        const logoNumber = document.getElementById('logoNumber');
        const closeModalButtons = document.querySelectorAll('.close-modal');
        
        if (logoEditButtons.length > 0 && logoUploadModal) {
            logoEditButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const logo = this.getAttribute('data-logo');
                    logoNumber.value = logo;
                    logoUploadModal.classList.remove('hidden');
                });
            });
            
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    logoUploadModal.classList.add('hidden');
                });
            });
        }
        
        // Logo preview
        const logoFile = document.getElementById('logoFile');
        const logoPreview = document.getElementById('logoPreview');
        const previewContainer = document.getElementById('previewContainer');
        
        if (logoFile && logoPreview) {
            logoFile.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
        
        // Logistics image edit
        const changeLogisticsBtn = document.getElementById('changeLogisticsBtn');
        const logisticsUploadModal = document.getElementById('logisticsUploadModal');
        const closeLogisticsModalButtons = document.querySelectorAll('.close-logistics-modal');
        
        if (changeLogisticsBtn && logisticsUploadModal) {
            changeLogisticsBtn.addEventListener('click', function() {
                logisticsUploadModal.classList.remove('hidden');
            });
            
            closeLogisticsModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    logisticsUploadModal.classList.add('hidden');
                });
            });
        }
    });
</script>
@endpush 