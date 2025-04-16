@pageSeo

@if($pageSeo)
    <title>{{ $pageSeo->title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $pageSeo->description }}">
    @if($pageSeo->keywords)
    <meta name="keywords" content="{{ $pageSeo->keywords }}">
    @endif

    <!-- Canonical URL -->
    @if($pageSeo->canonical_url)
    <link rel="canonical" href="{{ $pageSeo->canonical_url }}">
    @else
    <link rel="canonical" href="{{ url()->current() }}">
    @endif

    <!-- Robots Meta -->
    @if($pageSeo->custom_robots)
        <meta name="robots" content="{{ $pageSeo->custom_robots }}">
    @else
        @if($pageSeo->is_indexed && $pageSeo->is_followed)
        <meta name="robots" content="index, follow">
        @elseif($pageSeo->is_indexed && !$pageSeo->is_followed)
        <meta name="robots" content="index, nofollow">
        @elseif(!$pageSeo->is_indexed && $pageSeo->is_followed)
        <meta name="robots" content="noindex, follow">
        @else
        <meta name="robots" content="noindex, nofollow">
        @endif
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageSeo->og_title ?? $pageSeo->title }}">
    <meta property="og:description" content="{{ $pageSeo->og_description ?? $pageSeo->description }}">
    @if($pageSeo->og_image)
    <meta property="og:image" content="{{ asset($pageSeo->og_image) }}">
    @endif

    <!-- Custom Schema.org JSON-LD -->
    @if($pageSeo->custom_schema)
    {!! $pageSeo->custom_schema !!}
    @endif
@else
    <!-- Fallback to global SEO settings -->
    <title>{{ request()->path() === '/' ? 'Beranda' : ucfirst(request()->path()) }} - {{ config('app.name', 'ZDX Cargo') }}</title>
    <meta name="description" content="ZDX Cargo - Jasa pengiriman terpercaya untuk kebutuhan logistik Anda">
    <meta name="keywords" content="jasa pengiriman, cargo, logistik">
    <link rel="canonical" href="{{ url()->current() }}">
@endif

<!-- Global SEO settings -->
@if(isset($globalSeo) && $globalSeo)
    <!-- Google Analytics -->
    @if($globalSeo->google_analytics_id)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSeo->google_analytics_id }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $globalSeo->google_analytics_id }}');
    </script>
    @endif
    
    <!-- Global Schema Markup -->
    @if($globalSeo->schema_markup)
    {!! $globalSeo->schema_markup !!}
    @endif
    
    <!-- Custom Global Head Tags -->
    @if($globalSeo->custom_head_tags)
    {!! $globalSeo->custom_head_tags !!}
    @endif
@endif 