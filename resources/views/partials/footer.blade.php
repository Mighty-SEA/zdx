<!-- Footer -->
<footer class="bg-accent text-white mt-20 relative">
    <!-- Pola Latar Belakang -->
    <div class="absolute inset-0 overflow-hidden opacity-5">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="w-40 h-40 bg-[#FF6000] rounded-full absolute -top-20 -left-20 opacity-50"></div>
            <div class="w-56 h-56 bg-[#FF6000] rounded-full absolute top-40 -right-20 opacity-30"></div>
            <div class="w-32 h-32 bg-[#FF6000] rounded-full absolute bottom-10 left-1/4 opacity-40"></div>
        </div>
    </div>

    <!-- Konten Utama Footer -->
    <div class="max-w-7xl mx-auto px-6 py-10 relative">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-12">
            <!-- Tentang Perusahaan -->
            <div>
                <div class="flex items-center mb-5">
                    <img src="{{ asset('asset/logo.png') }}" alt="ZINDAN DIANTAR EXPRESS" class="h-12 mr-3">
                    <div>
                        <h3 class="text-xl font-bold text-[#FF6000] tracking-wide">ZINDAN</h3>
                        <p class="text-gray-400 text-xs tracking-wider">DIANTAR EXPRESS</p>
                    </div>
                </div>
                <p class="text-white text-opacity-70 mb-4">PT. Zindan Diantar Express adalah perusahaan jasa pengiriman barang terpercaya dengan jaringan yang luas di seluruh Indonesia.</p>
                <div class="flex items-start space-x-2">
                    <i class="fas fa-map-marker-alt text-[#FF6000] mt-1"></i>
                    <p class="text-white text-opacity-80">Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa,<br>
                    Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424</p>
                </div>
            </div>

            <!-- Layanan Perusahaan -->
            <div>
                <h4 class="text-lg font-semibold mb-5 text-[#FF6000] border-b border-gray-700 pb-2">Layanan Kami</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="/layanan" class="group flex items-center text-white text-opacity-80 hover:text-[#FF6000] transition-all duration-300">
                            <i class="fas fa-truck mr-3 text-[#FF6000] group-hover:translate-x-1 transition-transform duration-300"></i>
                            <span>Zindan Diantar Express Darat</span>
                        </a>
                    </li>
                    <li>
                        <a href="/layanan" class="group flex items-center text-white text-opacity-80 hover:text-[#FF6000] transition-all duration-300">
                            <i class="fas fa-ship mr-3 text-[#FF6000] group-hover:translate-x-1 transition-transform duration-300"></i>
                            <span>Zindan Diantar Express Laut</span>
                        </a>
                    </li>
                    <li>
                        <a href="/layanan" class="group flex items-center text-white text-opacity-80 hover:text-[#FF6000] transition-all duration-300">
                            <i class="fas fa-plane mr-3 text-[#FF6000] group-hover:translate-x-1 transition-transform duration-300"></i>
                            <span>Zindan Diantar Express Udara</span>
                        </a>
                    </li>
                </ul>
                
                <h4 class="text-lg font-semibold mb-4 mt-8 text-[#FF6000] border-b border-gray-700 pb-2">Halaman</h4>
                <div class="grid grid-cols-2 gap-y-3">
                    <a href="/profile" class="text-white text-opacity-80 hover:text-[#FF6000] transition-colors">Profile</a>
                    <a href="/tarif" class="text-white text-opacity-80 hover:text-[#FF6000] transition-colors">Tarif</a>
                    <a href="/tracking" class="text-white text-opacity-80 hover:text-[#FF6000] transition-colors">Tracking</a>
                    <a href="/contact" class="text-white text-opacity-80 hover:text-[#FF6000] transition-colors">Contact Us</a>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div>
                <h4 class="text-lg font-semibold mb-5 text-[#FF6000] border-b border-gray-700 pb-2">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-center text-white text-opacity-80">
                        <div class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3">
                            <i class="fas fa-phone-alt text-[#FF6000]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Telepon</p>
                            <p>021 3871 1144</p>
                        </div>
                    </li>
                    <li class="flex items-center text-white text-opacity-80">
                        <div class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3">
                            <i class="fas fa-headset text-[#FF6000]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Customer Service</p>
                            <p>021 3871 1181</p>
                        </div>
                    </li>
                    <li class="flex items-center text-white text-opacity-80">
                        <div class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-[#FF6000]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Email</p>
                            <p>info@zdx.co.id</p>
                        </div>
                    </li>
                </ul>
                
                <h4 class="text-lg font-semibold mb-4 mt-8 text-[#FF6000] border-b border-gray-700 pb-2">Media Sosial</h4>
                <div class="flex space-x-3 mt-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center hover:bg-opacity-20 transition-all duration-300 hover:scale-110">
                        <i class="fab fa-facebook-f text-[#FF6000]"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center hover:bg-opacity-20 transition-all duration-300 hover:scale-110">
                        <i class="fab fa-twitter text-[#FF6000]"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center hover:bg-opacity-20 transition-all duration-300 hover:scale-110">
                        <i class="fab fa-instagram text-[#FF6000]"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-[#FF6000] bg-opacity-10 flex items-center justify-center hover:bg-opacity-20 transition-all duration-300 hover:scale-110">
                        <i class="fab fa-linkedin-in text-[#FF6000]"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-white text-opacity-60">
            <p>&copy; Copyright 2025. All Rights Reserved. PT. Zindan Diantar Express</p>
        </div>
    </div>
    
    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-6 right-6 bg-[#FF6000] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110 opacity-0 invisible">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<script>
    // Scroll to Top Button
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'invisible');
            scrollToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            scrollToTopBtn.classList.add('opacity-0', 'invisible');
            scrollToTopBtn.classList.remove('opacity-100', 'visible');
        }
    });
    
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script> 