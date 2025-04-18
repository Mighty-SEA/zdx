@extends('layouts.admin')

@section('title', 'Manajemen Komoditas')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Manajemen Komoditas</h1>
            <a href="{{ route('admin.commodity.create') }}" class="px-4 py-2 bg-[#FF6000] hover:bg-[#E65100] text-white rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Komoditas
            </a>
        </div>
        <p class="mt-2 text-sm text-gray-600">
            Kelola jenis komoditas yang ditampilkan di halaman komoditas website
        </p>
    </div>

    <!-- Alert Status -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <span class="font-medium"><i class="fas fa-check-circle mr-2"></i></span> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium"><i class="fas fa-exclamation-circle mr-2"></i></span> {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            @if($commodities->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-8">
                    <div class="mb-4">
                        <i class="fas fa-box-open text-gray-300 text-6xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum ada data komoditas</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">
                        Tambahkan komoditas baru untuk ditampilkan di halaman komoditas website
                    </p>
                    <a href="{{ route('admin.commodity.create') }}" class="px-4 py-2 bg-[#FF6000] hover:bg-[#E65100] text-white rounded-lg inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Komoditas
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Komoditas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($commodities as $commodity)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-16 h-16 rounded-md overflow-hidden bg-gray-100">
                                            <img src="{{ $commodity->image_url }}" alt="{{ $commodity->name }}" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $commodity->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 line-clamp-2">{{ $commodity->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.commodity.edit', $commodity->id) }}" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.commodity.destroy', $commodity->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 delete-confirm" data-name="{{ $commodity->name }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Konfirmasi Hapus
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-confirm');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const name = this.getAttribute('data-name');
                    
                    if (confirm(`Apakah Anda yakin ingin menghapus komoditas "${name}"?`)) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
    @endpush
@endsection 