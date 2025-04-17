@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Layanan</h2>
                <p class="text-gray-600 mt-1">Kelola semua layanan yang ditampilkan di website Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.services.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Layanan
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

    <!-- Service List -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <div class="bg-gray-50">
                <div class="grid grid-cols-12 gap-2 px-5 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                    <div class="col-span-1">ID</div>
                    <div class="col-span-1">Gambar</div>
                    <div class="col-span-3">Judul</div>
                    <div class="col-span-3">Deskripsi</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-1">Dibuat Pada</div>
                    <div class="col-span-2 text-right">Aksi</div>
                </div>
            </div>
            <div class="bg-white divide-y divide-gray-200">
                @if($services->count() > 0)
                    @foreach($services as $service)
                    <div class="grid grid-cols-12 gap-2 px-5 py-4 hover:bg-gray-50">
                        <div class="col-span-1 text-sm text-gray-900">{{ $service->id }}</div>
                        <div class="col-span-1">
                            @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="h-10 w-14 object-cover rounded">
                            @else
                            <div class="h-10 w-14 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-span-3 text-sm text-gray-900">
                            <p class="font-medium truncate">{{ $service->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">Slug: {{ $service->slug }}</p>
                        </div>
                        <div class="col-span-3 text-sm text-gray-600 truncate">{{ $service->description }}</div>
                        <div class="col-span-1">
                            @if($service->status == 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Dipublikasi
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Draft
                            </span>
                            @endif
                        </div>
                        <div class="col-span-1 text-sm text-gray-500">
                            {{ $service->created_at->format('d M Y') }}
                        </div>
                        <div class="col-span-2 text-right flex justify-end items-center space-x-2">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-2 rounded">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="px-5 py-10 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600 mb-2">Belum ada layanan yang ditambahkan</p>
                            <a href="{{ route('admin.services.create') }}" class="mt-2 text-[#FF6000] hover:text-[#E65100]">
                                Tambah layanan sekarang
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-5 py-3 border-t border-gray-200">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection 