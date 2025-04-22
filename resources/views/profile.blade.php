@extends('layouts.app')

@section('meta_tags')
    <title>{{ $seoData['title'] ?? 'Profile - PT. Zindan Diantar Express' }}</title>
    <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
    <meta name="description" content="{{ $seoData['description'] ?? 'Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'profil zdx, sejarah zdx, visi misi zdx, pengiriman barang, cargo indonesia' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/profile') }}">

    <!-- Robots Meta -->
    <meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seoData['og_title'] ?? 'Profile - PT. Zindan Diantar Express' }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? 'Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.' }}">
    @if(isset($seoData['og_image']))
    <meta property="og:image" content="{{ asset($seoData['og_image']) }}">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? 'Profile - PT. Zindan Diantar Express' }}">
    <meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? 'Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.' }}">
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
        "@type": "Organization",
        "name": "PT. Zindan Diantar Express",
        "url": "{{ url('/profile') }}",
        "logo": "{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}",
        "description": "Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.",
        "founder": "PT. Zindan Diantar Express",
        "foundingDate": "2023-04-10",
        "sameAs": [
            @if(isset($contents['about']) && count($contents['about']) > 0 && !empty($contents['about'][0]->contact_facebook))
            "{{ $contents['about'][0]->contact_facebook }}",
            @endif
            @if(isset($contents['about']) && count($contents['about']) > 0 && !empty($contents['about'][0]->contact_instagram))
            "{{ $contents['about'][0]->contact_instagram }}",
            @endif
            @if(isset($contents['about']) && count($contents['about']) > 0 && !empty($contents['about'][0]->contact_twitter))
            "{{ $contents['about'][0]->contact_twitter }}",
            @endif
            @if(isset($contents['about']) && count($contents['about']) > 0 && !empty($contents['about'][0]->contact_youtube))
            "{{ $contents['about'][0]->contact_youtube }}"
            @endif
        ]
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
                        @if(isset($contents['about']) && count($contents['about']) > 0)
                            <h2 class="text-3xl font-bold text-[#FF6000] mb-6">{{ $contents['about'][0]->title }}</h2>
                            <div class="text-lg text-gray-600 leading-relaxed">
                                {!! $contents['about'][0]->content !!}
                            </div>
                        @else
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
                        @endif
                    </div>
                </div>
                <div class="lg:w-1/2 mt-8 lg:mt-0">
                    <div class="flex flex-col gap-4">
                        <!-- Logo Perusahaan tanpa frame -->
                        <div class="relative">
                            <img src="{{ $logoUrl }}" alt="ZDX Express Logo" class="w-full rounded-lg object-contain h-50 mb-10">
                        </div>
                        
                        <!-- Gambar Pengiriman Logistik -->
                        <div class="relative">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] rounded-lg blur"></div>
                            <div class="relative bg-white p-2 rounded-lg">
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->exists('images/logistics.jpg') ? \Illuminate\Support\Facades\Storage::url('images/logistics.jpg').'?v='.time() : asset('asset/logo2.png') }}" alt="Logistics Operations" class="rounded-lg w-full h-96 object-contain">
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
                    @if(isset($contents['vision']) && count($contents['vision']) > 0)
                        <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">{{ $contents['vision'][0]->title }}</h2>
                        <div class="text-lg text-gray-600 leading-relaxed">
                            {!! $contents['vision'][0]->content !!}
                        </div>
                    @else
                        <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">Visi</h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Menjadi perusahaan terbaik dan terpercaya dalam bidang jasa pengiriman barang diwilayah Indonesia 
                            dengan memberikan jasa layanan yang berkualitas dan terpercaya.
                        </p>
                    @endif
                </div>

                <!-- Misi -->
                <div class="bg-white p-8 rounded-lg shadow-md transform transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] opacity-10 rounded-bl-full"></div>
                    <div class="bg-gradient-to-br from-[#FF6000] to-[#FF8C00] text-white w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-2xl"></i>
                    </div>
                    @if(isset($contents['mission']) && count($contents['mission']) > 0)
                        <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">{{ $contents['mission'][0]->title }}</h2>
                        <div class="text-lg text-gray-600 leading-relaxed">
                            {!! $contents['mission'][0]->content !!}
                        </div>
                    @else
                        <h2 class="text-3xl font-bold text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-4 mb-4">Misi</h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Peningkatan jasa layanan dan sumber daya (Manusia, metode, teknologi, infrastruktur) secara berkesinambungan, 
                            sekaligus memperluas jaringan kerja dengan dukungan tenaga-tenaga ahli dibidangnya profesional dan 
                            berpengalaman serta bertanggung jawab.
                        </p>
                    @endif
                </div>
            </div>

            <!-- Struktur Organisasi Section -->
            <div class="mt-20">
                <div class="max-w-6xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-10">Struktur Organisasi</h2>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        @if(isset($contents['about']) && count($contents['about']) > 0 && !empty($contents['about'][0]->org_structure_path))
                            <img src="{{ asset($contents['about'][0]->org_structure_path) }}?v={{ time() }}" alt="Struktur Organisasi PT. Zindan Diantar Express" class="w-full rounded-lg">
                        @else
                            <img src="{{ asset('asset/struktur.jpg') }}?v={{ time() }}" alt="Struktur Organisasi PT. Zindan Diantar Express" class="w-full rounded-lg">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kontak Perusahaan Section -->
            @if(isset($contents['about']) && count($contents['about']) > 0 && 
                (!empty($contents['about'][0]->contact_phone) || 
                !empty($contents['about'][0]->contact_email) || 
                !empty($contents['about'][0]->contact_address) || 
                !empty($contents['about'][0]->contact_maps_link) || 
                !empty($contents['about'][0]->contact_facebook) || 
                !empty($contents['about'][0]->contact_instagram) || 
                !empty($contents['about'][0]->contact_twitter) || 
                !empty($contents['about'][0]->contact_youtube)))
            <div class="mt-20">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Kontak Kami</h2>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Informasi Kontak -->
                        <div class="bg-white p-8 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold text-[#FF6000] mb-6">Informasi Kontak</h3>
                            
                            <div class="space-y-6">
                                @if(!empty($contents['about'][0]->contact_phone))
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#FF6000] bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-phone-alt text-[#FF6000] text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">Telepon</h4>
                                        <p class="text-gray-600">{{ $contents['about'][0]->contact_phone }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if(!empty($contents['about'][0]->contact_email))
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#FF6000] bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-envelope text-[#FF6000] text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">Email</h4>
                                        <p class="text-gray-600">{{ $contents['about'][0]->contact_email }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if(!empty($contents['about'][0]->contact_address))
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#FF6000] bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-map-marker-alt text-[#FF6000] text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">Alamat</h4>
                                        <p class="text-gray-600">{{ $contents['about'][0]->contact_address }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Social Media -->
                                @if(!empty($contents['about'][0]->contact_facebook) || 
                                    !empty($contents['about'][0]->contact_instagram) || 
                                    !empty($contents['about'][0]->contact_twitter) || 
                                    !empty($contents['about'][0]->contact_youtube))
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#FF6000] bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-share-alt text-[#FF6000] text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">Media Sosial</h4>
                                        <div class="flex space-x-4 mt-2">
                                            @if(!empty($contents['about'][0]->contact_facebook))
                                            <a href="{{ $contents['about'][0]->contact_facebook }}" target="_blank" class="text-gray-600 hover:text-[#FF6000] transition-colors duration-300">
                                                <i class="fab fa-facebook fa-lg"></i>
                                            </a>
                                            @endif
                                            
                                            @if(!empty($contents['about'][0]->contact_instagram))
                                            <a href="{{ $contents['about'][0]->contact_instagram }}" target="_blank" class="text-gray-600 hover:text-[#FF6000] transition-colors duration-300">
                                                <i class="fab fa-instagram fa-lg"></i>
                                            </a>
                                            @endif
                                            
                                            @if(!empty($contents['about'][0]->contact_twitter))
                                            <a href="{{ $contents['about'][0]->contact_twitter }}" target="_blank" class="text-gray-600 hover:text-[#FF6000] transition-colors duration-300">
                                                <i class="fab fa-twitter fa-lg"></i>
                                            </a>
                                            @endif
                                            
                                            @if(!empty($contents['about'][0]->contact_youtube))
                                            <a href="{{ $contents['about'][0]->contact_youtube }}" target="_blank" class="text-gray-600 hover:text-[#FF6000] transition-colors duration-300">
                                                <i class="fab fa-youtube fa-lg"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Google Maps -->
                        @if(!empty($contents['about'][0]->contact_maps_link))
                        <div class="bg-white p-8 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold text-[#FF6000] mb-6">Lokasi Kami</h3>
                            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                <iframe src="{{ $contents['about'][0]->contact_maps_link }}" allowfullscreen="" loading="lazy" class="w-full h-full min-h-[300px] rounded-lg border-0"></iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Layanan Section -->
            <div class="mt-20">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
                    <div class="mt-6">
                        <p class="text-xl font-semibold text-[#FF6000]">Darat - Laut - Udara</p>
                    </div>
                </div>

                <div class="mt-12 grid gap-8 md:grid-cols-3">
                    @foreach($services as $service)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-64">
                            @if($service->image)
                                <img src="{{ asset($service->image) }}?v={{ time() }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <img src="https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                @if(str_contains(strtolower($service->title), 'darat'))
                                    <i class="fas fa-truck text-white text-6xl"></i>
                                @elseif(str_contains(strtolower($service->title), 'laut'))
                                    <i class="fas fa-ship text-white text-6xl"></i>
                                @elseif(str_contains(strtolower($service->title), 'udara'))
                                    <i class="fas fa-plane text-white text-6xl"></i>
                                @else
                                    <i class="fas fa-box text-white text-6xl"></i>
                                @endif
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->title }}</h3>
                            <div class="text-gray-600">{!! $service->description !!}</div>
                            <div class="mt-4">
                                <a href="{{ url('layanan/' . $service->slug) }}" class="text-[#FF6000] hover:text-[#FF8C00] font-medium">
                                    Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
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