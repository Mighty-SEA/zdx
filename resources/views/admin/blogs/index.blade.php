@extends('layouts.admin')

@section('title', 'Kelola Blog')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Blog</h2>
                <p class="text-gray-600 mt-1">Kelola semua artikel blog yang ditampilkan di website Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.blogs.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Blog
                </a>
                <a href="{{ route('admin.blogs.trash') }}" class="btn-secondary ml-2">
                    <i class="fas fa-trash mr-2"></i> Sampah
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Status -->
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow-sm p-5 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/3">
                <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter Status</label>
                <select id="statusFilter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all">Semua Status</option>
                    <option value="published">Dipublikasikan</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <div class="w-full md:w-1/3">
                <label for="categoryFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter Kategori</label>
                <select id="categoryFilter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all">Semua Kategori</option>
                    @php
                        $categories = $blogs->pluck('category')->unique()->filter()->sort();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/3">
                <label for="searchBlog" class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                <div class="relative">
                    <input type="text" id="searchBlog" placeholder="Cari judul atau slug..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog List -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <div class="bg-gray-50">
                <div class="grid grid-cols-12 gap-2 px-5 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                    <div class="col-span-1">ID</div>
                    <div class="col-span-1">Gambar</div>
                    <div class="col-span-3">Judul</div>
                    <div class="col-span-2">Kategori</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-2">Tanggal Publikasi</div>
                    <div class="col-span-2 text-right">Aksi</div>
                </div>
            </div>
            <div class="bg-white divide-y divide-gray-200" id="blogList">
                @if(count($blogs) > 0)
                    @foreach($blogs as $blog)
                    <div class="grid grid-cols-12 gap-2 px-5 py-4 hover:bg-gray-50 blog-row" 
                         data-status="{{ $blog->status }}" 
                         data-category="{{ $blog->category ?? 'uncategorized' }}" 
                         data-title="{{ strtolower($blog->title) }}" 
                         data-slug="{{ strtolower($blog->slug) }}">
                        <div class="col-span-1 text-sm text-gray-900">{{ $blog->id }}</div>
                        <div class="col-span-1">
                            @if($blog->image)
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="h-10 w-14 object-cover rounded">
                            @else
                            <div class="h-10 w-14 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-400"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-span-3 text-sm text-gray-900">
                            <p class="font-medium truncate">{{ $blog->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">Slug: {{ $blog->slug }}</p>
                        </div>
                        <div class="col-span-2 text-sm text-gray-600">
                            @if($blog->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $blog->category }}
                            </span>
                            @else
                            <span class="text-gray-400">Tanpa Kategori</span>
                            @endif
                        </div>
                        <div class="col-span-1">
                            @if($blog->status == 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Dipublikasi
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Draft
                            </span>
                            @endif
                        </div>
                        <div class="col-span-2 text-sm text-gray-500">
                            {{ $blog->published_at ? $blog->published_at->format('d M Y H:i') : '-' }}
                        </div>
                        <div class="col-span-2 text-right flex justify-end items-center space-x-2">
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-2 rounded tooltip" data-tooltip="Edit Blog">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($blog->status == 'published')
                            <a href="/{{ $blog->slug }}" target="_blank" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded tooltip" data-tooltip="Lihat Blog">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endif
                            <button type="button" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded tooltip delete-blog" data-tooltip="Hapus Blog" data-id="{{ $blog->id }}" data-title="{{ $blog->title }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $blog->id }}" action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="px-5 py-10 text-center" id="emptyBlogMessage">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600 mb-2">Belum ada blog yang ditambahkan</p>
                            <a href="{{ route('admin.blogs.create') }}" class="mt-2 text-[#FF6000] hover:text-[#E65100]">
                                Tambah blog sekarang
                            </a>
                        </div>
                    </div>
                    <div class="hidden px-5 py-10 text-center" id="noSearchResults">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600 mb-2">Tidak ada blog yang sesuai dengan filter</p>
                            <button type="button" id="resetFilter" class="mt-2 text-[#FF6000] hover:text-[#E65100]">
                                Reset filter
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-5 py-3 border-t border-gray-200">
            {{ $blogs->links() }}
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 hidden z-50">
    <div class="fixed inset-0 bg-black bg-opacity-50" id="deleteModalBackdrop"></div>
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 z-50">
            <div class="p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus Blog</h3>
                        <p class="mt-2 text-sm text-gray-500">Apakah Anda yakin ingin menghapus blog "<span id="deleteBlogTitle" class="font-medium"></span>"? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" id="cancelDeleteBlogBtn" class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBlogBtn" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                    Ya, Hapus Blog
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.tooltip {
    position: relative;
}
.tooltip:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 10;
}
</style>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const statusFilter = document.getElementById('statusFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchBlog');
    const blogRows = document.querySelectorAll('.blog-row');
    const emptyMessage = document.getElementById('emptyBlogMessage');
    const noResultsMessage = document.getElementById('noSearchResults');
    
    function applyFilters() {
        const status = statusFilter.value;
        const category = categoryFilter.value;
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        let visibleCount = 0;
        
        blogRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const rowCategory = row.getAttribute('data-category');
            const rowTitle = row.getAttribute('data-title');
            const rowSlug = row.getAttribute('data-slug');
            
            const statusMatch = status === 'all' || status === rowStatus;
            const categoryMatch = category === 'all' || category === rowCategory;
            const searchMatch = searchTerm === '' || 
                               rowTitle.includes(searchTerm) || 
                               rowSlug.includes(searchTerm);
            
            if (statusMatch && categoryMatch && searchMatch) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });
        
        // Show/hide empty message
        if (blogRows.length > 0) {
            emptyMessage.classList.add('hidden');
            
            if (visibleCount === 0) {
                noResultsMessage.classList.remove('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
            }
        }
    }
    
    // Add event listeners to filters
    statusFilter.addEventListener('change', applyFilters);
    categoryFilter.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);
    
    // Reset filter button
    if (document.getElementById('resetFilter')) {
        document.getElementById('resetFilter').addEventListener('click', function() {
            statusFilter.value = 'all';
            categoryFilter.value = 'all';
            searchInput.value = '';
            applyFilters();
        });
    }
    
    // Delete blog confirmation
    const deleteButtons = document.querySelectorAll('.delete-blog');
    const deleteModal = document.getElementById('deleteModal');
    const deleteBlogTitle = document.getElementById('deleteBlogTitle');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBlogBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBlogBtn');
    const deleteModalBackdrop = document.getElementById('deleteModalBackdrop');
    
    let currentDeleteForm;
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const blogId = this.getAttribute('data-id');
            const blogTitle = this.getAttribute('data-title');
            
            deleteBlogTitle.textContent = blogTitle;
            currentDeleteForm = document.getElementById(`delete-form-${blogId}`);
            
            deleteModal.classList.remove('hidden');
        });
    });
    
    function hideDeleteModal() {
        deleteModal.classList.add('hidden');
    }
    
    cancelDeleteBtn.addEventListener('click', hideDeleteModal);
    deleteModalBackdrop.addEventListener('click', hideDeleteModal);
    
    confirmDeleteBtn.addEventListener('click', function() {
        if (currentDeleteForm) {
            currentDeleteForm.submit();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
            hideDeleteModal();
        }
    });
});
</script>
@endpush 