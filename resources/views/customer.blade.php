@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] ?? 'Pelanggan / Partner ZDX - PT. Zindan Diantar Express' }}</title>
<link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
<meta name="description" content="{{ $seoData['description'] ?? 'Pelanggan dan partner terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.' }}">
<meta name="keywords" content="{{ $seoData['keywords'] ?? 'pelanggan zdx, partner zdx, customer logistik, partner logistik, testimonial pengiriman, cargo customer' }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/customer') }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] ?? 'Pelanggan / Partner ZDX - PT. Zindan Diantar Express' }}">
<meta property="og:description" content="{{ $seoData['og_description'] ?? 'Pelanggan dan partner terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.' }}">
@if(isset($seoData['og_image']))
<meta property="og:image" content="{{ $seoData['og_image'] }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? $seoData['og_title'] ?? 'Pelanggan / Partner ZDX - PT. Zindan Diantar Express' }}">
<meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? $seoData['og_description'] ?? 'Pelanggan dan partner terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.' }}">
@if(isset($seoData['twitter_image']))
<meta name="twitter:image" content="{{ $seoData['twitter_image'] }}">
@elseif(isset($seoData['og_image']))
<meta name="twitter:image" content="{{ $seoData['og_image'] }}">
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
    "url": "{{ url('/customer') }}",
    "description": "Pelanggan dan partner terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo",
    "logo": "{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}",
    "member": [
        @foreach($partners as $index => $partner)
        {
            "@type": "Organization",
            "name": "{{ $partner->company ?: $partner->name }}",
            "description": "{{ $partner->industry ?? 'Business Partner' }}"
        }{{ $index < $partners->count() - 1 ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
@endsection

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')

<!-- Customers Section -->
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Pelanggan & Partner ZDX</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Beberapa perusahaan terkemuka yang telah bermitra dan menjadi pelanggan ZDX Cargo untuk kebutuhan logistik mereka.</p>
        </div>

        <!-- Customers & Partners Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @if($partners->count() > 0)
                @foreach($partners as $partner)
                <div class="partner-item">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 h-48 flex flex-col items-center justify-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @if($partner->logo_path)
                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-24 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                        @else
                            <div class="w-20 h-20 bg-[#FFF0E6] rounded-full flex items-center justify-center mb-3">
                                <span class="text-[#FF6000] text-2xl font-bold">{{ substr($partner->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="text-center mt-4">
                            <h3 class="text-base font-medium text-gray-800">{{ $partner->company ?: $partner->name }}</h3>
                            @if($partner->industry)
                                <p class="text-sm text-gray-500 mt-1">{{ $partner->industry }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-16">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Data</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Data pelanggan dan partner bisnis akan ditampilkan di sini. Hubungi administrator untuk menambahkan data.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Join as Customer CTA -->
<div class="py-16 bg-gradient-to-r from-[#E65100] to-[#FF6000]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Bergabunglah dengan Pelanggan & Partner ZDX Cargo</h2>
        <p class="text-lg text-white/90 max-w-3xl mx-auto mb-8">Dapatkan solusi pengiriman yang handal, cepat, dan efisien untuk kebutuhan bisnis Anda. Kami siap menjadi mitra logistik terpercaya Anda.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/contact" class="px-8 py-3 bg-white text-[#FF6000] rounded-lg font-semibold shadow-md hover:bg-gray-100 transition-colors">Hubungi Kami</a>
            <a href="/rates" class="px-8 py-3 bg-[#FF8C00] text-white rounded-lg font-semibold shadow-md hover:bg-[#E65100] transition-colors">Lihat Tarif</a>
        </div>
    </div>
</div>

@endsection 