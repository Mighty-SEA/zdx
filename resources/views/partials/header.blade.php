<!-- Navbar -->
<nav class="bg-white shadow-lg fixed w-full z-50 transition-all duration-300" id="mainNav">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <!-- Logo tanpa frame -->
                    <div class="relative">
                        <img id="header-logo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->exists('logos/logo1.png') ? \Illuminate\Support\Facades\Storage::url('logos/logo1.png').'?v='.time() : asset('asset/logo.png') }}" alt="{{ $companyInfo->company_name ?? 'ZINDAN DIANTAR EXPRESS' }}" class="h-12 w-auto transform transition-all duration-300 group-hover:scale-105">
                    </div>
                    
                    <!-- Teks logo -->
                    <div class="hidden sm:block">
                        <div class="relative overflow-hidden">
                            <p class="text-[#FF6000] font-bold tracking-wide text-lg group-hover:translate-y-0 transition-all duration-300">
                                {{ $companyInfo->company_name ?? 'ZINDAN DIANTAR EXPRESS' }}
                            </p>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] group-hover:w-full transition-all duration-500 delay-100"></div>
                        </div>
                        <p class="text-gray-500 text-xs tracking-wider italic">{{ $companyInfo->company_slogan ?? 'Solusi Tepat Pengiriman Cepat' }}</p>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1 lg:space-x-4">
                <a href="/" class="menu-item px-3 py-2 rounded-md text-gray-800 hover:text-[#FF6000] transition-all duration-300 {{ request()->is('/') ? 'active-menu-item' : '' }} flex items-center gap-1 font-medium">
                    <i class="fas fa-home text-sm"></i>
                    <span>Home</span>
                </a>
                <a href="/services" class="menu-item px-3 py-2 rounded-md text-gray-800 hover:text-[#FF6000] transition-all duration-300 {{ request()->is('services') ? 'active-menu-item' : '' }} flex items-center gap-1 font-medium">
                    <i class="fas fa-cube text-sm"></i>
                    <span>Business Plan</span>
                </a>
                <a href="/tracking" class="menu-item px-3 py-2 rounded-md text-gray-800 hover:text-[#FF6000] transition-all duration-300 {{ request()->is('tracking') ? 'active-menu-item' : '' }} flex items-center gap-1 font-medium">
                    <i class="fas fa-search-location text-sm"></i>
                    <span>Tracking</span>
                </a>
                <a href="/rates" class="menu-item px-3 py-2 rounded-md text-gray-800 hover:text-[#FF6000] transition-all duration-300 {{ request()->is('rates') ? 'active-menu-item' : '' }} flex items-center gap-1 font-medium">
                    <i class="fas fa-tags text-sm"></i>
                    <span>Tarif</span>
                </a>
                <div class="relative group">
                    <a href="#" class="menu-item px-3 py-2 rounded-md text-gray-800 hover:text-[#FF6000] transition-all duration-300 flex items-center gap-1 font-medium">
                        <i class="fas fa-th-large text-sm"></i>
                        <span>Tentang Kami</span>
                        <i class="fas fa-chevron-down text-xs ml-1 group-hover:rotate-180 transition-transform duration-300"></i>
                    </a>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg overflow-hidden z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100">
                        <a href="/profile" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#FFF0E6] hover:text-[#FF6000] transition-colors {{ request()->is('profile') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                            <i class="fas fa-building mr-2 text-sm"></i>Profile
                        </a>
                        <a href="/customer" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#FFF0E6] hover:text-[#FF6000] transition-colors {{ request()->is('customer') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                            <i class="fas fa-user-friends mr-2 text-sm"></i>Pelanggan / Partner
                        </a>
                        <a href="/commodity" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#FFF0E6] hover:text-[#FF6000] transition-colors {{ request()->is('commodity') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                            <i class="fas fa-box mr-2 text-sm"></i>Commodity
                        </a>
                    </div>
                </div>
                <a href="/contact" class="ml-2 px-4 py-2 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-md shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1 font-medium">
                    <i class="fas fa-headset text-sm"></i>
                    <span>Hubungi Kami</span>
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="menuToggle" class="text-gray-800 hover:text-[#FF6000] focus:outline-none p-2 rounded-md transition-colors border border-gray-200 hover:border-[#FF6000]/30">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden bg-white pb-4 border-t border-gray-100 rounded-b-xl shadow-inner">
            <div class="flex flex-col space-y-1 mt-3">
                <a href="/" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('/') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-home w-5 text-center"></i><span>Home</span>
                </a>
                <a href="/services" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('services') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-cube w-5 text-center"></i><span>Business Plan</span>
                </a>
                <a href="/tracking" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('tracking') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-search-location w-5 text-center"></i><span>Tracking</span>
                </a>
                <a href="/rates" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('rates') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-tags w-5 text-center"></i><span>Tarif</span>
                </a>
                
                <!-- Tentang Kami Section -->
                <div class="px-4 py-2 text-gray-600 font-medium border-t border-gray-100 mt-2">
                    <span>Tentang Kami</span>
                </div>
                
                <a href="/profile" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('profile') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-building w-5 text-center"></i><span>Profile</span>
                </a>
                <a href="/customer" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('customer') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-user-friends w-5 text-center"></i><span>Pelanggan / Partner</span>
                </a>
                <a href="/commodity" class="px-4 py-3 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('commodity') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                    <i class="fas fa-box w-5 text-center"></i><span>Commodity</span>
                </a>
                
                <a href="/contact" class="mt-3 mx-4 px-4 py-3 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-md flex items-center justify-center space-x-2 shadow-sm">
                    <i class="fas fa-headset"></i><span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNav');
        if (window.scrollY > 30) {
            navbar.classList.add('py-1', 'shadow-lg', 'bg-white/95', 'backdrop-blur-sm');
            navbar.classList.remove('py-2');
        } else {
            navbar.classList.remove('py-1', 'shadow-lg', 'bg-white/95', 'backdrop-blur-sm');
            navbar.classList.add('py-2');
        }
    });
    
    // Toggle mobile menu
    document.getElementById('menuToggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    });
</script> 