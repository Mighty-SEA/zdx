@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('meta')
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $settings = $settings ?? \Illuminate\Support\Facades\DB::table('settings')->first();
@endphp
<link rel="icon" type="image/png" href="{{ !empty($settings->title_logo_path) ? asset($settings->title_logo_path) : asset('asset/logo.png') }}">
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h2>
            <p class="text-gray-600 mt-1">Kelola pengaturan umum aplikasi {{ $settings->company_name ?? ($companyInfo->company_name ?? 'ZDX Cargo') }}.</p>
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
                    <a href="#update" id="nav-update" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-sync-alt w-5 mr-2"></i>
                        <span>Update Aplikasi</span>
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
                    
                    @if(class_exists('App\View\Components\AnalyticsAlert'))
                        <x-analytics-alert />
                    @else
                        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-100 rounded-lg">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Google Analytics belum dikonfigurasi</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Untuk melihat data analitik yang akurat, silakan konfigurasi Google Analytics.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
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
                                        Alamat Utama <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="company_address" name="company_address" rows="2" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyAddress }}</textarea>
                                    @error('company_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mt-3">
                                    <label for="company_address2" class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat Tambahan 1
                                    </label>
                                    <textarea id="company_address2" name="company_address2" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyAddress2 ?? '' }}</textarea>
                                    @error('company_address2')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mt-3">
                                    <label for="company_address3" class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat Tambahan 2
                                    </label>
                                    <textarea id="company_address3" name="company_address3" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">{{ $companyAddress3 ?? '' }}</textarea>
                                    @error('company_address3')
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
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="company_phone2" class="block text-sm font-medium text-gray-700 mb-1">
                                            Telepon 2
                                        </label>
                                        <input type="text" id="company_phone2" name="company_phone2" value="{{ $companyPhone2 ?? '' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <p class="text-gray-500 text-xs mt-1">Nomor telepon alternatif untuk customer service</p>
                                        @error('company_phone2')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="company_phone3" class="block text-sm font-medium text-gray-700 mb-1">
                                            Telepon 3
                                        </label>
                                        <input type="text" id="company_phone3" name="company_phone3" value="{{ $companyPhone3 ?? '' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                        <p class="text-gray-500 text-xs mt-1">Nomor telepon alternatif tambahan</p>
                                        @error('company_phone3')
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
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <!-- Logo 1 -->
                                        @php
                                            $logos = \Illuminate\Support\Facades\DB::table('settings')->first();
                                        @endphp
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img id="logo1-preview" src="{{ $logos && $logos->logo_1_path ? asset($logos->logo_1_path).'?v='.rand() : asset('placeholder-image.png') }}" alt="{{ $logos && $logos->logo_1_alt ? $logos->logo_1_alt : 'Logo 1' }}" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Logo 1 <span class="text-xs text-indigo-600">(Utama)</span></span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="1" onclick="showLogoModal('1')">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                            @if($logos && $logos->logo_1_updated_at)
                                                <div class="mt-1 text-xs text-gray-500">
                                                    <i class="fas fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($logos->logo_1_updated_at)->format('d M Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Logo 2 -->
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img id="logo2-preview" src="{{ $logos && $logos->logo_2_path ? asset($logos->logo_2_path).'?v='.rand() : asset('placeholder-image.png') }}" alt="{{ $logos && $logos->logo_2_alt ? $logos->logo_2_alt : 'Logo 2' }}" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Logo 2</span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="2" onclick="showLogoModal('2')">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                            @if($logos && $logos->logo_2_updated_at)
                                                <div class="mt-1 text-xs text-gray-500">
                                                    <i class="fas fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($logos->logo_2_updated_at)->format('d M Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Logo 3 -->
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img id="logo3-preview" src="{{ $logos && $logos->logo_3_path ? asset($logos->logo_3_path).'?v='.rand() : asset('placeholder-image.png') }}" alt="{{ $logos && $logos->logo_3_alt ? $logos->logo_3_alt : 'Logo 3' }}" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Logo 3</span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="3" onclick="showLogoModal('3')">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                            @if($logos && $logos->logo_3_updated_at)
                                                <div class="mt-1 text-xs text-gray-500">
                                                    <i class="fas fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($logos->logo_3_updated_at)->format('d M Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Title Logo -->
                                        <div class="border rounded-lg p-2 bg-white">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <img id="title-logo-preview" src="{{ $logos && $logos->title_logo_path ? asset($logos->title_logo_path).'?v='.rand() : asset('placeholder-image.png') }}" alt="{{ $logos && $logos->title_logo_alt ? $logos->title_logo_alt : 'Title Logo' }}" class="w-full h-32 object-contain">
                                            </div>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Title Logo <span class="text-xs text-green-600">(Kompress)</span></span>
                                                <button type="button" class="logo-edit inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200" data-logo="title" onclick="showLogoModal('title')">
                                                    <i class="fas fa-edit mr-1"></i> Ubah
                                                </button>
                                            </div>
                                            @if($logos && $logos->title_logo_updated_at)
                                                <div class="mt-1 text-xs text-gray-500">
                                                    <i class="fas fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($logos->title_logo_updated_at)->format('d M Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-2">
                                        <i class="fas fa-info-circle mr-1"></i> Logo 1 akan digunakan sebagai logo utama di halaman profil dan favicon. Title Logo digunakan untuk versi kompress pada judul halaman.
                                    </div>
                                </div>
                                
                                <!-- Struktur Organisasi -->
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 mb-4">
                                    <h4 class="font-medium text-blue-800 mb-3">Struktur Organisasi</h4>
                                    
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="font-medium text-gray-700">Gambar Struktur Organisasi</h4>
                                            <button id="changeStructureBtn" type="button" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring" onclick="showStructureModal()">
                                                Ubah Gambar
                                            </button>
                                        </div>
                                        <div class="border rounded-lg p-2">
                                            <img id="structure-preview" src="{{ $logos && $logos->structure_image_path ? asset($logos->structure_image_path).'?v='.rand() : asset('placeholder-image.png') }}" alt="{{ $logos && $logos->structure_image_alt ? $logos->structure_image_alt : 'Struktur Organisasi' }}" class="w-full h-48 object-contain rounded">
                                        </div>
                                        <div class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-info-circle mr-1"></i> Gambar ini menampilkan struktur organisasi perusahaan pada halaman profil.
                                            @if($logos && $logos->structure_image_updated_at)
                                                <div class="mt-1 text-xs text-blue-500">
                                                    <i class="fas fa-clock mr-1"></i> Terakhir diperbarui: {{ \Carbon\Carbon::parse($logos->structure_image_updated_at)->format('d M Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Gambar Logistik -->
                                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                                    <h4 class="font-medium text-red-800 mb-3">Gambar Logistik</h4>
                                    
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="font-medium text-gray-700">Gambar Operasi Logistik</h4>
                                            <button id="changeLogisticsBtn" type="button" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring" onclick="showLogisticsModal()">
                                                Ubah Gambar
                                            </button>
                                        </div>
                                        <div class="border rounded-lg p-2">
                                            <img id="logistics-preview" src="{{ $logos && $logos->logistics_image_path ? asset($logos->logistics_image_path).'?v='.rand() : asset('placeholder-image.png') }}" alt="{{ $logos && $logos->logistics_image_alt ? $logos->logistics_image_alt : 'Operasi Logistik' }}" class="w-full h-48 object-cover rounded">
                                        </div>
                                        <div class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-info-circle mr-1"></i> Gambar ini ditampilkan di bawah logo pada halaman profil perusahaan.
                                            @if($logos && $logos->logistics_image_updated_at)
                                                <div class="mt-1 text-xs text-red-500">
                                                    <i class="fas fa-clock mr-1"></i> Terakhir diperbarui: {{ \Carbon\Carbon::parse($logos->logistics_image_updated_at)->format('d M Y H:i') }}
                                                </div>
                                            @endif
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
                                        <option value="zdx_api" {{ ($trackingProvider ?? '') == 'zdx_api' ? 'selected' : '' }}>ZDX API</option>
                                        <option value="wahana" {{ ($trackingProvider ?? '') == 'wahana' ? 'selected' : '' }}>Wahana Express</option>
                                        <option value="jne" {{ ($trackingProvider ?? '') == 'jne' ? 'selected' : '' }}>JNE</option>
                                        <option value="sicepat" {{ ($trackingProvider ?? '') == 'sicepat' ? 'selected' : '' }}>SiCepat</option>
                                        <option value="pos_indonesia" {{ ($trackingProvider ?? '') == 'pos_indonesia' ? 'selected' : '' }}>Pos Indonesia</option>
                                        <option value="custom" {{ ($trackingProvider ?? '') == 'custom' ? 'selected' : '' }}>Custom API</option>
                                    </select>
                                </div>
                                
                                <!-- Penjelasan ZDX API -->
                                <div id="zdx-api-info" class="bg-blue-50 p-3 rounded-md border border-blue-200 mb-4 {{ ($trackingProvider ?? '') == 'zdx_api' ? '' : 'hidden' }}">
                                    <h5 class="text-sm font-medium text-blue-700 mb-2">
                                        <i class="fas fa-info-circle mr-1"></i> Informasi ZDX API
                                    </h5>
                                    <p class="text-xs text-blue-600">
                                        ZDX API menggunakan endpoint-endpoint berikut sesuai dengan dokumentasi resmi:
                                    </p>
                                    <ul class="list-disc list-inside ml-2 mt-1 text-xs text-blue-600">
                                        <li>Tracking By AWB: <code class="bg-blue-100 px-1 py-0.5 rounded">https://www.apiweb.zdx.co.id/api/web/trackingWebAwb</code></li>
                                        <li>Detail Tracking By AWB: <code class="bg-blue-100 px-1 py-0.5 rounded">https://apiweb.zdx.co.id/api/web/detailAwb</code></li>
                                    </ul>
                                    <p class="text-xs text-blue-600 mt-1">
                                        Untuk menggunakan API ini, masukkan token API dari ZDX pada field API Key/Token.
                                    </p>
                                    
                                    <details class="mt-2">
                                        <summary class="text-xs font-medium text-blue-700 cursor-pointer">Tampilkan contoh format mapping response</summary>
                                        <div class="mt-2 p-2 bg-gray-100 rounded text-xs font-mono text-gray-800 whitespace-pre-wrap">
{
  "tracking_number": "process.awbdetail.awb_no",
  "status": "process.lasthistory.status",
  "service": "process.awbdetail.service_name",
  "shipper": {
    "name": "process.awbdetail.shipper_name",
    "address": "process.awbdetail.city_origin"
  },
  "receiver": {
    "name": "process.awbdetail.receiver_name", 
    "address": "process.awbdetail.receiver_address"
  },
  "timeline": "data"
}
                                        </div>
                                    </details>
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

                <!-- Update Aplikasi -->
                <div id="content-update" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Update Aplikasi dari GitHub</h3>
                        <p class="text-sm text-gray-600">Perbarui aplikasi dari repository GitHub yang terhubung</p>
                    </div>

                    <div class="alert alert-info bg-blue-50 text-blue-700 p-4 rounded-lg border border-blue-200 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <i class="fas fa-info-circle text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-medium mb-2">Informasi Penting</h5>
                                <ul class="list-disc pl-5 space-y-1 text-sm">
                                    <li>Fitur ini akan memperbarui aplikasi dari repository GitHub yang terhubung.</li>
                                    <li>Pastikan Anda telah melakukan backup database sebelum melakukan update, terutama jika memilih opsi migrate:refresh.</li>
                                    <li>Opsi "Update Saja" akan melakukan git pull dan membersihkan cache tanpa mengubah database.</li>
                                    <li>Opsi "Update dengan Migrasi" akan melakukan git pull, membersihkan cache dan menjalankan migrasi database baru.</li>
                                    <li>Opsi "Update dengan Refresh Database" akan melakukan git pull, membersihkan cache dan me-reset seluruh database lalu melakukan seeding ulang.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @if(session('update_error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('update_error') }}
                    </div>
                    @endif

                    @if(session('update_success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('update_success') }}
                    </div>
                    
                    @if(session('output'))
                    <div class="card mt-4 mb-6">
                        <div class="card-header bg-gray-800 text-white p-3">
                            <h6 class="m-0 font-medium">Output Proses Update</h6>
                        </div>
                        <div class="card-body bg-gray-50 border border-gray-200 rounded-b-lg">
                            <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm" style="max-height: 400px; overflow-y: auto;">{{ session('output') }}</pre>
                        </div>
                    </div>
                    @endif
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <!-- Update Saja -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                            <div class="p-5">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Update Saja</h4>
                                <p class="text-gray-600 text-sm mb-4">Melakukan git pull dan membersihkan cache aplikasi tanpa mengubah struktur database.</p>
                                <form action="{{ route('admin.update.perform') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center w-full transition-all duration-200">
                                        <i class="fas fa-sync-alt mr-2"></i> Update Aplikasi
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Update dengan Migrasi -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                            <div class="p-5">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Update dengan Migrasi</h4>
                                <p class="text-gray-600 text-sm mb-4">Melakukan git pull, membersihkan cache dan menjalankan migrasi database baru (php artisan migrate).</p>
                                <form action="{{ route('admin.update.perform') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="with_migration" value="1">
                                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center w-full transition-all duration-200">
                                        <i class="fas fa-database mr-2"></i> Update & Migrate
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Update dengan Refresh Database -->
                        <div class="bg-white rounded-lg border border-red-300 shadow-sm overflow-hidden">
                            <div class="p-5">
                                <h4 class="text-lg font-semibold text-red-600 mb-2">Update dengan Refresh Database</h4>
                                <p class="text-gray-600 text-sm mb-4">Melakukan git pull, membersihkan cache dan me-reset seluruh database lalu melakukan seeding (migrate:refresh --seed).</p>
                                <div class="bg-red-50 p-3 rounded-lg text-red-600 text-sm mb-4">
                                    <i class="fas fa-exclamation-triangle"></i> Perhatian: Tindakan ini akan menghapus semua data dan mengisinya kembali dengan data default!
                                </div>
                                <form action="{{ route('admin.update.perform') }}" method="POST" onsubmit="return confirm('PERINGATAN: Tindakan ini akan MENGHAPUS SEMUA DATA di database dan mengisinya kembali dengan data default! Apakah Anda yakin?');">
                                    @csrf
                                    <input type="hidden" name="with_refresh" value="1">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center w-full transition-all duration-200">
                                        <i class="fas fa-exclamation-circle mr-2"></i> Update & Refresh Database
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Delete Media -->
<form id="deleteMediaForm" action="{{ route('admin.company-media.delete') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="media_type" id="deleteMediaType" value="">
</form>

<!-- Modal Upload Logo -->
<div id="logoModal" class="fixed inset-0 z-50 hidden overflow-auto bg-gray-800 bg-opacity-75">
    <div class="relative p-6 mx-auto my-10 max-w-xl bg-white rounded-lg shadow-xl">
        <div class="flex justify-between items-center mb-4 pb-2 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Upload Logo <span id="logoNumberText"></span></h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeLogoModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form action="{{ route('admin.company-media.logo.upload') }}" method="POST" enctype="multipart/form-data" id="logoForm">
            @csrf
            <input type="hidden" name="logo_number" id="logoNumber" value="">
            
            <div class="mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center" id="logo-dropzone">
                    <div id="logo-preview-container" class="mb-3 hidden">
                        <img id="logo-preview" src="" alt="Preview" class="mx-auto h-32 object-contain rounded">
                    </div>
                    <label for="logo_file" class="cursor-pointer inline-flex flex-col items-center">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk upload logo</span>
                        <span class="text-xs text-gray-500 mt-1">PNG, JPG, GIF (maks. 2MB)</span>
                        <input type="file" name="logo_file" id="logo_file" class="hidden" accept="image/*" required onchange="previewLogoImage(this)">
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="logo_alt" class="block text-sm font-medium text-gray-700 mb-1">Alt Text (Deskripsi Logo)</label>
                <input type="text" name="logo_alt" id="logo_alt" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Logo ZDX Cargo">
                <p class="text-xs text-gray-500 mt-1">Deskripsi untuk aksesibilitas dan SEO</p>
            </div>
            
            <div class="mb-4">
                <label for="logo_name" class="block text-sm font-medium text-gray-700 mb-1">Nama File (opsional)</label>
                <input type="text" name="logo_name" id="logo_name" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Biarkan kosong untuk penamaan otomatis">
                <p class="text-xs text-gray-500 mt-1">Nama ini akan digunakan sebagai bagian dari nama file</p>
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50" onclick="closeLogoModal()">Batal</button>
                <div class="flex space-x-2">
                    <button type="button" id="deleteLogo" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 hidden" onclick="deleteMedia('logo')">Hapus</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Upload Struktur Organisasi -->
<div id="structureModal" class="fixed inset-0 z-50 hidden overflow-auto bg-gray-800 bg-opacity-75">
    <div class="relative p-6 mx-auto my-10 max-w-xl bg-white rounded-lg shadow-xl">
        <div class="flex justify-between items-center mb-4 pb-2 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Upload Struktur Organisasi</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeStructureModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form action="{{ route('admin.company-media.structure.upload') }}" method="POST" enctype="multipart/form-data" id="structureForm">
            @csrf
            
            <div class="mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center" id="structure-dropzone">
                    <div id="structure-preview-container" class="mb-3 hidden">
                        <img id="structure-modal-preview" src="" alt="Preview" class="mx-auto h-40 object-contain rounded">
                    </div>
                    <label for="structure_file" class="cursor-pointer inline-flex flex-col items-center">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk upload gambar struktur</span>
                        <span class="text-xs text-gray-500 mt-1">PNG, JPG (maks. 2MB)</span>
                        <input type="file" name="structure_file" id="structure_file" class="hidden" accept="image/*" required onchange="previewStructureImage(this)">
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="structure_alt" class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                <input type="text" name="structure_alt" id="structure_alt" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Struktur Organisasi ZDX Cargo">
                <p class="text-xs text-gray-500 mt-1">Deskripsi untuk aksesibilitas dan SEO</p>
            </div>
            
            <div class="mb-4">
                <label for="structure_name" class="block text-sm font-medium text-gray-700 mb-1">Nama File (opsional)</label>
                <input type="text" name="structure_name" id="structure_name" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Biarkan kosong untuk penamaan otomatis">
                <p class="text-xs text-gray-500 mt-1">Nama ini akan digunakan sebagai bagian dari nama file</p>
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50" onclick="closeStructureModal()">Batal</button>
                <div class="flex space-x-2">
                    <button type="button" id="deleteStructure" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 hidden" onclick="deleteMedia('structure_image')">Hapus</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Upload Gambar Logistik -->
<div id="logisticsModal" class="fixed inset-0 z-50 hidden overflow-auto bg-gray-800 bg-opacity-75">
    <div class="relative p-6 mx-auto my-10 max-w-xl bg-white rounded-lg shadow-xl">
        <div class="flex justify-between items-center mb-4 pb-2 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Upload Gambar Logistik</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeLogisticsModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form action="{{ route('admin.company-media.logistics.upload') }}" method="POST" enctype="multipart/form-data" id="logisticsForm">
            @csrf
            
            <div class="mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center" id="logistics-dropzone">
                    <div id="logistics-preview-container" class="mb-3 hidden">
                        <img id="logistics-modal-preview" src="" alt="Preview" class="mx-auto h-40 object-cover rounded">
                    </div>
                    <label for="logistics_file" class="cursor-pointer inline-flex flex-col items-center">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk upload gambar logistik</span>
                        <span class="text-xs text-gray-500 mt-1">PNG, JPG (maks. 2MB)</span>
                        <input type="file" name="logistics_file" id="logistics_file" class="hidden" accept="image/*" required onchange="previewLogisticsImage(this)">
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="logistics_alt" class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                <input type="text" name="logistics_alt" id="logistics_alt" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Operasi Logistik ZDX Cargo">
                <p class="text-xs text-gray-500 mt-1">Deskripsi untuk aksesibilitas dan SEO</p>
            </div>
            
            <div class="mb-4">
                <label for="logistics_name" class="block text-sm font-medium text-gray-700 mb-1">Nama File (opsional)</label>
                <input type="text" name="logistics_name" id="logistics_name" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Biarkan kosong untuk penamaan otomatis">
                <p class="text-xs text-gray-500 mt-1">Nama ini akan digunakan sebagai bagian dari nama file</p>
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50" onclick="closeLogisticsModal()">Batal</button>
                <div class="flex space-x-2">
                    <button type="button" id="deleteLogistics" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 hidden" onclick="deleteMedia('logistics_image')">Hapus</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi-fungsi untuk tab perusahaan
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('tab-general').addEventListener('click', function(e) {
        e.preventDefault();
        switchCompanyTab('general');
    });

    document.getElementById('tab-logos').addEventListener('click', function(e) {
        e.preventDefault();
        switchCompanyTab('logos');
    });

    document.getElementById('tab-about').addEventListener('click', function(e) {
        e.preventDefault();
        switchCompanyTab('about');
    });

    document.getElementById('tab-mission').addEventListener('click', function(e) {
        e.preventDefault();
        switchCompanyTab('mission');
    });

    // Navigasi tab utama
    const navLinks = document.querySelectorAll('[id^="nav-"]');
    const contentDivs = document.querySelectorAll('[id^="content-"]');
    
    function showContent(targetId) {
        // Sembunyikan semua konten
        contentDivs.forEach(function(div) {
            div.classList.add('hidden');
        });
        
        // Tampilkan konten yang dipilih
        const targetContent = document.getElementById('content-' + targetId);
        if (targetContent) {
            targetContent.classList.remove('hidden');
        }
        
        // Set kelas aktif pada navigasi
        navLinks.forEach(function(link) {
            const linkId = link.id.split('-')[1];
            if (linkId === targetId) {
                link.classList.remove('text-gray-700', 'hover:bg-gray-50');
                link.classList.add('text-indigo-600', 'bg-indigo-50');
            } else {
                link.classList.remove('text-indigo-600', 'bg-indigo-50');
                link.classList.add('text-gray-700', 'hover:bg-gray-50');
            }
        });
    }
    
    // Tambahkan event listener untuk setiap navigasi
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.id.split('-')[1];
            showContent(targetId);
            
            // Simpan pilihan tab ke localStorage
            localStorage.setItem('settings_active_tab', targetId);
            
            // Update URL dengan hash
            window.history.replaceState(null, null, '#' + targetId);
        });
    });
    
    // Periksa hash di URL
    const hash = window.location.hash.slice(1);
    if (hash && document.getElementById('nav-' + hash)) {
        showContent(hash);
    } else {
        // Jika tidak ada hash, periksa localStorage
        const savedTab = localStorage.getItem('settings_active_tab');
        if (savedTab && document.getElementById('nav-' + savedTab)) {
            showContent(savedTab);
        }
    }
});

// Fungsi untuk beralih tab di bagian perusahaan
function switchCompanyTab(tab) {
    // Sembunyikan semua panel
    document.querySelectorAll('.company-panel').forEach(function(panel) {
        panel.classList.add('hidden');
    });
    
    // Tampilkan panel yang dipilih
    document.getElementById('panel-' + tab).classList.remove('hidden');
    
    // Ubah status tab
    document.querySelectorAll('[id^="tab-"]').forEach(function(tabEl) {
        const tabId = tabEl.id.split('-')[1];
        if (tabId === tab) {
            tabEl.classList.add('border-indigo-600', 'text-indigo-600');
            tabEl.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
        } else {
            tabEl.classList.remove('border-indigo-600', 'text-indigo-600');
            tabEl.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
        }
    });
}

// Preview untuk logo
function previewLogoImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('logo-preview').src = e.target.result;
            document.getElementById('logo-preview-container').classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Modal logo
function showLogoModal(logoNumber) {
    document.getElementById('logoNumber').value = logoNumber;
    let logoText = 'Logo ' + logoNumber;
    
    if (logoNumber === 'title') {
        logoText = 'Title Logo';
    }
    
    document.getElementById('logoNumberText').textContent = logoText;
    document.getElementById('logoModal').classList.remove('hidden');
    
    // Reset form
    document.getElementById('logoForm').reset();
    document.getElementById('logo-preview-container').classList.add('hidden');
    
    // Set nilai alt text default
    const altInput = document.getElementById('logo_alt');
    if (altInput) {
        altInput.value = 'Logo ZDX Cargo';
        if (logoNumber === 'title') {
            altInput.value = 'Title Logo ZDX Cargo';
        }
    }
    
    // Show/hide delete button
    const logos = document.getElementById('deleteLogo');
    logos.classList.remove('hidden');
}

function closeLogoModal() {
    document.getElementById('logoModal').classList.add('hidden');
}

// Modal struktur organisasi
function showStructureModal() {
    document.getElementById('structureModal').classList.remove('hidden');
    
    // Reset form
    document.getElementById('structureForm').reset();
    document.getElementById('structure-preview-container').classList.add('hidden');
    
    // Set nilai alt text default
    const altInput = document.getElementById('structure_alt');
    if (altInput) {
        altInput.value = 'Struktur Organisasi ZDX Cargo';
    }
    
    // Show delete button if image exists
    const structureImg = document.getElementById('structure-preview');
    const deleteBtn = document.getElementById('deleteStructure');
    
    if (structureImg && !structureImg.src.includes('placeholder-image.png')) {
        deleteBtn.classList.remove('hidden');
    } else {
        deleteBtn.classList.add('hidden');
    }
}

function closeStructureModal() {
    document.getElementById('structureModal').classList.add('hidden');
}

// Preview untuk struktur
function previewStructureImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('structure-modal-preview').src = e.target.result;
            document.getElementById('structure-preview-container').classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Modal logistik
function showLogisticsModal() {
    document.getElementById('logisticsModal').classList.remove('hidden');
    
    // Reset form
    document.getElementById('logisticsForm').reset();
    document.getElementById('logistics-preview-container').classList.add('hidden');
    
    // Set nilai alt text default
    const altInput = document.getElementById('logistics_alt');
    if (altInput) {
        altInput.value = 'Operasi Logistik ZDX Cargo';
    }
}

function closeLogisticsModal() {
    document.getElementById('logisticsModal').classList.add('hidden');
}

// Preview untuk logistik
function previewLogisticsImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('logistics-modal-preview').src = e.target.result;
            document.getElementById('logistics-preview-container').classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Fungsi untuk menghapus media
function deleteMedia(mediaType) {
    if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
        const form = document.getElementById('deleteMediaForm');
        const mediaTypeInput = document.getElementById('deleteMediaType');
        
        if (form && mediaTypeInput) {
            mediaTypeInput.value = mediaType;
            form.submit();
        }
    }
}

// Fungsi Test API Tracking
document.addEventListener('DOMContentLoaded', function() {
    const testBtn = document.getElementById('test_tracking_api');
    if (testBtn) {
        testBtn.addEventListener('click', function() {
            const trackingNumber = document.getElementById('tracking_test_number').value.trim();
            if (!trackingNumber) {
                alert('Silakan masukkan nomor resi untuk testing');
                return;
            }
            
            // Ambil nilai-nilai dari form
            const apiUrl = document.getElementById('tracking_api_url').value;
            const apiKey = document.getElementById('tracking_api_key').value;
            const apiSecret = document.getElementById('tracking_api_secret').value;
            const provider = document.getElementById('tracking_provider').value;
            const method = document.getElementById('tracking_request_method').value;
            
            // Ambil headers dari textarea
            let headers = {};
            try {
                const headersText = document.getElementById('tracking_request_headers').value;
                if (headersText) {
                    headers = JSON.parse(headersText);
                }
            } catch (error) {
                alert('Format JSON untuk headers tidak valid');
                return;
            }
            
            // Tampilkan loading state
            const originalText = testBtn.innerHTML;
            testBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-1"></i> Testing...';
            testBtn.disabled = true;
            
            // Kirim request ke endpoint test API tracking
            fetch('{{ route('admin.settings.tracking.test') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    tracking_number: trackingNumber,
                    api_url: apiUrl,
                    api_key: apiKey,
                    api_secret: apiSecret,
                    provider: provider,
                    method: method,
                    headers: headers
                })
            })
            .then(response => response.json())
            .then(data => {
                // Reset button state
                testBtn.innerHTML = originalText;
                testBtn.disabled = false;
                
                // Tampilkan hasil
                const resultContainer = document.getElementById('tracking_api_test_result');
                const responseElem = document.getElementById('tracking_test_response');
                const requestDetails = document.getElementById('tracking_request_details');
                const requestUrl = document.getElementById('request_url');
                const requestMethod = document.getElementById('request_method');
                
                resultContainer.classList.remove('hidden');
                
                // Format JSON response agar lebih mudah dibaca
                let formattedResponse = '';
                if (data.success) {
                    formattedResponse = JSON.stringify(data.response, null, 2);
                    responseElem.classList.remove('text-red-600');
                    responseElem.classList.add('text-green-600');
                } else {
                    formattedResponse = data.message || 'Terjadi kesalahan saat menguji API';
                    if (data.response) {
                        formattedResponse += '\n\nResponse: ' + JSON.stringify(data.response, null, 2);
                    }
                    responseElem.classList.remove('text-green-600');
                    responseElem.classList.add('text-red-600');
                }
                
                responseElem.textContent = formattedResponse;
                
                // Tampilkan detail request
                if (data.request_url || data.request_method) {
                    requestDetails.classList.remove('hidden');
                    requestUrl.textContent = data.request_url || apiUrl;
                    requestMethod.textContent = data.request_method || method;
                } else {
                    requestDetails.classList.add('hidden');
                }
            })
            .catch(error => {
                testBtn.innerHTML = originalText;
                testBtn.disabled = false;
                
                alert('Terjadi kesalahan: ' + error.message);
                console.error('Error testing tracking API:', error);
            });
        });
    }
});
</script>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi TinyMCE untuk about_content
        if ('{{ env('TINYMCE_API_KEY', '') }}' !== 'no-api-key') {
            tinymce.init({
                selector: '#about_content, #vision_content, #mission_content',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
                ],
                toolbar: 'undo redo | styles | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image media table emoticons | removeformat help',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 16px; line-height: 1.6; }',
                branding: false,
                promotion: false,
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            });
        } else {
            // Jika tidak ada API key, pastikan textarea terlihat baik
            ['about_content', 'vision_content', 'mission_content'].forEach(function(id) {
                const textarea = document.getElementById(id);
                if (textarea) {
                    textarea.style.minHeight = '300px';
                    textarea.style.padding = '10px';
                }
            });
        }
    });
</script>
@endpush
