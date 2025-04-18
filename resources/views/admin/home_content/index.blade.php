@extends('layouts.admin')

@section('title', 'Kelola Konten Halaman Home')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Konten Halaman Home</h2>
                <p class="text-gray-600 mt-1">Kelola semua konten yang ditampilkan di halaman utama website</p>
            </div>
        </div>
    </div>

    <!-- Alert Status -->
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Info Card -->
    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded" role="alert">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mr-3 text-lg mt-1"></i>
            <div>
                <p class="font-medium">Panduan Pengelolaan Konten</p>
                <p class="text-sm mt-1">
                    Di sini Anda dapat mengedit konten yang ditampilkan di halaman utama website. Setiap bagian dapat diatur
                    secara terpisah, termasuk judul, deskripsi, gambar dan tombol aksi. Urutan bagian dapat diubah dengan drag & drop.
                </p>
            </div>
        </div>
    </div>

    <!-- Section Cards -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="font-semibold text-gray-800">Daftar Bagian</h3>
        </div>
        
        <div class="min-w-full divide-y divide-gray-200">
            <div class="bg-gray-50">
                <div class="grid grid-cols-12 gap-2 px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                    <div class="col-span-1">#</div>
                    <div class="col-span-4">Bagian</div>
                    <div class="col-span-5">Judul</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-1 text-right">Aksi</div>
                </div>
            </div>
            
            <div class="bg-white divide-y divide-gray-200" id="sections-table">
                @if($contentSections->count() > 0)
                    @foreach($contentSections as $section)
                    <div class="grid grid-cols-12 gap-2 px-6 py-4 hover:bg-gray-50" data-id="{{ $section->id }}">
                        <div class="col-span-1 flex items-center text-sm text-gray-900">
                            <i class='bx bx-transfer-alt handle cursor-move text-gray-400 mr-2'></i>
                            {{ $section->order }}
                        </div>
                        <div class="col-span-4 text-sm text-gray-900">
                            <p class="font-medium">
                            @if($section->section_key === 'service_cards')
                                CTA Section
                            @else
                                {{ $section->section_name }}
                            @endif
                            </p>
                            <p class="text-xs text-gray-500 mt-1">{{ $section->section_key }}</p>
                        </div>
                        <div class="col-span-5 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($section->title, 60) }}</div>
                        <div class="col-span-1">
                            @if($section->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                        <div class="col-span-1 text-right">
                            <a href="{{ route('admin.home-content.edit', $section->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-2 rounded">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="px-6 py-10 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600 mb-2">Belum ada konten yang ditambahkan</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionsTable = document.getElementById('sections-table');
    if (sectionsTable) {
        new Sortable(sectionsTable, {
            handle: '.handle',
            animation: 150,
            onEnd: function() {
                // Mendapatkan urutan baru
                const rows = sectionsTable.querySelectorAll('div[data-id]');
                const order = [];
                
                rows.forEach(function(row, index) {
                    const id = row.getAttribute('data-id');
                    order.push(id);
                    
                    // Update nomor urutan yang ditampilkan
                    const orderCell = row.querySelector('div:first-child');
                    if (orderCell) {
                        const handleIcon = orderCell.querySelector('i');
                        const newOrderText = document.createTextNode(' ' + (index + 1));
                        orderCell.innerHTML = '';
                        orderCell.appendChild(handleIcon);
                        orderCell.appendChild(newOrderText);
                    }
                });
                
                // Kirim urutan baru ke server
                fetch('{{ route("admin.home-content.order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tampilkan notifikasi sukses
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg z-50';
                        alertDiv.innerHTML = `
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                                <p>Urutan berhasil diperbarui</p>
                            </div>
                        `;
                        document.body.appendChild(alertDiv);
                        
                        // Hilangkan notifikasi setelah 2 detik
                        setTimeout(() => {
                            alertDiv.style.opacity = '0';
                            alertDiv.style.transition = 'opacity 0.5s';
                            setTimeout(() => alertDiv.remove(), 500);
                        }, 2000);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    }
});
</script>
@endsection 