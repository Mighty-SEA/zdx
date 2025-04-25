@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Pengguna</h2>
            <p class="text-gray-600 mt-1">Perbarui data pengguna admin</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.users') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="max-w-2xl mx-auto">
            @csrf
            @method('PUT')
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Nama lengkap pengguna" required>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="email@example.com" required>
                </div>
                
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="active" id="active" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" value="1" {{ $user->active ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Aktifkan pengguna</span>
                    </label>
                </div>
                
                <div class="flex justify-end pt-5">
                    <a href="{{ route('admin.users') }}" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-all duration-200 mr-4">
                        Batal
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Reset Password Section -->
<div class="bg-white rounded-lg shadow-sm mt-6">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-800">Reset Password</h3>
        <p class="text-gray-600 mt-1">Ubah password pengguna</p>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST" class="max-w-2xl mx-auto">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" id="current_password" name="current_password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('current_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="••••••••" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer" onclick="togglePasswordVisibility('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                        <i class="fas fa-key mr-2"></i> Reset Password
                    </button>
                </div>
            </div>
        </form>
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