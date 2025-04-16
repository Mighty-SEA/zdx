@extends('layouts.admin')

@section('title', 'Manajemen Tarif')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Tarif Pengiriman</h2>
                <p class="text-gray-600 mt-1">Kelola semua tarif pengiriman dari berbagai wilayah</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.rates.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Tarif Baru
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="rates-table" class="w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-4 font-semibold">Pulau</th>
                            <th class="py-3 px-4 font-semibold">Provinsi</th>
                            <th class="py-3 px-4 font-semibold">Kota/Kabupaten</th>
                            <th class="py-3 px-4 font-semibold">Kelurahan/Kecamatan</th>
                            <th class="py-3 px-4 font-semibold">Harga Satuan/Kg</th>
                            <th class="py-3 px-4 font-semibold">Minimal (Kg)</th>
                            <th class="py-3 px-4 font-semibold">Estimasi</th>
                            <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach($rates as $rate)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $rate->pulau }}</td>
                            <td class="py-3 px-4">{{ $rate->provinsi }}</td>
                            <td class="py-3 px-4">{{ $rate->kota_kab }}</td>
                            <td class="py-3 px-4">{{ $rate->kelurahan_kecamatan }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($rate->harga_satuan, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $rate->minimal_kg }}</td>
                            <td class="py-3 px-4">{{ $rate->estimasi }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex item-center justify-center gap-2">
                                    <a href="{{ route('admin.rates.edit', $rate->id) }}" class="btn-sm-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.rates.destroy', $rate->id) }}" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    .btn-primary {
        @apply inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wide transition hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 active:bg-indigo-700;
    }
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-wide transition hover:bg-gray-50 focus:outline-none focus:border-indigo-300 active:bg-gray-100;
    }
    .btn-sm-info {
        @apply inline-flex items-center justify-center p-2 bg-blue-100 text-blue-600 rounded transition hover:bg-blue-200;
    }
    .btn-sm-danger {
        @apply inline-flex items-center justify-center p-2 bg-red-100 text-red-600 rounded transition hover:bg-red-200;
    }
    .form-input {
        @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm;
    }
    .delete-form {
        display: inline;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // DataTable initialization with jQuery
    $('#rates-table').DataTable({
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });
    
    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                this.submit();
            }
        });
    });
});
</script>
@endpush 