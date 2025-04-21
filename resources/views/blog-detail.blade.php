@extends('layouts.app')

@section('meta_tags')
<title>{{ $seoData['title'] }}</title>
<link rel="icon" href="{{ asset('asset/logo.png') }}">
<meta name="description" content="{{ $seoData['description'] }}">
<meta name="keywords" content="{{ $seoData['keywords'] }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical_url'] }}">

<!-- Robots Meta -->
<meta name="robots" content="{{ $seoData['meta_robots'] }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $seoData['og_title'] }}">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
@if($seoData['og_image'])
<meta property="og:image" content="{{ asset($seoData['og_image']) }}">
@endif

<!-- Custom Schema.org JSON-LD -->
@if($seoData['custom_schema'])
{!! $seoData['custom_schema'] !!}
@endif
@endsection

@section('content')
<!-- Header Section -->
<div class="max-w-6xl mx-auto px-4 pt-12 pb-8">
    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $blog->title }}</h1>
    
    <div class="flex flex-wrap items-center text-base text-gray-500 mb-8">
        <span class="flex items-center mr-6 mb-2">
            <i class="far fa-calendar-alt mr-2"></i> {{ $blog->published_at->format('d M Y') }}
        </span>
        <span class="flex items-center mr-6 mb-2">
            <i class="far fa-user mr-2"></i> {{ $blog->author ?? 'Admin' }}
        </span>
        @if($blog->category)
        <span class="flex items-center mr-6 mb-2">
            <i class="far fa-folder mr-2"></i> {{ $blog->category }}
        </span>
        @endif
        <span class="flex items-center mb-2">
            <i class="far fa-clock mr-2"></i> {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min membaca
        </span>
    </div>
    
    <p class="text-xl md:text-2xl text-gray-700 max-w-4xl leading-relaxed">
        {{ $blog->description }}
    </p>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4">
    <div class="flex flex-col md:flex-row gap-10">
        <!-- Left Content -->
        <div class="w-full md:w-2/3">
            <!-- Feature Image -->
            @if($blog->image)
            <div class="mb-10 rounded-xl overflow-hidden">
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-auto object-cover">
            </div>
            @endif
            
            <!-- Content -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-10 shadow-sm">
                <div class="p-8 md:p-10">
                    <div class="prose prose-xl max-w-none">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
            
            <!-- Tags Section -->
            @if(is_array($blog->tags) && count($blog->tags) > 0)
            <div class="mb-10">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($blog->tags as $tag)
                    <a href="/blog/tag/{{ $tag }}" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg hover:bg-gray-200 transition-colors">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Share -->
            <div class="mb-10">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Bagikan</h3>
                <div class="flex gap-3">
                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . url()->current()) }}" target="_blank" class="bg-[#25D366] text-white p-3 rounded-full hover:opacity-90">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="bg-[#1877F2] text-white p-3 rounded-full hover:opacity-90">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="bg-[#1DA1F2] text-white p-3 rounded-full hover:opacity-90">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title) }}&summary={{ urlencode($blog->description) }}" target="_blank" class="bg-[#0A66C2] text-white p-3 rounded-full hover:opacity-90">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                </div>
            </div>
            
            <!-- Related Articles -->
            @if($relatedBlogs->count() > 0)
            <div class="mb-10">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedBlogs as $relatedBlog)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="h-32 bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center">
                            @if($relatedBlog->image)
                            <img src="{{ asset($relatedBlog->image) }}" alt="{{ $relatedBlog->title }}" class="h-full w-full object-cover">
                            @else
                            <i class="fas fa-newspaper text-white text-4xl"></i>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="mb-2 flex items-center text-xs text-gray-500">
                                <span class="flex items-center mr-3">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ $relatedBlog->published_at->format('d M Y') }}
                                </span>
                            </div>
                            <h4 class="text-lg font-bold mb-2 text-gray-800 line-clamp-2">{{ $relatedBlog->title }}</h4>
                            <a href="/{{ $relatedBlog->slug }}" class="text-[#FF6000] text-sm font-semibold hover:text-[#E65100]">
                                Baca Artikel
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <!-- Right Sidebar -->
        <div class="w-full md:w-1/3">
            <!-- Quick Contact -->
            <div class="bg-white rounded-xl border border-gray-200 p-8 sticky top-24 mb-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Hubungi Kami</h3>
                <div class="space-y-4 mb-8">
                    <a href="tel:+628123456789" class="flex items-center text-gray-700 hover:text-[#FF6000] text-lg">
                        <i class="fas fa-phone-alt w-6 text-[#FF6000]"></i>
                        <span>0812-3456-789</span>
                    </a>
                    <a href="mailto:info@example.com" class="flex items-center text-gray-700 hover:text-[#FF6000] text-lg">
                        <i class="fas fa-envelope w-6 text-[#FF6000]"></i>
                        <span>info@example.com</span>
                    </a>
                    <a href="https://wa.me/628123456789" class="flex items-center text-gray-700 hover:text-[#FF6000] text-lg">
                        <i class="fab fa-whatsapp w-6 text-[#FF6000]"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
                <a href="/kontak" class="block w-full bg-[#FF6000] text-center text-white px-4 py-4 rounded-lg hover:bg-[#E65100] transition-colors font-medium text-lg">
                    Konsultasi Gratis
                </a>
            </div>
            
            <!-- Categories -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Kategori</h3>
                <div class="space-y-2">
                    <a href="/blog/category/logistik" class="flex items-center justify-between py-2 px-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#FF6000]">
                        <span>Logistik</span>
                        <span class="bg-gray-100 text-gray-600 text-xs rounded-full px-2 py-1">12</span>
                    </a>
                    <a href="/blog/category/pengiriman" class="flex items-center justify-between py-2 px-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#FF6000]">
                        <span>Pengiriman</span>
                        <span class="bg-gray-100 text-gray-600 text-xs rounded-full px-2 py-1">8</span>
                    </a>
                    <a href="/blog/category/bisnis" class="flex items-center justify-between py-2 px-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#FF6000]">
                        <span>Bisnis</span>
                        <span class="bg-gray-100 text-gray-600 text-xs rounded-full px-2 py-1">5</span>
                    </a>
                    <a href="/blog/category/tips" class="flex items-center justify-between py-2 px-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#FF6000]">
                        <span>Tips & Trik</span>
                        <span class="bg-gray-100 text-gray-600 text-xs rounded-full px-2 py-1">3</span>
                    </a>
                </div>
            </div>
            
            <!-- Recent Posts -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Artikel Terbaru</h3>
                <div class="space-y-4">
                    <a href="#" class="flex items-start border-b border-gray-100 pb-4 group">
                        <div class="bg-gray-100 w-16 h-16 rounded overflow-hidden mr-3 flex-shrink-0">
                            <img src="https://via.placeholder.com/150" alt="Article Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 group-hover:text-[#FF6000] transition-colors line-clamp-2">Strategi Pengiriman Efisien untuk Bisnis E-commerce</h4>
                            <p class="text-xs text-gray-500 mt-1">24 Mar 2023</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-start border-b border-gray-100 pb-4 group">
                        <div class="bg-gray-100 w-16 h-16 rounded overflow-hidden mr-3 flex-shrink-0">
                            <img src="https://via.placeholder.com/150" alt="Article Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 group-hover:text-[#FF6000] transition-colors line-clamp-2">Panduan Lengkap Pengiriman Internasional</h4>
                            <p class="text-xs text-gray-500 mt-1">15 Mar 2023</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-start group">
                        <div class="bg-gray-100 w-16 h-16 rounded overflow-hidden mr-3 flex-shrink-0">
                            <img src="https://via.placeholder.com/150" alt="Article Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 group-hover:text-[#FF6000] transition-colors line-clamp-2">Tren Logistik yang Perlu Anda Ketahui di 2023</h4>
                            <p class="text-xs text-gray-500 mt-1">5 Mar 2023</p>
                        </div>
                    </a>
                </div>
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <a href="/blog" class="text-[#FF6000] font-medium hover:underline flex items-center text-sm">
                        Lihat Semua Artikel
                        <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            
            <!-- Banner Aplikasi -->
            <div class="bg-gray-900 rounded-xl p-6 mb-8 text-white shadow-md">
                <h3 class="text-xl font-bold mb-3">Download Aplikasi</h3>
                <p class="mb-4 text-gray-300">Lacak pengiriman lebih mudah dengan aplikasi mobile kami</p>
                <div class="flex space-x-3">
                    <a href="#" class="bg-black flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition-colors">
                        <i class="fab fa-google-play text-xl mr-2"></i>
                        <div class="text-xs">
                            <span class="block opacity-70">GET IT ON</span>
                            <span class="block text-sm font-medium">Google Play</span>
                        </div>
                    </a>
                    <a href="#" class="bg-black flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition-colors">
                        <i class="fab fa-apple text-xl mr-2"></i>
                        <div class="text-xs">
                            <span class="block opacity-70">DOWNLOAD ON</span>
                            <span class="block text-sm font-medium">App Store</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 