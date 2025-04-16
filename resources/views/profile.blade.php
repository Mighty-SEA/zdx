@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-indigo-700 to-blue-600 py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Tentang ZDX Cargo</h1>
        <p class="text-lg text-indigo-100 max-w-3xl mx-auto">Mitra logistik terpercaya yang menyediakan solusi pengiriman inovatif dengan jangkauan nasional dan internasional.</p>
    </div>
</div>

<!-- Company Overview -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex items-center gap-12">
            <div class="lg:w-1/2 mb-8 lg:mb-0">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Sejarah Perusahaan</h2>
                <p class="text-gray-600 mb-4">ZDX Cargo didirikan pada tahun 2010 dengan visi menjadi penyedia layanan logistik terkemuka di Indonesia. Berawal dari sebuah armada kecil dengan rute terbatas, kini kami telah berkembang menjadi perusahaan jasa pengiriman dengan jaringan yang luas di seluruh Indonesia dan beberapa negara di Asia Tenggara.</p>
                <p class="text-gray-600 mb-4">Selama lebih dari satu dekade, kami telah membangun kepercayaan dengan ribuan pelanggan melalui komitmen kami terhadap keandalan, efisiensi, dan kepuasan pelanggan. Seiring pertumbuhan, kami terus berinovasi dengan teknologi terkini untuk memberikan pengalaman pengiriman yang lebih baik.</p>
                <p class="text-gray-600">Hari ini, ZDX Cargo bangga menjadi bagian dari solusi logistik untuk berbagai perusahaan dari skala kecil hingga korporasi multinasional, membantu mereka mengoptimalkan rantai pasok dan memperluas jangkauan bisnis.</p>
            </div>
            <div class="lg:w-1/2 h-80 bg-gray-300 rounded-lg overflow-hidden relative">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 to-blue-600 opacity-20"></div>
                <div class="absolute inset-0 flex items-center justify-center text-gray-500 text-lg font-medium">Foto Kantor ZDX Cargo</div>
            </div>
        </div>
    </div>
</div>

<!-- Vision Mission -->
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Vision -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6 mx-auto md:mx-0">
                    <i class="fas fa-eye text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center md:text-left">Visi</h3>
                <p class="text-gray-600">Menjadi penyedia solusi logistik terdepan yang menghubungkan bisnis dengan pasar global melalui layanan pengiriman yang andal, efisien, dan inovatif, berkontribusi pada pertumbuhan ekonomi Indonesia.</p>
            </div>
            
            <!-- Mission -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow card-hover">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto md:mx-0">
                    <i class="fas fa-bullseye text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center md:text-left">Misi</h3>
                <ul class="text-gray-600 space-y-2">
                    <li><i class="fas fa-check text-green-500 mr-2"></i> Menyediakan layanan pengiriman yang cepat, aman, dan tepat waktu.</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i> Mengembangkan teknologi canggih untuk pelacakan dan manajemen pengiriman.</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i> Memperluas jangkauan layanan ke seluruh Indonesia dan pasar internasional.</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i> Membina hubungan jangka panjang dengan pelanggan melalui layanan berkualitas.</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i> Berkontribusi pada pembangunan ekonomi dengan menciptakan solusi logistik efisien.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Core Values -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Nilai-Nilai Perusahaan</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Prinsip yang menjadi dasar semua tindakan dan keputusan kami.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Value 1 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <i class="fas fa-shield-alt text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Integritas</h3>
                <p class="text-gray-600">Kami menjalankan bisnis dengan kejujuran, transparansi, dan etika tertinggi dalam semua aspek.</p>
            </div>
            
            <!-- Value 2 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <i class="fas fa-trophy text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Keunggulan</h3>
                <p class="text-gray-600">Kami berkomitmen untuk memberikan standar layanan tertinggi dan terus meningkatkan diri.</p>
            </div>
            
            <!-- Value 3 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <i class="fas fa-handshake text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Kerjasama</h3>
                <p class="text-gray-600">Kami menghargai kerja tim dan kolaborasi dengan pelanggan untuk solusi terbaik.</p>
            </div>
            
            <!-- Value 4 -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <i class="fas fa-lightbulb text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Inovasi</h3>
                <p class="text-gray-600">Kami terus mengembangkan solusi baru untuk menghadapi tantangan logistik modern.</p>
            </div>
        </div>
    </div>
</div>

<!-- Team -->
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Tim Kepemimpinan</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Perkenalkan tim berpengalaman yang memimpin ZDX Cargo.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-32 h-32 bg-gray-300 rounded-full overflow-hidden mx-auto mb-4">
                    <div class="w-full h-full flex items-center justify-center text-gray-500">Foto</div>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Budi Santoso</h3>
                <p class="text-indigo-600 mb-3">CEO & Founder</p>
                <p class="text-gray-600 mb-4">Berpengalaman lebih dari 20 tahun di industri logistik dan pengiriman dengan visi membangun ZDX Cargo menjadi pemimpin pasar.</p>
                <div class="flex justify-center space-x-3">
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-32 h-32 bg-gray-300 rounded-full overflow-hidden mx-auto mb-4">
                    <div class="w-full h-full flex items-center justify-center text-gray-500">Foto</div>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Siti Rahayu</h3>
                <p class="text-indigo-600 mb-3">COO</p>
                <p class="text-gray-600 mb-4">Ahli operasional dengan latar belakang manajemen rantai pasok yang kuat. Memimpin operasi ZDX Cargo di seluruh Indonesia.</p>
                <div class="flex justify-center space-x-3">
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center card-hover">
                <div class="w-32 h-32 bg-gray-300 rounded-full overflow-hidden mx-auto mb-4">
                    <div class="w-full h-full flex items-center justify-center text-gray-500">Foto</div>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Andi Wijaya</h3>
                <p class="text-indigo-600 mb-3">CTO</p>
                <p class="text-gray-600 mb-4">Spesialis teknologi dengan fokus pada implementasi sistem pelacakan dan manajemen pengiriman berbasis teknologi terkini.</p>
                <div class="flex justify-center space-x-3">
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Achievements -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Pencapaian & Penghargaan</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Pengakuan atas komitmen dan keunggulan kami dalam industri logistik.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative h-80 bg-gray-200 rounded-lg overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-600 opacity-0 group-hover:opacity-80 transition-opacity duration-300 flex items-center justify-center">
                    <div class="text-white text-center p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-xl font-bold mb-2">Perusahaan Logistik Terbaik 2023</h3>
                        <p>Penghargaan untuk keunggulan layanan dan inovasi di industri logistik Indonesia.</p>
                    </div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-gray-500">Penghargaan 1</span>
                </div>
            </div>
            
            <div class="relative h-80 bg-gray-200 rounded-lg overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-600 opacity-0 group-hover:opacity-80 transition-opacity duration-300 flex items-center justify-center">
                    <div class="text-white text-center p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-xl font-bold mb-2">ISO 9001:2015</h3>
                        <p>Sertifikasi untuk sistem manajemen mutu yang memenuhi standar internasional.</p>
                    </div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-gray-500">Sertifikasi</span>
                </div>
            </div>
            
            <div class="relative h-80 bg-gray-200 rounded-lg overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-600 opacity-0 group-hover:opacity-80 transition-opacity duration-300 flex items-center justify-center">
                    <div class="text-white text-center p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-xl font-bold mb-2">Top Brand Award 2022</h3>
                        <p>Penghargaan sebagai merek terpercaya dalam kategori jasa pengiriman barang.</p>
                    </div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-gray-500">Penghargaan 2</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="py-12 bg-gradient-to-r from-indigo-700 to-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Tertarik Bekerja Sama dengan Kami?</h2>
        <p class="text-lg text-indigo-100 max-w-3xl mx-auto mb-8">Hubungi tim kami untuk mendiskusikan solusi logistik yang sesuai dengan kebutuhan bisnis Anda.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/kontak" class="px-8 py-3 bg-white text-indigo-700 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition-colors">Hubungi Kami</a>
            <a href="/layanan" class="px-8 py-3 bg-indigo-800 text-white rounded-lg font-semibold shadow-md hover:bg-indigo-900 transition-colors">Layanan Kami</a>
        </div>
    </div>
</div>
@endsection 