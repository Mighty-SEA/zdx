@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] }}</title>
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

<!-- Custom Schema.org JSON-LD -->
@if($seoData['custom_schema'])
{!! $seoData['custom_schema'] !!}
@endif
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Layanan Kami</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Solusi logistik lengkap yang dirancang untuk memenuhi semua kebutuhan pengiriman Anda
            </p>
        </div>
    </div>

    <!-- Services Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <!-- Darat Service -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="h-48 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                    <i class="fas fa-truck text-white text-7xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">Pengiriman Darat</h3>
                    <p class="text-gray-600 mb-6">
                        Layanan pengiriman darat yang cepat dan andal ke seluruh Indonesia. 
                        Kami menawarkan solusi yang efisien untuk pengiriman jarak dekat hingga menengah.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman dari kota ke kota</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman dalam kota</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman barang berat</span>
                        </li>
                    </ul>
                    <a href="/kontak" class="inline-block bg-[#FF6000] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Laut Service -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="h-48 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                    <i class="fas fa-ship text-white text-7xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">Pengiriman Laut</h3>
                    <p class="text-gray-600 mb-6">
                        Solusi pengiriman melalui jalur laut untuk barang dalam jumlah besar. 
                        Ideal untuk pengiriman antar pulau dengan biaya yang kompetitif.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman antar pulau</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman kontainer</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Jasa forwarding internasional</span>
                        </li>
                    </ul>
                    <a href="/kontak" class="inline-block bg-[#FF6000] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Udara Service -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="h-48 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                    <i class="fas fa-plane text-white text-7xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">Pengiriman Udara</h3>
                    <p class="text-gray-600 mb-6">
                        Layanan pengiriman cepat melalui udara untuk kebutuhan mendesak dan barang berharga. 
                        Dijamin cepat sampai di tujuan.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman ekspres</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman dokumen penting</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-[#FF6000] mt-1 mr-2"></i>
                            <span>Pengiriman barang berharga</span>
                        </li>
                    </ul>
                    <a href="/kontak" class="inline-block bg-[#FF6000] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Services -->
        <h2 class="text-3xl font-bold text-center mb-12">Layanan Tambahan</h2>
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
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-black to-[#333333] py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Butuh Layanan Khusus?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Kami siap menyediakan solusi logistik yang disesuaikan dengan kebutuhan spesifik bisnis Anda
            </p>
            <a href="/kontak" class="inline-block bg-[#FF6000] text-white px-8 py-4 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                Konsultasi Gratis
            </a>
        </div>
    </div>
@endsection 