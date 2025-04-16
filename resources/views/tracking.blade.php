@extends('layouts.app')

@section('meta_tags')
    <title>Tracking - PT. Zindan Diantar Express</title>
    <meta name="description" content="Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Cargo.">
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                    Tracking
                </h1>
                <p class="mt-4 text-xl text-gray-600">
                    Lacak pengiriman Anda secara real-time
                </p>
            </div>

            <!-- Tracking Search Form -->
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    <form action="#" method="GET" class="space-y-6">
                        <div>
                            <label for="tracking_number" class="block text-sm font-medium text-gray-700">Masukkan Nomor Resi</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input
                                    type="text"
                                    name="tracking_number"
                                    id="tracking_number"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                    placeholder="Contoh: ZDX12345678"
                                >
                            </div>
                        </div>
                        <div>
                            <button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Lacak Pengiriman
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tracking Results (will be shown conditionally) -->
            <div class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-lg overflow-hidden hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Hasil Tracking</h2>
                </div>
                <div class="p-6">
                    <!-- Shipment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Pengiriman</h3>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex justify-between">
                                    <span class="font-medium">Nomor Resi:</span>
                                    <span>ZDX12345678</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium">Tanggal Pengiriman:</span>
                                    <span>12 April 2024</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium">Layanan:</span>
                                    <span>ZDX Express</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium">Status:</span>
                                    <span class="text-green-600 font-semibold">Dalam Pengiriman</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Alamat</h3>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li>
                                    <span class="font-medium block">Pengirim:</span>
                                    <span>PT. Sinar Jaya</span>
                                    <span class="block text-gray-500">Jakarta Barat, DKI Jakarta</span>
                                </li>
                                <li class="mt-3">
                                    <span class="font-medium block">Penerima:</span>
                                    <span>PT. Maju Bersama</span>
                                    <span class="block text-gray-500">Bandung, Jawa Barat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Tracking Timeline -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pengiriman</h3>
                        <div class="relative">
                            <div class="absolute top-0 left-5 h-full w-0.5 bg-gray-200"></div>
                            
                            <!-- Timeline Items -->
                            <div class="ml-5 space-y-6">
                                <!-- Status 1 -->
                                <div class="relative pb-4">
                                    <div class="absolute -left-5 mt-1.5 h-4 w-4 rounded-full border border-white bg-green-500"></div>
                                    <div class="pl-6">
                                        <p class="font-medium text-gray-900">Dalam Pengiriman</p>
                                        <p class="text-sm text-gray-500">Paket telah dikirim dan sedang dalam perjalanan</p>
                                        <p class="text-xs text-gray-400 mt-1">11 Apr 2024, 14:30 WIB</p>
                                    </div>
                                </div>
                                
                                <!-- Status 2 -->
                                <div class="relative pb-4">
                                    <div class="absolute -left-5 mt-1.5 h-4 w-4 rounded-full border border-white bg-gray-400"></div>
                                    <div class="pl-6">
                                        <p class="font-medium text-gray-900">Paket Diproses</p>
                                        <p class="text-sm text-gray-500">Paket sedang diproses di gudang Jakarta</p>
                                        <p class="text-xs text-gray-400 mt-1">11 Apr 2024, 09:15 WIB</p>
                                    </div>
                                </div>
                                
                                <!-- Status 3 -->
                                <div class="relative pb-4">
                                    <div class="absolute -left-5 mt-1.5 h-4 w-4 rounded-full border border-white bg-gray-400"></div>
                                    <div class="pl-6">
                                        <p class="font-medium text-gray-900">Paket Diterima</p>
                                        <p class="text-sm text-gray-500">Paket telah diterima di gudang Jakarta</p>
                                        <p class="text-xs text-gray-400 mt-1">10 Apr 2024, 16:45 WIB</p>
                                    </div>
                                </div>
                                
                                <!-- Status 4 -->
                                <div class="relative">
                                    <div class="absolute -left-5 mt-1.5 h-4 w-4 rounded-full border border-white bg-gray-400"></div>
                                    <div class="pl-6">
                                        <p class="font-medium text-gray-900">Paket Dijemput</p>
                                        <p class="text-sm text-gray-500">Paket telah dijemput dari lokasi pengirim</p>
                                        <p class="text-xs text-gray-400 mt-1">10 Apr 2024, 13:22 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tracking Info -->
            <div class="max-w-4xl mx-auto mt-12">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Cara Melacak Kiriman</h2>
                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                        <li>Masukkan nomor resi pengiriman Anda pada kolom yang tersedia</li>
                        <li>Klik tombol "Lacak Pengiriman" untuk melihat status terkini</li>
                        <li>Sistem kami akan menampilkan detail perjalanan paket Anda</li>
                    </ol>
                    
                    <p class="mt-6 text-sm text-gray-500">
                        Jika Anda mengalami kesulitan melacak kiriman atau memerlukan bantuan lebih lanjut, 
                        silakan hubungi tim layanan pelanggan kami di <span class="text-indigo-600 font-semibold">customer.service@zdx.co.id</span> 
                        atau telepon <span class="text-indigo-600 font-semibold">021-7654321</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection 