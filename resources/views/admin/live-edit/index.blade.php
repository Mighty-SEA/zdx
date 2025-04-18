@extends('layouts.admin')

@section('title', 'Live Edit Manager')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-200 px-6 py-4">
            <h1 class="text-2xl font-semibold text-gray-800">Live Edit Manager</h1>
            <p class="text-gray-600 mt-1">Kelola dan aktifkan mode edit pada halaman website</p>
        </div>
        
        <div class="px-6 py-4">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            Mode Live Edit memungkinkan Anda mengedit konten halaman secara langsung dari halaman depan website. Klik tombol di bawah ini untuk mengaktifkan mode edit, lalu kunjungi halaman yang ingin diedit.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex space-x-4 mb-6">
                <button id="enableEditModeBtn" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-edit mr-2"></i> Aktifkan Mode Edit
                </button>
                <button id="disableEditModeBtn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-times mr-2"></i> Nonaktifkan Mode Edit
                </button>
            </div>
            
            <h2 class="text-lg font-medium text-gray-800 mb-4">Halaman yang Dapat Diedit</h2>
            
            <div class="bg-gray-50 border border-gray-200 rounded-md overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <li>
                        <a href="/" class="block hover:bg-gray-100 px-4 py-3 flex items-center justify-between" target="_blank">
                            <div class="flex items-center">
                                <i class="fas fa-home text-gray-500 mr-3"></i>
                                <span class="text-gray-800">Halaman Beranda</span>
                            </div>
                            <span class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/layanan" class="block hover:bg-gray-100 px-4 py-3 flex items-center justify-between" target="_blank">
                            <div class="flex items-center">
                                <i class="fas fa-box text-gray-500 mr-3"></i>
                                <span class="text-gray-800">Halaman Layanan</span>
                            </div>
                            <span class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile" class="block hover:bg-gray-100 px-4 py-3 flex items-center justify-between" target="_blank">
                            <div class="flex items-center">
                                <i class="fas fa-building text-gray-500 mr-3"></i>
                                <span class="text-gray-800">Halaman Profil</span>
                            </div>
                            <span class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/kontak" class="block hover:bg-gray-100 px-4 py-3 flex items-center justify-between" target="_blank">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-500 mr-3"></i>
                                <span class="text-gray-800">Halaman Kontak</span>
                            </div>
                            <span class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const enableEditModeBtn = document.getElementById('enableEditModeBtn');
        const disableEditModeBtn = document.getElementById('disableEditModeBtn');
        
        // Check if edit mode is enabled
        const editModeEnabled = localStorage.getItem('liveEditMode') === 'enabled';
        if (editModeEnabled) {
            enableEditModeBtn.classList.add('bg-gray-400');
            enableEditModeBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
            disableEditModeBtn.classList.add('bg-red-600');
        } else {
            disableEditModeBtn.classList.add('bg-gray-400');
            disableEditModeBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            enableEditModeBtn.classList.add('bg-green-600');
        }
        
        enableEditModeBtn.addEventListener('click', function() {
            console.log('Aktifkan Mode Edit diklik');
            // Langsung atur localStorage tanpa perlu API call
            localStorage.setItem('liveEditMode', 'enabled');
            enableEditModeBtn.classList.add('bg-gray-400');
            enableEditModeBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
            disableEditModeBtn.classList.remove('bg-gray-400');
            disableEditModeBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            alert('Mode edit telah diaktifkan. Kunjungi halaman yang ingin diedit.');
        });
        
        disableEditModeBtn.addEventListener('click', function() {
            console.log('Nonaktifkan Mode Edit diklik');
            // Langsung hapus localStorage tanpa perlu API call
            localStorage.removeItem('liveEditMode');
            disableEditModeBtn.classList.add('bg-gray-400');
            disableEditModeBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            enableEditModeBtn.classList.remove('bg-gray-400');
            enableEditModeBtn.classList.add('bg-green-600', 'hover:bg-green-700');
            alert('Mode edit telah dinonaktifkan.');
        });
    });
</script>
@endpush 