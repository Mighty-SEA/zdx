@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>
            <p class="text-gray-600 mt-1">Kelola pengguna dan akun administrator</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button type="button" id="addUserBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-user-plus mr-2"></i> Tambah Pengguna
            </button>
        </div>
    </div>

    <div class="p-6">
        <!-- Filters and Search -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
            <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                <div class="flex items-center">
                    <span class="text-sm text-gray-500 mr-2">Status:</span>
                    <select id="statusFilter" class="bg-white border border-gray-300 rounded-md py-1 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Non-aktif</option>
                    </select>
                </div>
            </div>
            
            <div class="relative">
                <input type="text" id="searchUsers" class="bg-gray-100 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full md:w-64" placeholder="Cari pengguna...">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <input type="checkbox" id="selectAllUsers" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="ml-2">Pengguna</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Login Terakhir
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50" data-user-id="{{ $user->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <input type="checkbox" class="userCheckbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" value="{{ $user->id }}">
                                <div class="flex items-center ml-4">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-medium">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">Terdaftar pada {{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->active)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Non-aktif
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($user->last_login_at)
                                    {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                                @else
                                    Belum pernah login
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900 edit-user-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-active="{{ $user->active ? 1 : 0 }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-900 reset-password-btn" data-id="{{ $user->id }}" title="Reset Password">
                                    <i class="fas fa-key"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 delete-user-btn" data-id="{{ $user->id }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
            <div class="flex-1 flex justify-between sm:hidden">
                {{ $users->onEachSide(1)->links() }}
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $users->firstItem() }}</span> sampai <span class="font-medium">{{ $users->lastItem() }}</span> dari <span class="font-medium">{{ $users->total() }}</span> pengguna
                    </p>
                </div>
                <div>
                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal (Hidden by default) -->
<div id="addUserModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 md:mx-0">
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Tambah Pengguna Baru</h3>
            <button id="closeAddUserModal" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="userForm" class="p-6">
            @csrf
            <input type="hidden" id="userId" name="userId" value="">
            <input type="hidden" id="formMethod" name="_method" value="POST">
            
            <div class="space-y-4">
                <div>
                    <label for="userName" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="userName" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nama lengkap pengguna" required>
                </div>
                
                <div>
                    <label for="userEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="userEmail" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="email@example.com" required>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div id="passwordContainer">
                        <label for="userPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" id="userPassword" name="password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('userPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="active" id="userActive" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Aktifkan pengguna</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancelAddUser" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
                <button type="submit" id="submitBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                    <i class="fas fa-user-plus mr-2"></i> <span id="submitBtnText">Tambah Pengguna</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reset Password Modal -->
<div id="resetPasswordModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 md:mx-0">
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Reset Password</h3>
            <button id="closeResetPasswordModal" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="resetPasswordForm" class="p-6">
            @csrf
            <input type="hidden" id="resetUserId" name="userId" value="">
            
            <div class="space-y-4">
                <p class="text-gray-600">Masukkan password baru untuk pengguna</p>
                
                <div>
                    <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="newPassword" name="password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('newPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancelResetPassword" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                    <i class="fas fa-key mr-2"></i> Reset Password
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete User Confirmation Modal -->
<div id="deleteUserModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 md:mx-0">
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h3>
            <button id="closeDeleteUserModal" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="p-6">
            <p class="text-gray-700 mb-6">Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelDeleteUser" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
                <button type="button" id="confirmDeleteUser" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                    <i class="fas fa-trash mr-2"></i> Hapus Pengguna
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle select all checkboxes
        const selectAllCheckbox = document.getElementById('selectAllUsers');
        const userCheckboxes = document.querySelectorAll('.userCheckbox');
        
        selectAllCheckbox.addEventListener('change', function() {
            userCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
        
        // Modal functionality
        const addUserBtn = document.getElementById('addUserBtn');
        const addUserModal = document.getElementById('addUserModal');
        const closeAddUserModal = document.getElementById('closeAddUserModal');
        const cancelAddUser = document.getElementById('cancelAddUser');
        
        function openModal() {
            addUserModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        
        function closeModal() {
            addUserModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        addUserBtn.addEventListener('click', openModal);
        closeAddUserModal.addEventListener('click', closeModal);
        cancelAddUser.addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        addUserModal.addEventListener('click', function(e) {
            if (e.target === addUserModal) {
                closeModal();
            }
        });
        
        // Form submission (simulate for now)
        const addUserForm = document.getElementById('addUserForm');
        addUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Here you would typically make an API call to create the user
            alert('Pengguna baru berhasil ditambahkan!');
            closeModal();
        });
        
        // Filtering logic
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchUsers');
        
        // Add filter functionality (simplified for demo)
        function applyFilters() {
            const statusValue = statusFilter.value.toLowerCase();
            const searchValue = searchInput.value.toLowerCase();
            
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const userStatus = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const userName = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                
                const statusMatch = statusValue === '' || 
                    (statusValue === 'active' && userStatus.includes('aktif') && !userStatus.includes('non-aktif')) ||
                    (statusValue === 'inactive' && userStatus.includes('non-aktif'));
                const searchMatch = searchValue === '' || 
                    userName.includes(searchValue) || 
                    userEmail.includes(searchValue);
                
                if (statusMatch && searchMatch) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        }
        
        statusFilter.addEventListener('change', applyFilters);
        searchInput.addEventListener('input', applyFilters);
    });
    
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