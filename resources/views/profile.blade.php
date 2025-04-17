@extends('layouts.app')

@section('meta_tags')
    <title>Profile - PT. Zindan Diantar Express</title>
    <link rel="icon" href="asset/logo.png">
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
    <!-- Hero Section tanpa Logo -->
    <div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] pt-16 pb-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        
        <!-- Pola Latar Belakang dengan Animasi -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="w-64 h-64 bg-white rounded-full absolute -top-32 -right-32 opacity-5"></div>
                <div class="w-96 h-96 bg-white rounded-full absolute -bottom-32 -left-32 opacity-5"></div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Teks Hero -->
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-6">Profile Perusahaan</h1>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                    Mengenal lebih dekat PT. Zindan Diantar Express
                </p>
            </div>
        </div>
        
        <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="absolute bottom-0 w-full h-12 text-white">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
            </svg>
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

            <!-- Company Profile Section with Image -->
            <div class="mt-8 lg:flex lg:items-center lg:gap-12">
                <div class="lg:w-1/2">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h2 class="text-3xl font-bold text-[#FF6000] mb-6">Tentang Kami</h2>
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
                <div class="lg:w-1/2 mt-8 lg:mt-0">
                    <div class="flex flex-col gap-4">
                        <!-- Logo Perusahaan tanpa frame -->
                        <div class="relative">
                            <img src="{{ asset('asset/logo.png') }}" alt="ZDX Express Logo" class="w-full rounded-lg object-contain h-50 mb-10">
                        </div>
                        
                        <!-- Gambar Pengiriman Logistik -->
                        <div class="relative">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] rounded-lg blur"></div>
                            <div class="relative bg-white p-2 rounded-lg">
                                <img src="https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Logistics Operations" class="rounded-lg w-full h-96 object-cover">
                            </div>
                            <div class="absolute -bottom-4 -right-4 bg-white p-4 rounded-lg shadow-lg">
                                <div class="text-lg font-bold text-[#FF6000]">100+</div>
                                <div class="text-sm text-gray-600">Pengiriman per hari</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi & Misi Section dengan Ikon -->
            <div class="mt-20 grid gap-8 md:grid-cols-2">
                <!-- Visi -->
                <div class="bg-white p-8 rounded-lg shadow-md transform transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] opacity-10 rounded-bl-full"></div>
                    <div class="bg-gradient-to-br from-[#FF6000] to-[#FF8C00] text-white w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">Visi</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Menjadi perusahaan terbaik dan terpercaya dalam bidang jasa pengiriman barang diwilayah Indonesia 
                        dengan memberikan jasa layanan yang berkualitas dan terpercaya.
                    </p>
                </div>

                <!-- Misi -->
                <div class="bg-white p-8 rounded-lg shadow-md transform transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] opacity-10 rounded-bl-full"></div>
                    <div class="bg-gradient-to-br from-[#FF6000] to-[#FF8C00] text-white w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">Misi</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Peningkatan jasa layanan dan sumber daya (Manusia, metode, teknologi, infrastruktur) secara berkesinambungan, 
                        sekaligus memperluas jaringan kerja dengan dukungan tenaga-tenaga ahli dibidangnya profesional dan 
                        berpengalaman serta bertanggung jawab.
                    </p>
                </div>
            </div>

            <!-- Struktur Organisasi Section -->
            <div class="mt-20">
                <div class="max-w-6xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-10">Struktur Organisasi</h2>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="{{ asset('asset/struktur.jpg') }}" alt="Struktur Organisasi PT. Zindan Diantar Express" class="w-full rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Layanan Section -->
            <div class="mt-20">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
                    <div class="mt-6">
                        <p class="text-xl font-semibold text-[#FF6000]">Darat - Laut - Udara</p>
                    </div>
                </div>

                <div class="mt-12 grid gap-8 md:grid-cols-3">
                    <!-- Service 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-64">
                            <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pengiriman Darat" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-truck text-white text-6xl"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Zindan Diantar Express Darat</h3>
                            <p class="text-gray-600">Metode pengiriman melalui transportasi darat dengan jaringan yang luas dan armada yang handal.</p>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-64">
                            <img src="https://images.unsplash.com/photo-1577127294100-e200e65fab92?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pengiriman Laut" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-ship text-white text-6xl"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Zindan Diantar Express Laut</h3>
                            <p class="text-gray-600">Metode pengiriman melalui transportasi laut untuk pengiriman antar pulau dengan biaya yang efisien.</p>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-64">
                            <img src="https://images.unsplash.com/photo-1531265726475-52ad60219627?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pengiriman Udara" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-plane text-white text-6xl"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Zindan Diantar Express Udara</h3>
                            <p class="text-gray-600">Metode pengiriman melalui transportasi udara untuk pengiriman cepat dan aman ke seluruh wilayah Indonesia.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="mt-20">
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1566536063027-25d957a60459?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Logistics Background" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black opacity-80"></div>
                    </div>
                    <div class="relative py-16 px-6">
                        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                            <div class="text-center">
                                <div class="bg-[#FF6000] bg-opacity-20 rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                                    <i class="fas fa-handshake text-[#FF6000] text-3xl"></i>
                                </div>
                                <div class="text-5xl font-bold text-white">20+</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">PARTNER</div>
                            </div>

                            <div class="text-center">
                                <div class="bg-[#FF6000] bg-opacity-20 rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                                    <i class="fas fa-project-diagram text-[#FF6000] text-3xl"></i>
                                </div>
                                <div class="text-5xl font-bold text-white">100+</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">PROJECT</div>
                            </div>

                            <div class="text-center">
                                <div class="bg-[#FF6000] bg-opacity-20 rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                                    <i class="fas fa-thumbs-up text-[#FF6000] text-3xl"></i>
                                </div>
                                <div class="text-5xl font-bold text-white">95%</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">SUCCESS</div>
                            </div>

                            <div class="text-center">
                                <div class="bg-[#FF6000] bg-opacity-20 rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                                    <i class="fas fa-map-marked-alt text-[#FF6000] text-3xl"></i>
                                </div>
                                <div class="text-5xl font-bold text-white">34</div>
                                <div class="mt-2 text-xl font-medium text-[#FF6000]">PROVINCES</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="mt-20 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Butuh Informasi Lebih Lanjut?</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-8">
                    Hubungi kami untuk mendapatkan informasi lebih detail tentang layanan pengiriman PT. Zindan Diantar Express.
                </p>
                <a href="/contact" class="inline-block px-8 py-3 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <i class="fas fa-phone-alt mr-2"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
@endsection 