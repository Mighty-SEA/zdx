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
        <div id="modalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full">
                <!-- Close button -->
                <div class="absolute top-0 right-0 pt-3 pr-3 z-10">
                    <button type="button" class="closeModalBtn text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Tutup</span>
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Form -->
                <form action="{{ route('admin.rates.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    <div class="px-4 pt-5 pb-4 sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-file-import text-indigo-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Import Data Tarif
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Upload file Excel atau CSV yang berisi data tarif pengiriman. Format file harus sesuai dengan template yang disediakan.
                                    </p>
                                    <div class="mt-3 flex items-center">
                                        <a href="{{ route('admin.rates.download-template') }}" class="flex items-center text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                            <i class="fas fa-download mr-2"></i> Unduh Template Excel
                                        </a>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-xs text-gray-500">
                                            <span class="font-semibold">Petunjuk Import:</span>
                                            <ol class="list-decimal list-inside pl-2 mt-1">
                                                <li>Unduh template Excel</li>
                                                <li>Isi data sesuai format (jangan mengganti header kolom)</li>
                                                <li>Simpan file dan upload disini</li>
                                            </ol>
                                        </p>
                                    </div>
                                    <div class="mt-4">
                                        <label for="duplicate_handling" class="block text-sm font-medium text-gray-700 mb-1">Penanganan Data Duplikat</label>
                                        <select id="duplicate_handling" name="duplicate_handling" class="w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                                            <option value="update">Update data yang sudah ada (harga, minimal, estimasi)</option>
                                            <option value="skip">Lewati data yang sudah ada (hanya tambah yang baru)</option>
                                            <option value="duplicate">Tambahkan semua (izinkan duplikat)</option>
                                        </select>
                                        <p class="mt-1 text-xs text-gray-500">Data dianggap duplikat jika Pulau, Provinsi, Kota/Kabupaten dan Kelurahan sama</p>
                                    </div>
                                    <div class="mt-4">
                                        <label for="file-upload" class="block text-sm font-medium text-gray-700 mb-1">File Import</label>
                                        <input id="file-upload" type="file" name="file" accept=".xlsx,.xls,.csv" class="w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                            border border-gray-300 rounded-md" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: XLSX, XLS, atau CSV</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" id="submitImport" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <i class="fas fa-upload mr-2"></i> Import
                        </button>
                        <button type="button" class="closeModalBtn mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
                
                <!-- Loading Overlay -->
                <div id="loadingOverlay" class="hidden absolute inset-0 bg-white bg-opacity-80 flex items-center justify-center rounded-lg z-50">
                    <div class="text-center">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-600 mb-2"></div>
                        <p class="text-indigo-600 font-medium">Mengimport data...</p>
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

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
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
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
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
    
    /* Modal Fixes */
    #importModal.fixed {
        z-index: 9999 !important;
    }
    #modalOverlay.fixed {
        z-index: 9998 !important;
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

    // Modal functionality
    const modal = document.getElementById('importModal');
    const overlay = document.getElementById('modalOverlay');
    const openBtn = document.getElementById('openImportModalBtn');
    const closeBtns = document.querySelectorAll('.closeModalBtn');
    const importForm = document.getElementById('importForm');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
    // Open modal
    openBtn.addEventListener('click', function() {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
    
    // Close modal with close buttons
    closeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });
    
    // Close modal when clicking overlay
    overlay.addEventListener('click', function() {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
    
    // Form submission
    importForm.addEventListener('submit', function(event) {
        const fileInput = document.getElementById('file-upload');
        if (fileInput && fileInput.files.length > 0) {
            loadingOverlay.classList.remove('hidden');
            // Form will submit normally
        } else {
            event.preventDefault();
            alert('Silakan pilih file terlebih dahulu.');
        }
    });
});
</script>
@endpush 