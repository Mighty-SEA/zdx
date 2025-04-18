@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Konten Halaman</h4>
                    <a href="{{ route('admin.page-contents.create') }}" class="btn btn-primary float-right">
                        <i class="fa fa-plus"></i> Tambah Konten
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Halaman</th>
                                    <th>Bagian</th>
                                    <th>Judul</th>
                                    <th>Urutan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pageContents as $index => $content)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @switch($content->page_key)
                                                @case('home')
                                                    Beranda
                                                    @break
                                                @case('about')
                                                    Tentang Kami
                                                    @break
                                                @case('services')
                                                    Layanan
                                                    @break
                                                @case('products')
                                                    Produk
                                                    @break
                                                @case('contact')
                                                    Kontak
                                                    @break
                                                @default
                                                    {{ $content->page_key }}
                                            @endswitch
                                        </td>
                                        <td>{{ $content->section }}</td>
                                        <td>{{ $content->title }}</td>
                                        <td>{{ $content->order }}</td>
                                        <td>
                                            <span class="badge badge-{{ $content->is_active ? 'success' : 'danger' }}">
                                                {{ $content->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.page-contents.edit', $content->id) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.page-contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data konten halaman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $pageContents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 