@extends('layouts.admin')

@section('title', 'Informasi Perusahaan')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Informasi Perusahaan
    </h2>

    @include('admin.partials.alerts')

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
        <div class="w-full overflow-x-auto">
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <div class="text-sm text-gray-600 mb-4">
                    <p>Kelola informasi perusahaan seperti profil, visi & misi, logo, dan struktur organisasi.</p>
                </div>

                <!-- Tabs -->
                <div class="mb-6 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-purple-600 rounded-t-lg text-purple-600 active">Informasi Perusahaan</a>
                        </li>
                    </ul>
                </div>

                <!-- Content Section -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Section 1: Informasi Umum -->
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-info-circle mr-2 text-purple-600"></i>Informasi Umum
                        </h3>
                        <div class="space-y-4">
                            @foreach($contents as $content)
                                @if(in_array($content->section, ['about']))
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex justify-between items-center">
                                            <h4 class="font-medium text-gray-700">{{ $content->title }}</h4>
                                            <a href="{{ route('admin.profile-content.edit', $content->id) }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md hover:bg-purple-700 focus:outline-none focus:ring">
                                                Edit
                                            </a>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-600 truncate">{{ \Illuminate\Support\Str::limit(strip_tags($content->content), 100) }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Section 2: Visi & Misi -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-bullseye mr-2 text-blue-600"></i>Visi & Misi
                        </h3>
                        <div class="space-y-4">
                            @foreach($contents as $content)
                                @if(in_array($content->section, ['vision', 'mission']))
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <div class="flex justify-between items-center">
                                            <h4 class="font-medium text-gray-700">{{ $content->title }}</h4>
                                            <a href="{{ route('admin.profile-content.edit', $content->id) }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring">
                                                Edit
                                            </a>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-600 truncate">{{ \Illuminate\Support\Str::limit(strip_tags($content->content), 100) }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Section 3: Logo Perusahaan -->
                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-image mr-2 text-indigo-600"></i>Logo Perusahaan
                        </h3>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="grid grid-cols-3 gap-4">
                                <!-- Logo 1 -->
                                <div class="border rounded-lg p-2">
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
                                <div class="border rounded-lg p-2">
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
                                <div class="border rounded-lg p-2">
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
                    </div>

                    <!-- Section 4: Struktur Organisasi -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-sitemap mr-2 text-green-600"></i>Struktur Organisasi
                        </h3>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-medium text-gray-700">Struktur Organisasi</h4>
                                @php
                                    $aboutContent = $contents->where('section', 'about')->first();
                                @endphp
                                @if($aboutContent)
                                <a href="{{ route('admin.profile-content.edit', $aboutContent->id) }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring">
                                    Ubah Struktur
                                </a>
                                @endif
                            </div>
                            <div class="border rounded-lg p-2">
                                @php
                                    $aboutContent = $contents->where('section', 'about')->first();
                                    $structurePath = $aboutContent && $aboutContent->org_structure_path ? $aboutContent->org_structure_path : 'asset/struktur.jpg';
                                @endphp
                                <img src="{{ asset($structurePath) }}?v={{ time() }}" alt="Struktur Organisasi" class="w-full h-48 object-contain">
                            </div>
                            <div class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i> Untuk mengubah gambar struktur organisasi, silakan edit bagian "Tentang Kami".
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Gambar Logistik -->
                    <div class="bg-red-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-boxes mr-2 text-red-600"></i>Gambar Logistik
                        </h3>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Upload Logo -->
<div id="logoUploadModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Upload Logo</h3>
                <button type="button" class="close-modal text-gray-400 hover:text-gray-500 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <form id="logoUploadForm" action="/admin/logo/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="logo_number" id="logoNumber" value="1">
            
            <div class="px-6 py-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih File Logo
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-md px-6 py-10 text-center">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="logoFile" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                    <span>Upload file</span>
                                    <input id="logoFile" name="logo_file" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG, GIF sampai 2MB
                            </p>
                        </div>
                        <div id="previewContainer" class="mt-4 flex justify-center hidden">
                            <img id="logoPreview" src="#" alt="Preview" class="max-h-40 max-w-full">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3">
                <button type="button" class="close-modal px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk Upload Gambar Logistik -->
<div id="logisticsUploadModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Upload Gambar Logistik</h3>
                <button type="button" class="close-logistics-modal text-gray-400 hover:text-gray-500 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <form id="logisticsUploadForm" action="/admin/logistics/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-6 py-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Gambar Logistik
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-md px-6 py-10 text-center">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="logisticsFile" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none">
                                    <span>Upload file</span>
                                    <input id="logisticsFile" name="logistics_file" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG sampai 2MB
                            </p>
                        </div>
                        <div id="logisticsPreviewContainer" class="mt-4 flex justify-center hidden">
                            <img id="logisticsPreview" src="#" alt="Preview" class="max-h-40 max-w-full">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3">
                <button type="button" class="close-logistics-modal px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables
        const logoUploadModal = document.getElementById('logoUploadModal');
        const logisticsUploadModal = document.getElementById('logisticsUploadModal');
        
        // Show Logo Upload Modal
        document.querySelectorAll('.logo-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const logoNumber = this.getAttribute('data-logo');
                document.getElementById('logoNumber').value = logoNumber;
                logoUploadModal.classList.remove('hidden');
            });
        });
        
        // Show Logistics Upload Modal
        document.getElementById('changeLogisticsBtn')?.addEventListener('click', function() {
            logisticsUploadModal.classList.remove('hidden');
        });
        
        // Close Modals
        document.querySelectorAll('.close-modal').forEach(function(closeBtn) {
            closeBtn.addEventListener('click', function() {
                logoUploadModal.classList.add('hidden');
                if(logisticsUploadModal) logisticsUploadModal.classList.add('hidden');
            });
        });
        
        // Logo Preview Functionality
        const logoFile = document.getElementById('logoFile');
        const logoPreview = document.getElementById('logoPreview');
        const previewContainer = document.getElementById('previewContainer');
        
        logoFile.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush 