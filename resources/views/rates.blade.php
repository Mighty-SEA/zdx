@extends('layouts.app')

@section('meta_tags')
<title>{{ $seo->title ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}</title>
<link rel="icon" type="image/png" href="{{ !empty($companyInfo->title_logo_path) ? asset('storage/'.$companyInfo->title_logo_path) : asset('asset/logo.png') }}">
<meta name="description" content="{{ $seo->description ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">
<meta name="keywords" content="{{ $seo->keywords ?? 'tarif pengiriman, harga cargo, biaya logistik, ongkos kirim, ekspedisi' }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url('/rates') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/rates') }}">
<meta property="og:title" content="{{ $seo->title ?? 'Tarif Pengiriman - PT. Zindan Diantar Express' }}">
<meta property="og:description" content="{{ $seo->description ?? 'Informasi tarif pengiriman barang ZDX Cargo yang kompetitif dan transparan untuk kebutuhan logistik Anda.' }}">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Custom Select2 CSS -->
<style>
    .select2-container--default .select2-selection--single {
        height: 48px;
        padding: 10px 8px;
        border-color: #d1d5db;
        border-radius: 0.5rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #4b5563;
        line-height: normal;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #FF6000;
    }
    
    .select2-dropdown {
        border-color: #d1d5db;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .select2-search--dropdown .select2-search__field {
        border-radius: 0.25rem;
        border-color: #d1d5db;
        padding: 8px;
    }
    
    .select2-search--dropdown .select2-search__field:focus {
        outline: 2px solid #FF6000;
        border-color: #FF6000;
    }

    .elegant-button {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
        background-size: 200% auto;
        background-position: right center;
    }
    
    .elegant-button:hover {
        background-position: left center;
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(0, 85, 255, 0.2), 0 3px 6px rgba(0, 0, 0, 0.1);
    }
    
    .elegant-button::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to bottom right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 100%);
        transform: rotate(30deg);
        transition: all 0.6s;
        opacity: 0;
    }
    
    .elegant-button:hover::after {
        opacity: 1;
    }
    
    .elegant-button .btn-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg, 
            rgba(255, 255, 255, 0) 0%, 
            rgba(255, 255, 255, 0.2) 50%, 
            rgba(255, 255, 255, 0) 100%
        );
        animation: shine-effect 3s infinite;
    }
    
    @keyframes shine-effect {
        0% {
            left: -100%;
        }
        20% {
            left: 100%;
        }
        100% {
            left: 100%;
        }
    }
</style>
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
                                    
                                    <div class="mt-4 pt-3 border-t border-gray-200 flex justify-center">
                                        <a href="/order" class="elegant-button w-full bg-gradient-to-r from-[#0066CC] to-[#2D9CDB] text-white py-3 rounded-lg font-semibold transition-all duration-500 text-center text-lg shadow-md">
                                            <span class="btn-shine"></span>
                                            Pesan Sekarang
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
                        <div class="mt-2 flex justify-end">
                            <button id="reset-filters" class="text-sm text-[#FF6000] hover:underline flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset Filter
                            </button>
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
                                <tr class="border-t border-gray-100 hover:bg-gray-100/30" 
                                    data-island="{{ $rate->pulau }}" 
                                    data-province="{{ $rate->provinsi }}" 
                                    data-city="{{ $rate->kota_kab }}" 
                                    data-kelurahan="{{ $rate->kelurahan_kecamatan }}">
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
                            <div class="p-4 hover:bg-gray-100/30"
                                data-island="{{ $rate->pulau }}" 
                                data-province="{{ $rate->provinsi }}" 
                                data-city="{{ $rate->kota_kab }}" 
                                data-kelurahan="{{ $rate->kelurahan_kecamatan }}">
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
    <!-- jQuery (diperlukan untuk Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Menyimpan data popularRates dalam object JavaScript
        const popularRates = @json($popularRates);
        
        $(document).ready(function() {
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
            
            // Inisialisasi Select2 pada dropdown provinsi
            $('#province-select').select2({
                placeholder: "Pilih Provinsi",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Provinsi tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            $('#city-select').select2({
                placeholder: "Pilih Kota/Kabupaten",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Kota tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            $('#kelurahan-select').select2({
                placeholder: "Pilih Kelurahan/Kecamatan",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Kelurahan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
            
            // Filter selectors
            const filterIsland = document.getElementById('filter-island');
            const filterProvince = document.getElementById('filter-province');
            const searchCity = document.getElementById('search-city');
            const rateTableBody = document.getElementById('rate-table-body');
            
            // Event listener untuk provinsi dropdown (menggunakan event Select2)
            $('#province-select').on('change', function() {
                const province = this.value;
                
                // Reset dependent dropdowns
                $('#city-select').empty().append('<option value="">Pilih Kota/Kabupaten</option>').trigger('change');
                $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').trigger('change');
                
                $('#kelurahan-select').prop('disabled', true);
                
                if (!province) {
                    $('#city-select').prop('disabled', true).trigger('change');
                    return;
                }
                
                // Show loading state
                $('#city-select').prop('disabled', true).empty().append('<option value="">Memuat data...</option>').trigger('change');
                
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
                    $('#city-select').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                    
                    if (data.success && data.cities.length > 0) {
                        data.cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            $('#city-select').append(option);
                        });
                        $('#city-select').prop('disabled', false).trigger('change');
                    } else {
                        $('#city-select').empty().append('<option value="">Tidak ada data kota</option>').trigger('change');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    $('#city-select').empty().append('<option value="">Error memuat data</option>').trigger('change');
                });
            });
            
            // Event listener untuk kota/kabupaten dropdown (menggunakan event Select2)
            $('#city-select').on('change', function() {
                const city = this.value;
                const province = $('#province-select').val();
                
                // Reset kelurahan dropdown
                $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').trigger('change');
                
                if (!city || !province) {
                    $('#kelurahan-select').prop('disabled', true).trigger('change');
                    return;
                }
                
                // Show loading state
                $('#kelurahan-select').prop('disabled', true).empty().append('<option value="">Memuat data...</option>').trigger('change');
                
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
                    $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>');
                    
                    if (data.success && data.kelurahans.length > 0) {
                        data.kelurahans.forEach(kelurahan => {
                            const option = document.createElement('option');
                            option.value = kelurahan;
                            option.textContent = kelurahan;
                            $('#kelurahan-select').append(option);
                        });
                        $('#kelurahan-select').prop('disabled', false).trigger('change');
                    } else {
                        $('#kelurahan-select').empty().append('<option value="">Tidak ada data kelurahan</option>').trigger('change');
                        // Allow calculation without kelurahan if no data available
                        $('#kelurahan-select').prop('disabled', false).trigger('change');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    $('#kelurahan-select').empty().append('<option value="">Error memuat data</option>').trigger('change');
                });
            });
            
            calculateBtn.addEventListener('click', function() {
                resultDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
                
                const province = $('#province-select').val();
                const city = $('#city-select').val();
                const kelurahan = $('#kelurahan-select').val();
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
            
            // Inisialisasi Select2 untuk filter juga
            $('#filter-island').select2({
                placeholder: "Semua Pulau",
                allowClear: true,
                width: '100%'
            });
            
            $('#filter-province').select2({
                placeholder: "Semua Provinsi",
                allowClear: true,
                width: '100%'
            });
            
            // Menambahkan fungsi debounce untuk pencarian
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }
            
            // Filter functionality
            function applyFilters() {
                const islandValue = $('#filter-island').val() ? $('#filter-island').val().toLowerCase() : '';
                const provinceValue = $('#filter-province').val() ? $('#filter-province').val().toLowerCase() : '';
                const cityValue = searchCity.value.toLowerCase();
                
                // Tambahkan kelas loading
                rateTableBody.classList.add('opacity-50');
                document.getElementById('mobile-rate-cards').classList.add('opacity-50');
                
                // Gunakan setTimeout untuk mencegah UI freezing pada dataset besar
                setTimeout(() => {
                    // Filter untuk tampilan tabel desktop
                    const rows = rateTableBody.querySelectorAll('tr');
                    let visibleCount = 0;
                    
                    rows.forEach(row => {
                        const cityText = (row.getAttribute('data-city') || '').toLowerCase();
                        const kelurahanText = (row.getAttribute('data-kelurahan') || '').toLowerCase();
                        const provinceText = (row.getAttribute('data-province') || '').toLowerCase();
                        const islandText = (row.getAttribute('data-island') || '').toLowerCase();
                        
                        const cityFullText = cityText + ' ' + kelurahanText;
                        
                        const matchIsland = !islandValue || islandText.includes(islandValue);
                        const matchProvince = !provinceValue || provinceText.includes(provinceValue);
                        const matchCity = !cityValue || cityFullText.includes(cityValue);
                        
                        const isVisible = matchIsland && matchProvince && matchCity;
                        row.style.display = isVisible ? '' : 'none';
                        if (isVisible) visibleCount++;
                    });
                    
                    // Filter untuk tampilan card mobile
                    const mobileCards = document.querySelectorAll('#mobile-rate-cards > div > div');
                    
                    mobileCards.forEach(card => {
                        const cityText = (card.getAttribute('data-city') || '').toLowerCase();
                        const kelurahanText = (card.getAttribute('data-kelurahan') || '').toLowerCase();
                        const provinceText = (card.getAttribute('data-province') || '').toLowerCase();
                        const islandText = (card.getAttribute('data-island') || '').toLowerCase();
                        
                        const cityFullText = cityText + ' ' + kelurahanText;
                        
                        const matchIsland = !islandValue || islandText.includes(islandValue);
                        const matchProvince = !provinceValue || provinceText.includes(provinceValue);
                        const matchCity = !cityValue || cityFullText.includes(cityValue);
                        
                        card.style.display = (matchIsland && matchProvince && matchCity) ? '' : 'none';
                    });
                    
                    // Hapus kelas loading
                    rateTableBody.classList.remove('opacity-50');
                    document.getElementById('mobile-rate-cards').classList.remove('opacity-50');
                }, 50);
            }
            
            // Terapkan debounce untuk input pencarian
            const debouncedSearch = debounce(applyFilters, 300);
            
            $('#filter-island').on('change', applyFilters);
            $('#filter-province').on('change', applyFilters);
            searchCity.addEventListener('input', debouncedSearch);
            
            // Reset filter button
            document.getElementById('reset-filters').addEventListener('click', function() {
                $('#filter-island').val('').trigger('change');
                $('#filter-province').val('').trigger('change');
                searchCity.value = '';
                applyFilters();
            });
        });
    </script>
    @endpush
@endsection 