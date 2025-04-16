@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-indigo-900 to-blue-800 py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Hubungi Kami</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Tim kami siap membantu Anda dengan segala pertanyaan dan kebutuhan pengiriman
            </p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Nama Anda">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Perusahaan (Opsional)</label>
                            <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Nama Perusahaan">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Email</label>
                            <input type="email" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="email@anda.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Telepon</label>
                            <input type="tel" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="08123456789">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Subjek</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Subjek pesan Anda">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Pesan</label>
                        <textarea rows="5" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="button" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                        Kirim Pesan
                    </button>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div>
                <div class="bg-gray-100 rounded-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="text-xl text-indigo-600 mt-1 mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Kantor Pusat</h3>
                                <p class="text-gray-600">
                                    Jalan Merdeka No. 123<br>
                                    Jakarta Pusat, 10110<br>
                                    Indonesia
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="text-xl text-indigo-600 mt-1 mr-4">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Telepon</h3>
                                <p class="text-gray-600">
                                    Layanan Pelanggan: (021) 123-4567<br>
                                    Pengiriman: (021) 765-4321
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="text-xl text-indigo-600 mt-1 mr-4">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Email</h3>
                                <p class="text-gray-600">
                                    Info: info@zdxcargo.com<br>
                                    Layanan Pelanggan: cs@zdxcargo.com<br>
                                    Karir: karir@zdxcargo.com
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="text-xl text-indigo-600 mt-1 mr-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Jam Operasional</h3>
                                <p class="text-gray-600">
                                    Senin - Jumat: 08:00 - 17:00<br>
                                    Sabtu: 08:00 - 14:00<br>
                                    Minggu & Hari Libur: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Maps -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden h-80">
                    <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                        <div class="text-center p-4">
                            <i class="fas fa-map-marked-alt text-5xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600">Peta akan ditampilkan di sini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branch Offices -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Kantor Cabang</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Branch 1 -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-xl mb-4">Surabaya</h3>
                <div class="space-y-4 text-gray-600">
                    <p><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i> Jalan Raya Darmo No. 45, Surabaya</p>
                    <p><i class="fas fa-phone text-indigo-600 mr-2"></i> (031) 567-8901</p>
                    <p><i class="fas fa-envelope text-indigo-600 mr-2"></i> surabaya@zdxcargo.com</p>
                </div>
            </div>
            
            <!-- Branch 2 -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-xl mb-4">Bandung</h3>
                <div class="space-y-4 text-gray-600">
                    <p><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i> Jalan Asia Afrika No. 78, Bandung</p>
                    <p><i class="fas fa-phone text-indigo-600 mr-2"></i> (022) 123-4567</p>
                    <p><i class="fas fa-envelope text-indigo-600 mr-2"></i> bandung@zdxcargo.com</p>
                </div>
            </div>
            
            <!-- Branch 3 -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-xl mb-4">Medan</h3>
                <div class="space-y-4 text-gray-600">
                    <p><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i> Jalan Iskandar Muda No. 120, Medan</p>
                    <p><i class="fas fa-phone text-indigo-600 mr-2"></i> (061) 456-7890</p>
                    <p><i class="fas fa-envelope text-indigo-600 mr-2"></i> medan@zdxcargo.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-indigo-800 to-blue-700 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Bergabunglah dengan ZDX Cargo</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Kami selalu mencari individu berbakat untuk bergabung dengan tim kami yang terus berkembang
            </p>
            <a href="#" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Karir di ZDX Cargo
            </a>
        </div>
    </div>
@endsection 