@extends('layouts.app')

@section('meta_tags')
    <title>{{ $seoData['title'] ?? 'Kontak Kami - PT. Zindan Diantar Express' }}</title>
    <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
    <meta name="description" content="{{ $seoData['description'] ?? 'Hubungi ZDX Cargo untuk informasi layanan pengiriman dan pertanyaan lainnya.' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'kontak zdx, hubungi zdx, alamat zdx, telepon zdx, email zdx' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/contact') }}">
    
    <!-- Robots Meta -->
    <meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seoData['og_title'] ?? 'Kontak Kami - PT. Zindan Diantar Express' }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? 'Hubungi ZDX Cargo untuk informasi layanan pengiriman dan pertanyaan lainnya.' }}">
    <meta property="og:image" content="{{ $seoData['og_image'] ?? asset('asset/images/zdx-logo.png') }}">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? $seoData['og_title'] ?? 'Kontak Kami - PT. Zindan Diantar Express' }}">
    <meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? $seoData['og_description'] ?? 'Hubungi ZDX Cargo untuk informasi layanan pengiriman dan pertanyaan lainnya.' }}">
    <meta name="twitter:image" content="{{ $seoData['twitter_image'] ?? $seoData['og_image'] ?? asset('asset/images/zdx-logo.png') }}">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Schema.org JSON-LD -->
    @if(isset($seoData['custom_schema']))
    {!! $seoData['custom_schema'] !!}
    @else
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "PT. Zindan Diantar Express",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('asset/logo.png') }}",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+62-21-38711144",
                "contactType": "customer service",
                "areaServed": "ID",
                "availableLanguage": ["id", "en"]
            },
            {
                "@type": "ContactPoint",
                "telephone": "+62-21-38711181",
                "contactType": "technical support",
                "areaServed": "ID",
                "availableLanguage": ["id", "en"]
            }
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih",
            "addressLocality": "Bekasi",
            "addressRegion": "Jawa Barat",
            "postalCode": "17424",
            "addressCountry": "ID"
        },
        "sameAs": [
            "https://www.facebook.com/zdxcargo",
            "https://www.instagram.com/zdxcargo",
            "https://twitter.com/zdxcargo"
        ]
    }
    </script>
    @endif

    <!-- Fungsi formatPhoneNumber -->
    @php
    function formatPhoneNumber($phoneNumber) {
        // Menghapus semua karakter non-angka
        $number = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Jika nomor dimulai dengan 62, tambahkan + di depannya dan format dengan benar
        if (substr($number, 0, 2) === '62') {
            // Format: +62 xxx xxxx xxxx
            $formatted = '+62 ' . substr($number, 2, 3) . ' ' . 
                         substr($number, 5, 4) . ' ' . 
                         substr($number, 9);
            return $formatted;
        } 
        // Jika nomor dimulai dengan 0, tetap gunakan format tersebut dengan spasi yang tepat
        else if (substr($number, 0, 1) === '0') {
            // Format: 0xxx xxxx xxxx
            $formatted = '0' . substr($number, 1, 3) . ' ' . 
                         substr($number, 4, 4) . ' ' . 
                         substr($number, 8);
            return $formatted;
        }
        // Format lainnya
        else {
            return '+' . $number;
        }
    }

    // Get raw phone number for main company phone (regular call)
    $whatsappPhone = preg_replace('/[^0-9]/', '', $companyInfo->company_phone ?? '');
    
    // Customer Service 1 (WhatsApp)
    $whatsappPhoneCS1 = preg_replace('/[^0-9]/', '', $companyInfo->company_phone_cs1 ?? '');
    $displayPhoneCS1 = formatPhoneNumber($companyInfo->company_phone_cs1 ?? '');
    $csName1 = $companyInfo->cs_name1 ?? 'Customer Service 1';
    // Format untuk WhatsApp link - pastikan dimulai dengan 62 (bukan 0)
    $waLinkCS1 = $whatsappPhoneCS1;
    if (substr($whatsappPhoneCS1, 0, 1) === '0') {
        $waLinkCS1 = '62' . substr($whatsappPhoneCS1, 1);
    }
    
    // Customer Service 2 (WhatsApp)
    $whatsappPhoneCS2 = preg_replace('/[^0-9]/', '', $companyInfo->company_phone_cs2 ?? '');
    $displayPhoneCS2 = formatPhoneNumber($companyInfo->company_phone_cs2 ?? '');
    $csName2 = $companyInfo->cs_name2 ?? 'Customer Service 2';
    // Format untuk WhatsApp link - pastikan dimulai dengan 62 (bukan 0)
    $waLinkCS2 = $whatsappPhoneCS2;
    if (substr($whatsappPhoneCS2, 0, 1) === '0') {
        $waLinkCS2 = '62' . substr($whatsappPhoneCS2, 1);
    }
    
    // Get formatted phone for display
    $displayPhone = formatPhoneNumber($companyInfo->company_phone ?? '');
    
    // Format email
    $companyEmail = $companyInfo->company_email ?? 'info@zdx.co.id';
    @endphp
@endsection

@section('content')
    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden rotate-180">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="absolute bottom-0 w-full h-12 text-white">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
        </svg>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-white pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-2 text-gray-500 text-sm mb-8">
            <a href="/" class="hover:text-[#FF6000]">Home</a>
            <span>•</span>
            <span class="text-[#FF6000]">Contact Us</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Intro -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
            <div class="w-24 h-1 bg-[#FF6000] mx-auto mb-6 rounded-full"></div>
            <p class="max-w-2xl mx-auto text-lg text-gray-600">Kami siap membantu Anda dengan kebutuhan pengiriman. Hubungi kami melalui berbagai channel komunikasi berikut.</p>
        </div>
        
        <!-- Contact Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Phone Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-[#FF6000] transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Hubungi Kami</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-center">
                        <p class="text-gray-700 font-medium">{{ $csName1 }}</p>
                        <a href="https://wa.me/{{ $waLinkCS1 }}" class="ml-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-[#FF6000] text-center text-xl font-bold">{{ $displayPhoneCS1 }}</p>
                    
                    <div class="flex items-center justify-center">
                        <p class="text-gray-700 font-medium">{{ $csName2 }}</p>
                        <a href="https://wa.me/{{ $waLinkCS2 }}" class="ml-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-[#FF6000] text-center text-xl font-bold">{{ $displayPhoneCS2 }}</p>
                    
                    <div class="flex items-center justify-center">
                        <p class="text-gray-700 font-medium">Customer Service</p>
                    </div>
                    <p class="text-[#FF6000] text-center text-xl font-bold">{{ $displayPhone }}</p>
                </div>
                <div class="mt-6 text-center">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-4 py-2 bg-[#FF6000] text-white rounded-lg hover:bg-[#E65100] transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Hubungi Kami
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-2 space-y-2" style="display: none;">
                            <a href="https://wa.me/{{ $waLinkCS1 }}" class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-md">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    <span>{{ $csName1 }}</span>
                                </div>
                                <span class="text-xs text-gray-500">WhatsApp</span>
                            </a>
                            <a href="https://wa.me/{{ $waLinkCS2 }}" class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-md">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    <span>{{ $csName2 }}</span>
                                </div>
                                <span class="text-xs text-gray-500">WhatsApp</span>
                            </a>
                            <a href="tel:{{ $whatsappPhone }}" class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-md">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span>Customer Service</span>
                                </div>
                                <span class="text-xs text-gray-500">Telepon</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Email Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-[#FF6000] transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Email Kami</h3>
                <div class="space-y-3">
                    <p class="text-gray-700 text-center font-medium">Informasi Umum</p>
                    <p class="text-[#FF6000] text-center text-xl font-bold">{{ $companyEmail }}</p>
                    <p class="text-gray-700 text-center font-medium">Customer Service</p>
                    <p class="text-[#FF6000] text-center text-xl font-bold">cs@zdx.co.id</p>
                </div>
                <div class="mt-6 text-center">
                    <a href="mailto:{{ $companyEmail }}" class="inline-flex items-center px-4 py-2 bg-[#FF6000] text-white rounded-lg hover:bg-[#E65100] transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Sekarang
                    </a>
                </div>
            </div>
            
            <!-- Social Media Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-[#FF6000] transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Social Media</h3>
                <p class="text-gray-700 text-center mb-4">Ikuti kami di social media untuk update terbaru</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ $companyInfo->company_facebook ?? '#' }}" class="w-12 h-12 rounded-full bg-[#FF6000] flex items-center justify-center text-white hover:bg-[#E65100] transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                        </svg>
                    </a>
                    <a href="{{ $companyInfo->company_instagram ?? '#' }}" class="w-12 h-12 rounded-full bg-[#FF6000] flex items-center justify-center text-white hover:bg-[#E65100] transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"></path>
                        </svg>
                    </a>
                    <a href="{{ $companyInfo->company_twitter ?? '#' }}" class="w-12 h-12 rounded-full bg-[#FF6000] flex items-center justify-center text-white hover:bg-[#E65100] transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Alamat Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Lokasi Kami</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Head Office -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="h-40 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] p-6 flex flex-col justify-between">
                        <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Head Office</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 mb-4">{{ $companyInfo->company_address ?? 'Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424' }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($companyInfo->company_address ?? 'Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424') }}" target="_blank" class="inline-flex items-center text-[#FF6000] hover:text-[#E65100]">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            Lihat di Google Maps
                        </a>
                    </div>
                </div>
                
                <!-- Warehouse Operation -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="h-40 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] p-6 flex flex-col justify-between">
                        <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Warehouse Operation</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 mb-4">Jl. Diponegoro, Jatimulya, Tambun Selatan, Bekasi Timur</p>
                        <a href="https://maps.google.com/?q=Jl. Diponegoro, Jatimulya, Tambun Selatan, Bekasi Timur" target="_blank" class="inline-flex items-center text-[#FF6000] hover:text-[#E65100]">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            Lihat di Google Maps
                        </a>
                    </div>
                </div>
                
                <!-- Operational Office -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="h-40 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] p-6 flex flex-col justify-between">
                        <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Operational Office / Gateway</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 mb-4">Regulated Cahaya Mas Utama Gedung BTS A-8 Soewarna Business Park Blok A Lot.8 Kota Tangerang</p>
                        <a href="https://maps.google.com/?q=Regulated Cahaya Mas Utama Gedung BTS A-8 Soewarna Business Park Blok A Lot.8 Kota Tangerang" target="_blank" class="inline-flex items-center text-[#FF6000] hover:text-[#E65100]">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            Lihat di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Map -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-16">
            <div class="p-6 bg-gradient-to-r from-[#FF6000] to-[#FF8C00]">
                <h2 class="text-2xl font-bold text-white">Lokasi Head Office</h2>
            </div>
            <div class="h-96 bg-gray-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8641829579854!2d106.95815701476935!3d-6.282267895453966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698dd7a8c2e3ed%3A0x66c7add95def62a!2sJl.%20Swatantra%20I%2C%20Jatirasa%2C%20Kec.%20Jatiasih%2C%20Kota%20Bks%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1634567890123!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection 