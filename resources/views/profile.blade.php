@extends('layouts.app')

@section('meta_tags')
    <title>Profile - PT. Zindan Diantar Express</title>
    <meta name="description" content="Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.">
    <meta name="keywords" content="profil zdx, sejarah zdx, visi misi zdx, pengiriman barang, cargo indonesia">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/profile') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/profile') }}">
    <meta property="og:title" content="Profile - PT. Zindan Diantar Express">
    <meta property="og:description" content="Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.">
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Profile Perusahaan</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Mengenal lebih dekat PT. Zindan Diantar Express
            </p>
        </div>
    </div>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-8 flex space-x-2 text-gray-500 text-sm">
                <a href="/" class="hover:text-[#FF6000]">Home</a>
                <span>•</span>
                <span class="text-[#FF6000]">Profile</span>
            </div>

            <!-- Company Profile Section -->
            <div class="mt-8">
                <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
                    <p class="text-lg text-gray-600 leading-relaxed">
                        PT. ZINDAN DIANTAR EXPRESS (ZDX) merupakan perusahaan yang didirikan pada tanggal 10 April 2023 
                        dan mulai beroperasi di tahun 2023. Meski terbilang baru, PT. ZDX sudah memiliki berbagai pengalaman 
                        dalam bidang jasa pengiriman barang melalui darat, laut dan udara.
                    </p>
                    <p class="text-lg text-gray-600 mt-6 leading-relaxed">
                        PT. ZDX memiliki service pengiriman Door to Door (Home Service) & Port to Port (Airport Service) 
                        dengan harga yang bersaing, pelayanan yang baik, dan kecepatan pengiriman.
                    </p>
                    <p class="text-lg text-gray-600 mt-6 leading-relaxed">
                        PT. ZDX mulai beroperasional secara mandiri dengan bisnis utama pengiriman barang via udara, 
                        dan juga perusahaan yang independen, dalam arti kata bahwa bukan merupakan perusahaan yang terafiliasi 
                        atau bukan merupakan anak perusahaan dari suatu group.
                    </p>
                </div>
            </div>

            <!-- Visi & Misi Section -->
            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <!-- Visi -->
                <div class="bg-white p-8 rounded-lg shadow-md transform transition-all duration-300 hover:-translate-y-1">
                    <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">Visi</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Menjadi perusahaan terbaik dan terpercaya dalam bidang jasa pengiriman barang diwilayah Indonesia 
                        dengan memberikan jasa layanan yang berkualitas dan terpercaya.
                    </p>
                </div>

                <!-- Misi -->
                <div class="bg-white p-8 rounded-lg shadow-md transform transition-all duration-300 hover:-translate-y-1">
                    <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">Misi</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Peningkatan jasa layanan dan sumber daya (Manusia, metode, teknologi, infrastruktur) secara berkesinambungan, 
                        sekaligus memperluas jaringan kerja dengan dukungan tenaga-tenaga ahli dibidangnya profesional dan 
                        berpengalaman serta bertanggung jawab.
                    </p>
                </div>
            </div>

            <!-- Layanan Section -->
            <div class="mt-16">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
                    <div class="mt-6">
                        <p class="text-xl font-semibold text-[#FF6000]">Darat - Laut - Udara</p>
                    </div>
                </div>

                <div class="mt-12 grid gap-8 md:grid-cols-3">
                    <!-- Service 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2">
                        <div class="h-32 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                            <i class="fas fa-truck text-white text-6xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Zindan Diantar Express Darat</h3>
                            <p class="text-gray-600">Metode pengiriman melalui transportasi darat dengan jaringan yang luas dan armada yang handal.</p>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2">
                        <div class="h-32 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                            <i class="fas fa-ship text-white text-6xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Zindan Diantar Express Laut</h3>
                            <p class="text-gray-600">Metode pengiriman melalui transportasi laut untuk pengiriman antar pulau dengan biaya yang efisien.</p>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2">
                        <div class="h-32 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                            <i class="fas fa-plane text-white text-6xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Zindan Diantar Express Udara</h3>
                            <p class="text-gray-600">Metode pengiriman melalui transportasi udara untuk pengiriman cepat dan aman ke seluruh wilayah Indonesia.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="mt-16">
                <div class="bg-gradient-to-r from-black to-[#333333] rounded-lg shadow-xl overflow-hidden">
                    <div class="py-12 px-6">
                        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-white">20+</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">PARTNER</div>
                            </div>

                            <div class="text-center">
                                <div class="text-5xl font-bold text-white">100+</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">PROJECT</div>
                            </div>

                            <div class="text-center">
                                <div class="text-5xl font-bold text-white">95%</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">SUCCESS</div>
                            </div>

                            <div class="text-center">
                                <div class="text-5xl font-bold text-white">34</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">PROVINCES</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Butuh Informasi Lebih Lanjut?</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-8">
                    Hubungi kami untuk mendapatkan informasi lebih detail tentang layanan pengiriman PT. Zindan Diantar Express.
                </p>
                <a href="/contact" class="inline-block px-8 py-3 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
@endsection 