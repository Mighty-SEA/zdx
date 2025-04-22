@extends('layouts.admin')

@section('title', 'Edit Pelanggan / Partner')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container mx-auto">
    <header class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Pelanggan / Partner</h1>
                <p class="text-gray-600 mt-1">Ubah data pelanggan atau partner bisnis ZDX Cargo.</p>
            </div>
            <div>
                <a href="{{ route('admin.partners') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </header>

    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                            <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
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
            
            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Dasar</h3>
                
                    <!-- Tipe -->
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe <span class="text-red-500">*</span></label>
                        <select id="type" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('type') border-red-500 @enderror" required>
                            <option value="customer" {{ old('type', $partner->type) == 'customer' ? 'selected' : '' }}>Pelanggan</option>
                            <option value="partner" {{ old('type', $partner->type) == 'partner' ? 'selected' : '' }}>Partner</option>
                        </select>
                    </div>
                    
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $partner->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('name') border-red-500 @enderror" required>
                    </div>
                    
                    <!-- Perusahaan -->
                    <div class="mb-4">
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Perusahaan</label>
                        <input type="text" id="company" name="company" value="{{ old('company', $partner->company) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('company') border-red-500 @enderror">
                    </div>
                    
                    <!-- Industri -->
                    <div class="mb-4">
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industri</label>
                        <input type="text" id="industry" name="industry" value="{{ old('industry', $partner->industry) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('industry') border-red-500 @enderror">
                    </div>
                    
                    <!-- Logo -->
                    <div class="mb-4">
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                        
                        @if($partner->logo_path)
                        <div class="mb-2">
                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 w-16 object-cover rounded-md border border-gray-200">
                            <p class="text-xs text-gray-500 mt-1">Logo saat ini</p>
                        </div>
                        @endif
                        
                        <div class="flex items-center">
                            <input type="file" id="logo" name="logo" accept="image/*" class="hidden">
                            <label for="logo" class="border border-gray-300 rounded-md px-3 py-2 cursor-pointer hover:bg-gray-50 flex-1 mr-2 truncate">
                                <span id="logoFileName" class="text-gray-500">Pilih file...</span>
                            </label>
                            <button type="button" id="clearLogo" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG. Max: 2MB</p>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('status') border-red-500 @enderror" required>
                            <option value="active" {{ old('status', $partner->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $partner->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Kontak</h3>
                    
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $partner->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('email') border-red-500 @enderror">
                    </div>
                    
                    <!-- Telepon -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $partner->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('phone') border-red-500 @enderror">
                    </div>
                    
                    <!-- Website -->
                    <div class="mb-4">
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $partner->website) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('website') border-red-500 @enderror" placeholder="https://">
                    </div>
                    
                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea id="address" name="address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address', $partner->address) }}</textarea>
                    </div>
                    
                    <!-- Kota -->
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $partner->city) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('city') border-red-500 @enderror">
                    </div>
                    
                    <!-- Negara -->
                    <div class="mb-4">
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Negara</label>
                        <input type="text" id="country" name="country" value="{{ old('country', $partner->country) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('country') border-red-500 @enderror">
                    </div>
                </div>
            </div>
            
            <div class="mt-6 border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tambahan</h3>
                
                <!-- Deskripsi / Catatan -->
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Catatan</label>
                    <textarea id="notes" name="notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6000] focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes', $partner->notes) }}</textarea>
                </div>
            </div>
            
            <div class="mt-6 border-t pt-6 flex justify-end">
                <a href="{{ route('admin.partners') }}" class="btn-secondary mr-2">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File input handling
        const logoInput = document.getElementById('logo');
        const logoFileName = document.getElementById('logoFileName');
        const clearLogo = document.getElementById('clearLogo');
        
        logoInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                logoFileName.textContent = this.files[0].name;
            } else {
                logoFileName.textContent = 'Pilih file...';
            }
        });
        
        clearLogo.addEventListener('click', function() {
            logoInput.value = '';
            logoFileName.textContent = 'Pilih file...';
        });
    });
</script>
@endpush 