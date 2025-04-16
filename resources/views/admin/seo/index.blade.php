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
            <a href="{{ route('admin.seo.initialize') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-sync-alt mr-2"></i> Inisialisasi Default
            </a>
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
    
    // Event listeners
    searchInput.addEventListener('input', filterPages);
    filterStatus.addEventListener('change', filterPages);
});
</script>
@endpush 