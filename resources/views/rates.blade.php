@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}</title>
<link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
<meta name="description" content="{{ $seoData['description'] ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">
<meta name="keywords" content="{{ $seoData['keywords'] ?? 'tarif pengiriman, harga cargo, biaya logistik, ongkos kirim, ekspedisi' }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/tarif') }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}">
<meta property="og:description" content="{{ $seoData['og_description'] ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">
@if(isset($seoData['og_image']))
<meta property="og:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}">
<meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">
@if(isset($seoData['twitter_image']))
<meta name="twitter:image" content="{{ asset($seoData['twitter_image']) }}">
@endif

<!-- Custom Schema.org JSON-LD -->
@if(isset($seoData['custom_schema']))
{!! $seoData['custom_schema'] !!}
@else
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Tarif Pengiriman - PT. Zindan Diantar Express",
    "description": "Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.",
    "url": "{{ url('/tarif') }}",
    "mainEntity": {
        "@type": "Service",
        "name": "Layanan Cek Tarif ZDX Express",
        "description": "Layanan untuk memeriksa dan menghitung biaya pengiriman barang ke berbagai tujuan di Indonesia",
        "provider": {
            "@type": "Organization",
            "name": "PT. Zindan Diantar Express"
        },
        "offers": {
            "@type": "AggregateOffer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock"
        }
    }
}
</script>
@endif

<!-- Fungsi formatPhoneNumber -->
@php
function formatPhoneNumber($phoneNumber) {
    // Menghapus semua karakter non-angka
    $number = preg_replace('/[^0-9]/', '', $phoneNumber);
    
    // Jika nomor dimulai dengan 62, ubah ke 0
    if (substr($number, 0, 2) === '62') {
        $number = '0' . substr($number, 2);
    }
    
    // Format nomor dengan spasi setiap 4 digit
    $formatted = '';
    for ($i = 0; $i < strlen($number); $i++) {
        $formatted .= $number[$i];
        if (($i + 1) % 4 == 0 && $i < strlen($number) - 1) {
            $formatted .= ' ';
        }
    }
    
    return $formatted;
}

// Get raw phone number for WhatsApp (CS1)
$whatsappPhone = preg_replace('/[^0-9]/', '', $companyInfo->company_phone_cs1 ?? '6285814718888');
// Get formatted phone for display
$displayPhone = formatPhoneNumber($companyInfo->company_phone ?? '');
@endphp

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Custom Select2 CSS -->
<style>
    .select2-container--default .select2-selection--single {
        height: 48px;
        padding: 10px 8px;
        border-color: #d1d5db;
        border-radius: 0.5rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #4b5563;
        line-height: normal;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #FF6000;
    }
    
    .select2-dropdown {
        border-color: #d1d5db;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .select2-search--dropdown .select2-search__field {
        border-radius: 0.25rem;
        border-color: #d1d5db;
        padding: 8px;
    }
    
    .select2-search--dropdown .select2-search__field:focus {
        outline: 2px solid #FF6000;
        border-color: #FF6000;
    }

    .elegant-button {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
        background-size: 200% auto;
        background-position: right center;
    }
    
    .elegant-button:hover {
        background-position: left center;
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(0, 85, 255, 0.2), 0 3px 6px rgba(0, 0, 0, 0.1);
    }
    
    .elegant-button::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to bottom right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 100%);
        transform: rotate(30deg);
        transition: all 0.6s;
        opacity: 0;
    }
    
    .elegant-button:hover::after {
        opacity: 1;
    }
    
    .elegant-button .btn-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg, 
            rgba(255, 255, 255, 0) 0%, 
            rgba(255, 255, 255, 0.2) 50%, 
            rgba(255, 255, 255, 0) 100%
        );
        animation: shine-effect 3s infinite;
    }
    
    @keyframes shine-effect {
        0% {
            left: -100%;
        }
        20% {
            left: 100%;
        }
        100% {
            left: 100%;
        }
    }
</style>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 pt-8 pb-16">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Pesan Pengiriman ZDX Express</h1>
            <p class="text-gray-600 mt-2">Kirim barang Anda dengan mudah dan cepat</p>
        </div>

        <!-- Calculator Box -->
        <div class="max-w-xl mx-auto w-full">
            <div class="bg-gray-50 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] py-3 px-6">
                    <h2 class="text-xl font-bold text-white">Form Pemesanan</h2>
                </div>
                
                <div class="p-6" id="rate-calculator">
                    <!-- Step 1 -->
                    <div class="mb-5">
                        <div class="flex items-center mb-3">
                            <div class="w-6 h-6 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-bold mr-2">1</div>
                            <label class="font-semibold text-gray-700">Pilih Asal</label>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <select id="origin-province-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white">
                                    <option value="">Pilih Provinsi Asal</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Banten">Banten</option>
                                </select>
                            </div>
                            <div>
                                <select id="origin-city-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" disabled>
                                    <option value="">Pilih Kota/Kabupaten Asal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="mb-5">
                        <div class="flex items-center mb-3">
                            <div class="w-6 h-6 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-bold mr-2">2</div>
                            <label class="font-semibold text-gray-700">Pilih Tujuan</label>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            <div>
                                <select id="province-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province }}">{{ $province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select id="city-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" disabled>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                            <div>
                                <select id="kelurahan-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" disabled>
                                    <option value="">Pilih Kelurahan/Kecamatan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="mb-5">
                        <div class="flex items-center mb-3">
                            <div class="w-6 h-6 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-bold mr-2">3</div>
                            <label class="font-semibold text-gray-700">Masukkan Berat dalam kg</label>
                        </div>
                        <div class="flex items-center">
                            <input type="number" id="weight" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" placeholder="Contoh: 100" min="0.1" step="0.1">
                            <span class="ml-3 text-gray-600 font-medium">kg</span>
                        </div>
                    </div>
                    
                    <!-- Hitung Button -->
                    <button type="button" id="calculate-rate" class="w-full bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-3 rounded-lg font-semibold hover:shadow-md transition-all duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Pesan Sekarang
                    </button>

                    <!-- Error Message -->
                    <div id="error-message" class="mt-5 hidden">
                        <div class="bg-red-50 border border-red-100 text-red-700 p-4 rounded-lg">
                            <p id="error-text" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-[#FFF0E6] py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Butuh Penawaran Khusus?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Dapatkan penawaran harga spesial untuk pengiriman dalam jumlah besar atau kontrak jangka panjang
            </p>
            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companyInfo->company_phone_cs1 ?? '6285814718888') }}?text={{ urlencode('Halo Admin ZDX Express,

Saya tertarik untuk mendapatkan penawaran khusus untuk pengiriman dalam jumlah besar.

Mohon informasi lebih lanjut mengenai layanan dan tarif spesial yang tersedia.

Terima kasih.') }}" target="_blank" class="inline-block bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                Minta Penawaran
            </a>
        </div>
    </div>

    @push('scripts')
    <!-- jQuery (diperlukan untuk Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            const calculateBtn = document.getElementById('calculate-rate');
            const originProvinceSelect = document.getElementById('origin-province-select');
            const originCitySelect = document.getElementById('origin-city-select');
            const provinceSelect = document.getElementById('province-select');
            const citySelect = document.getElementById('city-select');
            const kelurahanSelect = document.getElementById('kelurahan-select');
            const weight = document.getElementById('weight');
            const errorDiv = document.getElementById('error-message');
            const errorText = document.getElementById('error-text').querySelector('span');
            
            // Inisialisasi Select2 pada dropdown
            $('#origin-province-select').select2({
                placeholder: "Pilih Provinsi Asal",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Provinsi tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            $('#origin-city-select').select2({
                placeholder: "Pilih Kota/Kabupaten Asal",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Kota tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            $('#province-select').select2({
                placeholder: "Pilih Provinsi",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Provinsi tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            $('#city-select').select2({
                placeholder: "Pilih Kota/Kabupaten",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Kota tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            $('#kelurahan-select').select2({
                placeholder: "Pilih Kelurahan/Kecamatan",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Kelurahan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            // Event listener untuk provinsi asal dropdown
            $('#origin-province-select').on('change', function() {
                const province = this.value;
                
                // Reset dependent dropdowns
                $('#origin-city-select').empty().append('<option value="">Pilih Kota/Kabupaten Asal</option>').trigger('change');
                
                if (!province) {
                    $('#origin-city-select').prop('disabled', true).trigger('change');
                    return;
                }
                
                $('#origin-city-select').prop('disabled', false);
                
                // Isi dengan data sesuai provinsi yang dipilih
                if (province === 'DKI Jakarta') {
                    $('#origin-city-select').empty().append(`
                        <option value="">Pilih Kota/Kabupaten Asal</option>
                        <option value="Jakarta Pusat">Jakarta Pusat</option>
                        <option value="Jakarta Utara">Jakarta Utara</option>
                        <option value="Jakarta Barat">Jakarta Barat</option>
                        <option value="Jakarta Selatan">Jakarta Selatan</option>
                        <option value="Jakarta Timur">Jakarta Timur</option>
                    `).trigger('change');
                } else if (province === 'Jawa Barat') {
                    $('#origin-city-select').empty().append(`
                        <option value="">Pilih Kota/Kabupaten Asal</option>
                        <option value="Depok">Depok</option>
                        <option value="Bekasi">Bekasi</option>
                        <option value="Bogor">Bogor</option>
                        <option value="Sukabumi">Sukabumi</option>
                        <option value="Karawang">Karawang</option>
                    `).trigger('change');
                } else if (province === 'Banten') {
                    $('#origin-city-select').empty().append(`
                        <option value="">Pilih Kota/Kabupaten Asal</option>
                        <option value="Tangerang">Tangerang</option>
                        <option value="Tangerang Selatan">Tangerang Selatan</option>
                    `).trigger('change');
                }
            });
            
            // Event listener untuk provinsi dropdown
            $('#province-select').on('change', function() {
                const province = this.value;
                
                // Reset dependent dropdowns
                $('#city-select').empty().append('<option value="">Pilih Kota/Kabupaten</option>').trigger('change');
                $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').trigger('change');
                
                $('#kelurahan-select').prop('disabled', true);
                
                if (!province) {
                    $('#city-select').prop('disabled', true).trigger('change');
                    return;
                }
                
                // Show loading state
                $('#city-select').prop('disabled', true).empty().append('<option value="">Memuat data...</option>').trigger('change');
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('province', province);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request to get cities
                fetch('{{ route('get.cities') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    $('#city-select').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                    
                    if (data.success && data.cities.length > 0) {
                        data.cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            $('#city-select').append(option);
                        });
                        $('#city-select').prop('disabled', false).trigger('change');
                    } else {
                        $('#city-select').empty().append('<option value="">Tidak ada data kota</option>').trigger('change');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    $('#city-select').empty().append('<option value="">Error memuat data</option>').trigger('change');
                });
            });
            
            // Event listener untuk kota/kabupaten dropdown
            $('#city-select').on('change', function() {
                const city = this.value;
                const province = $('#province-select').val();
                
                // Reset kelurahan dropdown
                $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').trigger('change');
                
                if (!city || !province) {
                    $('#kelurahan-select').prop('disabled', true).trigger('change');
                    return;
                }
                
                // Show loading state
                $('#kelurahan-select').prop('disabled', true).empty().append('<option value="">Memuat data...</option>').trigger('change');
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('province', province);
                formData.append('city', city);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request to get kelurahan/kecamatan
                fetch('{{ route('get.kelurahans') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>');
                    
                    if (data.success && data.kelurahans.length > 0) {
                        data.kelurahans.forEach(kelurahan => {
                            const option = document.createElement('option');
                            option.value = kelurahan;
                            option.textContent = kelurahan;
                            $('#kelurahan-select').append(option);
                        });
                        $('#kelurahan-select').prop('disabled', false).trigger('change');
                    } else {
                        $('#kelurahan-select').empty().append('<option value="">Tidak ada data kelurahan</option>').trigger('change');
                        $('#kelurahan-select').prop('disabled', false).trigger('change');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    $('#kelurahan-select').empty().append('<option value="">Error memuat data</option>').trigger('change');
                });
            });
            
            calculateBtn.addEventListener('click', function() {
                errorDiv.classList.add('hidden');
                
                const originProvince = $('#origin-province-select').val();
                const originCity = $('#origin-city-select').val();
                const province = $('#province-select').val();
                const city = $('#city-select').val();
                const kelurahan = $('#kelurahan-select').val();
                const weightValue = weight.value;
                
                if (!originProvince || !originCity || !province || !city || !weightValue) {
                    errorText.textContent = 'Harap lengkapi asal, tujuan, dan berat.';
                    errorDiv.classList.remove('hidden');
                    return;
                }

                // Membuat teks asal dan tujuan
                let originText = `${originCity}, ${originProvince}`;
                let destinationText = kelurahan ? 
                    `${kelurahan}, ${city}, ${province}` : 
                    `${city}, ${province}`;

                // Membuat pesan WhatsApp
                let whatsappText = encodeURIComponent(
                    `Halo Admin ZDX Express,\n\n` +
                    `Saya ingin melakukan pemesanan pengiriman barang dengan detail:\n\n` +
                    `Asal: ${originText}\n` +
                    `Tujuan: ${destinationText}\n` +
                    `Berat: ${weightValue} kg\n\n` +
                    `Terima kasih.`
                );

                // Redirect ke WhatsApp
                window.open(
                    `https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companyInfo->company_phone_cs1 ?? '6285814718888') }}?text=${whatsappText}`,
                    '_blank'
                );
            });
        });
    </script>
    @endpush
@endsection 