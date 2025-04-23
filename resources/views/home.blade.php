@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] }}</title>
<link rel="icon" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : $logoUrl }}">
<meta name="description" content="{{ $seoData['description'] }}">
<meta name="keywords" content="{{ $seoData['keywords'] }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] }} - PT. Zindan Diantar Express">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
@if($seoData['og_image'])
<meta property="og:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Custom Schema.org JSON-LD -->
@if($seoData['custom_schema'])
{!! $seoData['custom_schema'] !!}
@endif

<!-- CSS Khusus Halaman Home -->
@if(app()->environment('production'))
<link rel="stylesheet" href="{{ asset('css/home.min.css') }}">
@else
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
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

@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="relative overflow-hidden h-[94vh] flex items-center justify-center hero-section">
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
    <div class="relative w-full max-w-7xl mx-auto px-4 flex flex-col h-full justify-center z-10 pt-10 sm:pt-0 hero-content-mobile">
        <div class="text-center">
            <!-- Main headline dengan efek melayang -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-4 md:mb-6 tracking-tight text-white">
                @if(isset($homeContent['hero']))
                <span class="block mb-2 animate-fade-in-up" style="animation-delay: 0.3s">{{ Str::beforeLast($homeContent['hero']->title, '&') }}</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white to-[#FFF0E6] animate-fade-in-up" style="animation-delay: 0.6s">{{ Str::afterLast($homeContent['hero']->title, '&') }}</span>
                @else
                <span class="block mb-2 animate-fade-in-up" style="animation-delay: 0.3s">Solusi Pengiriman</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white to-[#FFF0E6] animate-fade-in-up" style="animation-delay: 0.6s">Cepat & Terpercaya</span>
                @endif
            </h1>

            <!-- Subheading dengan efek fade-in -->
            <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 text-white max-w-2xl mx-auto opacity-90 animate-fade-in-up" style="animation-delay: 0.9s">
                @if(isset($homeContent['hero']))
                {{ $homeContent['hero']->subtitle }}
                @else
                Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu
                @endif
            </p>

            <!-- CTA Buttons dengan desain yang lebih menarik -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10 sm:mb-12 animate-fade-in-up" style="animation-delay: 1.2s">
                @if(isset($homeContent['hero']) && $homeContent['hero']->button_text && $homeContent['hero']->button_url)
                <a href="{{ $homeContent['hero']->button_url }}" class="group relative px-6 py-3 sm:px-8 sm:py-4 rounded-full bg-white text-[#FF6000] font-semibold overflow-hidden transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                    <span class="relative z-10 text-sm sm:text-base flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        {{ $homeContent['hero']->button_text }}
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FFF0E6] to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                @else
                <a href="/tracking" class="group relative px-6 py-3 sm:px-8 sm:py-4 rounded-full bg-white text-[#FF6000] font-semibold overflow-hidden transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                    <span class="relative z-10 text-sm sm:text-base flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Lacak Pengiriman
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FFF0E6] to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                @endif
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
                @if(isset($homeContent) && isset($homeContent['stats']) && !empty($homeContent['stats']->metadata))
                    @php 
                        $statsData = json_decode($homeContent['stats']->metadata, true); 
                    @endphp
                    @if(isset($statsData['items']) && is_array($statsData['items']))
                        @foreach($statsData['items'] as $stat)
                        <div class="text-center bg-white/10 rounded-lg p-3 backdrop-blur-sm shadow-inner">
                            <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-1">
                                <span class="counter" data-target="{{ $stat['number'] }}">0</span>{{ $stat['symbol'] ?? '' }}
                            </div>
                            <div class="text-xs sm:text-sm text-white text-opacity-90 font-medium">{{ $stat['label'] }}</div>
                        </div>
                        @endforeach
                    @else
                        <!-- Fallback jika struktur items tidak ada -->
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
                    @endif
                @else
                    <!-- Fallback jika section stats tidak ada atau metadata kosong -->
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
                @endif
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
                    @if(isset($homeContent) && isset($homeContent['services']) && !empty($homeContent['services']->title))
                        {{ $homeContent['services']->title }}
                    @else
                        Layanan Kami
                    @endif
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] transform scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                    @if(isset($homeContent) && isset($homeContent['services']) && !empty($homeContent['services']->subtitle))
                        {{ $homeContent['services']->subtitle }}
                    @else
                        Kami menyediakan berbagai layanan pengiriman yang dirancang untuk memenuhi kebutuhan logistik Anda
                    @endif
                </p>
            </div>

            <!-- Services Cards dengan animasi hover -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-10">
                @if(isset($services) && is_object($services) && $services->count() > 0)
                    @php $displayedServices = $services->take(3); @endphp
                    @foreach($displayedServices as $service)
                    <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <div class="relative h-32 sm:h-40 md:h-48 overflow-hidden">
                            @if(isset($service->image) && !empty($service->image))
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="h-full w-full object-cover">
                            @else
                            <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] to-[#FF8C00]"></div>
                            <div class="absolute inset-0 bg-black opacity-10"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-white">
                                <i class="fas fa-box-open text-white text-5xl"></i>
                            </div>
                            @endif
                        </div>
                        <div class="p-4 sm:p-5 md:p-6">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 md:mb-3 text-gray-800 group-hover:text-[#FF6000] transition-colors duration-300">{{ $service->title }}</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-3 md:mb-4">{{ Str::limit($service->description, 80) }}</p>
                            <a href="/layanan/{{ $service->slug }}" class="inline-flex items-center text-sm sm:text-base font-medium text-[#FF6000] hover:text-[#E65100] transition-colors">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($services->count() > 3)
                    <div class="group col-span-3 mt-6 text-center" data-aos="fade-up">
                        <a href="/layanan" class="inline-flex items-center justify-center px-6 py-3 bg-[#FF6000] text-white font-semibold rounded-lg shadow-md hover:bg-[#E65100] transition-colors duration-300">
                            <span>Lihat {{ $services->count() - 3 }} Layanan Lainnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                    @endif
                @else
                    <!-- Fallback layanan jika tidak ada data -->
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
                    
                    <div class="group col-span-3 mt-6 text-center" data-aos="fade-up">
                        <a href="/layanan" class="inline-flex items-center justify-center px-6 py-3 bg-[#FF6000] text-white font-semibold rounded-lg shadow-md hover:bg-[#E65100] transition-colors duration-300">
                            <span>Lihat Layanan Lainnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                @endif
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
                        @if(isset($homeContent) && isset($homeContent['features']) && !empty($homeContent['features']->image_path))
                            <img src="{{ asset($homeContent['features']->image_path) }}" 
                                 alt="Features Image" 
                                 class="w-full h-auto rounded-2xl transform transition duration-700 hover:scale-105">
                        @else
                            <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                                 alt="Cargo Features" 
                                 class="w-full h-auto rounded-2xl transform transition duration-700 hover:scale-105">
                        @endif
                        <!-- Overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                        
                        <!-- Badge positioning -->
                        <div class="absolute top-4 left-4 bg-[#FF6000] text-white px-4 py-1 rounded-full text-sm font-semibold shadow-lg">
                            @if(isset($homeContent) && isset($homeContent['features']) && !empty($homeContent['features']->button_text))
                                {{ $homeContent['features']->button_text }}
                            @else
           
                            @endif
                        </div>
                    </div>
                    
                    <!-- Floating stats cards -->
                    <div class="absolute -bottom-8 -right-8 bg-white rounded-xl shadow-xl p-4 max-w-xs transform rotate-3 hover:rotate-0 transition-transform duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center">
                            <div>
                                <p class="text-[#FF6000] font-semibold">
                                    @if(isset($homeContent) && isset($homeContent['features']) && !empty($homeContent['features']->button_url))
                                        {{ $homeContent['features']->button_url }}
                                    @else
                        
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content Column -->
                <div class="order-1 md:order-2" data-aos="fade-left">
                    <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-xl p-8 shadow-lg border border-white/20">                     
                        <div class="space-y-6">
                            @if(isset($homeContent) && isset($homeContent['features']) && !empty($homeContent['features']->content))
                                {!! $homeContent['features']->content !!}
                            @else
                                <!-- Default Features -->
                                @include('partials.default-features')
                            @endif
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="mt-8" data-aos="fade-up" data-aos-delay="400">
                            <a href="{{ isset($homeContent['features']) && !empty($homeContent['features']->button_url) ? $homeContent['features']->button_url : '/profile' }}" 
                               class="inline-flex items-center px-6 py-3 bg-[#FF6000] text-white font-medium rounded-lg shadow-lg hover:bg-[#E65100] transition-colors duration-300">
                                {{ isset($homeContent['features']) && !empty($homeContent['features']->button_text) ? $homeContent['features']->button_text : 'Pelajari Lebih Lanjut' }}
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
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                            @if(isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->title))
                                {{ $homeContent['cta']->title }}
                            @else
                                Siap Mengirim Barang Anda?
                            @endif
                        </h2>
                        <p class="text-white text-opacity-90 text-lg mb-6">
                            @if(isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->subtitle))
                                {{ $homeContent['cta']->subtitle }}
                            @else
                                Dapatkan penawaran terbaik untuk pengiriman barang Anda dengan layanan berkualitas prima dan jangkauan luas.
                            @endif
                        </p>
                        
                        <!-- Checklist items -->
                        <div class="space-y-3 mb-8">
                            @if(isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->metadata))
                                @php
                                    $metadata = json_decode($homeContent['cta']->metadata, true);
                                    $benefits = $metadata['benefits'] ?? [
                                        'Tarif bersaing untuk semua jenis pengiriman',
                                        'Konsultasi gratis untuk kebutuhan logistik',
                                        'Jaminan kepuasan untuk setiap pengiriman'
                                    ];
                                @endphp
                                
                                @foreach($benefits as $benefit)
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-white">{{ $benefit }}</span>
                                </div>
                                @endforeach
                            @else
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
                            @endif
                        </div>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap gap-4">
                            @php
                                $ctaButtonText = isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->button_text) ? $homeContent['cta']->button_text : 'Hubungi Kami';
                                $ctaButtonUrl = isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->button_url) ? $homeContent['cta']->button_url : 'https://wa.me/'.$whatsappPhone;
                                
                                $ctaButton2Text = '';
                                $ctaButton2Url = '';
                                
                                if(isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->metadata)) {
                                    $ctaMetadata = json_decode($homeContent['cta']->metadata, true);
                                    $ctaButton2Text = $ctaMetadata['button2_text'] ?? 'Lacak Kiriman';
                                    $ctaButton2Url = $ctaMetadata['button2_url'] ?? '/tracking';
                                } else {
                                    $ctaButton2Text = 'Lacak Kiriman';
                                    $ctaButton2Url = '/tracking';
                                }
                                
                                // Jika URL adalah '/kontak', maka konversi ke WhatsApp
                                if($ctaButtonUrl == '/kontak') {
                                    $ctaButtonUrl = 'https://wa.me/'.$whatsappPhone.'?text='.urlencode('Halo Admin ZDX Express, Saya ingin menanyakan informasi lebih lanjut tentang layanan pengiriman dari ZDX Express. Mohon informasi lengkap mengenai layanan yang tersedia dan cara melakukan pemesanan. Terima kasih.');
                                }
                            @endphp
                            
                            <a href="{{ $ctaButtonUrl }}" {{ strpos($ctaButtonUrl, 'http') === 0 ? 'target="_blank"' : '' }} class="inline-flex items-center px-6 py-3 bg-white text-[#FF6000] font-semibold rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                                {{ $ctaButtonText }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </a>
                            <a href="{{ $ctaButton2Url }}" {{ strpos($ctaButton2Url, 'http') === 0 ? 'target="_blank"' : '' }} class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg transition-all duration-300 hover:bg-white/10">
                                {{ $ctaButton2Text }}
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
                                @if(isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->image_path))
                                    <img src="{{ asset('storage/' . $homeContent['cta']->image_path) }}" alt="CTA Image" class="w-full h-auto rounded-lg shadow">
                                @elseif(isset($homeContent) && isset($homeContent['cta']) && !empty($homeContent['cta']->metadata))
                                    @php
                                        $ctaMetadata = json_decode($homeContent['cta']->metadata, true);
                                        $imagePath = $ctaMetadata['image_path'] ?? 'https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80';
                                    @endphp
                                    <img src="{{ $imagePath }}" alt="CTA Image" class="w-full h-auto rounded-lg shadow">
                                @else
                                    <img src="https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Logistics Team" class="w-full h-auto rounded-lg shadow">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Clients -->
            <div class="mt-20 mb-10 text-center" data-aos="fade-up">
                <h3 class="text-xl text-white font-medium mb-8">Partner Terpercaya Kami</h3>
                
                <!-- Partner carousel -->
                <div class="swiper partner-carousel">
                    <div class="swiper-wrapper py-4">
                        @if(isset($partners) && is_object($partners) && $partners->count() > 0)
                            @foreach($partners as $partner)
                                <div class="swiper-slide">
                                    <div class="client-logo bg-white/10 p-6 rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105 h-40 flex flex-col items-center justify-center mx-2">
                                        @if(isset($partner->logo_path) && !empty($partner->logo_path))
                                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->company ?: ($partner->name ?? 'Partner') }}" class="max-h-24 max-w-full group-hover:grayscale-0 transition-all duration-300">
                                        @else
                                            <div class="w-20 h-20 bg-[#FFF0E6] rounded-full flex items-center justify-center mb-3">
                                                <span class="text-[#FF6000] text-2xl font-bold">{{ substr($partner->name ?? 'P', 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="text-center mt-3">
                                            <h3 class="text-sm font-medium text-white">{{ $partner->company ?: ($partner->name ?? 'Partner') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback partners jika tidak ada data -->
                            @for($i = 1; $i <= 5; $i++)
                                <div class="swiper-slide">
                                    <div class="client-logo bg-white/10 p-6 rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105 h-40 flex flex-col items-center justify-center mx-2">
                                        <img src="{{ asset('asset/images/client'.$i.'.png') }}" alt="Client {{ $i }}" class="max-h-24 max-w-full filter grayscale hover:grayscale-0 transition-all duration-300">
                                        <div class="text-center mt-3">
                                            <h3 class="text-sm font-medium text-white">Partner {{ $i }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<!-- Library yang dibutuhkan -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<!-- Swiper.js untuk carousel -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<!-- Script khusus halaman home -->
@if(app()->environment('production'))
<script src="{{ asset('js/home.min.js') }}"></script>
@else
<script src="{{ asset('js/home.js') }}"></script>
@endif

<!-- Konfigurasi Partner Carousel -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const partnerSwiper = new Swiper('.partner-carousel', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        allowTouchMove: false,
        cssMode: false,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        }
    });
});
</script>
@endpush 