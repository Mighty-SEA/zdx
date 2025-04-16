@extends('layouts.admin')

@section('title', 'Tambah Tarif Pengiriman')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Tarif Pengiriman</h2>
                <p class="text-gray-600 mt-1">Tambahkan satu atau beberapa tarif pengiriman sekaligus</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.rates') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Add Form -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <form id="ratesForm" action="{{ route('admin.rates.store') }}" method="POST">
            @csrf
            <div class="p-6">
                <div class="mb-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-800">Data Tarif</h3>
                        <button type="button" id="addRowBtn" class="btn-sm-primary">
                            <i class="fas fa-plus mr-1"></i> Tambah Baris
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm leading-normal">
                                <th class="py-3 px-4 font-semibold">Pulau</th>
                                <th class="py-3 px-4 font-semibold">Provinsi</th>
                                <th class="py-3 px-4 font-semibold">Kota/Kabupaten</th>
                                <th class="py-3 px-4 font-semibold">Kelurahan/Kecamatan</th>
                                <th class="py-3 px-4 font-semibold">Harga/Kg</th>
                                <th class="py-3 px-4 font-semibold">Minimal (Kg)</th>
                                <th class="py-3 px-4 font-semibold">Estimasi</th>
                                <th class="py-3 px-4 font-semibold w-16 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ratesTableBody">
                            <tr class="rate-row border-b border-gray-200">
                                <td class="py-2 px-4">
                                    <input type="text" name="rates[0][pulau]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="text" name="rates[0][provinsi]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="text" name="rates[0][kota_kab]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="text" name="rates[0][kelurahan_kecamatan]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="number" name="rates[0][harga_satuan]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="number" name="rates[0][minimal_kg]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="text" name="rates[0][estimasi]" class="form-input w-full" required>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <button type="button" class="btn-sm-danger remove-row-btn" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <div>
                    <span class="text-sm text-gray-600" id="rowCounter">1 data akan ditambahkan</span>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.rates') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">Simpan Data</button>
                </div>
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
    .btn-sm-primary {
        @apply inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded text-xs text-white transition hover:bg-indigo-700 focus:outline-none;
    }
    .btn-sm-danger {
        @apply inline-flex items-center justify-center p-2 bg-red-100 text-red-600 rounded transition hover:bg-red-200;
    }
    .form-input {
        @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ratesTableBody = document.getElementById('ratesTableBody');
    const addRowBtn = document.getElementById('addRowBtn');
    const rowCounter = document.getElementById('rowCounter');
    let rowIndex = 0;
    
    // Add new row
    addRowBtn.addEventListener('click', function() {
        rowIndex++;
        
        const newRow = document.createElement('tr');
        newRow.className = 'rate-row border-b border-gray-200';
        
        newRow.innerHTML = `
            <td class="py-2 px-4">
                <input type="text" name="rates[${rowIndex}][pulau]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4">
                <input type="text" name="rates[${rowIndex}][provinsi]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4">
                <input type="text" name="rates[${rowIndex}][kota_kab]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4">
                <input type="text" name="rates[${rowIndex}][kelurahan_kecamatan]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4">
                <input type="number" name="rates[${rowIndex}][harga_satuan]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4">
                <input type="number" name="rates[${rowIndex}][minimal_kg]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4">
                <input type="text" name="rates[${rowIndex}][estimasi]" class="form-input w-full" required>
            </td>
            <td class="py-2 px-4 text-center">
                <button type="button" class="btn-sm-danger remove-row-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        
        ratesTableBody.appendChild(newRow);
        
        // Enable all remove buttons when we have more than one row
        if (ratesTableBody.children.length > 1) {
            document.querySelectorAll('.remove-row-btn').forEach(btn => {
                btn.disabled = false;
            });
        }
        
        updateRowCounter();
        
        // Add event listener to the newly added remove button
        newRow.querySelector('.remove-row-btn').addEventListener('click', function() {
            newRow.remove();
            
            // If only one row left, disable its remove button
            if (ratesTableBody.children.length === 1) {
                ratesTableBody.querySelector('.remove-row-btn').disabled = true;
            }
            
            updateRowCounter();
        });
    });
    
    // Update row counter text
    function updateRowCounter() {
        const count = ratesTableBody.children.length;
        rowCounter.textContent = `${count} data akan ditambahkan`;
    }
    
    // Form submission
    document.getElementById('ratesForm').addEventListener('submit', function(e) {
        // If needed, you can add validation here
    });
});
</script>
@endpush 