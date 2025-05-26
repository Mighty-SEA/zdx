// JavaScript untuk halaman rates (tarif)

// Ambil CSRF token dari meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
    
    // Inisialisasi Select2
    if ($.fn.select2) {
        $('#origin-province-select').select2({
            placeholder: "Pilih Provinsi Asal",
            allowClear: true
        });
        
        $('#origin-city-select').select2({
            placeholder: "Pilih Kota/Kabupaten Asal",
            allowClear: true
        });
        
        $('#province-select').select2({
            placeholder: "Pilih Provinsi",
            allowClear: true
        });
        
        $('#city-select').select2({
            placeholder: "Pilih Kota/Kabupaten",
            allowClear: true
        });
        
        $('#kelurahan-select').select2({
            placeholder: "Pilih Kelurahan/Kecamatan",
            allowClear: true
        });
    }
    
    // Data kota berdasarkan provinsi (contoh)
    const cityData = {
        'DKI Jakarta': ['Jakarta Barat', 'Jakarta Pusat', 'Jakarta Timur', 'Jakarta Utara', 'Jakarta Selatan', 'Kepulauan Seribu'],
        'Jawa Barat': ['Bandung', 'Bekasi', 'Bogor', 'Depok', 'Cimahi', 'Sukabumi', 'Tasikmalaya', 'Cirebon'],
        'Banten': ['Tangerang', 'Tangerang Selatan', 'Serang', 'Cilegon']
    };
    
    // Menghandle perubahan pada provinsi asal
    $('#origin-province-select').on('change', function() {
        const selectedProvince = $(this).val();
        const citySelect = $('#origin-city-select');
        
        // Reset city select
        citySelect.empty().append('<option value="">Pilih Kota/Kabupaten Asal</option>').prop('disabled', true);
        
        if (selectedProvince && cityData[selectedProvince]) {
            // Tambahkan opsi kota berdasarkan provinsi yang dipilih
            cityData[selectedProvince].forEach(city => {
                citySelect.append(`<option value="${city}">${city}</option>`);
            });
            
            // Enable select kota
            citySelect.prop('disabled', false);
        }
    });
    
    // Menghandle perubahan pada provinsi tujuan
    $('#province-select').on('change', function() {
        const selectedProvince = $(this).val();
        const citySelect = $('#city-select');

        // Reset city select
        citySelect.empty().append('<option value="">Pilih Kota/Kabupaten</option>').prop('disabled', true);
        $('#kelurahan-select').empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').prop('disabled', true);

        if (selectedProvince) {
            // AJAX ke backend untuk ambil kota
            $.ajax({
                url: '/get-cities',
                type: 'POST',
                data: {
                    province: selectedProvince,
                    _token: csrfToken
                },
                success: function(response) {
                    console.log('[DEBUG] Response kota:', response);
                    if (response.success && response.cities && response.cities.length > 0) {
                        response.cities.forEach(function(city) {
                            citySelect.append(`<option value="${city}">${city}</option>`);
                        });
                        citySelect.prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('[DEBUG] AJAX error get-cities:', status, error, xhr.responseText);
                }
            });
        }
    });
    
    // Menghandle perubahan pada kota tujuan
    $('#city-select').on('change', function() {
        const selectedCity = $(this).val();
        const kelurahanSelect = $('#kelurahan-select');
        const selectedProvince = $('#province-select').val();
        console.log('[DEBUG] Kota dipilih:', selectedCity, 'Provinsi:', selectedProvince);
        
        // Reset kelurahan select
        kelurahanSelect.empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').prop('disabled', true);
        
        if (selectedCity && selectedProvince) {
            // AJAX ke backend untuk ambil kelurahan
            $.ajax({
                url: '/get-kelurahans',
                type: 'POST',
                data: {
                    province: selectedProvince,
                    city: selectedCity,
                    _token: csrfToken // pastikan CSRF token dikirim
                },
                success: function(response) {
                    console.log('[DEBUG] Response kelurahan:', response);
                    if (response.success && response.kelurahans && response.kelurahans.length > 0) {
                        response.kelurahans.forEach(function(kelurahan) {
                            kelurahanSelect.append(`<option value="${kelurahan}">${kelurahan}</option>`);
                        });
                        kelurahanSelect.prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('[DEBUG] AJAX error:', status, error, xhr.responseText);
                }
            });
        }
    });
    
    // Form validasi untuk tombol Pesan Sekarang
    const calculateRateBtn = document.getElementById('calculate-rate');
    const errorMessageDiv = document.getElementById('error-message');
    const errorText = errorMessageDiv ? errorMessageDiv.querySelector('#error-text span') : null;
    
    // Fungsi untuk memvalidasi form
    function validateForm() {
        // Reset error message
        if (errorMessageDiv) {
            errorMessageDiv.classList.add('hidden');
        }
        
        const originProvinceSelect = document.getElementById('origin-province-select');
        const originCitySelect = document.getElementById('origin-city-select');
        const provinceSelect = document.getElementById('province-select');
        const citySelect = document.getElementById('city-select');
        const kelurahanSelect = document.getElementById('kelurahan-select');
        const weightInput = document.getElementById('weight');

        if (!originProvinceSelect || !originProvinceSelect.value) {
            showError('Silakan pilih provinsi asal');
            return false;
        }
        
        if (!originCitySelect || !originCitySelect.value) {
            showError('Silakan pilih kota/kabupaten asal');
            return false;
        }
        
        if (!provinceSelect || !provinceSelect.value) {
            showError('Silakan pilih provinsi tujuan');
            return false;
        }
        
        if (!citySelect || !citySelect.value) {
            showError('Silakan pilih kota/kabupaten tujuan');
            return false;
        }
        
        if (!kelurahanSelect || !kelurahanSelect.value) {
            showError('Silakan pilih kelurahan/kecamatan tujuan');
            return false;
        }
        
        // Validasi berat (minimal 0.1 kg)
        if (!weightInput || !weightInput.value || parseFloat(weightInput.value) < 0.1) {
            showError('Berat minimal 0.1 kg');
            return false;
        }
        
        return true;
    }

    // Fungsi untuk menampilkan pesan error
    function showError(message) {
        if (errorMessageDiv && errorText) {
            errorText.textContent = message;
            errorMessageDiv.classList.remove('hidden');
        }
    }
    
    // Event listener untuk tombol calculate-rate (Pesan Sekarang)
    if (calculateRateBtn) {
        calculateRateBtn.addEventListener('click', function(e) {
            // Mencegah navigasi ke link jika validasi gagal
            if (!validateForm()) {
                e.preventDefault();
                return;
            }
            e.preventDefault();
            // Ambil data form
            const originProvince = document.getElementById('origin-province-select').value;
            const originCity = document.getElementById('origin-city-select').value;
            const destProvince = document.getElementById('province-select').value;
            const destCity = document.getElementById('city-select').value;
            const destKelurahan = document.getElementById('kelurahan-select').value;
            const weight = document.getElementById('weight').value;
            // Nomor WhatsApp tujuan (di-inject dari blade)
            const whatsappPhone = window.whatsappPhone || '6285814718888';
            // Format pesan
            const message =
                `Halo Admin ZDX Express,%0A%0ASaya ingin melakukan pemesanan pengiriman dengan detail berikut:%0A` +
                `Asal: ${originCity}, ${originProvince}%0A` +
                `Tujuan: ${destKelurahan}, ${destCity}, ${destProvince}%0A` +
                `Berat: ${weight} kg%0A%0AMohon info lebih lanjut dan konfirmasi biaya pengiriman.%0ATerima kasih.`;
            // Redirect ke WhatsApp
            const waUrl = `https://wa.me/${whatsappPhone}?text=${message}`;
            if (typeof window.gtag_report_conversion === 'function') {
                window.gtag_report_conversion(waUrl);
            } else {
                window.open(waUrl, '_blank');
            }
        });
    }

    // Function untuk request penawaran spesial
    window.requestSpecialOffer = function(event) {
        // Tidak perlu melakukan apa-apa, biarkan navigasi ke link WhatsApp
        // Fungsi ini didefinisikan untuk mencegah error jika onclick="requestSpecialOffer(event)" di markup HTML
    };
}); 