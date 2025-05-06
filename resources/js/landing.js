import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false,
            disable: window.innerWidth < 768
        });
    }

    // Deteksi perangkat mobile
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if (isMobile) {
        document.body.classList.add('is-mobile-device');
    }

    // Efek scroll pada navbar
    const navbar = document.getElementById('mainNav');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 30) {
                navbar.classList.add('py-1', 'shadow-lg', 'bg-white/95', 'backdrop-blur-sm');
                navbar.classList.remove('py-2');
            } else {
                navbar.classList.remove('py-1', 'shadow-lg', 'bg-white/95', 'backdrop-blur-sm');
                navbar.classList.add('py-2');
            }
        });
    }

    // Toggle mobile menu
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Toggle Tentang Kami dropdown on mobile
    const aboutDropdownToggle = document.getElementById('aboutDropdownToggle');
    const aboutDropdown = document.getElementById('aboutDropdown');
    const aboutChevron = document.getElementById('aboutChevron');
    if (aboutDropdownToggle && aboutDropdown && aboutChevron) {
        aboutDropdownToggle.addEventListener('click', function() {
            aboutDropdown.classList.toggle('hidden');
            aboutChevron.classList.toggle('rotate-180');
        });
    }

    // WhatsApp popup
    const whatsappButton = document.getElementById('whatsapp-button');
    const whatsappPopup = document.getElementById('whatsapp-popup');
    const closePopupButton = document.getElementById('close-whatsapp-popup');
    if (whatsappButton && whatsappPopup && closePopupButton) {
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
        document.addEventListener('click', function(event) {
            const isClickInsidePopup = whatsappPopup.contains(event.target);
            const isClickOnButton = whatsappButton.contains(event.target);
            if (!isClickInsidePopup && !isClickOnButton && !whatsappPopup.classList.contains('hidden')) {
                whatsappPopup.classList.add('hidden');
                whatsappPopup.classList.remove('fadeInUp');
            }
        });
    }

    // gtag_report_conversion function
    window.gtag_report_conversion = function(url) {
        var callback = function () {
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        };
        if (typeof gtag === 'function') {
            gtag('event', 'conversion', {
                'send_to': 'AW-17029364315/q7EXCO_fzrwaENv0nbg_',
                'value': 1.0,
                'currency': 'IDR',
                'transaction_id': '',
                'event_callback': callback
            });
        }
        return false;
    };
    // Panggil otomatis saat halaman dimuat
    if (typeof window.gtag_report_conversion === 'function') {
        window.gtag_report_conversion();
    }

    setupSmoothScroll();
    setupScrollAnimations();

    // Smooth scroll untuk link TOC
    const tocLinks = document.querySelectorAll('.toc-link');
    tocLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                const viewportHeight = window.innerHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - (viewportHeight / 3);
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            }
        });
    });
    // Highlight TOC item saat scroll
    const headings = document.querySelectorAll('#blog-content h2, #blog-content h3');
    if (headings.length > 0) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            headings.forEach((heading, index) => {
                if (!heading.textContent.trim()) return;
                const offsetTop = heading.offsetTop - 150;
                const nextHeading = headings[index + 1];
                const offsetBottom = nextHeading ? nextHeading.offsetTop - 150 : Infinity;
                const link = document.querySelector(`.toc-link[href="#${heading.id}"]`);
                if (link) {
                    if (scrollPosition >= offsetTop && scrollPosition < offsetBottom) {
                        link.classList.add('text-[#FF6000]', 'font-medium');
                    } else {
                        link.classList.remove('text-[#FF6000]', 'font-medium');
                    }
                }
            });
        });
    }
});

// Smooth scroll for anchor links
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
}

// Animation for elements when they enter viewport
function setupScrollAnimations() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// ===== JS dari rates.blade.php =====
// Fungsi untuk menangani klik tombol "Minta Penawaran"
window.requestSpecialOffer = function(event) {
    event.preventDefault();
    let message =
        'Halo Admin ZDX Express,\n\n' +
        'Saya tertarik untuk mendapatkan penawaran khusus untuk pengiriman dalam jumlah besar.\n\n' +
        'Mohon informasi lebih lanjut mengenai layanan dan tarif spesial yang tersedia.\n\n' +
        'Terima kasih.';
    let orderUrl = orderNowRoute + "?message=" + encodeURIComponent(message);
    window.location.href = orderUrl;
};
// Inisialisasi Select2 dan event handler lain dari rates.blade.php bisa ditambahkan di sini jika diperlukan

// ===== JS dari tracking.blade.php =====
document.addEventListener('DOMContentLoaded', function() {
    const trackingForm = document.getElementById('tracking-form');
    if (trackingForm) {
        trackingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const trackingNumber = document.getElementById('tracking_number').value.trim();
            const errorMessage = document.getElementById('error-message');
            if (!trackingNumber) {
                errorMessage.textContent = 'Silakan masukkan nomor resi';
                errorMessage.classList.remove('hidden');
                return;
            } else {
                errorMessage.classList.add('hidden');
            }
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-2"></i> Mencari...';
            submitBtn.disabled = true;
            fetch(trackShipmentRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ tracking_number: trackingNumber })
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                if (data.success) {
                    window.location.href = trackingUrl + '?tracking_number=' + trackingNumber;
                } else {
                    errorMessage.textContent = 'Kode Resi tidak ditemukan';
                    errorMessage.classList.remove('hidden');
                }
            })
            .catch(error => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                errorMessage.textContent = 'Kode Resi tidak ditemukan';
                errorMessage.classList.remove('hidden');
                console.error('Error:', error);
            });
        });
    }
}); 