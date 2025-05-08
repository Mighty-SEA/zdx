// JavaScript untuk halaman rates (tarif)

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
        
        if (selectedProvince && cityData[selectedProvince]) {
            // Tambahkan opsi kota berdasarkan provinsi yang dipilih
            cityData[selectedProvince].forEach(city => {
                citySelect.append(`<option value="${city}">${city}</option>`);
            });
            
            // Enable select kota
            citySelect.prop('disabled', false);
        }
    });
    
    // Menghandle perubahan pada kota tujuan
    $('#city-select').on('change', function() {
        const selectedCity = $(this).val();
        const kelurahanSelect = $('#kelurahan-select');
        
        // Reset kelurahan select
        kelurahanSelect.empty().append('<option value="">Pilih Kelurahan/Kecamatan</option>').prop('disabled', true);
        
        if (selectedCity) {
            // Contoh data kelurahan (bisa diganti dengan data yang sebenarnya)
            const kelurahanList = [
                'Kelurahan 1', 'Kelurahan 2', 'Kelurahan 3', 'Kelurahan 4', 'Kelurahan 5'
            ];
            
            // Tambahkan opsi kelurahan
            kelurahanList.forEach(kelurahan => {
                kelurahanSelect.append(`<option value="${kelurahan}">${kelurahan}</option>`);
            });
            
            // Enable select kelurahan
            kelurahanSelect.prop('disabled', false);
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
            }
        });
    }

    // Function untuk request penawaran spesial
    window.requestSpecialOffer = function(event) {
        // Tidak perlu melakukan apa-apa, biarkan navigasi ke link WhatsApp
        // Fungsi ini didefinisikan untuk mencegah error jika onclick="requestSpecialOffer(event)" di markup HTML
    };
}); 