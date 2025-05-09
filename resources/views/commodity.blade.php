@extends('layouts.app')

@section('meta_tags')
    <title>{{ $seoData['title'] ?? 'Komoditas Pengiriman - Jasa Pengiriman Berbagai Jenis Barang | ZDX Express' }}</title>
    <!-- <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}"> -->
    <meta name="description" content="{{ $seoData['description'] ?? 'ZDX Express melayani pengiriman berbagai jenis komoditas, dari general cargo, elektronik, frozen food, hingga barang bernilai tinggi dengan penanganan khusus dan aman.' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'komoditas pengiriman, cargo zdx, jenis barang kiriman, layanan pengiriman khusus, jasa cargo, pengiriman barang berharga, pengiriman frozen food' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/komoditas') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $seoData['canonical_url'] ?? url('/komoditas') }}">
    <meta property="og:title" content="{{ $seoData['og_title'] ?? $seoData['title'] ?? 'Komoditas Pengiriman - Jasa Pengiriman Berbagai Jenis Barang | ZDX Express' }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? $seoData['description'] ?? 'ZDX Express melayani pengiriman berbagai jenis komoditas, dari general cargo, elektronik, frozen food, hingga barang bernilai tinggi dengan penanganan khusus dan aman.' }}">
    <meta property="og:image" content="{{ $seoData['og_image'] ?? asset('asset/komoditas-banner.jpg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['og_title'] ?? $seoData['title'] ?? 'Komoditas Pengiriman - Jasa Pengiriman Berbagai Jenis Barang | ZDX Express' }}">
    <meta name="twitter:description" content="{{ $seoData['og_description'] ?? $seoData['description'] ?? 'ZDX Express melayani pengiriman berbagai jenis komoditas, dari general cargo, elektronik, frozen food, hingga barang bernilai tinggi dengan penanganan khusus dan aman.' }}">
    
    <!-- Structured Data -->
    @if($seoData['custom_schema'])
        {!! $seoData['custom_schema'] !!}
    @else
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "Jasa Pengiriman Komoditas ZDX Express",
        "serviceType": "Jasa Pengiriman",
        "provider": {
            "@type": "Organization",
            "name": "PT. Zindan Diantar Express",
            "url": "{{ url('/') }}"
        },
        "description": "Layanan pengiriman berbagai jenis komoditas oleh ZDX Express, dari general cargo hingga barang bernilai tinggi dengan penanganan khusus.",
        "offers": {
            "@type": "Offer",
            "availability": "https://schema.org/InStock"
        }
    }
    </script>
    @endif
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

    <!-- Main Content -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Utama (H1) -->
            <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">Komoditas Pengiriman ZDX Express</h1>
            
            <!-- Penjelasan Singkat -->
            <div class="mb-16 max-w-4xl mx-auto text-center">
                <p class="text-xl text-gray-700 leading-relaxed">
                    PT. Zindan Diantar Express melayani pengiriman berbagai jenis komoditas, dari barang umum hingga kargo bernilai tinggi dan sensitif. 
                    Setiap jenis komoditas ditangani dengan prosedur dan perlakuan khusus untuk memastikan keamanan dan ketepatan waktu pengiriman.
                </p>
            </div>

            <!-- Kategori Komoditas -->
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Jenis Komoditas Yang Kami Layani</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($commodities as $commodity)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="{{ $commodity->image_url }}" alt="Pengiriman {{ $commodity->name }} - ZDX Express" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">{{ $commodity->name }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                {{ $commodity->description }}
                            </p>
                            <div class="mt-4">
                                <a href="{{ url('/kontak') }}" class="text-[#FF6000] hover:text-[#E65100] font-medium" aria-label="Hubungi kami tentang pengiriman {{ $commodity->name }}">
                                    Tanyakan lebih lanjut <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <!-- CTA Section -->
            <section class="bg-gradient-to-r from-[#E65100] to-[#FF6000] rounded-lg shadow-lg overflow-hidden">
                <div class="p-10 text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">Butuh Pengiriman Khusus untuk Komoditas Anda?</h2>
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto">
                        Tim kami siap memberikan solusi pengiriman terbaik untuk komoditas spesifik Anda. Hubungi kami untuk konsultasi dan penawaran harga.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ url('/kontak') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-[#FF6000] bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Hubungi Kami
                        </a>
                        <a href="{{ url('/tarif') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF8C00] hover:bg-[#E65100] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF8C00]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Cek Tarif
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
@endpush 