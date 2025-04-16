<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZDX Cargo - Jasa Pengiriman Terpercaya</title>
    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50 transition-all duration-300" id="mainNav">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-2 rounded-lg">
                            <i class="fas fa-shipping-fast text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-600">ZDX Cargo</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-4">
                    <a href="/" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('/') ? 'active-menu-item' : '' }}">Beranda</a>
                    <a href="/layanan" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('layanan') ? 'active-menu-item' : '' }}">Layanan</a>
                    <a href="/tarif" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('tarif') ? 'active-menu-item' : '' }}">Tarif</a>
                    <a href="/tracking" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('tracking') ? 'active-menu-item' : '' }}">Tracking</a>
                    <a href="/customer" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('customer') ? 'active-menu-item' : '' }}">Customer</a>
                    <a href="/profil" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('profil') ? 'active-menu-item' : '' }}">Profil</a>
                    <a href="/kontak" class="menu-item px-3 py-2 rounded-md text-gray-700 hover:text-indigo-600 transition-colors {{ request()->is('kontak') ? 'active-menu-item' : '' }}">Kontak</a>
                    <a href="#" class="ml-4 px-5 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-full font-medium hover:shadow-lg transform hover:scale-105 transition-all">
                        <i class="fas fa-headset mr-1"></i> Hubungi Kami
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="menuToggle" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden hidden bg-white pb-4 border-t border-gray-100">
                <div class="flex flex-col space-y-2 mt-2">
                    <a href="/" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('/') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Beranda</a>
                    <a href="/layanan" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('layanan') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Layanan</a>
                    <a href="/tarif" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('tarif') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Tarif</a>
                    <a href="/tracking" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('tracking') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Tracking</a>
                    <a href="/customer" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('customer') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Customer</a>
                    <a href="/profil" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('profil') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Profil</a>
                    <a href="/kontak" class="px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md {{ request()->is('kontak') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">Kontak</a>
                    <div class="pt-2 mt-2 border-t border-gray-100">
                        <a href="#" class="mx-4 inline-block px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-md font-medium">
                            <i class="fas fa-headset mr-1"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">ZDX Cargo</h3>
                    <p class="text-gray-400">Solusi pengiriman barang terpercaya untuk kebutuhan bisnis dan pribadi Anda.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white footer-link">Pengiriman Darat</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white footer-link">Pengiriman Laut</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white footer-link">Pengiriman Udara</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400"><i class="fas fa-phone mr-2"></i> +62 123 4567 890</li>
                        <li class="text-gray-400"><i class="fas fa-envelope mr-2"></i> info@zdxcargo.com</li>
                        <li class="text-gray-400"><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 ZDX Cargo. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html> 