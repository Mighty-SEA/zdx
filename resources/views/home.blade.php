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
    <div class="relative overflow-hidden h-screen flex items-center justify-center">
        <!-- Background dengan efek gradient yang lebih menarik -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] via-[#FF8C00] to-[#E65100]">
            <!-- Pattern overlay untuk tekstur -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNGM2LjYyNyAwIDEyLTQh1Y1JjA3yW21RewAhxjanvaUoSkVZF3PxMCAyNCAxNS4zNzMgMjQgMjJzNS4zNzMgMTQh1Y1JjA3yW21RewAhxjanvaUoSkVZF3PiIHN0cm9rZS13aWR0aD0iMiIvPjwvZz48L3N2Zz4=')] opacity-10"></div>
        </div>

        <!-- Floating Elements dengan efek blur yang lebih menarik -->
        <div class="absolute top-1/4 left-1/4 w-32 h-32 md:w-80 md:h-80 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-36 h-36 md:w-96 md:h-96 bg-[#FF8C00] rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-40 h-40 md:w-96 md:h-96 bg-[#E65100] rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        
        <!-- Particle effect (Latar belakang dengan titik-titik) -->
        <div class="absolute inset-0 overflow-hidden" id="particles-js"></div>

        <!-- Hero Content dengan desain yang lebih menarik -->
        <div class="relative w-full max-w-7xl mx-auto px-4 flex flex-col h-full justify-center z-10">
            <div class="text-center">
                <!-- Logo Animation -->
                <div class="mb-6 md:mb-8 transform transition-all duration-1000">
                    <img src="{{ asset('asset/logo.png') }}" alt="ZDX Logo" class="h-20 md:h-24 mx-auto animate-float">
                </div>

                <!-- Main headline dengan efek melayang -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-4 md:mb-6 tracking-tight text-white">
                    <span class="block mb-2 animate-fade-in-up" style="animation-delay: 0.3s">Solusi Pengiriman</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white to-[#FFF0E6] animate-fade-in-up" style="animation-delay: 0.6s">Cepat & Terpercaya</span>
                </h1>

                <!-- Subheading dengan efek fade-in -->
                <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 text-white max-w-2xl mx-auto opacity-90 animate-fade-in-up" style="animation-delay: 0.9s">
                    Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu
                </p>

                <!-- CTA Buttons dengan desain yang lebih menarik -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10 sm:mb-12 animate-fade-in-up" style="animation-delay: 1.2s">
                    <a href="/tracking" class="group relative px-6 py-3 sm:px-8 sm:py-4 rounded-full bg-white text-[#FF6000] font-semibold overflow-hidden transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="relative z-10 text-sm sm:text-base flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Lacak Pengiriman
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFF0E6] to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <a href="/tarif" class="group relative px-6 py-3 sm:px-8 sm:py-4 rounded-full border-2 border-white text-white font-semibold overflow-hidden transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="relative z-10 text-sm sm:text-base flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Cek Tarif
                        </span>
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </a>
                </div>

                <!-- Stats Section dengan animasi -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 bg-white/10 backdrop-blur-md p-6 rounded-xl animate-fade-in-up" style="animation-delay: 1.5s">
                    <div class="text-center bg-white/10 rounded-lg p-3 backdrop-blur-sm shadow-inner">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-1">
                            <span class="counter" data-target="10000">0</span>+
                        </div>
                        <div class="text-xs sm:text-sm text-white text-opacity-90 font-medium">Partner</div>
                    </div>
                    <div class="text-center bg-white/10 rounded-lg p-3 backdrop-blur-sm shadow-inner">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-1">
                            <span class="counter" data-target="100">0</span>+
                        </div>
                        <div class="text-xs sm:text-sm text-white text-opacity-90 font-medium">Project</div>
                    </div>
                    <div class="text-center bg-white/10 rounded-lg p-3 backdrop-blur-sm shadow-inner">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-1">
                            <span class="counter" data-target="24">0</span>/7
                        </div>
                        <div class="text-xs sm:text-sm text-white text-opacity-90 font-medium">Success</div>
                    </div>
                    <div class="text-center bg-white/10 rounded-lg p-3 backdrop-blur-sm shadow-inner">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-1">
                            <span class="counter" data-target="99">0</span>%
                        </div>
                        <div class="text-xs sm:text-sm text-white text-opacity-90 font-medium">Country</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator yang lebih menarik -->

    </div>

    <!-- Services Section -->
    <div class="relative overflow-hidden py-20">
        <!-- Background abstrak untuk services section -->
        <div class="absolute inset-0 bg-white">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-20 right-20 w-72 h-72 bg-[#FF6000] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <div class="absolute bottom-20 left-20 w-80 h-80 bg-[#FF8C00] rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative">
            <!-- Section Header dengan animasi -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="inline-block text-3xl sm:text-4xl font-bold relative">
                    Layanan Kami
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] transform scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">Kami menyediakan berbagai layanan pengiriman yang dirancang untuk memenuhi kebutuhan logistik Anda</p>
            </div>

            <!-- Services Cards dengan animasi hover -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-10">
                <!-- Service Card 1 -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-32 sm:h-40 md:h-48 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] to-[#FF8C00]"></div>
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 md:mb-3 text-gray-800 group-hover:text-[#FF6000] transition-colors duration-300">Pengiriman Darat</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 md:mb-4">Layanan pengiriman darat cepat dan aman ke seluruh Indonesia.</p>
                        <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 md:mb-4">
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Tepat Waktu</span>
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Aman</span>
                        </div>
                        <a href="/layanan" class="inline-flex items-center text-sm sm:text-base font-medium text-[#FF6000] hover:text-[#E65100] transition-colors">
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-32 sm:h-40 md:h-48 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] to-[#FF8C00]"></div>
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 md:mb-3 text-gray-800 group-hover:text-[#FF6000] transition-colors duration-300">Pengiriman Laut</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 md:mb-4">Solusi pengiriman laut efisien untuk barang dalam jumlah besar.</p>
                        <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 md:mb-4">
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Volume Besar</span>
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Ekonomis</span>
                        </div>
                        <a href="/layanan" class="inline-flex items-center text-sm sm:text-base font-medium text-[#FF6000] hover:text-[#E65100] transition-colors">
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-32 sm:h-40 md:h-48 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] to-[#FF8C00]"></div>
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 md:mb-3 text-gray-800 group-hover:text-[#FF6000] transition-colors duration-300">Pengiriman Udara</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 md:mb-4">Pengiriman cepat melalui udara untuk kebutuhan mendesak.</p>
                        <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 md:mb-4">
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Super Cepat</span>
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Prioritas</span>
                        </div>
                        <a href="/layanan" class="inline-flex items-center text-sm sm:text-base font-medium text-[#FF6000] hover:text-[#E65100] transition-colors">
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 4 (tambahan, bisa dihapus jika tidak diperlukan) -->
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative h-32 sm:h-40 md:h-48 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] to-[#FF8C00]"></div>
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 md:mb-3 text-gray-800 group-hover:text-[#FF6000] transition-colors duration-300">Logistik E-commerce</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 md:mb-4">Solusi pengiriman khusus untuk kebutuhan bisnis online Anda.</p>
                        <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 md:mb-4">
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">Fulfillment</span>
                            <span class="px-2 py-1 bg-[#FFF0E6] text-[#FF6000] text-xs font-medium rounded-full">COD</span>
                        </div>
                        <a href="/layanan" class="inline-flex items-center text-sm sm:text-base font-medium text-[#FF6000] hover:text-[#E65100] transition-colors">
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gradient-to-b from-white to-[#FFF0E6] py-24 relative overflow-hidden">
        <!-- Elemen dekoratif -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-[#FF6000] rounded-full opacity-10"></div>
            <div class="absolute top-1/4 right-0 w-60 h-60 bg-[#FF8C00] rounded-full opacity-5"></div>
            <div class="absolute bottom-0 left-1/4 w-80 h-80 bg-[#E65100] rounded-full opacity-5"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <!-- Image Column with floating effect -->
                <div class="relative order-2 md:order-1" data-aos="fade-right">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                             alt="Cargo Features" 
                             class="w-full h-auto rounded-2xl transform transition duration-700 hover:scale-105">
                        <!-- Overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                        
                        <!-- Badge positioning -->
                        <div class="absolute top-4 left-4 bg-[#FF6000] text-white px-4 py-1 rounded-full text-sm font-semibold shadow-lg">
                            Terpercaya
                        </div>
                    </div>
                    
                    <!-- Floating stats cards -->
                    <div class="absolute -bottom-8 -right-8 bg-white rounded-xl shadow-xl p-4 max-w-xs transform rotate-3 hover:rotate-0 transition-transform duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center">
                            <div class="bg-[#FFF0E6] rounded-full p-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[#FF6000] font-semibold">Pengiriman Tepat Waktu</p>
                                <p class="text-gray-600 text-sm">98% pengiriman tepat waktu</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content Column -->
                <div class="order-1 md:order-2" data-aos="fade-left">
                    <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-xl p-8 shadow-lg border border-white/20">
                        <h2 class="text-3xl sm:text-4xl font-bold mb-6 text-gray-800 relative inline-block">
                            Mengapa Memilih Kami?
                            <div class="h-1 w-1/2 bg-[#FF6000] absolute bottom-0 left-0 rounded-full"></div>
                        </h2>
                        
                        <p class="text-gray-600 mb-8">
                            ZDX menyediakan solusi logistik terbaik dengan komitmen untuk kualitas, keandalan, dan kepuasan pelanggan. Kami hadir untuk menjawab kebutuhan pengiriman Anda.
                        </p>
                        
                        <div class="space-y-6">
                            <!-- Feature 1 -->
                            <div class="flex items-start transition-all duration-300 hover:translate-x-2" data-aos="fade-up" data-aos-delay="100">
                                <div class="bg-[#FFF0E6] rounded-lg p-3 mr-5 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            </div>
                            <div>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Layanan 24/7</h3>
                                    <p class="text-gray-600">Tim dukungan pelanggan kami siap membantu Anda sepanjang waktu, memberikan bantuan kapanpun Anda membutuhkannya.</p>
                                </div>
                            </div>
                            
                            <!-- Feature 2 -->
                            <div class="flex items-start transition-all duration-300 hover:translate-x-2" data-aos="fade-up" data-aos-delay="200">
                                <div class="bg-[#FFF0E6] rounded-lg p-3 mr-5 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Keamanan Terjamin</h3>
                                    <p class="text-gray-600">Kami memprioritaskan keamanan dengan sistem pelacakan real-time dan kemasan yang aman untuk barang Anda.</p>
                        </div>
                            </div>
                            
                            <!-- Feature 3 -->
                            <div class="flex items-start transition-all duration-300 hover:translate-x-2" data-aos="fade-up" data-aos-delay="300">
                                <div class="bg-[#FFF0E6] rounded-lg p-3 mr-5 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                            </div>
                            <div>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Harga Kompetitif</h3>
                                    <p class="text-gray-600">Kami menawarkan tarif yang bersaing dengan komitmen tanpa biaya tersembunyi untuk semua layanan kami.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="mt-8" data-aos="fade-up" data-aos-delay="400">
                            <a href="/profile" class="inline-flex items-center px-6 py-3 bg-[#FF6000] text-white font-medium rounded-lg shadow-lg hover:bg-[#E65100] transition-colors duration-300">
                                Pelajari Lebih Lanjut
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative py-20 overflow-hidden">
        <!-- Background dengan gradien dan pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] via-[#FF8C00] to-[#1A1A1A]">
            <!-- Pattern overlay untuk tekstur -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNGM2LjYyNyAwIDEyLTUuMzczIDEyLTEyUzQyLjYyNyAxMCAzNiAxMCAyNCAxNS4zNzMgMjQgMjJzNS4zNzMgMTIgMTIgMTJ6IiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIvPjwvZz48L3N2Zz4=')] opacity-10"></div>
        </div>
        
        <!-- Wave effect di atas -->
        <div class="absolute top-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200" class="fill-white">
                <path d="M0,96L48,101.3C96,107,192,117,288,106.7C384,96,480,64,576,64C672,64,768,96,864,122.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>
        
        <!-- Content container -->
        <div class="max-w-7xl mx-auto px-6 py-12 relative">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 md:p-12 shadow-xl border border-white/20">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <!-- Left Column -->
                    <div data-aos="fade-right" class="order-2 md:order-1">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Mengirim Barang Anda?</h2>
                        <p class="text-white text-opacity-90 text-lg mb-6">
                            Dapatkan penawaran terbaik untuk pengiriman barang Anda dengan layanan berkualitas prima dan jangkauan luas.
                        </p>
                        
                        <!-- Checklist items -->
                        <div class="space-y-3 mb-8">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">Tarif bersaing untuk semua jenis pengiriman</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">Konsultasi gratis untuk kebutuhan logistik</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">Jaminan kepuasan untuk setiap pengiriman</span>
                            </div>
                        </div>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap gap-4">
                            <a href="/contact" class="inline-flex items-center px-6 py-3 bg-white text-[#FF6000] font-semibold rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </a>
                            <a href="/tracking" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg transition-all duration-300 hover:bg-white/10">
                                Lacak Kiriman
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="flex justify-center order-1 md:order-2" data-aos="fade-left">
                        <!-- 3D Floating Image -->
                        <div class="relative w-full max-w-md">
                            <div class="absolute top-0 left-0 right-0 bottom-0 bg-[#FF6000]/20 rounded-xl blur-2xl"></div>
                            <div class="relative bg-white p-6 rounded-xl shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-500">
                                <img src="https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Logistics Team" class="w-full h-auto rounded-lg shadow">
                                
                                <!-- Badge -->
                                <div class="absolute -top-4 -right-4 bg-[#FF6000] text-white rounded-full w-20 h-20 flex items-center justify-center shadow-lg transform rotate-12">
                                    <div class="text-center leading-tight">
                                        <div class="text-xs">MULAI</div>
                                        <div class="font-bold text-lg">HARI INI</div>
                                    </div>
                                </div>
                                
                                <!-- Quote -->
                                <div class="bg-white shadow-lg rounded-lg p-4 absolute -bottom-5 -left-5 max-w-xs transform -rotate-6 hover:rotate-0 transition-all duration-300">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF6000] mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        <p class="text-gray-600 text-sm">
                                            "Layanan terbaik yang pernah kami gunakan untuk logistik perusahaan kami."
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Clients -->
            <div class="mt-20 mb-0 text-center" data-aos="fade-up">
                <h3 class="text-xl text-white font-medium mb-8">Dipercaya oleh Perusahaan Terkemuka</h3>
                <div class="flex flex-wrap justify-center gap-8 items-center">
                    <img src="{{ asset('asset/images/client1.png') }}" alt="Client 1" class="h-12 opacity-80 hover:opacity-100 transition-opacity duration-300 filter brightness-0 invert">
                    <img src="{{ asset('asset/images/client2.png') }}" alt="Client 2" class="h-12 opacity-80 hover:opacity-100 transition-opacity duration-300 filter brightness-0 invert">
                    <img src="{{ asset('asset/images/client3.png') }}" alt="Client 3" class="h-12 opacity-80 hover:opacity-100 transition-opacity duration-300 filter brightness-0 invert">
                    <img src="{{ asset('asset/images/client4.png') }}" alt="Client 4" class="h-12 opacity-80 hover:opacity-100 transition-opacity duration-300 filter brightness-0 invert">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- AOS - Animate On Scroll Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    
    <script>
        /* Initialize AOS */
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
        
        /* Particle JS Config */
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    "particles": {
                        "number": {
                            "value": 80,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": "#ffffff"
                        },
                        "shape": {
                            "type": "circle",
                            "stroke": {
                                "width": 0,
                                "color": "#000000"
                            }
                        },
                        "opacity": {
                            "value": 0.5,
                            "random": false
                        },
                        "size": {
                            "value": 3,
                            "random": true
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.4,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": 2,
                            "direction": "none",
                            "random": false,
                            "straight": false,
                            "out_mode": "out",
                            "bounce": false
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "repulse"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        }
                    },
                    "retina_detect": true
                });
            }
        });

        /* Counter Animation */
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200; // Kecepatan animasi (ms)

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => animateCounter(counter), 1);
                } else {
                    counter.innerText = target;
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
    
    <style>
        /* Tambahkan CSS untuk animasi */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            opacity: 0;
            animation: fade-in-up 0.8s ease forwards;
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
    @endpush
@endsection 