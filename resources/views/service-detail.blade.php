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
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $seoData['og_title'] }}">
<meta name="twitter:description" content="{{ $seoData['og_description'] }}">
@if($seoData['og_image'])
<meta name="twitter:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Custom Schema.org JSON-LD -->
@if($seoData['custom_schema'])
{!! $seoData['custom_schema'] !!}
@endif
@endsection

@section('content')
<!-- Header Section -->
<div class="max-w-6xl mx-auto px-4 pt-12 pb-8">
    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $service->title }}</h1>
    
    <div class="flex items-center text-base text-gray-500 mb-8">
        <span class="flex items-center mr-6">
            <i class="far fa-calendar-alt mr-2"></i> Updated: {{ now()->format('d M Y') }}
        </span>
        <span class="flex items-center">
            <i class="far fa-clock mr-2"></i> {{ ceil(str_word_count(strip_tags($service->content)) / 200) }} min read
        </span>
    </div>
    
    <p class="text-xl md:text-2xl text-gray-700 max-w-4xl leading-relaxed">
        {{ $service->description }}
    </p>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4">
    <div class="flex flex-col md:flex-row gap-10">
        <!-- Left Content -->
        <div class="w-full md:w-2/3">
            <!-- Feature Image -->
            @if($service->image)
            <div class="mb-10 rounded-xl overflow-hidden">
                <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="w-full h-auto object-cover">
            </div>
            @endif
            
            <!-- Content -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-10 shadow-sm">
                <div class="p-8 md:p-10">
                    <div class="prose prose-xl prose-headings:font-bold prose-headings:text-gray-900 prose-p:text-gray-700 prose-ul:my-6 prose-ul:list-disc prose-li:my-2 max-w-none">
                        {!! $service->content !!}
                    </div>
                </div>
            </div>
            
            <!-- Key Benefits -->
            
            <!-- Share -->
            <div class="mb-20">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Bagikan</h3>
                <div class="flex gap-3">
                    <a href="#" class="bg-[#25D366] text-white p-3 rounded-full hover:opacity-90 w-12 h-12 flex items-center justify-center">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="#" class="bg-[#1877F2] text-white p-3 rounded-full hover:opacity-90 w-12 h-12 flex items-center justify-center">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="bg-[#1DA1F2] text-white p-3 rounded-full hover:opacity-90 w-12 h-12 flex items-center justify-center">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="bg-[#0A66C2] text-white p-3 rounded-full hover:opacity-90 w-12 h-12 flex items-center justify-center">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="w-full md:w-1/3">
            <!-- Quick Contact -->
            <div class="bg-white rounded-xl border border-gray-200 p-8 mb-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Hubungi Kami</h3>
                <div class="space-y-4 mb-8">
                    <a href="tel:+{{ preg_replace('/[^0-9]/', '', $companyInfo->contact_phone ?? '628123456789') }}" class="flex items-center text-gray-700 hover:text-[#FF6000] text-lg">
                        <i class="fas fa-phone-alt w-6 text-[#FF6000]"></i>
                        <span>{{ $companyInfo->contact_phone ?? '0812-3456-789' }}</span>
                    </a>
                    <a href="mailto:{{ $companyInfo->contact_email ?? 'info@example.com' }}" class="flex items-center text-gray-700 hover:text-[#FF6000] text-lg">
                        <i class="fas fa-envelope w-6 text-[#FF6000]"></i>
                        <span>{{ $companyInfo->contact_email ?? 'info@example.com' }}</span>
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companyInfo->contact_phone ?? '628123456789') }}" class="flex items-center text-gray-700 hover:text-[#FF6000] text-lg">
                        <i class="fab fa-whatsapp w-6 text-[#FF6000]"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companyInfo->company_phone_cs1 ?? '6285814718888') }}?text={{ urlencode('Halo Admin ZDX Express,

Saya tertarik untuk konsultasi mengenai layanan ' . $service->title . '.

Mohon informasi lebih lanjut mengenai layanan ini dan tarif yang tersedia.

Terima kasih.') }}" target="_blank" class="inline-block bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                    Konsultasi Gratis
                </a>
            </div>
            
            <!-- Layanan Lainnya -->
            <div class="bg-white rounded-xl border border-gray-200 p-8 mb-10 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Layanan Terkait</h3>
                <div class="space-y-4">
                    @if(isset($services) && count($services) > 0)
                        @foreach($services->where('id', '!=', $service->id)->take(3) as $relatedService)
                            <a href="/layanan/{{ $relatedService->slug }}" class="flex items-center text-gray-700 hover:text-[#FF6000] p-3 rounded-lg hover:bg-gray-50 text-lg">
                                <i class="fas fa-chevron-right text-sm w-5 text-[#FF6000]"></i>
                                <span>{{ $relatedService->title }}</span>
                            </a>
                        @endforeach
                    @else
                        <a href="#" class="flex items-center text-gray-700 hover:text-[#FF6000] p-3 rounded-lg hover:bg-gray-50 text-lg">
                            <i class="fas fa-chevron-right text-sm w-5 text-[#FF6000]"></i>
                            <span>Pengiriman Domestik</span>
                        </a>
                        <a href="#" class="flex items-center text-gray-700 hover:text-[#FF6000] p-3 rounded-lg hover:bg-gray-50 text-lg">
                            <i class="fas fa-chevron-right text-sm w-5 text-[#FF6000]"></i>
                            <span>Pengiriman Internasional</span>
                        </a>
                        <a href="#" class="flex items-center text-gray-700 hover:text-[#FF6000] p-3 rounded-lg hover:bg-gray-50 text-lg">
                            <i class="fas fa-chevron-right text-sm w-5 text-[#FF6000]"></i>
                            <span>Cargo & Logistik</span>
                        </a>
                    @endif
                </div>
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <a href="/layanan" class="text-[#FF6000] font-medium hover:underline flex items-center text-lg">
                        Lihat Semua Layanan
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CTA -->
<div class="bg-gray-50 mt-6 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] rounded-xl p-10 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 opacity-10">
                <i class="fas fa-truck-moving text-9xl transform -rotate-12"></i>
            </div>
            <div class="relative z-10 max-w-3xl">
                <h2 class="text-3xl font-bold mb-6">Mulai kirim paket Anda sekarang!</h2>
                <p class="mb-8 text-xl">
                    Dapatkan penawaran terbaik untuk kebutuhan pengiriman bisnis Anda. Konsultasikan kebutuhan Anda dengan ahli kami sekarang.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/kontak" class="inline-block bg-white text-[#FF6000] px-8 py-4 rounded-lg font-medium hover:bg-gray-100 transition-colors text-lg">
                        Hubungi Kami
                    </a>
                    <a href="/tracking" class="inline-block bg-white/20 backdrop-blur-sm text-white border border-white/30 px-8 py-4 rounded-lg font-medium hover:bg-white/30 transition-colors text-lg">
                        Lacak Kiriman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Jika butuh inisialisasi khusus, gunakan @push('scripts') -->
@endpush 