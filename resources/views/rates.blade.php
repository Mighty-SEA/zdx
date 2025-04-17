@extends('layouts.app')

@section('meta_tags')
<title>{{ $seo->title ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}</title>
<meta name="description" content="{{ $seo->description ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">
<meta name="keywords" content="{{ $seo->keywords ?? 'tarif pengiriman, harga cargo, biaya logistik, ongkos kirim, ekspedisi' }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url('/rates') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/rates') }}">
<meta property="og:title" content="{{ $seo->title ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}">
<meta property="og:description" content="{{ $seo->description ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-[#E65100] to-[#FF6000] py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">Tarif Pengiriman</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Temukan tarif pengiriman yang kompetitif dan transparan untuk kebutuhan Anda
            </p>
        </div>
    </div>

    <!-- Rate Calculator -->
    <div class="max-w-4xl mx-auto px-4 py-16 -mt-12 relative z-20">
        <div class="bg-white rounded-xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-center mb-8">Kalkulator Tarif</h2>
            <div id="rate-calculator">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Kota Tujuan</label>
                        <select id="destination-city" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]">
                            <option value="">Pilih Kota Tujuan</option>
                            @foreach($popularCities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Berat (kg)</label>
                        <input type="number" id="weight" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]" placeholder="Masukkan berat" min="1" step="0.1">
                    </div>
                </div>

                <button type="button" id="calculate-rate" class="w-full bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    Hitung Tarif
                </button>

                <div id="calculation-result" class="mt-6 hidden">
                    <div class="bg-[#FFF0E6] p-6 rounded-lg">
                        <h3 class="text-xl font-bold mb-4">Hasil Perhitungan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-700">Tujuan:</p>
                                <p id="result-destination" class="font-bold text-lg"></p>
                            </div>
                            <div>
                                <p class="text-gray-700">Berat:</p>
                                <p id="result-weight" class="font-bold text-lg"></p>
                            </div>
                            <div>
                                <p class="text-gray-700">Tarif per kg:</p>
                                <p id="result-rate" class="font-bold text-lg"></p>
                            </div>
                            <div>
                                <p class="text-gray-700">Total Biaya:</p>
                                <p id="result-total" class="font-bold text-xl text-[#FF6000]"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="error-message" class="mt-6 hidden">
                    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg">
                        <p id="error-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rate Tables -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Tarif Populer</h2>
        
        <!-- Filters -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <select id="filter-island" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]">
                    <option value="">Semua Pulau</option>
                    @foreach($islands as $island)
                        <option value="{{ $island }}">{{ $island }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select id="filter-province" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]">
                    <option value="">Semua Provinsi</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="text" id="search-city" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000]" placeholder="Cari kota/kabupaten...">
            </div>
        </div>
        
        <!-- Rate Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#FFF0E6]">
                            <th class="text-left py-4 px-6 font-semibold text-gray-800">Kota Tujuan</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-800">Provinsi</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-800">Pulau</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-800">Tarif (/kg)</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-800">Minimum (kg)</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-800">Estimasi (hari)</th>
                        </tr>
                    </thead>
                    <tbody id="rate-table-body">
                        @foreach($popularRates as $rate)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-4 px-6">{{ $rate->kota_kab }}</td>
                            <td class="py-4 px-6">{{ $rate->provinsi }}</td>
                            <td class="py-4 px-6">{{ $rate->pulau }}</td>
                            <td class="py-4 px-6 font-medium text-[#FF6000]">Rp{{ number_format($rate->harga_satuan, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">{{ $rate->minimal_kg }}</td>
                            <td class="py-4 px-6">{{ $rate->estimasi ?? '1-3' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-[#FFF0E6] p-8 rounded-xl mb-12">
            <h3 class="text-xl font-bold mb-4 text-gray-800">Catatan Penting:</h3>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-[#FF6000] mt-1 mr-2"></i>
                    <span>Tarif di atas sudah termasuk pajak, namun belum termasuk asuransi pengiriman</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-[#FF6000] mt-1 mr-2"></i>
                    <span>Perhitungan berat volumetrik: (P x L x T) / 6000</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-[#FF6000] mt-1 mr-2"></i>
                    <span>Tarif dapat berubah sewaktu-waktu tergantung situasi dan kondisi</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-[#FF6000] mt-1 mr-2"></i>
                    <span>Untuk pengiriman dengan berat di atas 10kg, berlaku tarif khusus</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Butuh Penawaran Khusus?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Dapatkan penawaran harga spesial untuk pengiriman dalam jumlah besar atau kontrak jangka panjang
            </p>
            <a href="/contact" class="inline-block bg-white text-[#FF6000] px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 hover:-translate-y-1 shadow-md">
                Minta Penawaran
            </a>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calculateBtn = document.getElementById('calculate-rate');
            const destinationCity = document.getElementById('destination-city');
            const weight = document.getElementById('weight');
            const resultDiv = document.getElementById('calculation-result');
            const errorDiv = document.getElementById('error-message');
            const resultDestination = document.getElementById('result-destination');
            const resultWeight = document.getElementById('result-weight');
            const resultRate = document.getElementById('result-rate');
            const resultTotal = document.getElementById('result-total');
            const errorText = document.getElementById('error-text');
            
            // Filter selectors
            const filterIsland = document.getElementById('filter-island');
            const filterProvince = document.getElementById('filter-province');
            const searchCity = document.getElementById('search-city');
            const rateTableBody = document.getElementById('rate-table-body');
            
            calculateBtn.addEventListener('click', function() {
                resultDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
                
                const destination = destinationCity.value;
                const weightValue = weight.value;
                
                if (!destination || !weightValue) {
                    errorText.textContent = 'Harap lengkapi semua field.';
                    errorDiv.classList.remove('hidden');
                    return;
                }
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('destination', destination);
                formData.append('weight', weightValue);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request
                fetch('{{ route('search.rates') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        resultDestination.textContent = data.city;
                        resultWeight.textContent = weightValue + ' kg';
                        resultRate.textContent = 'Rp' + data.rate_formatted;
                        resultTotal.textContent = 'Rp' + data.total_formatted;
                        resultDiv.classList.remove('hidden');
                    } else {
                        errorText.textContent = data.message || 'Tarif tidak ditemukan untuk tujuan tersebut.';
                        errorDiv.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    errorText.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    errorDiv.classList.remove('hidden');
                    console.error('Error:', error);
                });
            });
            
            // Filter functionality
            function applyFilters() {
                const islandValue = filterIsland.value.toLowerCase();
                const provinceValue = filterProvince.value.toLowerCase();
                const cityValue = searchCity.value.toLowerCase();
                
                const rows = rateTableBody.querySelectorAll('tr');
                
                rows.forEach(row => {
                    const cityCell = row.cells[0].textContent.toLowerCase();
                    const provinceCell = row.cells[1].textContent.toLowerCase();
                    const islandCell = row.cells[2].textContent.toLowerCase();
                    
                    const matchIsland = !islandValue || islandCell.includes(islandValue);
                    const matchProvince = !provinceValue || provinceCell.includes(provinceValue);
                    const matchCity = !cityValue || cityCell.includes(cityValue);
                    
                    if (matchIsland && matchProvince && matchCity) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            filterIsland.addEventListener('change', applyFilters);
            filterProvince.addEventListener('change', applyFilters);
            searchCity.addEventListener('input', applyFilters);
        });
    </script>
    @endpush
@endsection 