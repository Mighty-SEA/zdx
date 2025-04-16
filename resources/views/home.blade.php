@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden h-screen flex items-center justify-center">
        <!-- Background dengan efek gradient dan pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-blue-800 to-indigo-600">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNGM2LjYyNyAwIDEyLTUuMzczIDEyLTEyUzQyLjYyNyAxMCAzNiAxMCAyNCAxNS4zNzMgMjQgMjJzNS4zNzMgMTIgMTIgMTJ6IiBzdHJva2U9IiMyYzM2N2QiIHN0cm9rZS13aWR0aD0iMiIvPjwvZz48L3N2Zz4=')] opacity-10"></div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-1/4 left-1/4 w-32 h-32 md:w-64 md:h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-32 h-32 md:w-64 md:h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-32 h-32 md:w-64 md:h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>

        <!-- Hero Content -->
        <div class="relative w-full max-w-7xl mx-auto px-4 flex flex-col h-full justify-center">
            <div class="text-center">
                <!-- Logo Animation -->
                <div class="mb-3 md:mb-4 animate-bounce">
                    <i class="fas fa-shipping-fast text-3xl sm:text-4xl md:text-5xl text-white"></i>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-2 sm:mb-3 md:mb-4 tracking-tight text-white">
                    <span class="block">Solusi Pengiriman</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-indigo-300">Cepat & Terpercaya</span>
                </h1>

                <p class="text-base sm:text-lg md:text-xl mb-4 sm:mb-5 md:mb-6 text-gray-200 max-w-2xl mx-auto">
                    Kirim barang Anda ke seluruh Indonesia dengan layanan terbaik kami
                </p>

                <!-- CTA Buttons with Hover Effects -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center mb-6 sm:mb-8">
                    <a href="/tracking" class="group relative px-5 py-2 sm:px-6 sm:py-3 rounded-full bg-white text-indigo-600 font-semibold overflow-hidden transition-all duration-300 hover:scale-105">
                        <span class="relative z-10 text-sm sm:text-base">Lacak Pengiriman</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-200 to-indigo-200 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <a href="/tarif" class="group relative px-5 py-2 sm:px-6 sm:py-3 rounded-full border-2 border-white text-white font-semibold overflow-hidden transition-all duration-300 hover:scale-105">
                        <span class="relative z-10 text-sm sm:text-base">Cek Tarif</span>
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </a>
                </div>

                <!-- Stats Section -->
                <div class="grid grid-cols-4 gap-2 sm:gap-4">
                    <div class="text-center">
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-0 sm:mb-1">
                            <span class="counter" data-target="10000">0</span>+
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Partner</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-0 sm:mb-1">
                            <span class="counter" data-target="100">0</span>+
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Project</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-0 sm:mb-1">
                            <span class="counter" data-target="24">0</span>/7
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Success</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-0 sm:mb-1">
                            <span class="counter" data-target="99">0</span>%
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Country</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-lg sm:text-xl"></i>
        </div>
    </div>

    <!-- Services Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Layanan Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative bg-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-indigo-600 opacity-10 rounded-3xl"></div>
                <div class="relative text-indigo-600 text-5xl mb-4">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="relative text-xl font-semibold mb-2">Pengiriman Darat</h3>
                <p class="relative text-gray-600">Layanan pengiriman darat cepat dan aman ke seluruh Indonesia</p>
            </div>
            <div class="relative bg-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-indigo-600 opacity-10 rounded-3xl"></div>
                <div class="relative text-indigo-600 text-5xl mb-4">
                    <i class="fas fa-ship"></i>
                </div>
                <h3 class="relative text-xl font-semibold mb-2">Pengiriman Laut</h3>
                <p class="relative text-gray-600">Solusi pengiriman laut untuk barang dalam jumlah besar</p>
            </div>
            <div class="relative bg-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-indigo-600 opacity-10 rounded-3xl"></div>
                <div class="relative text-indigo-600 text-5xl mb-4">
                    <i class="fas fa-plane"></i>
                </div>
                <h3 class="relative text-xl font-semibold mb-2">Pengiriman Udara</h3>
                <p class="relative text-gray-600">Pengiriman cepat melalui udara untuk kebutuhan mendesak</p>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Mengapa Memilih Kami?</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="text-indigo-600 text-xl mr-4">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                                <p class="text-gray-600">Tim kami siap membantu Anda kapan saja</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-indigo-600 text-xl mr-4">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Keamanan Terjamin</h3>
                                <p class="text-gray-600">Barang Anda aman dalam perjalanan</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-indigo-600 text-xl mr-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Pengiriman Tepat Waktu</h3>
                                <p class="text-gray-600">Barang sampai sesuai jadwal yang dijanjikan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                         alt="Cargo Features" 
                         class="rounded-xl shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-800 to-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Siap Mengirim Barang Anda?</h2>
            <p class="text-xl mb-8">Dapatkan penawaran terbaik untuk pengiriman barang Anda</p>
            <a href="/kontak" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition duration-300 transform hover:scale-105">
                Hubungi Kami
            </a>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200; // Kecepatan animasi (ms)

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => animateCounter(counter), 1);
                } else {
                    counter.innerText = target;
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
    @endpush
@endsection 