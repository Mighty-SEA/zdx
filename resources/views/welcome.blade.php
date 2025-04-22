@extends('layouts.app')

@section('meta_tags')
    <title>{{ $seoData['title'] ?? 'PT. Zindan Diantar Express - Jasa Pengiriman Barang Terpercaya' }}</title>
    <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
    <meta name="description" content="{{ $seoData['description'] ?? 'Jasa pengiriman barang darat, laut, dan udara terpercaya di Indonesia.' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'pengiriman barang, cargo, ekspedisi, jasa kirim, logistik, zdx, zindan express' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/') }}">
    
    <!-- Robots Meta -->
    <meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seoData['og_title'] ?? 'PT. Zindan Diantar Express - Jasa Pengiriman Barang Terpercaya' }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? 'Jasa pengiriman barang darat, laut, dan udara terpercaya di Indonesia.' }}">
    @if(isset($seoData['og_image']))
    <meta property="og:image" content="{{ asset($seoData['og_image']) }}">
    @endif
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? $seoData['og_title'] ?? 'PT. Zindan Diantar Express - Jasa Pengiriman Barang Terpercaya' }}">
    <meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? $seoData['og_description'] ?? 'Jasa pengiriman barang darat, laut, dan udara terpercaya di Indonesia.' }}">
    @if(isset($seoData['twitter_image']))
    <meta name="twitter:image" content="{{ asset($seoData['twitter_image']) }}">
    @elseif(isset($seoData['og_image']))
    <meta name="twitter:image" content="{{ asset($seoData['og_image']) }}">
    @endif
    
    <!-- Custom Schema.org JSON-LD -->
    @if(isset($seoData['custom_schema']))
    {!! $seoData['custom_schema'] !!}
    @else
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "PT. Zindan Diantar Express",
        "url": "{{ url('/') }}",
        "logo": "{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}",
        "description": "Jasa pengiriman barang darat, laut, dan udara terpercaya di Indonesia.",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $companyInfo->company_phone ?? '+62-21-38711144' }}",
            "contactType": "customer service",
            "areaServed": "ID",
            "availableLanguage": "id"
        }
    }
    </script>
    @endif
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative py-16 px-4 sm:px-6 lg:px-8">
                <div class="mt-10 text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Visi</span>
                    </h1>
                    <p class="mt-5 max-w-3xl mx-auto text-xl text-gray-600">
                        Menjadi perusahaan terbaik dan terpercaya dalam bidang jasa pengiriman barang diwilayah Indonesia dengan memberikan jasa layanan yang berkualitas dan terpercaya
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Layanan Kami
                </h2>
                <p class="mt-4 text-xl text-gray-500">
                    Darat - Laut - Udara
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Service 1 -->
                    <div class="bg-gray-50 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Zindan Diantar Express Udara
                            </h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <p>Metode pengiriman melalui transportasi udara.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-gray-50 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Zindan Diantar Express Darat
                            </h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <p>Metode pengiriman melalui transportasi darat.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-gray-50 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Zindan Diantar Express Laut
                            </h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <p>Metode pengiriman melalui transportasi laut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-indigo-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <span class="text-5xl font-extrabold text-white">0</span>
                    <p class="mt-2 text-xl font-medium text-white">PARTNER</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl font-extrabold text-white">0</span>
                    <p class="mt-2 text-xl font-medium text-white">PROJECT</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl font-extrabold text-white">0</span>
                    <p class="mt-2 text-xl font-medium text-white">SUCCESS</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl font-extrabold text-white">0</span>
                    <p class="mt-2 text-xl font-medium text-white">COUNTRY</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Brand Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-8">
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
            </div>
            <div class="mt-8 grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-4">
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">zdx</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">zdx</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">zdx</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
            </div>
            <div class="mt-8 grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-3">
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">Zindan Diantar Express</span>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-gray-500">zdx</span>
                </div>
            </div>
        </div>
    </div>
@endsection 