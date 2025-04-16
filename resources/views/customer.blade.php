@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-indigo-700 to-blue-600 py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Pelanggan Kami</h1>
        <p class="text-lg text-indigo-100 max-w-3xl mx-auto">Mitra bisnis terpercaya yang telah menggunakan layanan ZDX Cargo untuk pengiriman mereka. Bergabunglah dengan ratusan perusahaan yang telah memercayakan logistik mereka pada kami.</p>
    </div>
</div>

<!-- Customer Testimonials -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Kata Mereka</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Berikut testimoni dari beberapa pelanggan kami yang telah merasakan layanan pengiriman ZDX Cargo.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                        <span class="text-indigo-700 text-xl font-bold">S</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Samudra Electronics</h3>
                        <p class="text-sm text-gray-600">Jakarta, Indonesia</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"ZDX Cargo telah menjadi mitra logistik utama kami selama 3 tahun terakhir. Pengiriman selalu tepat waktu dan customer service sangat responsif. Sangat membantu bisnis kami berkembang!"</p>
                <div class="flex text-yellow-500">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <span class="text-blue-700 text-xl font-bold">M</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Mitra Sejahtera</h3>
                        <p class="text-sm text-gray-600">Surabaya, Indonesia</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Pengalaman luar biasa menggunakan layanan ZDX Cargo. Barang kami yang sensitif selalu sampai dalam kondisi prima. Pelacakan real-time memudahkan kami memantau status pengiriman."</p>
                <div class="flex text-yellow-500">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <span class="text-green-700 text-xl font-bold">B</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Bintang Perdana</h3>
                        <p class="text-sm text-gray-600">Bandung, Indonesia</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Tarif yang kompetitif dan transparan menjadi alasan utama kami memilih ZDX Cargo. Tidak ada biaya tersembunyi dan proses pengiriman selalu lancar dari awal hingga akhir."</p>
                <div class="flex text-yellow-500">
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

<!-- Client Logos -->
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Dipercaya Oleh</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Beberapa perusahaan terkemuka yang telah bermitra dengan ZDX Cargo untuk kebutuhan logistik mereka.</p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
            <!-- Client Logos (Placeholder) -->
            <div class="p-4 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition-all">
                <div class="w-full h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Logo 1</div>
            </div>
            <div class="p-4 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition-all">
                <div class="w-full h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Logo 2</div>
            </div>
            <div class="p-4 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition-all">
                <div class="w-full h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Logo 3</div>
            </div>
            <div class="p-4 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition-all">
                <div class="w-full h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Logo 4</div>
            </div>
            <div class="p-4 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition-all">
                <div class="w-full h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Logo 5</div>
            </div>
            <div class="p-4 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition-all">
                <div class="w-full h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Logo 6</div>
            </div>
        </div>
    </div>
</div>

<!-- Case Studies -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Studi Kasus</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Bagaimana ZDX Cargo membantu menyelesaikan tantangan logistik perusahaan.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Case Study 1 -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="h-48 bg-gray-300 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-blue-500 opacity-80 flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white px-6 text-center">Solusi Rantai Pasok untuk Industri Manufaktur</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">PT. Baja Sentosa menghadapi masalah keterlambatan pengiriman komponen yang berdampak pada proses produksi. ZDX Cargo menyediakan solusi pengiriman terjadwal yang meningkatkan efisiensi hingga 40%.</p>
                    <a href="#" class="inline-flex items-center font-medium text-indigo-600 hover:text-indigo-500">
                        Baca selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
            
            <!-- Case Study 2 -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="h-48 bg-gray-300 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-500 to-cyan-500 opacity-80 flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white px-6 text-center">Pengiriman Internasional untuk E-Commerce</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">TokoOnline.com ingin memperluas jangkauan ke pasar internasional namun terkendala biaya logistik tinggi. ZDX Cargo membantu dengan solusi konsolidasi pengiriman yang menghemat biaya hingga 35%.</p>
                    <a href="#" class="inline-flex items-center font-medium text-indigo-600 hover:text-indigo-500">
                        Baca selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
            
            <!-- Case Study 3 -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="h-48 bg-gray-300 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-purple-500 to-indigo-500 opacity-80 flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white px-6 text-center">Distribusi Makanan dan Minuman</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">FreshFood Indonesia membutuhkan solusi pengiriman untuk produk mudah rusak ke seluruh Indonesia. ZDX Cargo menyediakan armada berpendingin dan jadwal tepat waktu yang mengurangi kerusakan produk hingga 90%.</p>
                    <a href="#" class="inline-flex items-center font-medium text-indigo-600 hover:text-indigo-500">
                        Baca selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Join as Customer CTA -->
<div class="py-12 bg-gradient-to-r from-indigo-700 to-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Bergabunglah dengan Pelanggan ZDX Cargo</h2>
        <p class="text-lg text-indigo-100 max-w-3xl mx-auto mb-8">Dapatkan solusi pengiriman yang handal, cepat, dan efisien untuk kebutuhan bisnis Anda. Kami siap menjadi mitra logistik terpercaya Anda.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/kontak" class="px-8 py-3 bg-white text-indigo-700 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition-colors">Hubungi Kami</a>
            <a href="/tarif" class="px-8 py-3 bg-indigo-800 text-white rounded-lg font-semibold shadow-md hover:bg-indigo-900 transition-colors">Lihat Tarif</a>
        </div>
    </div>
</div>
@endsection 