@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}</title>
<link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
<meta name="description" content="{{ $seoData['description'] ?? 'Cek tarif pengiriman ZDX Express untuk berbagai rute dan layanan. Dapatkan harga terbaik untuk pengiriman barang di seluruh Indonesia.' }}">
<meta name="keywords" content="{{ $seoData['keywords'] ?? 'tarif pengiriman, cek ongkir, biaya kirim, harga cargo' }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/tarif') }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}">
<meta property="og:description" content="{{ $seoData['og_description'] ?? 'Cek tarif pengiriman ZDX Express untuk berbagai rute dan layanan. Dapatkan harga terbaik untuk pengiriman barang di seluruh Indonesia.' }}">
@if(isset($seoData['og_image']))
<meta property="og:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}">
<meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? 'Cek tarif pengiriman ZDX Express untuk berbagai rute dan layanan. Dapatkan harga terbaik untuk pengiriman barang di seluruh Indonesia.' }}">
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
    "description": "Cek tarif pengiriman ZDX Express untuk berbagai rute dan layanan. Dapatkan harga terbaik untuk pengiriman barang di seluruh Indonesia.",
    "url": "{{ url('/tarif') }}",
    "mainEntity": {
        "@type": "Service",
        "name": "Layanan Cek Tarif ZDX Express",
        "description": "Layanan untuk menghitung tarif pengiriman barang di seluruh Indonesia",
        "provider": {
            "@type": "Organization",
            "name": "PT. Zindan Diantar Express"
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

<!-- CSS Khusus Halaman Rates (Tarif) -->
@vite(['resources/css/rates.css'])
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
                    <h2 class="text-xl font-bold text-white">Cek Tarif Pengiriman</h2>
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
                    <a href="{{ route('order.now') }}" id="calculate-rate" class="w-full bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-3 rounded-lg font-semibold hover:shadow-md transition-all duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Pesan Sekarang
                    </a>

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
            <a 
                id="request-special-offer"
                href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companyInfo->company_phone_cs1 ?? '6285814718888') }}?text={{ urlencode('Halo Admin ZDX Express,

Saya tertarik untuk mendapatkan penawaran khusus untuk pengiriman dalam jumlah besar.

Mohon informasi lebih lanjut mengenai layanan dan tarif spesial yang tersedia.

Terima kasih.') }}"
                onclick="requestSpecialOffer(event)"
                class="inline-block bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
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
        // Route untuk AJAX check rate
        const calculateRateUrl = "{{ url('/api/check-rate') }}";
        const csrfToken = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    </script>

    <!-- Script khusus halaman rates (tarif) -->
    @vite(['resources/js/rates.js'])
    @endpush
@endsection 