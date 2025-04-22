@extends('layouts.admin')

@section('title', 'Manajemen Tarif')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Tarif Pengiriman</h2>
                <p class="text-gray-600 mt-1">Kelola semua tarif pengiriman dari berbagai wilayah</p>
            </div>
            <div class="mt-4 md:mt-0 flex gap-2">
                <a href="{{ route('admin.rates.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Tarif Baru
                </a>
                <button type="button" id="openImportModalBtn" class="btn-secondary">
                    <i class="fas fa-file-import mr-2"></i> Import
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif
    
    @if(session('warning'))
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-yellow-500 mr-3 text-lg"></i>
            <p>{{ session('warning') }}</p>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <p class="font-bold flex items-center"><i class="fas fa-exclamation-circle mr-2"></i> Terjadi kesalahan:</p>
        <ul class="list-disc ml-6 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Import Modal -->
    <div id="importModal" class="fixed z-[9999] inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div id="modalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>
        
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
                <!-- Header -->
                <div class="px-6 pt-5 pb-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-t-xl border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3 mr-4">
                            <i class="fas fa-file-import text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800" id="modal-title">Import Data Tarif</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Upload file Excel atau CSV yang berisi data tarif pengiriman.
                                Format file harus sesuai dengan template yang disediakan.
                            </p>
                        </div>
                        <!-- Close button -->
                        <button type="button" class="closeModalBtn ml-auto text-gray-400 hover:text-gray-500 focus:outline-none transition-colors p-2 rounded-full hover:bg-gray-100">
                            <span class="sr-only">Tutup</span>
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Form -->
                <form action="{{ route('admin.rates.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    <div class="px-6 py-5">
                        <!-- Template download -->
                        <div class="mb-6 bg-blue-50 p-3 rounded-lg border border-blue-100 flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-download text-blue-500 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <a href="{{ route('admin.rates.download-template') }}" class="text-sm font-medium text-blue-700 hover:text-blue-800">
                                    Unduh Template Excel
                                </a>
                            </div>
                        </div>
                        
                        <!-- Duplicate Handling -->
                        <div class="mb-6 relative">
                            <div class="absolute left-0 w-1 h-full bg-yellow-400 rounded-full"></div>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 pl-5">
                                <label for="duplicate_handling" class="block text-base font-medium text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2 text-yellow-500"></i> 
                                    <span class="border-b-2 border-yellow-300 pb-0.5">Penanganan Data Duplikat</span>
                                </label>
                                <div class="bg-white rounded-md border border-yellow-100 p-2 mb-3">
                                    <select id="duplicate_handling" name="duplicate_handling" class="w-full rounded-md border-0 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 text-sm py-2">
                                        <option value="update">Update data yang sudah ada (harga, minimal, estimasi)</option>
                                        <option value="skip">Lewati data yang sudah ada (hanya tambah yang baru)</option>
                                        <option value="duplicate">Tambahkan semua (izinkan duplikat)</option>
                                    </select>
                                </div>
                                <div class="flex bg-white rounded-md border border-yellow-100 p-2">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <i class="fas fa-info-circle text-yellow-500 text-base"></i>
                                    </div>
                                    <div class="ml-2">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Catatan:</span> 
                                            Data dianggap duplikat jika sama:
                                        </p>
                                        <div class="mt-1 flex flex-wrap gap-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pulau
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Provinsi
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Kota/Kabupaten
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Kelurahan
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- File Upload -->
                        <div class="mb-2">
                            <label for="file-upload" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="fas fa-file-upload mr-2 text-indigo-500"></i> File Import
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer" id="dropzone">
                                <div class="space-y-1 text-center">
                                    <div class="flex justify-center">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                    </div>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Pilih file</span>
                                            <input id="file-upload" name="file" type="file" class="sr-only" accept=".xlsx,.xls,.csv">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">XLSX, XLS, atau CSV (Maks. 10MB)</p>
                                </div>
                            </div>
                            <div id="file-selected" class="mt-2 text-sm text-gray-500 hidden">
                                <div class="bg-indigo-50 p-2 rounded-lg border border-indigo-100 flex items-center">
                                    <i class="fas fa-file-excel text-indigo-500 mr-2"></i>
                                    <span id="file-name">Tidak ada file yang dipilih</span>
                                    <button type="button" id="remove-file" class="ml-auto text-gray-400 hover:text-red-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Actions -->
                    <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-xl border-t border-gray-100">
                        <button type="submit" id="submitImport" class="inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            <i class="fas fa-upload mr-2"></i> Import Data
                        </button>
                        <button type="button" class="closeModalBtn inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-gray-700 text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
                
                <!-- Loading Overlay -->
                <div id="loadingOverlay" class="hidden absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center rounded-xl z-50">
                    <div class="text-center">
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-3 border-r-1 border-indigo-600 mb-4"></div>
                        <p class="text-indigo-600 font-medium mb-2">Sedang Mengimport Data...</p>
                        <p class="text-xs text-gray-500">Mohon tunggu sebentar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            <!-- Search and filter controls -->
            <div class="flex flex-col md:flex-row gap-4 mb-6 items-end">
                <div class="w-full md:w-1/3">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search-input" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="Cari lokasi...">
                    </div>
                </div>
                <div class="w-full md:w-1/4">
                    <label for="filter_pulau" class="block text-sm font-medium text-gray-700 mb-1">Filter Pulau</label>
                    <select id="filter_pulau" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Semua Pulau</option>
                        @php
                            $pulauList = App\Models\Rate::select('pulau')->distinct()->pluck('pulau');
                        @endphp
                        @foreach($pulauList as $pulau)
                            <option value="{{ $pulau }}">{{ $pulau }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/4">
                    <label for="perPage" class="block text-sm font-medium text-gray-700 mb-1">Tampilkan</label>
                    <select id="perPage" name="per_page" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 data</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 data</option>
                    </select>
                </div>
                <div class="w-full md:w-auto ml-auto">
                    <button type="button" id="resetFilters" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-sync-alt mr-2"></i> Reset
                    </button>
                </div>
            </div>
            
            <!-- Bulk Actions -->
            <div class="flex flex-col md:flex-row gap-4 mb-6 items-center">
                <div id="bulkActionContainer" class="hidden w-full">
                    <div class="flex flex-wrap gap-2 items-center">
                        <span class="text-sm font-medium text-gray-700">Aksi Masal:</span>
                        <button type="button" id="bulkDeleteBtn" class="inline-flex items-center px-3 py-1.5 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i class="fas fa-trash-alt mr-1.5"></i> Hapus Data Terpilih
                        </button>
                        <span id="selectedCount" class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full">
                            0 item terpilih
                        </span>
                        <button type="button" id="clearSelection" class="text-xs text-gray-500 hover:text-gray-700 underline">
                            Batal pilih
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Bulk Delete Form -->
            <form id="bulkDeleteForm" action="{{ route('admin.rates.bulk-delete') }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_ids" id="selectedIdsInput">
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <input type="checkbox" id="selectAll" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded cursor-pointer">
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pulau</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota/Kabupaten</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelurahan/Kecamatan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan/Kg</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Minimal (Kg)</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estimasi</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rates as $rate)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-3 py-4 whitespace-nowrap text-center">
                                <input type="checkbox" class="select-item focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded cursor-pointer" data-id="{{ $rate->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rate->pulau }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rate->provinsi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rate->kota_kab }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rate->kelurahan_kecamatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($rate->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $rate->minimal_kg }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rate->estimasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.rates.edit', $rate->id) }}" class="btn-sm-info tooltip" data-tooltip="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.rates.destroy', $rate->id) }}" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm-danger tooltip" data-tooltip="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada data tarif yang ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($rates->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-gray-100 cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $rates->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Sebelumnya
                        </a>
                    @endif
                    
                    @if ($rates->hasMorePages())
                        <a href="{{ $rates->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Selanjutnya
                        </a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-gray-100 cursor-not-allowed">
                            Selanjutnya
                        </span>
                    @endif
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">{{ $rates->firstItem() ?: 0 }}</span> sampai <span class="font-medium">{{ $rates->lastItem() ?: 0 }}</span> dari <span class="font-medium">{{ $rates->total() }}</span> data
                        </p>
                    </div>
                    <div>
                        @if ($rates->hasPages())
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($rates->onFirstPage())
                                <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-300">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $rates->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($rates->getUrlRange(max(1, $rates->currentPage() - 2), min($rates->lastPage(), $rates->currentPage() + 2)) as $page => $url)
                                @if ($page == $rates->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-indigo-500 bg-indigo-50 text-sm font-medium text-indigo-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($rates->hasMorePages())
                                <a href="{{ $rates->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-300">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-primary {
        @apply inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wide transition hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 active:bg-indigo-700;
    }
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-wide transition hover:bg-gray-50 focus:outline-none focus:border-indigo-300 active:bg-gray-100;
    }
    .btn-sm-info {
        @apply inline-flex items-center justify-center p-2 bg-blue-100 text-blue-600 rounded transition hover:bg-blue-200;
    }
    .btn-sm-danger {
        @apply inline-flex items-center justify-center p-2 bg-red-100 text-red-600 rounded transition hover:bg-red-200;
    }
    .form-input {
        @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm;
    }
    .delete-form {
        display: inline;
    }
    
    /* Modal Fixes & Animations */
    #importModal {
        z-index: 9999 !important;
    }
    #modalOverlay {
        z-index: 9998 !important;
    }
    #modalContent {
        z-index: 10000 !important;
        transform: scale(0.95);
        opacity: 0;
        transition: transform 0.3s ease-out, opacity 0.2s ease-out;
    }
    #modalContent.scale-100 {
        transform: scale(1);
        opacity: 1;
    }
    
    /* Tooltip styles */
    .tooltip {
        position: relative;
    }
    .tooltip:before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 10px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s;
    }
    .tooltip:hover:before {
        opacity: 1;
        visibility: visible;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
jQuery(document).ready(function($) {
    // Filter and search form submission
    var filterForm = $('<form id="filterForm" method="GET"></form>').appendTo('body');
    
    function updateFilters() {
        var searchValue = $('#search-input').val();
        var pulauValue = $('#filter_pulau').val();
        var perPageValue = $('#perPage').val();
        
        // Clear the form first
        filterForm.empty();
        
        // Add the current values
        if (searchValue) {
            filterForm.append('<input type="hidden" name="search" value="' + searchValue + '">');
        }
        
        if (pulauValue) {
            filterForm.append('<input type="hidden" name="pulau" value="' + pulauValue + '">');
        }
        
        if (perPageValue) {
            filterForm.append('<input type="hidden" name="per_page" value="' + perPageValue + '">');
        }
        
        // Submit the form
        filterForm.submit();
    }
    
    // Setup event handlers for the filter controls
    $('#search-input').on('keyup', function(e) {
        if (e.keyCode === 13) { // Enter key
            updateFilters();
        }
    });
    
    $('#filter_pulau, #perPage').on('change', function() {
        updateFilters();
    });
    
    // Reset filters
    $('#resetFilters').on('click', function() {
        window.location.href = "{{ route('admin.rates') }}";
    });
    
    // Delete confirmation
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            this.submit();
        }
    });
    
    // Initialize filter values from URL params
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('search')) {
        $('#search-input').val(urlParams.get('search'));
    }
    if (urlParams.get('pulau')) {
        $('#filter_pulau').val(urlParams.get('pulau'));
    }
    
    // Bulk Actions
    const selectAll = document.getElementById('selectAll');
    const selectItems = document.querySelectorAll('.select-item');
    const bulkActionContainer = document.getElementById('bulkActionContainer');
    const selectedCount = document.getElementById('selectedCount');
    const clearSelection = document.getElementById('clearSelection');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');
    const selectedIdsInput = document.getElementById('selectedIdsInput');
    
    // Handle select all checkbox
    selectAll.addEventListener('change', function() {
        const isChecked = this.checked;
        
        selectItems.forEach(item => {
            item.checked = isChecked;
        });
        
        updateBulkActionVisibility();
    });
    
    // Handle individual checkbox changes
    selectItems.forEach(item => {
        item.addEventListener('change', function() {
            updateSelectAllCheckbox();
            updateBulkActionVisibility();
        });
    });
    
    // Update the "Select All" checkbox based on individual selections
    function updateSelectAllCheckbox() {
        const checkedItems = document.querySelectorAll('.select-item:checked');
        selectAll.checked = checkedItems.length === selectItems.length && selectItems.length > 0;
    }
    
    // Show/hide bulk action options and update count
    function updateBulkActionVisibility() {
        const checkedItems = document.querySelectorAll('.select-item:checked');
        
        if (checkedItems.length > 0) {
            bulkActionContainer.classList.remove('hidden');
            selectedCount.textContent = checkedItems.length + ' item terpilih';
        } else {
            bulkActionContainer.classList.add('hidden');
        }
    }
    
    // Clear selection
    clearSelection.addEventListener('click', function() {
        selectAll.checked = false;
        selectItems.forEach(item => {
            item.checked = false;
        });
        bulkActionContainer.classList.add('hidden');
    });
    
    // Bulk Delete action
    bulkDeleteBtn.addEventListener('click', function() {
        const checkedItems = document.querySelectorAll('.select-item:checked');
        
        if (checkedItems.length === 0) {
            alert('Silakan pilih minimal satu data untuk dihapus');
            return;
        }
        
        const selectedIds = Array.from(checkedItems).map(item => item.dataset.id);
        
        if (confirm(`Apakah Anda yakin ingin menghapus ${checkedItems.length} data yang dipilih? Tindakan ini tidak dapat dibatalkan.`)) {
            selectedIdsInput.value = JSON.stringify(selectedIds);
            bulkDeleteForm.submit();
        }
    });

    // Modal functionality - Enhanced with animations
    const modal = document.getElementById('importModal');
    const modalContent = document.getElementById('modalContent');
    const overlay = document.getElementById('modalOverlay');
    const openBtn = document.getElementById('openImportModalBtn');
    const closeBtns = document.querySelectorAll('.closeModalBtn');
    const importForm = document.getElementById('importForm');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const fileUpload = document.getElementById('file-upload');
    const dropzone = document.getElementById('dropzone');
    const fileSelected = document.getElementById('file-selected');
    const fileName = document.getElementById('file-name');
    const removeFile = document.getElementById('remove-file');
    const submitBtn = document.getElementById('submitImport');
    
    // Open modal with animation - PERBAIKAN DISINI
    openBtn.addEventListener('click', function() {
        // Tampilkan modal dahulu
        modal.style.display = 'block';
        
        // Hapus kelas hidden setelah modal ditampilkan
        setTimeout(() => {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            // Terapkan animasi pada konten modal
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    });
    
    // Close modal with animation - PERBAIKAN DISINI
    function closeModal() {
        // Animasi untuk menghilangkan content modal
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        // Hilangkan modal setelah animasi selesai
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.style.display = '';
            document.body.classList.remove('overflow-hidden');
        }, 200);
    }
    
    // Close modal with close buttons
    closeBtns.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });
    
    // Close modal when clicking overlay
    overlay.addEventListener('click', closeModal);
    
    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
    
    // File upload handling
    fileUpload.addEventListener('change', function(e) {
        updateFileInfo(this.files);
    });
    
    // Remove selected file
    removeFile.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        fileUpload.value = '';
        fileSelected.classList.add('hidden');
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    });
    
    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropzone.classList.add('bg-indigo-50', 'border-indigo-300');
        dropzone.classList.remove('bg-gray-50', 'border-gray-300');
    }
    
    function unhighlight() {
        dropzone.classList.remove('bg-indigo-50', 'border-indigo-300');
        dropzone.classList.add('bg-gray-50', 'border-gray-300');
    }
    
    dropzone.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileUpload.files = files;
        updateFileInfo(files);
    }
    
    function updateFileInfo(files) {
        if (files.length > 0) {
            const file = files[0];
            
            // Check file type
            const validTypes = ['.xlsx', '.xls', '.csv', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'text/csv'];
            const fileType = file.type;
            const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
            
            if (!validTypes.includes(fileType) && !validTypes.includes(fileExtension)) {
                alert('Format file tidak valid. Silakan upload file Excel (.xlsx, .xls) atau CSV (.csv)');
                fileUpload.value = '';
                return;
            }
            
            // Check file size (max 10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 10MB.');
                fileUpload.value = '';
                return;
            }
            
            fileName.textContent = file.name;
            fileSelected.classList.remove('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            fileSelected.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
    
    // Form submission with validation
    importForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const fileInput = document.getElementById('file-upload');
        if (fileInput && fileInput.files.length > 0) {
            loadingOverlay.classList.remove('hidden');
            this.submit();
        } else {
            alert('Silakan pilih file terlebih dahulu.');
        }
    });
});
</script>
@endpush 