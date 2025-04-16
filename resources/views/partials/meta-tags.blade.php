@if(isset($seoData))
    <title>{{ $seoData['title'] }}</title>
    <meta name="description" content="{{ $seoData['description'] }}">
    <meta name="keywords" content="{{ $seoData['keywords'] }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoData['canonical_url'] }}">

    <!-- Robots Meta -->
    <meta name="robots" content="{{ $seoData['meta_robots'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
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
@else
    <!-- Fallback to default SEO settings -->
    <title>{{ request()->path() === '/' ? 'Beranda' : ucfirst(request()->path()) }} - {{ config('app.name', 'ZDX Express') }}</title>
    <meta name="description" content="ZDX Express - Jasa pengiriman terpercaya untuk kebutuhan logistik Anda">
    <meta name="keywords" content="jasa pengiriman, ekspedisi, kurir">
    <link rel="canonical" href="{{ url()->current() }}">
@endif 