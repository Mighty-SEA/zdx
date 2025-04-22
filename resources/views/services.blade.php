@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] }}</title>
<link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
<meta name="description" content="{{ $seoData['description'] }}">
<meta name="keywords" content="{{ $seoData['keywords'] }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] }}">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
@if($seoData['og_image'])
<meta property="og:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? $seoData['og_title'] ?? $seoData['title'] }}">
<meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? $seoData['og_description'] ?? $seoData['description'] }}">
@if(isset($seoData['twitter_image']))
<meta name="twitter:image" content="{{ asset($seoData['twitter_image']) }}">
@elseif($seoData['og_image'])
<meta name="twitter:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Custom Schema.org JSON-LD -->
@if($seoData['custom_schema'])
{!! $seoData['custom_schema'] !!}
@else
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Layanan PT. Zindan Diantar Express",
    "description": "Daftar layanan pengiriman dan logistik yang disediakan oleh PT. Zindan Diantar Express",
    "url": "{{ url('/layanan') }}",
    "itemListElement": [
        @foreach($services as $index => $service)
        {
            "@type": "ListItem",
            "position": {{ $loop->iteration }},
            "name": "{{ $service->title }}",
            "description": "{{ $service->description }}",
            "url": "{{ url('/layanan/' . $service->slug) }}"
        }{{ $index < $services->count() - 1 ? ',' : '' }}
        @endforeach
    ]
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

// Get raw phone number for WhatsApp
$whatsappPhone = preg_replace('/[^0-9]/', '', $companyInfo->company_phone ?? '');
// Get formatted phone for display
$displayPhone = formatPhoneNumber($companyInfo->company_phone ?? '');
@endphp
@endsection

@section('content')

    <!-- Services Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            @foreach($services as $service)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="h-48 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                    @if($service->image)
                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="h-full w-full object-cover">
                    @else
                    <i class="fas fa-box-open text-white text-7xl"></i>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $service->title }}</h3>
                    <p class="text-gray-600 mb-6">
                        {{ $service->description }}
                    </p>
                    <a href="/layanan/{{ $service->slug }}" class="inline-block bg-[#FF6000] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                        Selengkapnya
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else

        @endif

        <!-- Additional Services -->
        {{-- <h2 class="text-3xl font-bold text-center mb-12">Layanan Tambahan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Warehousing -->
            <div class="bg-white p-8 rounded-xl shadow-lg flex">
                <div class="text-4xl text-[#FF6000] mr-6">
                    <i class="fas fa-warehouse"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Pergudangan</h3>
                    <p class="text-gray-600">
                        Layanan penyimpanan barang dengan fasilitas gudang modern dan sistem manajemen inventaris yang efisien.
                        Kami menawarkan solusi pergudangan jangka pendek maupun jangka panjang.
                    </p>
                </div>
            </div>

            <!-- Packaging -->
            <div class="bg-white p-8 rounded-xl shadow-lg flex">
                <div class="text-4xl text-[#FF6000] mr-6">
                    <i class="fas fa-box"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Pengemasan</h3>
                    <p class="text-gray-600">
                        Layanan pengemasan profesional untuk memastikan barang Anda terlindungi dengan baik selama pengiriman.
                        Tersedia berbagai jenis kemasan sesuai kebutuhan.
                    </p>
                </div>
            </div>

            <!-- Tracking -->
            <div class="bg-white p-8 rounded-xl shadow-lg flex">
                <div class="text-4xl text-[#FF6000] mr-6">
                    <i class="fas fa-search-location"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Pelacakan Realtime</h3>
                    <p class="text-gray-600">
                        Pantau status pengiriman Anda secara realtime melalui sistem pelacakan online kami.
                        Dapatkan informasi terkini tentang lokasi dan status barang Anda.
                    </p>
                </div>
            </div>

            <!-- Insurance -->
            <div class="bg-white p-8 rounded-xl shadow-lg flex">
                <div class="text-4xl text-[#FF6000] mr-6">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Asuransi Pengiriman</h3>
                    <p class="text-gray-600">
                        Layanan asuransi untuk melindungi barang Anda dari risiko kerusakan atau kehilangan selama proses pengiriman.
                        Berikan ketenangan pikiran dengan perlindungan ekstra.
                    </p>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-black to-[#333333] py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Butuh Layanan Khusus?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Kami siap menyediakan solusi logistik yang disesuaikan dengan kebutuhan spesifik bisnis Anda
            </p>
            <a href="https://wa.me/{{ $whatsappPhone }}?text={{ urlencode('Halo Admin ZDX Express,

Saya tertarik untuk konsultasi gratis mengenai layanan logistik khusus untuk bisnis kami.

Mohon informasi lebih lanjut untuk layanan yang dapat disesuaikan dengan kebutuhan bisnis kami.

Terima kasih.') }}" target="_blank" class="inline-block bg-[#FF6000] text-white px-8 py-4 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                Konsultasi Gratis
            </a>
        </div>
    </div>
@endsection 