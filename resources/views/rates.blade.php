@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-indigo-900 to-blue-800 py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Tarif Pengiriman</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Temukan tarif pengiriman yang kompetitif dan transparans untuk kebutuhan Anda
            </p>
        </div>
    </div>

    <!-- Rate Calculator -->
    <div class="max-w-4xl mx-auto px-4 py-16 -mt-12 relative z-20">
        <div class="bg-white rounded-xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-center mb-8">Kalkulator Tarif</h2>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Kota Asal</label>
                        <select class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Pilih Kota Asal</option>
                            <option>Jakarta</option>
                            <option>Surabaya</option>
                            <option>Bandung</option>
                            <option>Medan</option>
                            <option>Makassar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Kota Tujuan</label>
                        <select class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Pilih Kota Tujuan</option>
                            <option>Jakarta</option>
                            <option>Surabaya</option>
                            <option>Bandung</option>
                            <option>Medan</option>
                            <option>Makassar</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 mb-2">Berat (kg)</label>
                        <input type="number" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan berat">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Panjang (cm)</label>
                        <input type="number" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Panjang">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Jenis Layanan</label>
                        <select class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Pilih Layanan</option>
                            <option>Reguler</option>
                            <option>Ekspres</option>
                            <option>Super Ekspres</option>
                        </select>
                    </div>
                </div>

                <button type="button" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                    Hitung Tarif
                </button>
            </form>
        </div>
    </div>

    <!-- Rate Tables -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Tarif Populer</h2>
        
        <!-- Tabs -->
        <div class="flex justify-center mb-8">
            <button class="px-8 py-3 bg-indigo-600 text-white rounded-l-lg font-semibold">Darat</button>
            <button class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold">Laut</button>
            <button class="px-8 py-3 bg-gray-200 text-gray-700 rounded-r-lg font-semibold">Udara</button>
        </div>
        
        <!-- Rate Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left py-4 px-6 font-semibold">Rute</th>
                            <th class="text-left py-4 px-6 font-semibold">Jarak (km)</th>
                            <th class="text-left py-4 px-6 font-semibold">Waktu</th>
                            <th class="text-left py-4 px-6 font-semibold">Tarif (/kg)</th>
                            <th class="text-left py-4 px-6 font-semibold">Minimum (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-4 px-6">Jakarta - Bandung</td>
                            <td class="py-4 px-6">150</td>
                            <td class="py-4 px-6">1 hari</td>
                            <td class="py-4 px-6">Rp15.000</td>
                            <td class="py-4 px-6">1</td>
                        </tr>
                        <tr class="border-b bg-gray-50">
                            <td class="py-4 px-6">Jakarta - Surabaya</td>
                            <td class="py-4 px-6">800</td>
                            <td class="py-4 px-6">2 hari</td>
                            <td class="py-4 px-6">Rp22.000</td>
                            <td class="py-4 px-6">1</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 px-6">Jakarta - Yogyakarta</td>
                            <td class="py-4 px-6">450</td>
                            <td class="py-4 px-6">1-2 hari</td>
                            <td class="py-4 px-6">Rp18.000</td>
                            <td class="py-4 px-6">1</td>
                        </tr>
                        <tr class="border-b bg-gray-50">
                            <td class="py-4 px-6">Surabaya - Malang</td>
                            <td class="py-4 px-6">95</td>
                            <td class="py-4 px-6">1 hari</td>
                            <td class="py-4 px-6">Rp12.000</td>
                            <td class="py-4 px-6">1</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6">Bandung - Cirebon</td>
                            <td class="py-4 px-6">130</td>
                            <td class="py-4 px-6">1 hari</td>
                            <td class="py-4 px-6">Rp14.000</td>
                            <td class="py-4 px-6">1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-gray-100 p-8 rounded-xl mb-12">
            <h3 class="text-xl font-bold mb-4">Catatan Penting:</h3>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-indigo-600 mt-1 mr-2"></i>
                    <span>Tarif di atas sudah termasuk pajak, namun belum termasuk asuransi pengiriman</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-indigo-600 mt-1 mr-2"></i>
                    <span>Perhitungan berat volumetrik: (P x L x T) / 6000</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-indigo-600 mt-1 mr-2"></i>
                    <span>Tarif dapat berubah sewaktu-waktu tergantung situasi dan kondisi</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-indigo-600 mt-1 mr-2"></i>
                    <span>Untuk pengiriman dengan berat di atas 10kg, berlaku tarif khusus</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-indigo-800 to-blue-700 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Butuh Penawaran Khusus?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Dapatkan penawaran harga spesial untuk pengiriman dalam jumlah besar atau kontrak jangka panjang
            </p>
            <a href="/kontak" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Minta Penawaran
            </a>
        </div>
    </div>
@endsection 