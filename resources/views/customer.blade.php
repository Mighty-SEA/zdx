@extends('layouts.app')

@section('meta_tags')
<title>Customer ZDX - PT. Zindan Diantar Express</title>
<meta name="description" content="Pelanggan terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.">
<meta name="keywords" content="pelanggan zdx, customer logistik, testimonial pengiriman, cargo customer">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url('/customer') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/customer') }}">
<meta property="og:title" content="Customer ZDX - PT. Zindan Diantar Express">
<meta property="og:description" content="Pelanggan terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.">
@endsection

@section('content')
<!-- Hero Section tanpa Logo -->
<div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] pt-16 pb-24">
    <div class="absolute inset-0 bg-black opacity-30"></div>
    
    <!-- Pola Latar Belakang dengan Animasi -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="w-64 h-64 bg-white rounded-full absolute -top-32 -right-32 opacity-5"></div>
            <div class="w-96 h-96 bg-white rounded-full absolute -bottom-32 -left-32 opacity-5"></div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Teks Hero -->
        <div class="text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Customer Kami</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Perusahaan dan brand terkemuka yang telah mempercayakan pengiriman mereka pada ZDX Express
            </p>
        </div>
    </div>
    
    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden rotate-180">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="absolute bottom-0 w-full h-12 text-white">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
        </svg>
    </div>
</div>

<!-- Partners Logos Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Dipercaya Oleh Perusahaan Terkemuka</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kami bangga dapat bermitra dengan perusahaan-perusahaan terkemuka di berbagai industri. Kepercayaan mereka adalah bukti komitmen kami terhadap kualitas layanan.
            </p>
        </div>

        <!-- Filter Kategori -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="filter-btn active px-6 py-2 rounded-full bg-[#FF6000] text-white font-medium transition-all hover:shadow-md">
                Semua Partner
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-100 text-gray-700 font-medium transition-all hover:bg-gray-200">
                E-Commerce
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-100 text-gray-700 font-medium transition-all hover:bg-gray-200">
                Manufaktur
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-100 text-gray-700 font-medium transition-all hover:bg-gray-200">
                Retail
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-100 text-gray-700 font-medium transition-all hover:bg-gray-200">
                F&B
            </button>
        </div>

        <!-- Logos Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <!-- Logo 1 -->
            <div class="logo-item group" data-category="e-commerce">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 2 -->
            <div class="logo-item group" data-category="retail">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 3 -->
            <div class="logo-item group" data-category="e-commerce">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 4 -->
            <div class="logo-item group" data-category="f&b">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 5 -->
            <div class="logo-item group" data-category="manufaktur">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 6 -->
            <div class="logo-item group" data-category="retail">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 7 -->
            <div class="logo-item group" data-category="e-commerce">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 8 -->
            <div class="logo-item group" data-category="f&b">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 9 -->
            <div class="logo-item group" data-category="manufaktur">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 10 -->
            <div class="logo-item group" data-category="retail">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 11 -->
            <div class="logo-item group" data-category="e-commerce">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 12 -->
            <div class="logo-item group" data-category="manufaktur">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 13 -->
            <div class="logo-item group" data-category="f&b">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 14 -->
            <div class="logo-item group" data-category="manufaktur">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
            
            <!-- Logo 15 -->
            <div class="logo-item group" data-category="retail">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 h-36 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FF6000]/10 to-[#FF8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img src="https://placehold.co/200x80/E5E7EB/a3a3a3?text=Partner+Logo" alt="Partner Logo" class="max-h-20 max-w-full filter grayscale group-hover:grayscale-0 transition-all duration-300">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Join as Customer CTA -->
<div class="py-16 bg-gradient-to-r from-[#E65100] to-[#FF6000]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Bergabunglah dengan Mitra ZDX Cargo</h2>
        <p class="text-lg text-white/90 max-w-3xl mx-auto mb-8">Jadilah bagian dari jaringan pelanggan ZDX Express dan dapatkan solusi pengiriman yang handal, cepat, dan efisien untuk kebutuhan bisnis Anda.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/contact" class="px-8 py-3 bg-white text-[#FF6000] rounded-lg font-semibold shadow-md hover:bg-gray-100 transition-colors">Hubungi Kami</a>
            <a href="/rates" class="px-8 py-3 bg-[#FF8C00] text-white rounded-lg font-semibold shadow-md hover:bg-[#E65100] transition-colors">Lihat Tarif</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const logoItems = document.querySelectorAll('.logo-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active', 'bg-[#FF6000]', 'text-white'));
            filterButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-700'));
            
            // Add active class to clicked button
            this.classList.add('active', 'bg-[#FF6000]', 'text-white');
            this.classList.remove('bg-gray-100', 'text-gray-700');
            
            // Filter logos
            const category = this.textContent.trim().toLowerCase();
            
            if (category === 'semua partner') {
                // Show all logos
                logoItems.forEach(item => {
                    item.style.display = 'block';
                    // Add animation
                    item.classList.add('animate-fadeIn');
                    setTimeout(() => {
                        item.classList.remove('animate-fadeIn');
                    }, 500);
                });
            } else {
                // Filter logos by category
                logoItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    if (itemCategory === category) {
                        item.style.display = 'block';
                        // Add animation
                        item.classList.add('animate-fadeIn');
                        setTimeout(() => {
                            item.classList.remove('animate-fadeIn');
                        }, 500);
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    });
});
</script>

<style>
.animate-fadeIn {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.filter-btn.active {
    box-shadow: 0 0 0 2px rgba(255, 96, 0, 0.2);
}
</style>
@endsection 