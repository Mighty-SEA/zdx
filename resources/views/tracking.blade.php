@extends('layouts.app')

@section('meta_tags')
    <title>{{ $seoData['title'] ?? 'Tracking - PT. Zindan Diantar Express' }}</title>
    <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
    <meta name="description" content="{{ $seoData['description'] ?? 'Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo. Pantau status pengiriman secara real-time.' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'lacak pengiriman, tracking zdx, cek resi, status kiriman, cargo tracking' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/tracking') }}">

    <!-- Robots Meta -->
    <meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seoData['og_title'] ?? 'Tracking Pengiriman - PT. Zindan Diantar Express' }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? 'Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo. Pantau status pengiriman secara real-time.' }}">
    @if(isset($seoData['og_image']))
    <meta property="og:image" content="{{ asset($seoData['og_image']) }}">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? 'Tracking Pengiriman - PT. Zindan Diantar Express' }}">
    <meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? 'Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo. Pantau status pengiriman secara real-time.' }}">
    @if(isset($seoData['twitter_image']))
    <meta name="twitter:image" content="{{ asset($seoData['twitter_image']) }}">
    @endif

    <!-- Custom Schema.org JSON-LD -->
    @if(isset($seoData['custom_schema']))
    {!! $seoData['custom_schema'] !!}
    @else
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Tracking Pengiriman - PT. Zindan Diantar Express",
        "description": "Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo. Pantau status pengiriman secara real-time.",
        "url": "{{ url('/tracking') }}",
        "mainEntity": {
            "@type": "Service",
            "name": "Layanan Tracking ZDX Express",
            "description": "Layanan pelacakan pengiriman untuk memantau status pengiriman barang Anda secara real-time",
            "provider": {
                "@type": "Organization",
                "name": "PT. Zindan Diantar Express"
            }
        }
    }
    </script>
    @endif
    
    <!-- CSS Khusus Halaman Tracking -->
    @if(app()->environment('production'))
    <link rel="stylesheet" href="{{ asset('css/tracking.min.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/tracking.css') }}">
    @endif
@endsection

@section('content')
    <!-- Hero Section -->


    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <!-- Tracking Search Form -->
            <div class="max-w-3xl mx-auto -mt-12 relative z-10">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form id="tracking-form" action="{{ url('/tracking') }}" method="GET">
                        <div class="mb-4">
                            <label for="tracking_number" class="block text-base font-medium text-gray-700 mb-2">Nomor Resi</label>
                            <div class="flex rounded-md overflow-hidden border border-gray-300">
                                <span class="bg-gray-100 px-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    name="tracking_number"
                                    id="tracking_number"
                                    class="flex-1 p-3 focus:outline-none focus:ring-1 focus:ring-[#FF6000]"
                                    placeholder="Masukkan nomor resi pengiriman Anda"
                                    value="{{ $trackingNumber ?? '' }}"
                                    required
                                >
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Contoh: ZDX12345678</p>
                            <div id="error-message" class="mt-2 text-red-600 text-sm font-medium hidden"></div>
                        </div>
                        <button
                            type="submit"
                            class="w-full py-3 px-4 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white font-medium rounded-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
                        >
                            Lacak Pengiriman
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tracking Results (will be shown conditionally) -->
            @if(isset($trackingData))
            <div id="tracking-results" class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-5 py-3">
                    <h2 class="text-lg font-semibold text-white">Detail Pengiriman</h2>
                </div>
                <div class="p-5">
                    @if(isset($trackingData['error']) && $trackingData['error'])
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                            {{ $trackingData['message'] ?? 'Terjadi kesalahan saat mengambil data tracking' }}
                        </div>
                    @else
                        <!-- Shipment Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <h3 class="text-base font-semibold text-gray-800 mb-3">
                                    Informasi Pengiriman
                                </h3>
                                <ul class="space-y-3 text-sm">
                                    <li class="flex justify-between border-b border-gray-200 pb-2">
                                        <span class="text-gray-600">Nomor Resi:</span>
                                        <span class="bg-[#FFF0E6] text-[#FF6000] px-2 py-1 rounded font-medium">{{ $trackingData['tracking_number'] }}</span>
                                    </li>
                                    <li class="flex justify-between border-b border-gray-200 pb-2">
                                        <span class="text-gray-600">Tanggal Pengiriman:</span>
                                        <span>{{ $trackingData['date_sent'] ?? date('d F Y') }}</span>
                                    </li>
                                    <li class="flex justify-between border-b border-gray-200 pb-2">
                                        <span class="text-gray-600">Layanan:</span>
                                        <span>{{ $trackingData['service'] ?? 'ZDX Express' }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded flex items-center text-xs">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                            {{ $trackingData['status_text'] }}
                                        </span>
                                    </li>
                                    
                                    @if(isset($trackingData['volumetric']))
                                    <li class="flex justify-between border-b border-gray-200 mt-3 pt-2 pb-2">
                                        <span class="text-gray-600">Volumetrik:</span>
                                        <span>{{ $trackingData['volumetric'] }}</span>
                                    </li>
                                    @endif
                                    
                                    @if(isset($trackingData['total_colly']))
                                    <li class="flex justify-between border-b border-gray-200 pb-2">
                                        <span class="text-gray-600">Total Colly:</span>
                                        <span>{{ $trackingData['total_colly'] }}</span>
                                    </li>
                                    @endif
                                    
                                    @if(isset($trackingData['total_weight']))
                                    <li class="flex justify-between border-b border-gray-200 pb-2">
                                        <span class="text-gray-600">Berat (kg):</span>
                                        <span>{{ $trackingData['total_weight'] }}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <h3 class="text-base font-semibold text-gray-800 mb-3">
                                    Informasi Alamat
                                </h3>
                                <div class="space-y-4 text-sm">
                                    <div class="border-b border-gray-200 pb-3">
                                        <p class="font-medium text-gray-700 mb-1">Pengirim:</p>
                                        <p>{{ $trackingData['shipper']['name'] ?? 'PT. Sinar Jaya' }}</p>
                                        <p class="text-gray-500">{{ $trackingData['shipper']['address'] ?? 'Jakarta Barat, DKI Jakarta' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700 mb-1">Penerima:</p>
                                        <p>{{ $trackingData['receiver']['name'] ?? 'PT. Maju Bersama' }}</p>
                                        <p class="text-gray-500">{{ $trackingData['receiver']['address'] ?? 'Bandung, Jawa Barat' }}</p>
                                        @if(isset($trackingData['receiver']['phone']))
                                        <p class="text-gray-500">Tel: {{ $trackingData['receiver']['phone'] }}</p>
                                        @endif
                                    </div>
                                    
                                    @if(isset($trackingData['special_instruction']))
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <p class="font-medium text-gray-700 mb-1">Instruksi Khusus:</p>
                                        <p class="text-gray-600 italic">{{ $trackingData['special_instruction'] }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tracking Timeline -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                Status Pengiriman
                            </h3>
                            <div class="relative">
                                <div class="absolute top-0 left-3 h-full w-0.5 bg-gray-200"></div>
                                
                                <!-- Timeline Items -->
                                <div class="ml-10 space-y-6">
                                    @if(isset($trackingData['timeline']) && count($trackingData['timeline']) > 0)
                                        @foreach(array_reverse($trackingData['timeline']) as $index => $timeline)
                                            <div class="relative">
                                                <div class="absolute -left-10 mt-1 h-6 w-6 rounded-full {{ $index === 0 ? 'bg-[#FF6000]' : 'bg-gray-300' }} flex items-center justify-center">
                                                    <span class="text-white text-xs">{{ count($trackingData['timeline']) - $index }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-800">
                                                        {{ $timeline['status_text'] ?? 'Status Pengiriman' }}
                                                        @if($index === 0)
                                                            <span class="ml-2 bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">Aktif</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $timeline['description'] ?? 'Detail status pengiriman' }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">{{ isset($timeline['timestamp']) ? \Carbon\Carbon::parse($timeline['timestamp'])->format('d M Y, H:i') . ' WIB' : date('d M Y, H:i') . ' WIB' }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="py-3 text-center text-gray-500">
                                            Tidak ada data riwayat pengiriman
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Tracking Info -->
            <div class="max-w-4xl mx-auto mt-10 mb-16">
                <div class="bg-[#FFF0E6] rounded-lg p-6 border border-gray-200">
                    <div class="flex flex-col md:flex-row gap-6 items-center md:items-start">
                        <div class="w-full md:w-1/3 flex justify-center">
                            <!-- SVG illustration instead of image -->
                            <div class="text-[#FF6000]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-36 h-36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    <path d="M12 13 L12 16"></path>
                                    <circle cx="12" cy="10" r="1"></circle>
                                    <path d="M4 12 L20 12"></path>
                                    <path d="M10 7 L14 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="w-full md:w-2/3">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">
                                Cara Melacak Kiriman
                            </h2>
                            <ol class="space-y-3 text-gray-700">
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 bg-[#FF6000] text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">1</span>
                                    <span>Masukkan nomor resi pengiriman Anda pada kolom yang tersedia</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 bg-[#FF6000] text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">2</span>
                                    <span>Klik tombol "Lacak Pengiriman" untuk melihat status terkini</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 bg-[#FF6000] text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">3</span>
                                    <span>Detail pengiriman beserta riwayat status akan ditampilkan</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Route untuk AJAX tracking
    const trackShipmentRoute = "{{ url('/api/track-shipment') }}";
    const csrfToken = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    const trackingUrl = "{{ url('/tracking') }}";
</script>

<!-- Script khusus halaman tracking -->
@if(app()->environment('production'))
<script src="{{ asset('js/tracking.min.js') }}"></script>
@else
<script src="{{ asset('js/tracking.js') }}"></script>
@endif
@endpush 