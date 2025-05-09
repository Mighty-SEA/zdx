@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] ?? 'Blog - PT. Zindan Diantar Express' }}</title>
<!-- <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}"> -->
<meta name="description" content="{{ $seoData['description'] ?? 'Blog artikel terbaru dari PT. Zindan Diantar Express' }}">
<meta name="keywords" content="{{ $seoData['keywords'] ?? 'blog, artikel, zdx cargo, pengiriman' }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/blog') }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] ?? 'index, follow' }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] ?? 'Blog - PT. Zindan Diantar Express' }}">
<meta property="og:description" content="{{ $seoData['og_description'] ?? 'Blog artikel terbaru dari PT. Zindan Diantar Express' }}">
@if(isset($seoData['og_image']))
<meta property="og:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? 'Blog - PT. Zindan Diantar Express' }}">
<meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? 'Blog artikel terbaru dari PT. Zindan Diantar Express' }}">
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
    "@type": "Blog",
    "name": "Blog PT. Zindan Diantar Express",
    "url": "{{ url('/blog') }}",
    "description": "Blog artikel terbaru dari PT. Zindan Diantar Express",
    "publisher": {
        "@type": "Organization",
        "name": "PT. Zindan Diantar Express",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}"
        }
    },
    "blogPost": [
        @foreach($blogs as $index => $blog)
        {
            "@type": "BlogPosting",
            "headline": "{{ $blog->title }}",
            "description": "{{ $blog->description }}",
            "datePublished": "{{ $blog->published_at->toIso8601String() }}",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ url($blog->slug) }}"
            },
            "author": {
                "@type": "Person",
                "name": "{{ $blog->author ?? 'Admin' }}"
            }
        }{{ $index < $blogs->count() - 1 ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8500] py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Blog & Artikel</h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Kumpulan artikel dan informasi seputar logistik, pengiriman, dan perkembangan industri.
            </p>
        </div>
    </div>

    <!-- Blog Articles Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        @if($blogs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($blogs as $blog)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl h-full flex flex-col">
                <div class="h-48 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                    @if($blog->image)
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                    @else
                    <i class="fas fa-newspaper text-white text-7xl"></i>
                    @endif
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="mb-4 flex items-center text-sm text-gray-500">
                        <span class="flex items-center mr-4">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $blog->published_at->format('d M Y') }}
                        </span>
                        @if($blog->category)
                        <span class="bg-gray-100 px-2 py-1 rounded text-gray-600">{{ $blog->category }}</span>
                        @endif
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $blog->title }}</h3>
                    <p class="text-gray-600 mb-6 flex-grow">
                        {{ $blog->description }}
                    </p>
                    <div class="mt-auto">
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span class="flex items-center">
                                <i class="far fa-user mr-1"></i> {{ $blog->author ?? 'Admin' }}
                            </span>
                        </div>
                        <a href="/{{ $blog->slug }}" class="inline-block bg-[#FF6000] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="my-12">
            {{ $blogs->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Artikel</h3>
            <p class="text-gray-500">Kami sedang mempersiapkan artikel-artikel menarik untuk Anda.</p>
        </div>
        @endif

        <!-- Categories Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-center mb-12">Kategori Artikel</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="/blog/category/logistik" class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all text-center group">
                    <div class="text-4xl text-[#FF6000] mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Logistik</h3>
                    <p class="text-gray-600">Artikel seputar manajemen logistik dan supply chain</p>
                </a>
                
                <a href="/blog/category/pengiriman" class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all text-center group">
                    <div class="text-4xl text-[#FF6000] mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pengiriman Internasional</h3>
                    <p class="text-gray-600">Tips dan informasi pengiriman ekspor-impor</p>
                </a>
                
                <a href="/blog/category/bisnis" class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all text-center group">
                    <div class="text-4xl text-[#FF6000] mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Bisnis</h3>
                    <p class="text-gray-600">Strategi bisnis dan perkembangan industri</p>
                </a>
                
                <a href="/blog/category/transportasi" class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all text-center group">
                    <div class="text-4xl text-[#FF6000] mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Transportasi</h3>
                    <p class="text-gray-600">Informasi seputar moda transportasi pengiriman</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Subscribe Section -->
    <div class="bg-gradient-to-r from-gray-900 to-[#333333] py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Dapatkan Artikel Terbaru</h2>
            <p class="text-xl text-gray-300 mb-8">
                Berlangganan newsletter kami untuk mendapatkan update artikel terbaru
            </p>
            
            <form class="flex flex-col md:flex-row gap-4 max-w-xl mx-auto">
                <input type="email" placeholder="Alamat Email Anda" class="flex-grow px-4 py-3 rounded-lg text-gray-700">
                <button type="submit" class="bg-[#FF6000] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#E65100] transition-colors">
                    Berlangganan
                </button>
            </form>
            
            <p class="text-gray-400 mt-4 text-sm">
                Kami tidak akan mengirimkan spam. Anda dapat berhenti berlangganan kapan saja.
            </p>
        </div>
    </div>
@endsection

@push('scripts')
@endpush 