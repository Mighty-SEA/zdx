@extends('layouts.app')

@section('meta_tags')
    <title>Tracking - PT. Zindan Diantar Express</title>
    <meta name="description" content="Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo. Pantau status pengiriman secara real-time.">
    <meta name="keywords" content="lacak pengiriman, tracking zdx, cek resi, status kiriman, cargo tracking">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/tracking') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/tracking') }}">
    <meta property="og:title" content="Tracking Pengiriman - PT. Zindan Diantar Express">
    <meta property="og:description" content="Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo. Pantau status pengiriman secara real-time.">
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Lacak Pengiriman</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Pantau status pengiriman Anda secara real-time
            </p>
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tracking Search Form -->
            <div class="max-w-3xl mx-auto -mt-12 relative z-10">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form action="#" method="GET">
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
                                >
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Contoh: ZDX12345678</p>
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
            <div class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-5 py-3">
                    <h2 class="text-lg font-semibold text-white">Detail Pengiriman</h2>
                </div>
                <div class="p-5">
                    <!-- Shipment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800 mb-3">
                                Informasi Pengiriman
                            </h3>
                            <ul class="space-y-3 text-sm">
                                <li class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-600">Nomor Resi:</span>
                                    <span class="bg-[#FFF0E6] text-[#FF6000] px-2 py-1 rounded font-medium">ZDX12345678</span>
                                </li>
                                <li class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-600">Tanggal Pengiriman:</span>
                                    <span>12 April 2024</span>
                                </li>
                                <li class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-600">Layanan:</span>
                                    <span>ZDX Express</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded flex items-center text-xs">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                        Dalam Pengiriman
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800 mb-3">
                                Informasi Alamat
                            </h3>
                            <div class="space-y-4 text-sm">
                                <div class="border-b border-gray-200 pb-3">
                                    <p class="font-medium text-gray-700 mb-1">Pengirim:</p>
                                    <p>PT. Sinar Jaya</p>
                                    <p class="text-gray-500">Jakarta Barat, DKI Jakarta</p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-700 mb-1">Penerima:</p>
                                    <p>PT. Maju Bersama</p>
                                    <p class="text-gray-500">Bandung, Jawa Barat</p>
                                </div>
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
                                <!-- Status 1 -->
                                <div class="relative">
                                    <div class="absolute -left-10 mt-1 h-6 w-6 rounded-full bg-[#FF6000] flex items-center justify-center">
                                        <span class="text-white text-xs">1</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">
                                            Dalam Pengiriman
                                            <span class="ml-2 bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">Aktif</span>
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">Paket telah dikirim dan sedang dalam perjalanan</p>
                                        <p class="text-xs text-gray-500 mt-1">11 Apr 2024, 14:30 WIB</p>
                                    </div>
                                </div>
                                
                                <!-- Status 2 -->
                                <div class="relative">
                                    <div class="absolute -left-10 mt-1 h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-white text-xs">2</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">Paket Diproses</p>
                                        <p class="text-sm text-gray-600 mt-1">Paket sedang diproses di gudang Jakarta</p>
                                        <p class="text-xs text-gray-500 mt-1">11 Apr 2024, 09:15 WIB</p>
                                    </div>
                                </div>
                                
                                <!-- Status 3 -->
                                <div class="relative">
                                    <div class="absolute -left-10 mt-1 h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-white text-xs">3</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">Paket Diterima</p>
                                        <p class="text-sm text-gray-600 mt-1">Paket telah diterima di gudang Jakarta</p>
                                        <p class="text-xs text-gray-500 mt-1">10 Apr 2024, 16:45 WIB</p>
                                    </div>
                                </div>
                                
                                <!-- Status 4 -->
                                <div class="relative">
                                    <div class="absolute -left-10 mt-1 h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-white text-xs">4</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">Paket Dijemput</p>
                                        <p class="text-sm text-gray-600 mt-1">Paket telah dijemput dari lokasi pengirim</p>
                                        <p class="text-xs text-gray-500 mt-1">10 Apr 2024, 13:22 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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