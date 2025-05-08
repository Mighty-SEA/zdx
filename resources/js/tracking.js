// JavaScript untuk halaman tracking

document.addEventListener('DOMContentLoaded', function() {
    // Form validasi
    const trackingForm = document.getElementById('tracking-form');
    const trackingNumberInput = document.getElementById('tracking_number');
    const errorMessage = document.getElementById('error-message');
    
    if (trackingForm) {
        trackingForm.addEventListener('submit', function(e) {
            // Reset error message
            errorMessage.classList.add('hidden');
            
            // Validasi nomor resi
            if (!trackingNumberInput.value.trim()) {
                e.preventDefault();
                errorMessage.textContent = 'Nomor resi tidak boleh kosong';
                errorMessage.classList.remove('hidden');
                return false;
            }
            
            // Validasi panjang nomor resi (min 6 karakter)
            if (trackingNumberInput.value.trim().length < 6) {
                e.preventDefault();
                errorMessage.textContent = 'Nomor resi minimal 6 karakter';
                errorMessage.classList.remove('hidden');
                return false;
            }
            
            return true;
        });
    }
    
    // Fungsi untuk tracking menggunakan AJAX (opsional)
    function trackShipmentAjax(trackingNumber) {
        // Menampilkan loading state
        const resultsContainer = document.getElementById('tracking-results');
        if (resultsContainer) {
            resultsContainer.innerHTML = '<div class="p-8 text-center"><div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-[#FF6000] mb-4"></div><p>Memuat data pengiriman...</p></div>';
        }
        
        // Kirim request AJAX
        fetch(trackShipmentRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                tracking_number: trackingNumber
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect ke halaman tracking dengan data yang sudah diambil
                window.location.href = `${trackingUrl}?tracking_number=${trackingNumber}`;
            } else {
                // Tampilkan pesan error
                if (resultsContainer) {
                    resultsContainer.innerHTML = `
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                            ${data.message || 'Terjadi kesalahan saat mengambil data tracking'}
                        </div>
                    `;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (resultsContainer) {
                resultsContainer.innerHTML = `
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                        Terjadi kesalahan saat menghubungi server
                    </div>
                `;
            }
        });
    }
    
    // Tambahkan event listener untuk tombol 'Enter' pada input
    if (trackingNumberInput) {
        trackingNumberInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const trackingNumber = trackingNumberInput.value.trim();
                if (trackingNumber.length >= 6) {
                    trackShipmentAjax(trackingNumber);
                } else {
                    errorMessage.textContent = 'Nomor resi minimal 6 karakter';
                    errorMessage.classList.remove('hidden');
                }
            }
        });
    }
}); 