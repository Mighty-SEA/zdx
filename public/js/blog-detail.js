document.addEventListener('DOMContentLoaded', function() {
    // Menambahkan smooth scroll untuk link TOC
    const tocLinks = document.querySelectorAll('.toc-link');
    tocLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Mendapatkan tinggi viewport
                const viewportHeight = window.innerHeight;
                // Posisi scroll yang menempatkan elemen di tengah viewport
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - (viewportHeight / 3);
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
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
    
    // Animasi teks berganti pada CTA
    const rotatingText = document.getElementById('rotating-text');
    if (rotatingText) {
        const phrases = [
            "Jasa Pengiriman?",
            "Ekspedisi Cepat?",
            "Logistik Andal?",
            "Kirim Barang?",
            "Cargo Express?",
            "Pengiriman Aman?"
        ];
        
        let currentIndex = 0;
        
        // CSS untuk animasi
        rotatingText.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        
        setInterval(() => {
            // Mulai animasi fade out
            rotatingText.style.opacity = "0";
            rotatingText.style.transform = "translateY(10px)";
            
            setTimeout(() => {
                // Ganti teks
                currentIndex = (currentIndex + 1) % phrases.length;
                rotatingText.textContent = phrases[currentIndex];
                
                // Mulai animasi fade in
                rotatingText.style.opacity = "1";
                rotatingText.style.transform = "translateY(0)";
            }, 500);
        }, 3000); // Ganti teks setiap 3 detik
    }
}); 