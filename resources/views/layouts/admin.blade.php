<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - ZDX Cargo Admin</title>
    
    <!-- Meta Tags Dasar -->
    <meta name="description" content="ZDX Cargo - Admin Panel">
    <meta name="keywords" content="cargo, shipping, admin, dashboard">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="ZDX Cargo Admin">
    <meta property="og:description" content="ZDX Cargo Admin Panel">
    
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-white h-full border-r border-gray-200">
            <!-- Logo Section -->
            <div class="px-6 py-4 flex items-center h-16">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="bg-indigo-600 text-white p-2 rounded-lg w-10 h-10 flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-xl"></i>
                        </div>
                    </div>
                    <span class="text-xl font-bold text-gray-800">ZDX Admin</span>
                </a>
            </div>
            
            <!-- Sidebar Menu -->
            <div class="py-4 overflow-y-auto no-scrollbar h-[calc(100vh-5rem)] flex flex-col">
                <!-- Main Menu -->
                <div class="px-5 mb-4">
                    <h3 class="text-xs uppercase font-medium text-gray-500 mb-2">Menu Utama</h3>
                    <nav>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt text-lg w-5 text-center"></i>
                            <span>Dashboard</span>
                        </a>
                    </nav>
                </div>
                
                <!-- Management Menu -->
                <div class="px-5 mb-4">
                    <h3 class="text-xs uppercase font-medium text-gray-500 mb-2">Manajemen</h3>
                    <nav class="space-y-1">
                        <a href="{{ route('admin.rates') }}" class="sidebar-link {{ request()->routeIs('admin.rates') ? 'active' : '' }}">
                            <i class="fas fa-dollar-sign text-lg w-5 text-center"></i>
                            <span>Tarif</span>
                        </a>
                        
                        <div x-data="{ open: {{ request()->routeIs('admin.users*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="sidebar-link w-full text-left flex items-center justify-between {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-users text-lg w-5 text-center"></i>
                                    <span>Manajemen Pengguna</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'transform rotate-180': open}"></i>
                            </button>
                            
                            <div x-show="open" class="pl-8 mt-1 mb-1">
                                <a href="{{ route('admin.users') }}" class="sidebar-sublink {{ request()->routeIs('admin.users') && !request()->routeIs('admin.users.roles') ? 'active' : '' }}">
                                    <i class="fas fa-user text-sm w-5 text-center"></i>
                                    <span>Daftar Pengguna</span>
                                </a>
                                <a href="{{ route('admin.users.roles') }}" class="sidebar-sublink {{ request()->routeIs('admin.users.roles') ? 'active' : '' }}">
                                    <i class="fas fa-user-shield text-sm w-5 text-center"></i>
                                    <span>Hak Akses</span>
                                </a>
                            </div>
                        </div>
                        
                        <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <i class="fas fa-cog text-lg w-5 text-center"></i>
                            <span>Pengaturan</span>
                        </a>
                    </nav>
                </div>
                
                <!-- Sidebar Footer -->
                <div class="mt-auto">
                    <div class="px-5 py-3">
                        <div class="text-xs text-gray-500 text-center">
                            <p>ZDX Cargo Admin</p>
                            <p>v1.0.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div id="mainContent" class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm z-10 border-b border-gray-200">
                <div class="flex items-center justify-between h-16 px-5">
                    <!-- Left Side - Mobile Menu & Search -->
                    <div class="flex items-center">
                        <!-- Mobile Menu Toggle -->
                        <button id="sidebarToggle" class="text-gray-600 lg:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <!-- Search Input -->
                        <div class="hidden md:block ml-4">
                            <div class="relative w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-search text-gray-400"></i>
                                </span>
                                <input type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Cari...">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Mobile Search Toggle -->
                        <button class="md:hidden text-gray-600 p-2 rounded-lg hover:bg-gray-100" id="mobileSearchToggle">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100 relative">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- Notifications Dropdown -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg overflow-hidden" style="display: none;">
                                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-700">Notifikasi</h3>
                                        <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Tandai semua dibaca</a>
                                    </div>
                                </div>
                                
                                <div class="max-h-72 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-500">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-800">Pengiriman Baru</p>
                                                <p class="text-xs text-gray-500">Pesanan #12345 telah dibuat</p>
                                                <p class="text-xs text-gray-400 mt-1">Baru saja</p>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-500">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-800">Pelanggan Baru</p>
                                                <p class="text-xs text-gray-500">John Doe baru saja mendaftar</p>
                                                <p class="text-xs text-gray-400 mt-1">30 menit yang lalu</p>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-500">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-800">Pengingat Sistem</p>
                                                <p class="text-xs text-gray-500">Perbarui tarif pengiriman</p>
                                                <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="px-4 py-2 bg-gray-50 text-center border-t border-gray-200">
                                    <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800">Lihat semua notifikasi</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100" id="userMenuBtn">
                                <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white">
                                    <span>A</span>
                                </div>
                                <span class="hidden md:block text-sm font-medium text-gray-700">Admin</span>
                                <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden" style="display: none; z-index: 50;">
                                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2 text-indigo-600"></i> Profil
                                </a>
                                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2 text-indigo-600"></i> Pengaturan
                                </a>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Search Bar (hidden by default) -->
                <div id="mobileSearchBar" class="md:hidden border-t border-gray-200 py-3 px-4 hidden">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Cari...">
                    </div>
                </div>
            </header>
            
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto no-scrollbar bg-gray-100">
                <div class="py-6 px-4 sm:px-6">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                    </div>
                    
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Alpine.js for Dropdowns -->
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('scripts')
</body>
</html> 