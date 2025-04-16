@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Profil Admin</h2>
            <p class="text-gray-600 mt-1">Kelola informasi profil dan akun Anda</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button type="submit" form="profileForm" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </div>

    <div class="p-6">
        <!-- Profile Information Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Profile Picture and Basic Info -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <div class="w-32 h-32 bg-indigo-600 rounded-full flex items-center justify-center text-white text-4xl font-bold overflow-hidden">
                                <span>A</span>
                                <!-- Profile picture would go here -->
                                <!-- <img src="profile-pic.jpg" alt="Profile Picture" class="w-full h-full object-cover"> -->
                            </div>
                            <div class="absolute bottom-0 right-0">
                                <label for="photoUpload" class="bg-white border border-gray-300 rounded-full w-8 h-8 flex items-center justify-center cursor-pointer shadow-sm hover:bg-gray-50">
                                    <i class="fas fa-camera text-gray-600"></i>
                                    <input type="file" id="photoUpload" class="hidden">
                                </label>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800">Admin User</h3>
                        <p class="text-gray-600 text-sm">Administrator</p>
                        <div class="mt-2 text-gray-500 text-sm">
                            Anggota sejak: 1 Januari 2024
                        </div>
                    </div>
                    
                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Status Akun</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Hak Akses</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800">Administrator</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Login Terakhir</span>
                            <span class="text-sm text-gray-600">Hari ini, 09:45</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Forms -->
            <div class="lg:col-span-2">
                <!-- Profile Form -->
                <form id="profileForm" class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pribadi</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="Admin User" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nama Lengkap">
                        </div>
                        
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" id="username" name="username" value="admin" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Username">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="admin@zdxcargo.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Email">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="+62 812 3456 7890" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Tuliskan bio singkat Anda">Administrator ZDX Cargo - mengelola semua operasi website cargo dan pengiriman.</textarea>
                    </div>
                </form>
                
                <!-- Change Password -->
                <form class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ubah Password</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('current_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="new_password" name="new_password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('new_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="confirm_password" name="confirm_password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('confirm_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                            <i class="fas fa-key mr-2"></i> Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Activity Log -->
        <div class="mt-6">
            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Aktivitas</h3>
                    <div class="text-sm text-gray-500">
                        <span class="mr-2">Filter:</span>
                        <select class="bg-white border border-gray-300 rounded-md py-1 px-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Semua Aktivitas</option>
                            <option>Login</option>
                            <option>Perubahan Data</option>
                            <option>Perubahan Password</option>
                        </select>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Waktu
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aktivitas
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    IP Address
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Browser
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    Hari ini, 09:45
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                    <div class="flex items-center">
                                        <div class="bg-green-100 p-1 rounded text-green-700 mr-2">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </div>
                                        Login Berhasil
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    192.168.1.1
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    Chrome - Windows
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    Kemarin, 17:32
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                    <div class="flex items-center">
                                        <div class="bg-indigo-100 p-1 rounded text-indigo-700 mr-2">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                        Informasi Profil Diubah
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    192.168.1.1
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    Chrome - Windows
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    Kemarin, 15:17
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                    <div class="flex items-center">
                                        <div class="bg-red-100 p-1 rounded text-red-700 mr-2">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </div>
                                        Logout
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    192.168.1.1
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    Chrome - Windows
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush 