<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - ZDX  Admin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
    
    <!-- Meta Tags Dasar -->
    <meta name="description" content="ZDX  - Admin Panel">
    <meta name="keywords" content=", shipping, admin, dashboard">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="ZDX ">
    <meta property="og:description" content="ZDX  Panel">
    
    @yield('meta')
    
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    
    <style>
        .logo-image {
            height: 40px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-white h-full border-r border-gray-200">
            <!-- Logo Section -->
            <div class="px-6 py-4 flex items-center h-16">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <div class="flex-shrink-0 mr-2">
                        <img id="admin-sidebar-logo" src="{{ !empty($companyInfo->company_logo) ? asset('storage/'.$companyInfo->company_logo) : asset('asset/logo.png') }}" alt="ZDX" class="logo-image" onerror="this.src='{{ asset('asset/logo.png') }}';">
                    </div>
                    <span class="text-xl font-bold text-gray-800 ml-1">Admin</span>
                </a>
            </div>
            
            <!-- Sidebar Menu -->
            <div class="py-4 overflow-y-auto no-scrollbar h-[calc(100vh-5rem)] flex flex-col">
                <!-- Dashboard Menu -->
                <div class="px-5 mb-4">
                    <nav>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home text-lg w-5 text-center"></i>
                            <span>Beranda</span>
                        </a>
                    </nav>
                </div>
                
                <!-- Divider -->
                <div class="px-5 mb-4">
                    <hr class="border-gray-200">
                </div>
                
                <!-- Operasional Menu -->
                <div class="px-5 mb-4">
                    <h3 class="text-xs uppercase font-medium text-gray-500 mb-2 flex items-center">
                        <i class="fas fa-truck-moving mr-2 text-gray-400"></i>Operasional
                    </h3>
                    <nav class="space-y-1">
                        <a href="{{ route('admin.rates') }}" class="sidebar-link {{ request()->routeIs('admin.rates') ? 'active' : '' }}">
                            <i class="fas fa-tags text-lg w-5 text-center"></i>
                            <span>Tarif Pengiriman</span>
                        </a>
                        
                        <a href="{{ route('admin.partners') }}" class="sidebar-link {{ request()->routeIs('admin.partners*') ? 'active' : '' }}">
                            <i class="fas fa-handshake text-lg w-5 text-center"></i>
                            <span>Pelanggan & Partner</span>
                        </a>
                    </nav>
                </div>
                
                <!-- Marketing Menu -->
                <div class="px-5 mb-4">
                    <h3 class="text-xs uppercase font-medium text-gray-500 mb-2 flex items-center">
                        <i class="fas fa-bullhorn mr-2 text-gray-400"></i>Marketing
                    </h3>
                    <nav class="space-y-1">
                        <a href="{{ route('admin.home-content.index') }}" class="sidebar-link {{ request()->routeIs('admin.home-content*') ? 'active' : '' }}">
                            <i class="fas fa-home text-lg w-5 text-center"></i>
                            <span>Konten Home</span>
                        </a>
                        
                        <a href="{{ route('admin.services') }}" class="sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                            <i class="fas fa-cubes text-lg w-5 text-center"></i>
                            <span>Layanan</span>
                        </a>
                        
                        <a href="{{ route('admin.blogs') }}" class="sidebar-link {{ request()->routeIs('admin.blogs*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper text-lg w-5 text-center"></i>
                            <span>Blog</span>
                        </a>
                        
                        <a href="{{ route('admin.commodity.index') }}" class="sidebar-link {{ request()->routeIs('admin.commodity*') ? 'active' : '' }}">
                            <i class="fas fa-boxes text-lg w-5 text-center"></i>
                            <span>Komoditas</span>
                        </a>
                        
                        <a href="{{ route('admin.seo') }}" class="sidebar-link {{ request()->routeIs('admin.seo*') ? 'active' : '' }}">
                            <i class="fas fa-search text-lg w-5 text-center"></i>
                            <span>SEO Halaman</span>
                        </a>
                    </nav>
                </div>
                
                <!-- Pengaturan Menu -->
                <div class="px-5 mb-4">
                    <h3 class="text-xs uppercase font-medium text-gray-500 mb-2 flex items-center">
                        <i class="fas fa-cogs mr-2 text-gray-400"></i>Sistem
                    </h3>
                    <nav class="space-y-1">
                        <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                            <i class="fas fa-users text-lg w-5 text-center"></i>
                            <span>Pengguna</span>
                        </a>
                        
                        <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <i class="fas fa-cog text-lg w-5 text-center"></i>
                            <span>Pengaturan</span>
                        </a>

                        <a href="{{ route('admin.profile') }}" class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                            <i class="fas fa-user-circle text-lg w-5 text-center"></i>
                            <span>Profil Saya</span>
                        </a>
                    </nav>
                </div>
                
                <!-- Divider -->
                <div class="px-5 mb-2 mt-auto">
                    <hr class="border-gray-200">
                </div>
                
                <!-- Sidebar Footer -->
                <div class="mt-2">
                    <div class="px-5 py-3">
                        <div class="text-xs text-gray-500 text-center px-1">
                            <div class="flex justify-between items-center pb-1 mb-2 border-b border-gray-200">
                                <span>ZDX ADMIN</span>
                                <span>v2.0.0</span>
                            </div>
                            <p class="text-[10px]">© {{ date('Y') }} ZDX. All rights reserved.</p>
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
                                <input type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#FF6000]" placeholder="Cari...">
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
                        <div class="relative" 
                            x-data="{ 
                                open: false, 
                                notifications: [], 
                                unreadCount: 0,
                                init() {
                                    this.fetchNotifications();
                                },
                                fetchNotifications() {
                                    fetch('{{ route('admin.notifications.data') }}')
                                        .then(response => response.json())
                                        .then(data => {
                                            this.notifications = data.notifications;
                                            this.unreadCount = data.unreadCount;
                                        });
                                },
                                markAsRead(id, index) {
                                    fetch(`{{ url('admin/notifications') }}/${id}/read`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            this.notifications[index].read_at = new Date();
                                            this.unreadCount = Math.max(0, this.unreadCount - 1);
                                        }
                                    });
                                },
                                markAllAsRead() {
                                    fetch('{{ route('admin.notifications.mark-all-read') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            this.notifications.forEach(notification => {
                                                notification.read_at = new Date();
                                            });
                                            this.unreadCount = 0;
                                        }
                                    });
                                }
                            }"
                        >
                            <button @click="open = !open" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100 relative">
                                <i class="fas fa-bell"></i>
                                <span 
                                    x-show="unreadCount > 0" 
                                    x-text="unreadCount" 
                                    class="absolute top-0 right-0 w-4 h-4 bg-[#FF6000] rounded-full text-white text-xs flex items-center justify-center">
                                </span>
                            </button>
                            
                            <!-- Notifications Dropdown -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg overflow-hidden z-50" style="display: none;">
                                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-700">Notifikasi</h3>
                                        <button @click="markAllAsRead()" x-show="unreadCount > 0" class="text-xs text-[#FF6000] hover:text-[#E65100]">
                                            Tandai semua dibaca
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="max-h-72 overflow-y-auto">
                                    <template x-if="notifications.length > 0">
                                        <div>
                                            <template x-for="(notification, index) in notifications" :key="notification.id">
                                                <a :href="notification.link || '#'" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100" :class="{'bg-[#FFF0E6]': !notification.read_at}">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0 mr-3">
                                                            <div class="w-10 h-10 rounded-full flex items-center justify-center" :class="notification.icon_background + ' ' + notification.icon_color">
                                                                <i :class="notification.icon"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1">
                                                            <p class="text-sm font-medium text-gray-800" x-text="notification.title"></p>
                                                            <p class="text-xs text-gray-500" x-text="notification.message"></p>
                                                            <div class="flex items-center justify-between mt-1">
                                                                <p class="text-xs text-gray-400" x-text="new Date(notification.created_at).toLocaleString('id-ID', {dateStyle: 'medium', timeStyle: 'short'})"></p>
                                                                <button 
                                                                    x-show="!notification.read_at" 
                                                                    @click.stop.prevent="markAsRead(notification.id, index)" 
                                                                    class="text-xs text-[#FF6000] hover:text-[#E65100]">
                                                                    Tandai dibaca
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </template>
                                        </div>
                                    </template>
                                    
                                    <template x-if="notifications.length === 0">
                                        <div class="py-8 text-center">
                                            <i class="fas fa-bell-slash text-gray-400 text-3xl mb-2"></i>
                                            <p class="text-gray-600 text-sm">Tidak ada notifikasi</p>
                                        </div>
                                    </template>
                                </div>
                                
                                <div class="px-4 py-2 bg-gray-50 text-center border-t border-gray-200">
                                    <a href="{{ route('admin.notifications') }}" class="text-xs text-[#FF6000] hover:text-[#E65100]">
                                        Lihat semua notifikasi
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-[#FFF0E6] flex items-center justify-center overflow-hidden border border-[#FF6000]/20">
                                    <span class="text-[#FF6000] font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden md:inline-block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>
                            
                            <!-- User Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50" style="display: none;">
                                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user text-gray-500 mr-2"></i> Profile
                                </a>
                                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog text-gray-500 mr-2"></i> Pengaturan
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt text-gray-500 mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Search Bar (Hidden by default) -->
                <div id="mobileSearchBar" class="px-5 py-3 border-t border-gray-200 hidden">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#FF6000]" placeholder="Cari...">
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-5">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"></div>
    
    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileSearchToggle = document.getElementById('mobileSearchToggle');
        const mobileSearchBar = document.getElementById('mobileSearchBar');
        
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
            
            if (sidebar.classList.contains('mobile-open')) {
                sidebarOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebarOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
        
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        });
        
        // Mobile Search Toggle
        mobileSearchToggle.addEventListener('click', function() {
            mobileSearchBar.classList.toggle('hidden');
        });
        
        // Fungsi untuk memperbarui logo admin
        function refreshAdminLogo() {
            const adminLogo = document.getElementById('admin-sidebar-logo');
            if (adminLogo) {
                // Ambil URL dasar
                let currentSrc = adminLogo.src.split('?')[0];
                // Tambahkan parameter untuk memaksa refresh
                adminLogo.src = currentSrc + '?v=' + new Date().getTime() + '&nocache=' + Math.random();
            }
        }
        
        // Auto refresh logo saat halaman di-load
        document.addEventListener('DOMContentLoaded', function() {
            // Check URL parameter untuk melihat apakah baru upload logo
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('nocache') || urlParams.has('t')) {
                refreshAdminLogo();
            }
            
            // Refresh logo secara periodik jika berada di halaman admin settings
            if (window.location.href.includes('admin/settings')) {
                setInterval(refreshAdminLogo, 30000); // Refresh setiap 30 detik
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html> 