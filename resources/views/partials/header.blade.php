<!-- Navbar -->
<nav class="bg-white shadow-lg fixed w-full z-50 transition-all duration-300" id="mainNav">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <!-- Logo tanpa frame -->
                    <div class="relative">
                        <img id="header-logo" src="{{ $logoUrl }}" alt="{{ $companyInfo->company_name ?? 'ZINDAN DIANTAR EXPRESS' }}" class="h-12 w-auto transform transition-all duration-300 group-hover:scale-105">
                    </div>
                    
                    <!-- Teks logo (tampilkan pada mobile dan desktop) -->
                    <div class="block">
                        <div class="relative overflow-hidden">
                            <p class="text-[#FF6000] font-bold tracking-wide text-sm sm:text-base md:text-lg group-hover:translate-y-0 transition-all duration-300">
                                {{ $companyInfo->company_name ?? 'PT ZDX CARGO' }}
                            </p>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] group-hover:w-full transition-all duration-500 delay-100"></div>
                        </div>
                        <p class="text-gray-500 text-xs tracking-wider italic hidden sm:block">{{ $companyInfo->company_slogan ?? 'Solusi Tepat Pengiriman Cepat' }}</p>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Menu - hanya tampil pada layar large (lg) ke atas -->
            <div class="hidden lg:flex items-center space-x-1 lg:space-x-4">
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
                        <a href="/blog" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#FFF0E6] hover:text-[#FF6000] transition-colors {{ request()->is('blog') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                            <i class="fas fa-newspaper mr-2 text-sm"></i>Blog
                        </a>
                    </div>
                </div>
                <a href="/contact" class="ml-2 px-4 py-2 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-md shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1 font-medium">
                    <i class="fas fa-headset text-sm"></i>
                    <span>Hubungi Kami</span>
                </a>
                <a href="/admin" class="ml-2 px-4 py-2 border border-[#FF6000] text-[#FF6000] rounded-md shadow-sm hover:shadow-md hover:bg-[#FFF0E6] transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1 font-medium">
                    <i class="fas fa-sign-in-alt text-sm"></i>
                    <span>Login</span>
                </a>
            </div>
            
            <!-- Mobile & Tablet Menu Button - tampil pada layar di bawah large (lg) -->
            <div class="lg:hidden">
                <button id="menuToggle" class="text-gray-800 hover:text-[#FF6000] focus:outline-none p-2 rounded-md transition-colors border border-gray-200 hover:border-[#FF6000]/30">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile & Tablet Menu - Dengan tampilan yang lebih baik -->
        <div id="mobileMenu" class="lg:hidden hidden bg-white pb-4 border-t border-gray-100 rounded-b-xl shadow-inner">
            <div class="flex flex-col space-y-1 mt-3">
                <!-- Menu item yang ditingkatkan tampilan mobilnya -->
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
                
                <!-- Tentang Kami Section dengan desain yang lebih baik -->
                <div class="px-4 py-2 text-gray-600 font-medium border-t border-gray-100 mt-2 flex items-center justify-between" id="aboutDropdownToggle">
                    <span>Tentang Kami</span>
                    <i class="fas fa-chevron-down text-xs ml-1 transition-transform duration-300" id="aboutChevron"></i>
                </div>
                
                <div id="aboutDropdown" class="hidden">
                    <a href="/profile" class="px-4 py-3 pl-8 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('profile') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                        <i class="fas fa-building w-5 text-center"></i><span>Profile</span>
                    </a>
                    <a href="/customer" class="px-4 py-3 pl-8 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('customer') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                        <i class="fas fa-user-friends w-5 text-center"></i><span>Pelanggan / Partner</span>
                    </a>
                    <a href="/commodity" class="px-4 py-3 pl-8 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('commodity') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                        <i class="fas fa-box w-5 text-center"></i><span>Commodity</span>
                    </a>
                    <a href="/blog" class="px-4 py-3 pl-8 text-gray-800 hover:bg-[#FFF0E6] hover:text-[#FF6000] rounded-md flex items-center space-x-3 transition-colors {{ request()->is('blog') ? 'bg-[#FFF0E6] text-[#FF6000] font-semibold' : '' }}">
                        <i class="fas fa-newspaper w-5 text-center"></i><span>Blog</span>
                    </a>
                </div>
                
                <!-- Button yang lebih menarik untuk mobile & tablet -->
                <div class="grid grid-cols-1 gap-3 mt-4 px-4">
                    <a href="/contact" class="px-4 py-3 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-md flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transition-all duration-300">
                        <i class="fas fa-headset"></i><span>Hubungi Kami</span>
                    </a>
                    
                    <a href="/login" class="px-4 py-3 border border-[#FF6000] text-[#FF6000] bg-white rounded-md flex items-center justify-center space-x-2 shadow-sm hover:bg-[#FFF0E6] transition-colors">
                        <i class="fas fa-sign-in-alt"></i><span>Login</span>
                    </a>
                </div>
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
    
    // Toggle Tentang Kami dropdown on mobile
    document.getElementById('aboutDropdownToggle').addEventListener('click', function() {
        const aboutDropdown = document.getElementById('aboutDropdown');
        const aboutChevron = document.getElementById('aboutChevron');
        aboutDropdown.classList.toggle('hidden');
        aboutChevron.classList.toggle('rotate-180');
    });
</script> 