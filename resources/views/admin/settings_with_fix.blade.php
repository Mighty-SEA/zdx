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
                <!-- Isi konten sama seperti file asli -->
            </div>
        </div>
    </div>
</div>

<!-- Form Delete Media -->
<form id="deleteMediaForm" action="{{ route('admin.company-media.delete') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="media_type" id="deleteMediaType" value="">
</form>
@endsection

@push('scripts')
<script>
// Fungsi-fungsi untuk tab perusahaan sama seperti file asli

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
</script>
@endpush 