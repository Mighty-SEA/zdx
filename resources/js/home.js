// JavaScript khusus untuk halaman home

// Inisialisasi AOS (Animate on Scroll)
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }

    // Inisialisasi Particles.js
    if (document.getElementById('particles-js') && typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#ffffff"
                },
                shape: {
                    type: "circle",
                    stroke: {
                        width: 0,
                        color: "#000000"
                    }
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: false
                    }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: "none",
                    random: false,
                    straight: false,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "grab"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                }
            },
            retina_detect: true
        });
    }

    // Inisialisasi Partner Carousel
    const partnerSwiper = new Swiper('.partner-carousel', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        allowTouchMove: false,
        cssMode: false,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        }
    });

    // Animasi Counter
    const counters = document.querySelectorAll('.counter');
    if (counters.length > 0) {
        const speed = 200;

        counters.forEach(counter => {
            const animate = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText.replace(/,/g, '');
                const increment = Math.trunc(target / speed);
                
                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(animate, 1);
                } else {
                    counter.innerText = target;
                }
            };
            
            animate();
        });
    }
}); 