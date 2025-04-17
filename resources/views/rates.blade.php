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
    <div class="max-w-7xl mx-auto px-4 pt-8 pb-16">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Cek Ongkir ZDX Express</h1>
            <p class="text-gray-600 mt-2">Hitung biaya pengiriman Anda dengan mudah dan cepat</p>
        </div>

        <!-- Desktop: Single column layout, Mobile: 1 column -->
        <div class="grid grid-cols-1 gap-8">
            <!-- Calculator Box -->
            <div class="max-w-xl mx-auto lg:max-w-full w-full">
                <div class="bg-gray-50 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] py-3 px-6">
                        <h2 class="text-xl font-bold text-white">Kalkulator Ongkir</h2>
                    </div>
                    
                    <div class="p-6" id="rate-calculator">
                        <!-- Step 1 -->
                        <div class="mb-5">
                            <div class="flex items-center mb-3">
                                <div class="w-6 h-6 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-bold mr-2">1</div>
                                <label class="font-semibold text-gray-700">Pilih Tujuan</label>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <div>
                                    <select id="province-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province }}">{{ $province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <select id="city-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" disabled>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="kelurahan-select" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" disabled>
                                        <option value="">Pilih Kelurahan/Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="mb-5">
                            <div class="flex items-center mb-3">
                                <div class="w-6 h-6 rounded-full bg-[#FF6000] text-white flex items-center justify-center font-bold mr-2">2</div>
                                <label class="font-semibold text-gray-700">Masukkan Berat dalam kg</label>
                            </div>
                            <div class="flex items-center">
                                <input type="number" id="weight" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" placeholder="Contoh: 100" min="0.1" step="0.1">
                                <span class="ml-3 text-gray-600 font-medium">kg</span>
                            </div>
                        </div>
                        
                        <!-- Hitung Button -->
                        <button type="button" id="calculate-rate" class="w-full bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-3 rounded-lg font-semibold hover:shadow-md transition-all duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Hitung Ongkir
                        </button>

                        <!-- Result -->
                        <div id="calculation-result" class="mt-5 hidden">
                            <div class="bg-[#FFF8F2] rounded-lg p-5 border border-[#FFE0CC]">
                                <h3 class="text-lg font-bold text-gray-800 mb-3 pb-2 border-b border-gray-200">Hasil Perhitungan</h3>
                                
                                <!-- Tampilan pesan khusus untuk tarif 0 -->
                                <div id="zero-rate-message" class="hidden text-center py-3">
                                    <p class="text-[#FF6000] font-semibold mb-3">Untuk rute ini silahkan hubungi kami</p>
                                    <a href="/contact" class="inline-block bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-2 px-5 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                                        Hubungi Kami
                                    </a>
                                </div>
                                
                                <!-- Tampilan normal untuk hasil perhitungan -->
                                <div id="normal-rate-result">
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tujuan:</span>
                                            <span id="result-destination" class="font-semibold text-gray-800"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Berat:</span>
                                            <span id="result-weight" class="font-semibold text-gray-800"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tarif per kg:</span>
                                            <span id="result-rate" class="font-semibold text-gray-800"></span>
                                        </div>
                                        <div class="flex justify-between pt-2 border-t border-gray-200">
                                            <span class="text-gray-600 font-medium">Total Biaya:</span>
                                            <span id="result-total" class="font-bold text-[#FF6000]"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 pt-3 border-t border-gray-200 flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Butuh bantuan?</span>
                                        <a href="/contact" class="text-[#FF6000] font-medium hover:underline">
                                            Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div id="error-message" class="mt-5 hidden">
                            <div class="bg-red-50 border border-red-100 text-red-700 p-4 rounded-lg">
                                <p id="error-text" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tarif Populer Box -->
            <div class="w-full">
                <div class="bg-gray-50 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] py-3 px-6">
                        <h2 class="text-xl font-bold text-white">Tarif Populer</h2>
                    </div>
                    
                    <!-- Filters -->
                    <div class="p-4 bg-gray-100/50 border-b border-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <select id="filter-island" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white">
                                    <option value="">Semua Pulau</option>
                                    @foreach($islands as $island)
                                        <option value="{{ $island }}">{{ $island }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select id="filter-province" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white">
                                    <option value="">Semua Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province }}">{{ $province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <div class="relative">
                                    <input type="text" id="search-city" class="w-full border border-gray-300 rounded-lg p-2 pl-8 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF6000] bg-white" placeholder="Cari kota/kecamatan...">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table (desktop) dan Cards (mobile) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100/50">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Kota Tujuan</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Provinsi</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Tarif (/kg)</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Min (kg)</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Estimasi</th>
                                </tr>
                            </thead>
                            <tbody id="rate-table-body">
                                @foreach($popularRates as $rate)
                                <tr class="border-t border-gray-100 hover:bg-gray-100/30">
                                    <td class="py-3 px-4">
                                        <div class="font-medium text-gray-800">{{ $rate->kota_kab }}</div>
                                        @if($rate->kelurahan_kecamatan)
                                        <div class="text-xs text-gray-500">{{ $rate->kelurahan_kecamatan }}</div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $rate->provinsi }}</td>
                                    <td class="py-3 px-4 font-medium text-[#FF6000]">Rp{{ number_format($rate->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $rate->minimal_kg }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $rate->estimasi ?? '1-3' }} hari</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Mobile Cards View -->
                    <div class="md:hidden" id="mobile-rate-cards">
                        <div class="divide-y divide-gray-100">
                            @foreach($popularRates as $rate)
                            <div class="p-4 hover:bg-gray-100/30">
                                <div class="flex justify-between mb-2">
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $rate->kota_kab }}</div>
                                        @if($rate->kelurahan_kecamatan)
                                        <div class="text-xs text-gray-500">{{ $rate->kelurahan_kecamatan }}</div>
                                        @endif
                                        <div class="text-xs text-gray-500 mt-1">{{ $rate->provinsi }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-medium text-[#FF6000]">Rp{{ number_format($rate->harga_satuan, 0, ',', '.') }}</div>
                                        <div class="text-xs text-gray-500 mt-1">Min: {{ $rate->minimal_kg }} kg</div>
                                    </div>
                                </div>
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Estimasi {{ $rate->estimasi ?? '1-3' }} hari
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-[#FFF0E6] py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Butuh Penawaran Khusus?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Dapatkan penawaran harga spesial untuk pengiriman dalam jumlah besar atau kontrak jangka panjang
            </p>
            <a href="/contact" class="inline-block bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                Minta Penawaran
            </a>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calculateBtn = document.getElementById('calculate-rate');
            const provinceSelect = document.getElementById('province-select');
            const citySelect = document.getElementById('city-select');
            const kelurahanSelect = document.getElementById('kelurahan-select');
            const weight = document.getElementById('weight');
            const resultDiv = document.getElementById('calculation-result');
            const errorDiv = document.getElementById('error-message');
            const resultDestination = document.getElementById('result-destination');
            const resultWeight = document.getElementById('result-weight');
            const resultRate = document.getElementById('result-rate');
            const resultTotal = document.getElementById('result-total');
            const errorText = document.getElementById('error-text').querySelector('span');
            
            // Filter selectors
            const filterIsland = document.getElementById('filter-island');
            const filterProvince = document.getElementById('filter-province');
            const searchCity = document.getElementById('search-city');
            const rateTableBody = document.getElementById('rate-table-body');
            
            // Event listener for provinsi dropdown
            provinceSelect.addEventListener('change', function() {
                const province = this.value;
                
                // Reset dependent dropdowns
                citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Kecamatan</option>';
                
                kelurahanSelect.disabled = true;
                
                if (!province) {
                    citySelect.disabled = true;
                    return;
                }
                
                // Show loading state
                citySelect.disabled = true;
                citySelect.innerHTML = '<option value="">Memuat data...</option>';
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('province', province);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request to get cities for the selected province
                fetch('{{ route('get.cities') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    
                    if (data.success && data.cities.length > 0) {
                        data.cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            citySelect.appendChild(option);
                        });
                        citySelect.disabled = false;
                    } else {
                        citySelect.innerHTML = '<option value="">Tidak ada data kota</option>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    citySelect.innerHTML = '<option value="">Error memuat data</option>';
                });
            });
            
            // Event listener for kota/kabupaten dropdown
            citySelect.addEventListener('change', function() {
                const city = this.value;
                const province = provinceSelect.value;
                
                // Reset kelurahan dropdown
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Kecamatan</option>';
                
                if (!city || !province) {
                    kelurahanSelect.disabled = true;
                    return;
                }
                
                // Show loading state
                kelurahanSelect.disabled = true;
                kelurahanSelect.innerHTML = '<option value="">Memuat data...</option>';
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('province', province);
                formData.append('city', city);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request to get kelurahan/kecamatan for the selected city
                fetch('{{ route('get.kelurahans') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Kecamatan</option>';
                    
                    if (data.success && data.kelurahans.length > 0) {
                        data.kelurahans.forEach(kelurahan => {
                            const option = document.createElement('option');
                            option.value = kelurahan;
                            option.textContent = kelurahan;
                            kelurahanSelect.appendChild(option);
                        });
                        kelurahanSelect.disabled = false;
                    } else {
                        kelurahanSelect.innerHTML = '<option value="">Tidak ada data kelurahan</option>';
                        // Allow calculation without kelurahan if no data available
                        kelurahanSelect.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    kelurahanSelect.innerHTML = '<option value="">Error memuat data</option>';
                });
            });
            
            calculateBtn.addEventListener('click', function() {
                resultDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
                
                const province = provinceSelect.value;
                const city = citySelect.value;
                const kelurahan = kelurahanSelect.value;
                const weightValue = weight.value;
                
                if (!province || !city || !weightValue) {
                    errorText.textContent = 'Harap lengkapi provinsi, kota, dan berat.';
                    errorDiv.classList.remove('hidden');
                    return;
                }
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('province', province);
                formData.append('city', city);
                if (kelurahan) {
                    formData.append('kelurahan', kelurahan);
                }
                formData.append('weight', weightValue);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request
                fetch('{{ route('calculate.rates') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let destinationText = `${city}, ${province}`;
                        if (kelurahan) {
                            destinationText = `${kelurahan}, ${city}, ${province}`;
                        }
                        
                        // Referensi ke elemen untuk tampilan tarif 0 dan tampilan normal
                        const zeroRateMessage = document.getElementById('zero-rate-message');
                        const normalRateResult = document.getElementById('normal-rate-result');
                        
                        // Cek apakah tarif adalah 0
                        if (data.rate === 0 || data.rate_formatted === "0") {
                            // Tampilkan pesan untuk tarif 0
                            zeroRateMessage.classList.remove('hidden');
                            normalRateResult.classList.add('hidden');
                        } else {
                            // Tampilkan hasil perhitungan normal
                            zeroRateMessage.classList.add('hidden');
                            normalRateResult.classList.remove('hidden');
                            
                            // Isi data hasil perhitungan
                            resultDestination.textContent = destinationText;
                            resultWeight.textContent = weightValue + ' kg';
                            resultRate.textContent = 'Rp' + data.rate_formatted;
                            resultTotal.textContent = 'Rp' + data.total_formatted;
                        }
                        
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
                
                // Filter untuk tampilan tabel desktop
                const rows = rateTableBody.querySelectorAll('tr');
                
                rows.forEach(row => {
                    const cityCell = row.cells[0].textContent.toLowerCase();
                    const provinceCell = row.cells[1].textContent.toLowerCase();
                    const islandIndex = Array.from(row.parentNode.children).indexOf(row);
                    const islandCell = islandIndex < popularRates.length ? popularRates[islandIndex].pulau.toLowerCase() : '';
                    
                    const matchIsland = !islandValue || islandCell.includes(islandValue);
                    const matchProvince = !provinceValue || provinceCell.includes(provinceValue);
                    const matchCity = !cityValue || cityCell.includes(cityValue);
                    
                    if (matchIsland && matchProvince && matchCity) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Filter untuk tampilan card mobile
                const mobileCards = document.querySelectorAll('#mobile-rate-cards > div > div');
                
                mobileCards.forEach((card, index) => {
                    if (index >= popularRates.length) return;
                    
                    const cardCity = card.querySelector('.font-medium.text-gray-800').textContent.toLowerCase();
                    const cardKelurahan = card.querySelector('.text-xs.text-gray-500')?.textContent.toLowerCase() || '';
                    const cardProvince = card.querySelectorAll('.text-xs.text-gray-500')[card.querySelector('.text-xs.text-gray-500:not([class*="mt-"])') ? 1 : 0].textContent.toLowerCase();
                    const cardIsland = popularRates[index].pulau.toLowerCase();
                    
                    const cityFullText = (cardCity + ' ' + cardKelurahan).toLowerCase();
                    
                    const matchIsland = !islandValue || cardIsland.includes(islandValue);
                    const matchProvince = !provinceValue || cardProvince.includes(provinceValue);
                    const matchCity = !cityValue || cityFullText.includes(cityValue);
                    
                    if (matchIsland && matchProvince && matchCity) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
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