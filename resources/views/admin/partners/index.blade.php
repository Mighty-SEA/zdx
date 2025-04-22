@extends('layouts.admin')

@section('title', 'Pelanggan / Partner')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container mx-auto">
    <header class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pelanggan / Partner</h1>
                <p class="text-gray-600 mt-1">Kelola semua pelanggan dan partner bisnis ZDX Cargo.</p>
            </div>
            <div>
                <a href="{{ route('admin.partners.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>Tambah Baru
                </a>
            </div>
        </div>
    </header>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent" placeholder="Cari nama, perusahaan, atau email...">
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                <select id="typeFilter" class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent">
                    <option value="">Semua Tipe</option>
                    <option value="customer">Pelanggan</option>
                    <option value="partner">Partner</option>
                </select>
                <select id="statusFilter" class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Pesan Error -->
    @if (session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipe
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kontak
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tgl Bergabung
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($partners->count() > 0)
                        @foreach($partners as $partner)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($partner->logo_path)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $partner->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $partner->type == 'partner' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $partner->type == 'partner' ? 'Partner' : 'Pelanggan' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $partner->company ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $partner->industry ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $partner->email ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $partner->phone ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $partner->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $partner->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $partner->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="7" class="px-6 py-12 text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-search text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada data Pelanggan / Partner</p>
                                    <p class="text-sm mt-1">Tambahkan data Pelanggan / Partner baru untuk mulai mengelola</p>
                                    <a href="{{ route('admin.partners.create') }}" class="mt-4 btn-primary-sm">
                                        <i class="fas fa-plus mr-2"></i>Tambah Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            <!-- Pagination akan ditampilkan di sini -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk mengelola pencarian, filter, dan navigasi halaman
    document.addEventListener('DOMContentLoaded', function() {
        // Implementasi pencarian dan filter akan ditambahkan di sini
    });
</script>
@endpush 