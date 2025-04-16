@extends('layouts.admin')

@section('title', 'Manajemen Pengiriman')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengiriman</h1>
            <p class="mt-1 text-gray-600">Kelola semua data pengiriman dalam satu tempat</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center text-sm font-medium">
                <i class="fas fa-plus mr-2"></i>
                <span class="hidden xs:inline">Tambah</span> Pengiriman
            </button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center text-sm font-medium">
                <i class="fas fa-file-export mr-2"></i>
                Export
            </button>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-6 max-w-full">
        <div class="flex flex-col space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <div class="relative">
                        <input type="text" id="search" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm pl-10" placeholder="No. Resi, Pelanggan...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        <option value="pending">Disiapkan</option>
                        <option value="in_transit">Dalam Pengiriman</option>
                        <option value="delivered">Selesai</option>
                        <option value="delayed">Tertunda</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                
                <!-- Service Type Filter -->
                <div>
                    <label for="service" class="block text-sm font-medium text-gray-700 mb-1">Jenis Layanan</label>
                    <select id="service" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua Layanan</option>
                        <option value="land">Darat</option>
                        <option value="sea">Laut</option>
                        <option value="air">Udara</option>
                    </select>
                </div>
                
                <!-- Date Range Filter -->
                <div>
                    <label for="daterange" class="block text-sm font-medium text-gray-700 mb-1">Rentang Tanggal</label>
                    <input type="text" id="daterange" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="DD/MM/YYYY - DD/MM/YYYY">
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="button" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-200">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
            </div>
        </div>
    </div>
    
    <!-- Shipments Table Card -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-full">
        <div class="flex flex-col sm:flex-row justify-between items-center p-4 border-b border-gray-100">
            <div class="text-sm text-gray-500 mb-2 sm:mb-0">
                <span class="font-medium text-gray-700">253</span> pengiriman ditemukan
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Tampilkan</span>
                <select class="rounded border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>10</option>
                    <option>25</option>
                    <option selected>50</option>
                    <option>100</option>
                </select>
                <span class="text-sm text-gray-600">entri</span>
            </div>
        </div>
        
        <!-- Responsive Table -->
        <div class="table-responsive w-full">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                No. Resi
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            <div class="flex items-center">
                                Pelanggan
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                            <div class="flex items-center">
                                Rute
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                            <div class="flex items-center">
                                Layanan
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Status
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                            <div class="flex items-center">
                                Tanggal
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                            <div class="flex items-center">
                                Biaya
                                <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-indigo-600">ZDX123456</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-sm">
                                    MJ
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">PT Maju Jaya</div>
                                    <div class="text-xs text-gray-500">customer@majujaya.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-900">Jakarta - Surabaya</div>
                            <div class="text-xs text-gray-500">Jawa Timur</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-900">Darat</div>
                            <div class="text-xs text-gray-500">Reguler</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                Selesai
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                            <div class="text-sm text-gray-900">15 Mei 2024</div>
                            <div class="text-xs text-gray-500">09:24 WIB</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden lg:table-cell">
                            Rp 1.450.000
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900 hidden sm:block">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 hidden sm:block">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 sm:hidden">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-indigo-600">ZDX789012</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm">
                                    SA
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">CV Sukses Abadi</div>
                                    <div class="text-xs text-gray-500">info@suksesabadi.co.id</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-900">Bandung - Medan</div>
                            <div class="text-xs text-gray-500">Sumatera Utara</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-900">Udara</div>
                            <div class="text-xs text-gray-500">Express</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                Dalam Pengiriman
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                            <div class="text-sm text-gray-900">14 Mei 2024</div>
                            <div class="text-xs text-gray-500">14:38 WIB</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden lg:table-cell">
                            Rp 2.875.000
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900 hidden sm:block">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 hidden sm:block">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 sm:hidden">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-indigo-600">ZDX345678</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-sm">
                                    SM
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">PT Sejahtera Mandiri</div>
                                    <div class="text-xs text-gray-500">contact@sejahteramandiri.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-900">Surabaya - Makassar</div>
                            <div class="text-xs text-gray-500">Sulawesi Selatan</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-900">Laut</div>
                            <div class="text-xs text-gray-500">Ekonomi</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                Tertunda
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                            <div class="text-sm text-gray-900">13 Mei 2024</div>
                            <div class="text-xs text-gray-500">08:15 WIB</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden lg:table-cell">
                            Rp 3.250.000
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900 hidden sm:block">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 hidden sm:block">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 sm:hidden">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex items-center justify-between flex-wrap gap-y-4">
                <div>
                    <p class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">5</span> dari <span class="font-medium">253</span> hasil
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left text-xs"></i>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium hidden sm:inline-flex">
                            3
                        </a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hidden sm:inline-flex">
                            ...
                        </span>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium hidden md:inline-flex">
                            8
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium hidden md:inline-flex">
                            9
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            10
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Action Modal (untuk aksi tambahan di layar kecil) -->
    <div id="mobileActionModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-end justify-center">
        <div class="bg-white rounded-t-xl w-full max-w-md p-5 mx-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Tindakan Pengiriman</h3>
                <button id="closeActionModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-3">
                <button class="w-full text-left py-3 px-4 rounded-lg flex items-center text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-eye text-indigo-600 w-5"></i>
                    <span class="ml-3">Lihat Detail</span>
                </button>
                <button class="w-full text-left py-3 px-4 rounded-lg flex items-center text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-edit text-blue-600 w-5"></i>
                    <span class="ml-3">Edit Pengiriman</span>
                </button>
                <button class="w-full text-left py-3 px-4 rounded-lg flex items-center text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-truck text-green-600 w-5"></i>
                    <span class="ml-3">Update Status</span>
                </button>
                <button class="w-full text-left py-3 px-4 rounded-lg flex items-center text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-print text-gray-600 w-5"></i>
                    <span class="ml-3">Cetak Label</span>
                </button>
                <button class="w-full text-left py-3 px-4 rounded-lg flex items-center text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-trash text-red-600 w-5"></i>
                    <span class="ml-3">Hapus Pengiriman</span>
                </button>
            </div>
            <div class="mt-6">
                <button id="cancelActionModal" class="w-full bg-gray-100 text-gray-700 py-2.5 rounded-lg font-medium">
                    Batal
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Script untuk date range picker atau fitur lainnya bisa ditambahkan di sini
    
    // Mobile action menu
    document.addEventListener('DOMContentLoaded', function() {
        const mobileActionBtns = document.querySelectorAll('.fa-ellipsis-v');
        const mobileActionModal = document.getElementById('mobileActionModal');
        const closeActionModal = document.getElementById('closeActionModal');
        const cancelActionModal = document.getElementById('cancelActionModal');
        
        mobileActionBtns.forEach(btn => {
            btn.parentElement.addEventListener('click', function() {
                mobileActionModal.classList.remove('hidden');
                mobileActionModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            });
        });
        
        function hideModal() {
            mobileActionModal.classList.add('hidden');
            mobileActionModal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
        
        closeActionModal.addEventListener('click', hideModal);
        cancelActionModal.addEventListener('click', hideModal);
        
        // Close when clicking outside the modal content
        mobileActionModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideModal();
            }
        });
    });
</script>
@endpush 