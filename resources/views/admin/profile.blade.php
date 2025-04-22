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
            <div class="lg:col-span-1 flex flex-col">
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200 mb-6">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <div class="w-32 h-32 bg-indigo-600 rounded-full flex items-center justify-center text-white text-4xl font-bold overflow-hidden" id="profileImageContainer">
                                @if(auth()->user()->photo)
                                    <img src="{{ asset('storage/profiles/' . auth()->user()->photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
                                @else
                                    <span>{{ substr(auth()->user()->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="absolute bottom-0 right-0">
                                <label for="photoUpload" class="bg-white border border-gray-300 rounded-full w-8 h-8 flex items-center justify-center cursor-pointer shadow-sm hover:bg-gray-50">
                                    <i class="fas fa-camera text-gray-600"></i>
                                    <input type="file" id="photoUpload" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-600 text-sm">Administrator</p>
                        <div class="mt-2 text-gray-500 text-sm">
                            Anggota sejak: {{ auth()->user()->created_at->format('d F Y') }}
                        </div>
                    </div>
                    
                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Status</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Login Terakhir</span>
                            <span class="text-sm text-gray-600">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d M Y, H:i') : 'Belum ada data' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Activity Log (Moved here) -->
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200 h-full flex-1">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-gray-800">Riwayat Aktivitas</h3>
                        <div class="text-xs text-gray-500">
                            <select id="activityFilter" class="bg-white border border-gray-300 rounded-md py-1 px-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="all">Semua</option>
                                <option value="Login">Login</option>
                                <option value="Profil">Data</option>
                                <option value="Password">Password</option>
                                <option value="Foto">Foto</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto overflow-y-auto" style="max-height: 280px;">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu
                                    </th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aktivitas
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="activityTableBody" class="bg-white divide-y divide-gray-200">
                                @forelse ($activities as $activity)
                                <tr>
                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-600">
                                        {{ $activity->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                                        <div class="flex items-center">
                                            <div class="p-1 rounded mr-2 {{ $activity->activity == 'Login Berhasil' ? 'bg-green-100 text-green-700' : ($activity->activity == 'Logout' ? 'bg-red-100 text-red-700' : 'bg-indigo-100 text-indigo-700') }}">
                                                <i class="fas {{ $activity->activity == 'Login Berhasil' ? 'fa-sign-in-alt' : ($activity->activity == 'Logout' ? 'fa-sign-out-alt' : ($activity->activity == 'Foto Profil Diubah' ? 'fa-camera' : ($activity->activity == 'Password Diubah' ? 'fa-key' : 'fa-user-edit'))) }}"></i>
                                            </div>
                                            {{ $activity->activity }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-3 py-4 text-center text-gray-500 text-xs">
                                        <i class="fas fa-history text-gray-300 text-lg mb-1"></i>
                                        <p>Belum ada riwayat</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3 text-center">
                        <button id="loadMoreBtn" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">
                            Muat lebih banyak
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Forms -->
            <div class="lg:col-span-2 flex flex-col">
                <!-- Profile Form -->
                <form id="profileForm" action="{{ route('admin.profile.update') }}" method="POST" class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200 mb-6">
                    @csrf
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pribadi</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nama Lengkap">
                        </div>
                        
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" id="username" name="username" value="{{ auth()->user()->username }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Username">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Email">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Tuliskan bio singkat Anda">{{ auth()->user()->bio }}</textarea>
                    </div>
                </form>
                
                <!-- Change Password -->
                <form id="passwordForm" action="{{ route('admin.profile.update-password') }}" method="POST" class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-indigo-200 transition-colors duration-200 flex-1">
                    @csrf
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
    </div>
</div>
@endsection

@push('styles')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
@endpush

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

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

    // Fungsi untuk menampilkan pesan error
    function showErrorMessage(element, message) {
        // Hapus error lama jika ada
        removeErrorMessage(element);
        
        // Tambahkan pesan error
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-500 text-sm mt-1 error-message';
        errorDiv.textContent = message;
        
        // Tambahkan setelah elemen
        element.parentNode.appendChild(errorDiv);
        
        // Tandai input dengan border merah
        element.classList.add('border-red-500');
    }
    
    // Fungsi untuk menghapus pesan error
    function removeErrorMessage(element) {
        // Hapus kelas border merah
        element.classList.remove('border-red-500');
        
        // Cari error message di parent
        const errorMessages = element.parentNode.querySelectorAll('.error-message');
        errorMessages.forEach(el => el.remove());
    }
    
    // Fungsi untuk menghapus semua error di form
    function clearFormErrors(form) {
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(el => el.remove());
        
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => input.classList.remove('border-red-500'));
    }

    // Fungsi untuk mengelola aktivitas
    let currentPage = 1;
    let currentFilter = 'all';
    
    // Format tanggal
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
    
    // Format aktivitas row
    function formatActivityRow(activity) {
        const iconClass = activity.activity.includes('Login') 
            ? 'fa-sign-in-alt' 
            : (activity.activity.includes('Logout') 
                ? 'fa-sign-out-alt' 
                : (activity.activity.includes('Foto') 
                    ? 'fa-camera' 
                    : (activity.activity.includes('Password') 
                        ? 'fa-key' 
                        : 'fa-user-edit')));
        
        const bgClass = activity.activity.includes('Login') 
            ? 'bg-green-100 text-green-700' 
            : (activity.activity.includes('Logout') 
                ? 'bg-red-100 text-red-700' 
                : 'bg-indigo-100 text-indigo-700');
                
        return `
            <tr>
                <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-600">
                    ${formatDate(activity.created_at)}
                </td>
                <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-800">
                    <div class="flex items-center">
                        <div class="p-1 rounded mr-2 ${bgClass}">
                            <i class="fas ${iconClass}"></i>
                        </div>
                        ${activity.activity}
                    </div>
                </td>
            </tr>
        `;
    }
    
    // Load more aktivitas
    function loadMoreActivities() {
        currentPage++;
        loadActivities(false);
    }
    
    // Load aktivitas berdasarkan filter
    function loadActivities(reset = true) {
        if (reset) {
            currentPage = 1;
        }
        
        const url = `{{ route('admin.profile.activities') }}?type=${currentFilter}&page=${currentPage}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tableBody = document.getElementById('activityTableBody');
                    
                    // Reset table jika ini adalah filter baru
                    if (reset) {
                        tableBody.innerHTML = '';
                    }
                    
                    if (data.activities.length === 0 && reset) {
                        // Jika tidak ada aktivitas dan ini adalah reset
                        tableBody.innerHTML = `
                            <tr>
                                <td colspan="2" class="px-3 py-4 text-center text-gray-500 text-xs">
                                    <i class="fas fa-history text-gray-300 text-lg mb-1"></i>
                                    <p>Belum ada riwayat</p>
                                </td>
                            </tr>
                        `;
                        
                        // Sembunyikan tombol "Muat lebih banyak"
                        document.getElementById('loadMoreBtn').style.display = 'none';
                    } else if (data.activities.length === 0) {
                        // Jika tidak ada lagi aktivitas untuk dimuat
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Tidak ada lagi riwayat aktivitas untuk ditampilkan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Sembunyikan tombol "Muat lebih banyak"
                        document.getElementById('loadMoreBtn').style.display = 'none';
                    } else {
                        // Jika ada aktivitas, tambahkan ke tabel
                        data.activities.forEach(activity => {
                            activity.browser_info = activity.browser_info || getBrowserInfo(activity.user_agent);
                            tableBody.innerHTML += formatActivityRow(activity);
                        });
                        
                        // Tampilkan tombol "Muat lebih banyak"
                        document.getElementById('loadMoreBtn').style.display = 'block';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memuat riwayat aktivitas. Silakan coba lagi.'
                });
            });
    }
    
    // Helper function for browser detection
    function getBrowserInfo(userAgent) {
        if (!userAgent) return 'Unknown';
        
        let browser = 'Unknown';
        let platform = 'Unknown';

        // Browser detection
        if (/MSIE|Trident/i.test(userAgent)) browser = 'IE';
        else if (/Edge/i.test(userAgent)) browser = 'Edge';
        else if (/Firefox/i.test(userAgent)) browser = 'Firefox';
        else if (/Safari/i.test(userAgent) && !/Chrome/i.test(userAgent)) browser = 'Safari';
        else if (/Chrome/i.test(userAgent)) browser = 'Chrome';
        else if (/Opera/i.test(userAgent)) browser = 'Opera';

        // OS detection
        if (/Windows/i.test(userAgent)) platform = 'Windows';
        else if (/Mac/i.test(userAgent)) platform = 'Mac';
        else if (/Linux/i.test(userAgent)) platform = 'Linux';
        else if (/Android/i.test(userAgent)) platform = 'Android';
        else if (/iOS|iPhone|iPad|iPod/i.test(userAgent)) platform = 'iOS';

        return `${browser} - ${platform}`;
    }

    // Tambahkan script untuk upload foto menggunakan AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const photoUpload = document.getElementById('photoUpload');
        const profileImageContainer = document.getElementById('profileImageContainer');
        
        photoUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const formData = new FormData();
                formData.append('photo', this.files[0]);
                formData.append('_token', '{{ csrf_token() }}');
                
                fetch('{{ route("admin.profile.upload-photo") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update tampilan foto
                        profileImageContainer.innerHTML = `<img src="${data.photo}" alt="Foto Profil" class="w-full h-full object-cover">`;
                        
                        // Tampilkan pesan sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                });
            }
        });

        // Form profil menggunakan AJAX
        const profileForm = document.getElementById('profileForm');
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Bersihkan error sebelumnya
            clearFormErrors(this);
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Reload aktivitas setelah berhasil update
                    loadActivities();
                } else {
                    if (data.errors) {
                        // Tampilkan error per field
                        Object.keys(data.errors).forEach(field => {
                            const element = document.getElementById(field);
                            if (element) {
                                showErrorMessage(element, data.errors[field][0]);
                            }
                        });
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                });
            });
        });

        // Form password menggunakan AJAX
        const passwordForm = document.getElementById('passwordForm');
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Bersihkan error sebelumnya
            clearFormErrors(this);
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    this.reset();
                    
                    // Reload aktivitas setelah berhasil update
                    loadActivities();
                } else {
                    if (data.errors) {
                        // Tampilkan error per field
                        Object.keys(data.errors).forEach(field => {
                            const element = document.getElementById(field);
                            if (element) {
                                showErrorMessage(element, data.errors[field][0]);
                            }
                        });
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message || 'Gagal mengubah password. Silakan coba lagi.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                });
            });
        });
        
        // Filter aktivitas
        const activityFilter = document.getElementById('activityFilter');
        activityFilter.addEventListener('change', function() {
            currentFilter = this.value;
            loadActivities();
        });
        
        // Load more button
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        loadMoreBtn.addEventListener('click', loadMoreActivities);
    });
</script>
@endpush 