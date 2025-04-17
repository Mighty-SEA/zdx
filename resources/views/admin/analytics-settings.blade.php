@extends('layouts.admin')

@section('title', 'Pengaturan Analytics')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Pengaturan Google Analytics</h2>
                <p class="text-gray-600 mt-1">Konfigurasi integrasi Google Analytics untuk Dashboard</p>
            </div>
        </div>
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <x-analytics-alert />
        
        <div class="max-w-2xl">
            <form action="{{ route('admin.analytics-settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="property_id" class="block font-medium text-gray-700 mb-2">
                        Property ID Google Analytics
                    </label>
                    <input type="text" name="property_id" id="property_id" value="{{ $propertyId }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]"
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
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]">
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
                        <li>Buat project di <a href="https://console.cloud.google.com/" target="_blank" class="text-[#FF6000] hover:underline">Google Cloud Console</a></li>
                        <li>Aktifkan Google Analytics API</li>
                        <li>Buat Service Account dengan peran "Viewer" pada Google Analytics</li>
                        <li>Buat kunci baru untuk Service Account dan download file JSON</li>
                        <li>Upload file JSON tersebut di form ini</li>
                        <li>Masukkan Property ID dari akun Google Analytics Anda</li>
                    </ol>
                </div>
                
                <div>
                    <button type="submit" class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-3 px-6 rounded-lg font-semibold hover:shadow-md transition-all duration-300">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 