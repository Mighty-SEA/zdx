@extends('layouts.admin')

@section('title', 'Edit Tarif Pengiriman')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Tarif Pengiriman</h2>
                <p class="text-gray-600 mt-1">Perbarui data tarif pengiriman</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.rates') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <form id="editForm" action="{{ route('admin.rates.update', $rate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pulau" class="block text-sm font-medium text-gray-700 mb-1">Pulau</label>
                        <input type="text" name="pulau" id="pulau" class="form-input w-full" required value="{{ $rate->pulau }}">
                    </div>
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                        <input type="text" name="provinsi" id="provinsi" class="form-input w-full" required value="{{ $rate->provinsi }}">
                    </div>
                    <div>
                        <label for="kota_kab" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                        <input type="text" name="kota_kab" id="kota_kab" class="form-input w-full" required value="{{ $rate->kota_kab }}">
                    </div>
                    <div>
                        <label for="kelurahan_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan/Kecamatan</label>
                        <input type="text" name="kelurahan_kecamatan" id="kelurahan_kecamatan" class="form-input w-full" required value="{{ $rate->kelurahan_kecamatan }}">
                    </div>
                    <div>
                        <label for="harga_satuan" class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan/Kg</label>
                        <input type="number" name="harga_satuan" id="harga_satuan" class="form-input w-full" required value="{{ $rate->harga_satuan }}">
                    </div>
                    <div>
                        <label for="minimal_kg" class="block text-sm font-medium text-gray-700 mb-1">Minimal (Kg)</label>
                        <input type="number" name="minimal_kg" id="minimal_kg" class="form-input w-full" required value="{{ $rate->minimal_kg }}">
                    </div>
                    <div>
                        <label for="estimasi" class="block text-sm font-medium text-gray-700 mb-1">Estimasi</label>
                        <input type="text" name="estimasi" id="estimasi" class="form-input w-full" required value="{{ $rate->estimasi }}">
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.rates') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-primary {
        @apply inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wide transition hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 active:bg-indigo-700;
    }
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-wide transition hover:bg-gray-50 focus:outline-none focus:border-indigo-300 active:bg-gray-100;
    }
    .form-input {
        @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50;
    }
</style>
@endpush 