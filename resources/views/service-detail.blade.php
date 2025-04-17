@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] }}</title>
<link rel="icon" href="{{ asset('asset/logo.png') }}">
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
    <div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] py-20">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-2/3">
                    <div class="mb-2">
                        <a href="{{ url('/layanan') }}" class="text-white hover:text-gray-200 inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Layanan
                        </a>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $service->title }}</h1>
                    <p class="text-xl text-gray-200 max-w-3xl">
                        {{ $service->description }}
                    </p>
                </div>
                @if($service->image)
                <div class="md:w-1/3 mt-6 md:mt-0 flex justify-center">
                    <div class="w-64 h-64 overflow-hidden rounded-lg shadow-xl">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="prose prose-lg max-w-none">
                    {!! $service->content !!}
                </div>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="mt-12 bg-[#FFF0E6] rounded-xl p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tertarik dengan layanan ini?</h2>
            <p class="text-gray-600 mb-6 max-w-3xl mx-auto">
                Konsultasikan kebutuhan pengiriman Anda dengan tim kami dan dapatkan solusi terbaik untuk bisnis Anda.
            </p>
            <a href="/kontak" class="inline-block bg-[#FF6000] text-white px-8 py-4 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                Hubungi Kami
            </a>
        </div>
    </div>
    
    <!-- Related Services (if any) -->
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Layanan Lainnya</h2>
            <div class="flex items-center justify-center space-x-4">
                <a href="/layanan" class="bg-white py-3 px-6 rounded-lg shadow hover:shadow-md transition-all">
                    Lihat Semua Layanan
                </a>
                <a href="/kontak" class="bg-[#FF6000] text-white py-3 px-6 rounded-lg shadow hover:shadow-md transition-all">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
@endsection 