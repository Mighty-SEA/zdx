<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17029364315"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-17029364315');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KTQBLCQK');</script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Search Console Verification -->
    <meta name="google-site-verification" content="masukkan-kode-verifikasi-google-anda-disini" />
    
    <!-- Favicon -->
    @php
        $settings = \Illuminate\Support\Facades\DB::table('settings')->first();
        $faviconPath = !empty($settings->title_logo_path) ? asset($settings->title_logo_path) : ($logoUrl ?? asset('asset/logo.png'));
    @endphp
    <link rel="icon" type="image/png" href="{{ $faviconPath }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ $faviconPath }}" sizes="48x48">
    <link rel="icon" type="image/png" href="{{ $faviconPath }}" sizes="96x96">
    <link rel="shortcut icon" href="{{ $faviconPath }}">
    <link rel="apple-touch-icon" href="{{ $faviconPath }}">
    <!-- Untuk hasil pencarian Google -->
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google-site-verification" content="your-verification-code-if-any">
    
    <!-- SEO Metadata -->
    @hasSection('meta_tags')
        @yield('meta_tags')
    @else
        @include('partials.meta-tags')
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        /* Tambahan untuk mengatasi masalah navbar fixed */
        main {
            padding-top: 80px; /* Sesuai dengan tinggi navbar */
        }
        
        /* Pengecualian untuk halaman yang memerlukan hero full height */
        .hero-fullheight {
            margin-top: -80px; /* Mengompensasi padding-top dari main */
            padding-top: 0;
        }
        
        /* Penyesuaian responsif untuk tampilan mobile */
        @media (max-width: 640px) {
            main {
                padding-top: 100px; /* Tambah padding untuk mobile agar konten tidak terlalu dekat dengan navbar */
            }
            
            .hero-fullheight {
                margin-top: -100px; /* Sesuaikan dengan padding-top mobile */
                padding-top: 20px; /* Tambahkan sedikit padding atas */
            }
            
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            h1, .h1 {
                font-size: 1.875rem !important; /* 30px */
                line-height: 2.25rem !important; /* 36px */
            }
            
            h2, .h2 {
                font-size: 1.5rem !important; /* 24px */
                line-height: 2rem !important; /* 32px */
            }
            
            .p-mobile-smaller {
                padding: 0.75rem !important;
            }
            
            .text-mobile-smaller {
                font-size: 0.875rem !important;
            }
            
            .gap-mobile-smaller {
                gap: 0.5rem !important;
            }
        }
        
        /* Tampilan tablet */
        @media (min-width: 641px) and (max-width: 1023px) {
            main {
                padding-top: 90px; /* Tambah padding untuk tablet */
            }
            
            .hero-fullheight {
                margin-top: -90px; /* Sesuaikan dengan padding-top tablet */
                padding-top: 10px;
            }
        }
        
        /* Fix untuk iOS safari 100vh bug */
        .min-h-screen {
            min-height: 100vh;
            min-height: -webkit-fill-available;
        }
        
        html {
            height: -webkit-fill-available;
        }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased overflow-x-hidden">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KTQBLCQK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    @stack('scripts')
    
    <!-- AOS Animation Init -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false,
                disable: window.innerWidth < 768 // Menonaktifkan di mobile untuk performa lebih baik
            });
            
            // Deteksi perangkat
            const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            if (isMobile) {
                // Tambahkan class khusus untuk mobile
                document.body.classList.add('is-mobile-device');
            }
        });
    </script>

    <!-- Event snippet for Purchase conversion page -->
    <script>
    function gtag_report_conversion(url) {
      var callback = function () {
        if (typeof(url) != 'undefined') {
          window.location = url;
        }
      };
      gtag('event', 'conversion', {
          'send_to': 'AW-17029364315/q7EXCO_fzrwaENv0nbg_',
          'value': 1.0,
          'currency': 'IDR',
          'transaction_id': '',
          'event_callback': callback
      });
      return false;
    }
    // Panggil otomatis saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
      gtag_report_conversion();
    });
    </script>
</body>
</html> 