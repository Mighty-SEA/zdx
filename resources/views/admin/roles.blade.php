@extends('layouts.admin')

@section('title', 'Manajemen Hak Akses')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Hak Akses</h2>
            <p class="text-gray-600 mt-1">Kelola hak akses dan izin pengguna dalam sistem</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button type="button" id="addRoleBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Hak Akses
            </button>
        </div>
    </div>

    <div class="p-6">
        <!-- Roles Table -->
        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 mb-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Hak Akses
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Pengguna
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Administrator Role -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-indigo-100 text-indigo-600">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Administrator</div>
                                    <div class="text-xs text-indigo-500">Akses penuh ke semua fitur</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Hak akses penuh untuk mengelola sistem, pengguna, konten, dan pengaturan.</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            1 pengguna
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900" title="Kelola Izin">
                                    <i class="fas fa-key"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Editor Role -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-blue-100 text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Editor</div>
                                    <div class="text-xs text-blue-500">Akses ke pengelolaan konten</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Dapat mengelola konten website, artikel, dan halaman tanpa akses ke pengaturan sistem.</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            1 pengguna
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900" title="Kelola Izin">
                                    <i class="fas fa-key"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Staff Role -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-green-100 text-green-600">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Staff</div>
                                    <div class="text-xs text-green-500">Akses terbatas</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Akses dasar untuk melihat informasi dan mengelola tugas-tugas harian.</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            1 pengguna
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-900" title="Kelola Izin">
                                    <i class="fas fa-key"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Permissions Management -->
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Izin Sistem</h3>
                <div class="mt-2 md:mt-0">
                    <button type="button" class="bg-white border border-gray-300 rounded-md py-1.5 px-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-sync-alt mr-1"></i> Segarkan Izin
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                <!-- Dashboard Section -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-tachometer-alt text-indigo-500 mr-2"></i> Dashboard
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat dashboard</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat laporan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Expor data</span>
                        </label>
                    </div>
                </div>
                
                <!-- Users Management Section -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-users text-indigo-500 mr-2"></i> Manajemen Pengguna
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat pengguna</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Tambah pengguna</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Edit pengguna</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Hapus pengguna</span>
                        </label>
                    </div>
                </div>
                
                <!-- Rates Management Section -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-dollar-sign text-indigo-500 mr-2"></i> Manajemen Tarif
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat tarif</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Tambah tarif</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Edit tarif</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Hapus tarif</span>
                        </label>
                    </div>
                </div>
                
                <!-- SEO Management Section -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-search text-indigo-500 mr-2"></i> Manajemen SEO
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat pengaturan SEO</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Edit pengaturan SEO</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Kelola meta tags</span>
                        </label>
                    </div>
                </div>
                
                <!-- Settings Section -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-cog text-indigo-500 mr-2"></i> Pengaturan Sistem
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat pengaturan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Edit pengaturan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Kelola backup</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Update sistem</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <button type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Role Modal (Hidden by default) -->
<div id="addRoleModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 md:mx-0">
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Hak Akses Baru</h3>
            <button id="closeAddRoleModal" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="addRoleForm" class="p-6">
            <div class="space-y-4">
                <div>
                    <label for="roleName" class="block text-sm font-medium text-gray-700 mb-1">Nama Hak Akses</label>
                    <input type="text" id="roleName" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nama hak akses" required>
                </div>
                
                <div>
                    <label for="roleDescription" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="roleDescription" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Deskripsi hak akses" required></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Izin Dasar</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="view_dashboard" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Lihat dashboard</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="view_profile" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Kelola profil</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancelAddRole" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Hak Akses
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal functionality
        const addRoleBtn = document.getElementById('addRoleBtn');
        const addRoleModal = document.getElementById('addRoleModal');
        const closeAddRoleModal = document.getElementById('closeAddRoleModal');
        const cancelAddRole = document.getElementById('cancelAddRole');
        
        function openModal() {
            addRoleModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        
        function closeModal() {
            addRoleModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        addRoleBtn.addEventListener('click', openModal);
        closeAddRoleModal.addEventListener('click', closeModal);
        cancelAddRole.addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        addRoleModal.addEventListener('click', function(e) {
            if (e.target === addRoleModal) {
                closeModal();
            }
        });
        
        // Form submission (simulate for now)
        const addRoleForm = document.getElementById('addRoleForm');
        addRoleForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Here you would typically make an API call to create the role
            alert('Hak akses baru berhasil ditambahkan!');
            closeModal();
        });
    });
</script>
@endpush 