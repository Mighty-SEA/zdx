@extends('layouts.app')

@section('meta_tags')
    <title>Komoditas - PT. Zindan Diantar Express</title>
    <link rel="icon" href="{{ asset('asset/logo.png') }}">
    <meta name="description" content="Layanan pengiriman berbagai jenis komoditas oleh ZDX Express, dari general cargo hingga barang bernilai tinggi.">
    <meta name="keywords" content="komoditas zdx, cargo zdx, jenis pengiriman zdx, layanan pengiriman, jasa cargo">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/commodity') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/commodity') }}">
    <meta property="og:title" content="Komoditas - PT. Zindan Diantar Express">
    <meta property="og:description" content="Layanan pengiriman berbagai jenis komoditas oleh ZDX Express, dari general cargo hingga barang bernilai tinggi.">
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
                <span class="text-[#FF6000]">Commodity</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Penjelasan Singkat -->
            <div class="mb-16 max-w-4xl mx-auto text-center">
                <p class="text-xl text-gray-700 leading-relaxed">
                    PT. Zindan Diantar Express melayani pengiriman berbagai jenis komoditas, dari barang umum hingga kargo bernilai tinggi dan sensitif. 
                    Setiap jenis komoditas ditangani dengan prosedur dan perlakuan khusus untuk memastikan keamanan dan ketepatan waktu pengiriman.
                </p>
            </div>

            <!-- Kategori Komoditas -->
            <div class="mb-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- General Cargo -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1577705998148-6da4f3963bc8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="General Cargo" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">General Cargo</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Barang umum seperti dokumen, pakaian, peralatan rumah tangga, dan barang-barang ringan lainnya. Dilayani dengan pengiriman cepat dan aman.
                            </p>
                        </div>
                    </div>

                    <!-- Electronics -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Electronics" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">Electronics</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Barang-barang elektronik seperti laptop, smartphone, alat rumah tangga elektronik, dan perangkat IT. Ditangani dengan prosedur khusus dan extra protection.
                            </p>
                        </div>
                    </div>

                    <!-- Valuable Cargo -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1607344645866-009c320b63e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Valuable Cargo" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">Valuable Cargo</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Barang bernilai tinggi seperti perhiasan, dokumen penting, atau barang branded eksklusif. Ditangani dengan keamanan ekstra dan asuransi khusus.
                            </p>
                        </div>
                    </div>

                    <!-- Frozen Food -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1624806992066-5ffcacead90d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Frozen Food" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">Frozen Food</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Makanan beku seperti daging, ikan, nugget, dan produk olahan lainnya. Ditransportasikan menggunakan armada berpendingin khusus.
                            </p>
                        </div>
                    </div>

                    <!-- FMCG -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="FMCG" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">FMCG</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Produk konsumsi cepat seperti makanan ringan, minuman, produk kecantikan, dan kebutuhan sehari-hari. Ditangani dengan sistem distribusi efisien.
                            </p>
                        </div>
                    </div>

                    <!-- Dangerous Goods -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1635513748158-b0c0a8ad0b83?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dangerous Goods" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">Dangerous Goods</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Bahan kimia, gas, atau cairan berbahaya yang memerlukan izin dan perlakuan khusus. Ditangani oleh tim berpengalaman dengan sertifikasi DG.
                            </p>
                        </div>
                    </div>

                    <!-- Heavy Cargo -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1586528116493-ce4c9d733638?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Heavy Cargo" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">Heavy Cargo</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Barang berat seperti mesin, spare part industri, atau material konstruksi. Ditangani dengan peralatan khusus dan armada yang sesuai.
                            </p>
                        </div>
                    </div>

                    <!-- Animal Live -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Animal Live" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-xl font-bold text-white">Animal Live</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">
                                Pengiriman hewan hidup yang memerlukan sertifikasi khusus dan perawatan selama perjalanan. Dilengkapi petugas yang terlatih menangani hewan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keunggulan Layanan ZDX -->
            <div class="mb-20 bg-gray-50 rounded-2xl p-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Kenapa Memilih ZDX untuk Pengiriman Komoditas?</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-white rounded-lg p-8 shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FF6000]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Pengalaman & Keahlian</h3>
                                <p class="text-gray-600">
                                    Tim ZDX berpengalaman dalam menangani berbagai jenis komoditas dengan penanganan khusus sesuai karakteristik barang.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-8 shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FF6000]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Armada Khusus</h3>
                                <p class="text-gray-600">
                                    Kami memiliki armada khusus untuk jenis komoditas tertentu, termasuk kendaraan berpendingin, truk berat, dan container khusus.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-8 shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FF6000]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Pengiriman Tepat Waktu</h3>
                                <p class="text-gray-600">
                                    Komitmen ZDX untuk pengiriman tepat waktu didukung oleh sistem manajemen logistik terintegrasi dan tim yang responsif.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-8 shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-[#FF6000]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Door-to-Door</h3>
                                <p class="text-gray-600">
                                    Pengiriman dari pintu ke pintu untuk semua jenis komoditas, dengan penanganan penuh oleh tim ZDX dari awal hingga akhir.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] rounded-lg shadow-lg overflow-hidden">
                <div class="p-10 text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">Butuh Pengiriman Khusus untuk Komoditas Anda?</h2>
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto">
                        Tim kami siap memberikan solusi pengiriman terbaik untuk komoditas spesifik Anda. Hubungi kami untuk konsultasi dan penawaran harga.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="/contact" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-[#FF6000] bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Hubungi Kami
                        </a>
                        <a href="/rates" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF8C00] hover:bg-[#E65100] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF8C00]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Cek Tarif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 