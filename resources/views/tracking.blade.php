@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-indigo-900 to-blue-800 py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Lacak Pengiriman</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Pantau status pengiriman Anda secara real-time dengan sistem pelacakan kami yang akurat
            </p>
        </div>
    </div>

    <!-- Tracking Form -->
    <div class="max-w-4xl mx-auto px-4 py-16 -mt-12 relative z-20">
        <div class="bg-white rounded-xl shadow-xl p-8 mb-16">
            <h2 class="text-2xl font-bold text-center mb-8">Masukkan Nomor Resi</h2>
            <form class="flex flex-col md:flex-row gap-4">
                <input type="text" class="flex-1 border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: ZDX12345678">
                <button type="button" class="bg-indigo-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                    Lacak Sekarang
                </button>
            </form>
        </div>

        <!-- Tracking Results (Sample) -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
            <div class="bg-indigo-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold">Nomor Resi: ZDX12345678</h3>
                    <span class="px-4 py-1 bg-green-500 rounded-full text-sm font-bold">Dalam Pengiriman</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div>
                        <p class="text-sm text-indigo-200">Pengirim</p>
                        <p class="font-semibold">PT Maju Jaya</p>
                    </div>
                    <div>
                        <p class="text-sm text-indigo-200">Penerima</p>
                        <p class="font-semibold">CV Sukses Selalu</p>
                    </div>
                    <div>
                        <p class="text-sm text-indigo-200">Tanggal Pengiriman</p>
                        <p class="font-semibold">12 Oktober 2023</p>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="p-6">
                <h4 class="font-bold mb-6">Status Pengiriman</h4>
                <div class="space-y-8">
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-4 h-4 bg-green-500 rounded-full"></div>
                        <div class="absolute left-2 top-5 w-0.5 h-16 bg-gray-300"></div>
                        <div>
                            <p class="font-semibold">Paket diterima di Gudang Jakarta</p>
                            <p class="text-sm text-gray-500">12 Oktober 2023, 08:30 WIB</p>
                            <p class="text-sm text-gray-600 mt-1">Barang telah diterima di gudang utama dan siap untuk diproses pengirimannya.</p>
                        </div>
                    </div>
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-4 h-4 bg-green-500 rounded-full"></div>
                        <div class="absolute left-2 top-5 w-0.5 h-16 bg-gray-300"></div>
                        <div>
                            <p class="font-semibold">Paket dalam perjalanan</p>
                            <p class="text-sm text-gray-500">12 Oktober 2023, 14:15 WIB</p>
                            <p class="text-sm text-gray-600 mt-1">Barang sedang dalam perjalanan menuju kota tujuan dengan armada ekspedisi kami.</p>
                        </div>
                    </div>
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-4 h-4 bg-green-500 rounded-full"></div>
                        <div class="absolute left-2 top-5 w-0.5 h-16 bg-gray-300"></div>
                        <div>
                            <p class="font-semibold">Paket tiba di kota tujuan</p>
                            <p class="text-sm text-gray-500">13 Oktober 2023, 10:45 WIB</p>
                            <p class="text-sm text-gray-600 mt-1">Barang telah tiba di gudang distribusi kota tujuan dan sedang dipersiapkan untuk pengantaran.</p>
                        </div>
                    </div>
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-4 h-4 bg-indigo-500 rounded-full"></div>
                        <div>
                            <p class="font-semibold">Paket sedang diantar</p>
                            <p class="text-sm text-gray-500">13 Oktober 2023, 14:20 WIB</p>
                            <p class="text-sm text-gray-600 mt-1">Barang sedang dalam proses pengantaran ke alamat penerima. Estimasi tiba: 16:00 WIB.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="bg-gray-100 rounded-xl p-8">
            <h2 class="text-2xl font-bold mb-6">Pertanyaan Umum</h2>
            <div class="space-y-4">
                <div class="border-b border-gray-300 pb-4">
                    <h3 class="font-semibold mb-2">Bagaimana cara melacak paket saya?</h3>
                    <p class="text-gray-600">Masukkan nomor resi yang Anda terima saat melakukan pengiriman ke dalam kolom di atas, lalu klik tombol "Lacak Sekarang".</p>
                </div>
                <div class="border-b border-gray-300 pb-4">
                    <h3 class="font-semibold mb-2">Di mana saya bisa mendapatkan nomor resi?</h3>
                    <p class="text-gray-600">Nomor resi akan diberikan oleh petugas kami saat Anda melakukan pengiriman. Nomor tersebut juga tercetak pada bukti pengiriman.</p>
                </div>
                <div class="border-b border-gray-300 pb-4">
                    <h3 class="font-semibold mb-2">Berapa lama waktu yang dibutuhkan untuk memperbarui status?</h3>
                    <p class="text-gray-600">Status pengiriman diperbarui secara real-time oleh tim kami di lapangan. Waktu pembaruan biasanya tidak lebih dari 30 menit setelah perubahan status terjadi.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">Apa yang harus saya lakukan jika paket belum sampai sesuai estimasi?</h3>
                    <p class="text-gray-600">Jika paket Anda belum sampai sesuai dengan estimasi yang diberikan, silakan hubungi layanan pelanggan kami di nomor (021) 123-4567 atau melalui email di cs@zdxcargo.com.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-indigo-800 to-blue-700 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Butuh Bantuan?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Tim customer service kami siap membantu Anda dengan pertanyaan seputar pengiriman
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/kontak" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Hubungi Kami
                </a>
                <a href="#" class="inline-block border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition-colors">
                    FAQ
                </a>
            </div>
        </div>
    </div>
@endsection 