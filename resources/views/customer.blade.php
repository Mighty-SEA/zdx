@extends('layouts.app')

@section('meta_tags')
<title>Pelanggan / Partner ZDX - PT. Zindan Diantar Express</title>
<meta name="description" content="Pelanggan dan partner terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.">
<meta name="keywords" content="pelanggan zdx, partner zdx, customer logistik, partner logistik, testimonial pengiriman, cargo customer">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url('/customer') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/customer') }}">
<meta property="og:title" content="Pelanggan / Partner ZDX - PT. Zindan Diantar Express">
<meta property="og:description" content="Pelanggan dan partner terpercaya yang telah menggunakan layanan pengiriman ZDX Cargo untuk kebutuhan logistik mereka.">
@endsection

@section('content')


{{-- Bagian testimonial dikomentari sementara
<!-- Customer Testimonials -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Kata Mereka</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Berikut testimoni dari beberapa pelanggan dan partner kami yang telah merasakan layanan pengiriman ZDX Cargo.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow hover:-translate-y-1 duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-[#FFF0E6] rounded-full flex items-center justify-center mr-4">
                        <span class="text-[#FF6000] text-xl font-bold">S</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Samudra Electronics</h3>
                        <p class="text-sm text-gray-600">Jakarta, Indonesia</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"ZDX Cargo telah menjadi mitra logistik utama kami selama 3 tahun terakhir. Pengiriman selalu tepat waktu dan customer service sangat responsif. Sangat membantu bisnis kami berkembang!"</p>
                <div class="flex text-[#FF6000]">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow hover:-translate-y-1 duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-[#FFF0E6] rounded-full flex items-center justify-center mr-4">
                        <span class="text-[#FF6000] text-xl font-bold">M</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Mitra Sejahtera</h3>
                        <p class="text-sm text-gray-600">Surabaya, Indonesia</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Pengalaman luar biasa menggunakan layanan ZDX Cargo. Barang kami yang sensitif selalu sampai dalam kondisi prima. Pelacakan real-time memudahkan kami memantau status pengiriman."</p>
                <div class="flex text-[#FF6000]">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow hover:-translate-y-1 duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-[#FFF0E6] rounded-full flex items-center justify-center mr-4">
                        <span class="text-[#FF6000] text-xl font-bold">B</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Bintang Perdana</h3>
                        <p class="text-sm text-gray-600">Bandung, Indonesia</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Tarif yang kompetitif dan transparan menjadi alasan utama kami memilih ZDX Cargo. Tidak ada biaya tersembunyi dan proses pengiriman selalu lancar dari awal hingga akhir."</p>
                <div class="flex text-[#FF6000]">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </div>
</div>
--}}

<!-- Client Logos -->
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Dipercaya Oleh</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Beberapa perusahaan terkemuka yang telah bermitra dan menjadi pelanggan ZDX Cargo untuk kebutuhan logistik mereka.</p>
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
        <h2 class="text-3xl font-bold text-white mb-6">Bergabunglah dengan Pelanggan & Partner ZDX Cargo</h2>
        <p class="text-lg text-white/90 max-w-3xl mx-auto mb-8">Dapatkan solusi pengiriman yang handal, cepat, dan efisien untuk kebutuhan bisnis Anda. Kami siap menjadi mitra logistik terpercaya Anda.</p>
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