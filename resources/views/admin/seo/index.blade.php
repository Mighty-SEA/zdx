@extends('layouts.admin')

@section('title', 'Pengaturan SEO')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan SEO Halaman</h2>
            <p class="text-gray-600 mt-1">Kelola metadata SEO untuk setiap halaman website ZDX Express.</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.seo.robots') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-robot mr-2"></i> Edit Robots.txt
            </a>
            <a href="{{ route('admin.seo.sitemap') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-sitemap mr-2"></i> Kelola Sitemap
            </a>
            <a href="{{ route('admin.seo.sync-services') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-sync-alt mr-2"></i> Sinkronkan Layanan
            </a>
            <button id="initializeDefaultBtn" type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-sync-alt mr-2"></i> Inisialisasi Default
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- SEO Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 rounded-lg p-5 shadow-sm border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 font-medium text-sm">Total Halaman</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $pageSettings->count() }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-green-50 rounded-lg p-5 shadow-sm border border-green-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-600 font-medium text-sm">Halaman Optimal</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $pageSettings->filter(function($page) { return $page->title && $page->description; })->count() }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-yellow-50 rounded-lg p-5 shadow-sm border border-yellow-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-600 font-medium text-sm">Perlu Perhatian</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $pageSettings->filter(function($page) { return !$page->title || !$page->description; })->count() }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-purple-50 rounded-lg p-5 shadow-sm border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-600 font-medium text-sm">Custom Schema</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $pageSettings->filter(function($page) { return $page->custom_schema; })->count() }}</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-code text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="mb-6 flex flex-col sm:flex-row gap-4">
        <div class="relative flex-grow">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" id="searchInput" placeholder="Cari halaman..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <select id="filterStatus" class="w-full sm:w-auto px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="all">Semua Status</option>
                <option value="complete">Lengkap</option>
                <option value="incomplete">Belum Lengkap</option>
            </select>
        </div>
    </div>

    <!-- Table with hover effects and better readability -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full bg-white table-hover">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold border-b">Halaman</th>
                    <th class="py-3 px-4 text-left font-semibold border-b">Identifier</th>
                    <th class="py-3 px-4 text-left font-semibold border-b">Judul</th>
                    <th class="py-3 px-4 text-left font-semibold border-b">Status</th>
                    <th class="py-3 px-4 text-center font-semibold border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200" id="pageList">
                @forelse($pageSettings as $page)
                <tr class="hover:bg-gray-50 transition-colors" data-status="{{ ($page->title && $page->description) ? 'complete' : 'incomplete' }}" data-name="{{ strtolower($page->page_name) }}" data-identifier="{{ strtolower($page->page_identifier) }}">
                    <td class="py-3 px-4">
                        <div class="font-medium text-gray-800">{{ $page->page_name }}</div>
                    </td>
                    <td class="py-3 px-4">
                        <span class="text-sm font-mono bg-gray-100 px-2 py-1 rounded">{{ $page->page_identifier }}</span>
                    </td>
                    <td class="py-3 px-4 max-w-xs truncate">{{ $page->title ?? 'Belum diatur' }}</td>
                    <td class="py-3 px-4">
                        @if($page->title && $page->description)
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">Lengkap</span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full font-medium">Belum Lengkap</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        <a href="{{ route('admin.seo.edit', $page->id) }}" class="inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                        Belum ada pengaturan SEO. Klik tombol "Inisialisasi Pengaturan Default" untuk menambahkan data awal.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi (Fixed) -->
<div id="confirmModalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-40 hidden"></div>
<div id="confirmModalContent" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">Konfirmasi Inisialisasi</h3>
                    <p class="mt-2 text-sm text-gray-500">Perhatian! Tindakan ini akan menginisialisasi ulang pengaturan SEO default. Data yang sudah ada mungkin akan diubah. Apakah Anda yakin ingin melanjutkan?</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3 rounded-b-lg">
            <button type="button" id="confirmNoBtn" class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Batal
            </button>
            <button type="button" id="confirmYesBtn" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const pageList = document.getElementById('pageList').querySelectorAll('tr');
    
    // Search and Filter function
    function filterPages() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;
        
        pageList.forEach(row => {
            const name = row.getAttribute('data-name');
            const identifier = row.getAttribute('data-identifier');
            const status = row.getAttribute('data-status');
            
            const matchesSearch = name.includes(searchTerm) || identifier.includes(searchTerm);
            const matchesStatus = statusFilter === 'all' || status === statusFilter;
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Event listeners for search and filter
    searchInput.addEventListener('input', filterPages);
    filterStatus.addEventListener('change', filterPages);

    // Modal elements
    const modalBackdrop = document.getElementById('confirmModalBackdrop');
    const modalContent = document.getElementById('confirmModalContent');
    const confirmYesBtn = document.getElementById('confirmYesBtn');
    const confirmNoBtn = document.getElementById('confirmNoBtn');
    const initializeDefaultBtn = document.getElementById('initializeDefaultBtn');

    // Show modal function
    function showModal() {
        modalBackdrop.classList.remove('hidden');
        modalContent.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    // Hide modal function
    function hideModal() {
        modalBackdrop.classList.add('hidden');
        modalContent.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Initialize button click handler
    if (initializeDefaultBtn) {
        initializeDefaultBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showModal();
        });
    }

    // Yes button handler
    if (confirmYesBtn) {
        confirmYesBtn.addEventListener('click', function() {
            hideModal();
            window.location.href = "{{ route('admin.seo.initialize') }}";
        });
    }

    // No button handler
    if (confirmNoBtn) {
        confirmNoBtn.addEventListener('click', function() {
            hideModal();
        });
    }

    // Click outside to close
    modalBackdrop.addEventListener('click', function() {
        hideModal();
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modalContent.classList.contains('hidden')) {
            hideModal();
        }
    });
});
</script>
@endpush 