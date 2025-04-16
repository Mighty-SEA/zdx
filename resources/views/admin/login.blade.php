<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags dari Database -->
    @php
    $seoSettings = DB::table('seo_settings')->first();
    @endphp
    
    <title>Login - {{ $seoSettings ? $seoSettings->site_title : 'ZDX Cargo Admin' }}</title>
    
    @if($seoSettings)
    <meta name="description" content="{{ $seoSettings->site_description }}">
    <meta name="keywords" content="{{ $seoSettings->site_keywords }}">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Google Analytics -->
    @if($seoSettings->google_analytics_id)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoSettings->google_analytics_id }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $seoSettings->google_analytics_id }}');
    </script>
    @endif
    
    <!-- Custom Head Tags -->
    @if($seoSettings->custom_head_tags)
    {!! $seoSettings->custom_head_tags !!}
    @endif
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-pattern {
            background-color: #f3f4f6;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234f46e5' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full mx-auto flex rounded-xl shadow-lg overflow-hidden">
        <!-- Left Side - Image and Branding -->
        <div class="hidden md:block w-1/2 bg-gradient-to-br from-indigo-600 to-blue-700 p-12 text-white">
            <div class="h-full flex flex-col">
                <div class="flex items-center space-x-3">
                    <div class="bg-white text-indigo-600 p-2 rounded-lg">
                        <i class="fas fa-shipping-fast text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold">ZDX Cargo</span>
                </div>
                
                <div class="mt-auto">
                    <h1 class="text-3xl font-bold mb-4">Selamat Datang di Panel Admin</h1>
                    <p class="text-indigo-100 mb-6">Kelola pengiriman, pelacakan, dan semua operasi cargo Anda dari satu dashboard terpadu.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-500 bg-opacity-30 rounded-full p-2 mr-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <span>Analitik real-time</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-indigo-500 bg-opacity-30 rounded-full p-2 mr-3">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span>Manajemen pengiriman</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-indigo-500 bg-opacity-30 rounded-full p-2 mr-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <span>Manajemen pengguna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="w-full md:w-1/2 bg-white p-8 lg:p-12">
            <div class="mb-8 text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Admin</h2>
                <p class="text-gray-600">Masukkan kredensial Anda untuk akses dashboard</p>
            </div>
            
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" placeholder="admin@zdxcargo.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror" placeholder="••••••••" required>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                </div>
                
                <!-- Login Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-2.5 rounded-lg font-medium transition-all hover:shadow-lg transform hover:scale-[1.02]">
                    Masuk
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>2024 &copy; ZDX Cargo. Semua hak dilindungi.</p>
            </div>
        </div>
    </div>
</body>
</html> 