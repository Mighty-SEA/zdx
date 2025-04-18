@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editor Halaman Utama</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Editor Halaman Utama</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit"></i>
            Editor Konten Halaman Utama
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-7">
                    <ul class="nav nav-tabs" id="editorTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button" role="tab" aria-controls="hero" aria-selected="true">Hero</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="false">Statistik</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">Layanan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">Tentang</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer" type="button" role="tab" aria-controls="footer" aria-selected="false">Footer</button>
                        </li>
                    </ul>
                    
                    <form id="frontendEditorForm" method="POST" action="{{ route('admin.page-contents.save-frontend-editor') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content mt-4" id="editorTabsContent">
                            <!-- Hero Section -->
                            <div class="tab-pane fade show active" id="hero" role="tabpanel" aria-labelledby="hero-tab">
                                <input type="hidden" name="sections[hero][id]" value="{{ $heroContent->id ?? '' }}">
                                <input type="hidden" name="sections[hero][page_key]" value="home">
                                <input type="hidden" name="sections[hero][section]" value="hero">
                                <input type="hidden" name="sections[hero][order]" value="1">
                                <input type="hidden" name="sections[hero][is_active]" value="1">
                                
                                <div class="mb-3">
                                    <label for="hero_title" class="form-label">Judul Hero</label>
                                    <input type="text" class="form-control content-input" id="hero_title" name="sections[hero][title]" value="{{ $heroContent->title ?? '' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="hero_subtitle" class="form-label">Sub Judul</label>
                                    <input type="text" class="form-control content-input" id="hero_subtitle" name="sections[hero][subtitle]" value="{{ $heroContent->subtitle ?? '' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="hero_content" class="form-label">Konten</label>
                                    <textarea class="form-control content-input" id="hero_content" name="sections[hero][content]" rows="3">{{ $heroContent->content ?? '' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="hero_image" class="form-label">Gambar Hero (Opsional)</label>
                                    <input type="file" class="form-control" id="hero_image" name="sections[hero][image]">
                                    @if(isset($heroContent) && $heroContent->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $heroContent->image) }}" alt="Hero Image" class="img-thumbnail" style="max-height: 150px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="hero_remove_image" name="sections[hero][remove_image]">
                                            <label class="form-check-label" for="hero_remove_image">
                                                Hapus gambar ini
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_cta_tracking" class="form-label">Teks Tombol Lacak</label>
                                            <input type="text" class="form-control content-input" id="hero_cta_tracking" name="sections[hero][extra_data][cta_tracking_text]" 
                                                value="{{ $heroContent && isset(json_decode($heroContent->extra_data, true)['cta_tracking_text']) ? json_decode($heroContent->extra_data, true)['cta_tracking_text'] : 'Lacak Pengiriman' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_cta_tarif" class="form-label">Teks Tombol Tarif</label>
                                            <input type="text" class="form-control content-input" id="hero_cta_tarif" name="sections[hero][extra_data][cta_tarif_text]" 
                                                value="{{ $heroContent && isset(json_decode($heroContent->extra_data, true)['cta_tarif_text']) ? json_decode($heroContent->extra_data, true)['cta_tarif_text'] : 'Cek Tarif' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Stats Section -->
                            <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                                <input type="hidden" name="sections[stats][id]" value="{{ $statsContent->id ?? '' }}">
                                <input type="hidden" name="sections[stats][page_key]" value="home">
                                <input type="hidden" name="sections[stats][section]" value="stats">
                                <input type="hidden" name="sections[stats][order]" value="2">
                                <input type="hidden" name="sections[stats][is_active]" value="1">
                                
                                <div class="mb-3">
                                    <label for="stats_title" class="form-label">Judul Statistik</label>
                                    <input type="text" class="form-control content-input" id="stats_title" name="sections[stats][title]" value="{{ $statsContent->title ?? 'Statistik Kami' }}">
                                </div>
                                
                                <div id="stats_items_container" class="mb-3">
                                    <label class="form-label">Item Statistik</label>
                                    
                                    @php
                                    $statsItems = [];
                                    if(isset($statsContent) && $statsContent->extra_data) {
                                        $extraData = json_decode($statsContent->extra_data, true);
                                        $statsItems = $extraData['stats'] ?? [];
                                    }
                                    if(empty($statsItems)) {
                                        $statsItems = [
                                            ['label' => 'Partner', 'value' => '100+'],
                                            ['label' => 'Project', 'value' => '100+'],
                                            ['label' => 'Success', 'value' => '100+'],
                                            ['label' => 'Country', 'value' => '100+']
                                        ];
                                    }
                                    @endphp
                                    
                                    @foreach($statsItems as $index => $item)
                                    <div class="stats-item border rounded p-3 mb-2">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Label</label>
                                                    <input type="text" class="form-control content-input" name="sections[stats][extra_data][stats][${index}][label]" value="{{ $item['label'] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Nilai</label>
                                                    <input type="text" class="form-control content-input" name="sections[stats][extra_data][stats][${index}][value]" value="{{ $item['value'] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-stats-item mb-3">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <button type="button" id="add_stats_item" class="btn btn-success mt-2">Tambah Item Statistik</button>
                            </div>
                            
                            <!-- Services Section -->
                            <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                                <input type="hidden" name="sections[services][id]" value="{{ $servicesContent->id ?? '' }}">
                                <input type="hidden" name="sections[services][page_key]" value="home">
                                <input type="hidden" name="sections[services][section]" value="services">
                                <input type="hidden" name="sections[services][order]" value="3">
                                <input type="hidden" name="sections[services][is_active]" value="1">
                                
                                <div class="mb-3">
                                    <label for="services_title" class="form-label">Judul Layanan</label>
                                    <input type="text" class="form-control content-input" id="services_title" name="sections[services][title]" value="{{ $servicesContent->title ?? 'Layanan Kami' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="services_subtitle" class="form-label">Sub Judul</label>
                                    <input type="text" class="form-control content-input" id="services_subtitle" name="sections[services][subtitle]" value="{{ $servicesContent->subtitle ?? 'Solusi Pengiriman Terbaik' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="services_content" class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control content-input editor" id="services_content" name="sections[services][content]" rows="4">{{ $servicesContent->content ?? 'Layanan pengiriman terbaik dengan jangkauan luas dan harga bersaing.' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="services_image" class="form-label">Gambar Layanan (Opsional)</label>
                                    <input type="file" class="form-control" id="services_image" name="sections[services][image]">
                                    @if(isset($servicesContent) && $servicesContent->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $servicesContent->image) }}" alt="Services Image" class="img-thumbnail" style="max-height: 150px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="services_remove_image" name="sections[services][remove_image]">
                                            <label class="form-check-label" for="services_remove_image">
                                                Hapus gambar ini
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- About Section -->
                            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <input type="hidden" name="sections[about][id]" value="{{ $aboutContent->id ?? '' }}">
                                <input type="hidden" name="sections[about][page_key]" value="home">
                                <input type="hidden" name="sections[about][section]" value="about">
                                <input type="hidden" name="sections[about][order]" value="4">
                                <input type="hidden" name="sections[about][is_active]" value="1">
                                
                                <div class="mb-3">
                                    <label for="about_title" class="form-label">Judul Tentang</label>
                                    <input type="text" class="form-control content-input" id="about_title" name="sections[about][title]" value="{{ $aboutContent->title ?? 'Tentang Kami' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_subtitle" class="form-label">Sub Judul</label>
                                    <input type="text" class="form-control content-input" id="about_subtitle" name="sections[about][subtitle]" value="{{ $aboutContent->subtitle ?? 'Mitra Pengiriman Terpercaya' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_content" class="form-label">Konten Tentang</label>
                                    <textarea class="form-control content-input editor" id="about_content" name="sections[about][content]" rows="5">{{ $aboutContent->content ?? 'ZDX Express adalah perusahaan logistik yang berpengalaman dalam pengiriman barang dalam dan luar negeri.' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_image" class="form-label">Gambar Tentang (Opsional)</label>
                                    <input type="file" class="form-control" id="about_image" name="sections[about][image]">
                                    @if(isset($aboutContent) && $aboutContent->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $aboutContent->image) }}" alt="About Image" class="img-thumbnail" style="max-height: 150px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="about_remove_image" name="sections[about][remove_image]">
                                            <label class="form-check-label" for="about_remove_image">
                                                Hapus gambar ini
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Footer Section -->
                            <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                                <input type="hidden" name="sections[footer][id]" value="{{ $footerContent->id ?? '' }}">
                                <input type="hidden" name="sections[footer][page_key]" value="home">
                                <input type="hidden" name="sections[footer][section]" value="footer">
                                <input type="hidden" name="sections[footer][order]" value="5">
                                <input type="hidden" name="sections[footer][is_active]" value="1">
                                
                                <div class="mb-3">
                                    <label for="footer_title" class="form-label">Judul Footer</label>
                                    <input type="text" class="form-control content-input" id="footer_title" name="sections[footer][title]" value="{{ $footerContent->title ?? 'ZDX Express' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="footer_content" class="form-label">Deskripsi Singkat</label>
                                    <textarea class="form-control content-input" id="footer_content" name="sections[footer][content]" rows="2">{{ $footerContent->content ?? 'Layanan pengiriman cepat dan terpercaya' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="footer_address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control content-input" id="footer_address" name="sections[footer][extra_data][address]" 
                                        value="{{ $footerContent && isset(json_decode($footerContent->extra_data, true)['address']) ? json_decode($footerContent->extra_data, true)['address'] : 'Jl. Raya No. 123, Jakarta' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="footer_phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control content-input" id="footer_phone" name="sections[footer][extra_data][phone]" 
                                        value="{{ $footerContent && isset(json_decode($footerContent->extra_data, true)['phone']) ? json_decode($footerContent->extra_data, true)['phone'] : '+62123456789' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="footer_email" class="form-label">Email</label>
                                    <input type="text" class="form-control content-input" id="footer_email" name="sections[footer][extra_data][email]" 
                                        value="{{ $footerContent && isset(json_decode($footerContent->extra_data, true)['email']) ? json_decode($footerContent->extra_data, true)['email'] : 'info@zdxcargo.com' }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 mb-3">
                            <button type="submit" class="btn btn-primary" id="saveButton">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-5 position-relative">
                    <div class="sticky-top" style="top: 20px; z-index: 100">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-eye"></i>
                                Preview
                            </div>
                            <div class="card-body p-0">
                                <iframe id="previewFrame" src="{{ route('home') }}?preview=true" style="width: 100%; height: 600px; border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi CKEditor pada semua textarea dengan class editor
        if (typeof ClassicEditor !== 'undefined') {
            $('.editor').each(function() {
                ClassicEditor.create(this)
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            $(this).val(editor.getData());
                            updatePreview();
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        }
        
        // Menangani perubahan konten
        $('.content-input').on('input change', function() {
            updatePreview();
        });
        
        // Menangani klik tab
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            updatePreview();
        });
        
        // Menambahkan item statistik baru
        $('#add_stats_item').on('click', function() {
            const newIndex = $('.stats-item').length;
            const newItem = `
                <div class="stats-item border rounded p-3 mb-2">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input type="text" class="form-control content-input" name="sections[stats][extra_data][stats][${newIndex}][label]" value="Item Baru">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Nilai</label>
                                <input type="text" class="form-control content-input" name="sections[stats][extra_data][stats][${newIndex}][value]" value="0+">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-stats-item mb-3">Hapus</button>
                        </div>
                    </div>
                </div>
            `;
            $('#stats_items_container').append(newItem);
            
            // Reinitialize remove event
            $('.remove-stats-item').off('click').on('click', function() {
                $(this).closest('.stats-item').remove();
                updatePreview();
                reindexStatsItems();
            });
            
            updatePreview();
        });
        
        // Menghapus item statistik
        $('.remove-stats-item').on('click', function() {
            $(this).closest('.stats-item').remove();
            updatePreview();
            reindexStatsItems();
        });
        
        // Reindex stats items setelah penghapusan
        function reindexStatsItems() {
            $('.stats-item').each(function(index) {
                $(this).find('input').each(function() {
                    const name = $(this).attr('name');
                    const newName = name.replace(/\[\d+\]/, `[${index}]`);
                    $(this).attr('name', newName);
                });
            });
        }
        
        // Submit form dengan Ajax
        $('#frontendEditorForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Tampilkan pesan sukses
                        $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                          '</div>').insertBefore('#editorTabs');
                        
                        // Refresh preview
                        updatePreview(true);
                    } else {
                        // Tampilkan pesan error
                        $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                          '</div>').insertBefore('#editorTabs');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Terjadi kesalahan saat menyimpan perubahan.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                      '</div>').insertBefore('#editorTabs');
                }
            });
        });
        
        // Fungsi untuk memperbarui preview
        function updatePreview(refresh = false) {
            if (refresh) {
                // Reload iframe untuk mendapatkan data terbaru dari server
                $('#previewFrame').attr('src', $('#previewFrame').attr('src'));
                return;
            }
            
            // Di sini Anda dapat mengimplementasikan live preview jika diinginkan
            // Misalnya menggunakan postMessage ke iframe
            // Untuk sekarang, kita hanya refresh iframe saat tombol simpan ditekan
        }
        
        // Load preview saat halaman dimuat
        updatePreview(true);
    });
</script>
@endsection 