document.addEventListener('DOMContentLoaded', function() {
    const whatsappButton = document.getElementById('whatsapp-button');
    const whatsappPopup = document.getElementById('whatsapp-popup');
    const closePopupButton = document.getElementById('close-whatsapp-popup');
    
    whatsappButton.addEventListener('click', function() {
        whatsappPopup.classList.toggle('hidden');
        if (!whatsappPopup.classList.contains('hidden')) {
            whatsappPopup.classList.add('fadeInUp');
        }
    });
    
    closePopupButton.addEventListener('click', function() {
        whatsappPopup.classList.add('hidden');
        whatsappPopup.classList.remove('fadeInUp');
    });
    
    // Menutup popup jika user mengklik di luar popup
    document.addEventListener('click', function(event) {
        const isClickInsidePopup = whatsappPopup.contains(event.target);
        const isClickOnButton = whatsappButton.contains(event.target);
        
        if (!isClickInsidePopup && !isClickOnButton && !whatsappPopup.classList.contains('hidden')) {
            whatsappPopup.classList.add('hidden');
            whatsappPopup.classList.remove('fadeInUp');
        }
    });
}); 