// JavaScript untuk halaman services

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS (Animate on Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
    
    // Konfigurasi tabs jika ada
    const tabButtons = document.querySelectorAll('[data-tab]');
    const tabContents = document.querySelectorAll('[data-tab-content]');
    
    if(tabButtons.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.getAttribute('data-tab');
                
                // Toggle active class pada tab buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('active-tab');
                    btn.classList.remove('border-[#FF6000]');
                    btn.classList.remove('text-[#FF6000]');
                    btn.classList.add('border-transparent');
                    btn.classList.add('text-gray-500');
                });
                
                button.classList.add('active-tab');
                button.classList.add('border-[#FF6000]');
                button.classList.add('text-[#FF6000]');
                button.classList.remove('border-transparent');
                button.classList.remove('text-gray-500');
                
                // Show/hide tab content
                tabContents.forEach(content => {
                    if(content.getAttribute('data-tab-content') === targetTab) {
                        content.classList.remove('hidden');
                    } else {
                        content.classList.add('hidden');
                    }
                });
            });
        });
    }
    
    // Faq accordion
    const faqItems = document.querySelectorAll('.faq-item');
    
    if(faqItems.length > 0) {
        faqItems.forEach(item => {
            const header = item.querySelector('.faq-header');
            const content = item.querySelector('.faq-content');
            const icon = item.querySelector('.faq-icon');
            
            header.addEventListener('click', () => {
                content.classList.toggle('hidden');
                
                // Toggle icon
                if(icon.classList.contains('rotate-0')) {
                    icon.classList.remove('rotate-0');
                    icon.classList.add('rotate-180');
                } else {
                    icon.classList.remove('rotate-180');
                    icon.classList.add('rotate-0');
                }
            });
        });
    }
}); 