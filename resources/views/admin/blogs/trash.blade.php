@extends('layouts.admin')

@section('title', 'Sampah Blog')

@section('content')
<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Sampah Blog</h2>
            <p class="text-gray-600 mt-1">Daftar blog yang sudah dihapus, bisa direstore kembali</p>
        </div>
        <div>
            <a href="{{ route('admin.blogs.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Blog
            </a>
        </div>
    </div>

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

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <div class="bg-gray-50">
                <div class="grid grid-cols-12 gap-2 px-5 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                    <div class="col-span-1">ID</div>
                    <div class="col-span-3">Judul</div>
                    <div class="col-span-2">Kategori</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-2">Dihapus Pada</div>
                    <div class="col-span-2 text-right">Aksi</div>
                </div>
            </div>
            <div class="bg-white divide-y divide-gray-200">
                @forelse($blogs as $blog)
                <div class="grid grid-cols-12 gap-2 px-5 py-4 hover:bg-gray-50">
                    <div class="col-span-1 text-sm text-gray-900">{{ $blog->id }}</div>
                    <div class="col-span-3 text-sm text-gray-900">
                        <p class="font-medium truncate">{{ $blog->title }}</p>
                        <p class="text-xs text-gray-500 mt-1">Slug: {{ $blog->slug }}</p>
                    </div>
                    <div class="col-span-2 text-sm text-gray-600">
                        {{ $blog->category ?? '-' }}
                    </div>
                    <div class="col-span-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            {{ $blog->status }}
                        </span>
                    </div>
                    <div class="col-span-2 text-sm text-gray-500">
                        {{ $blog->deleted_at->format('d M Y H:i') }}
                    </div>
                    <div class="col-span-2 text-right">
                        <form action="{{ route('admin.blogs.restore', $blog->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-900 bg-green-50 p-2 rounded" title="Restore">
                                <i class="fas fa-undo"></i> Restore
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="px-5 py-10 text-center">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-trash text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-600 mb-2">Tidak ada blog di sampah</p>
                        <a href="{{ route('admin.blogs.index') }}" class="mt-2 text-[#FF6000] hover:text-[#E65100]">
                            Kembali ke daftar blog
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="bg-white px-5 py-3 border-t border-gray-200">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection 