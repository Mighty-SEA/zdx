import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
});

// Setup semua event listeners
function setupEventListeners() {
    // Toggle sidebar pada mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.add('mobile-open');
            overlay.classList.remove('hidden');
        });
    }
    
    // Tutup sidebar saat klik overlay
    const overlay = document.getElementById('sidebarOverlay');
    if (overlay) {
        overlay.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            
            sidebar.classList.remove('mobile-open');
            this.classList.add('hidden');
        });
    }
    
    // Toggle search box pada mobile
    const mobileSearchToggle = document.getElementById('mobileSearchToggle');
    if (mobileSearchToggle) {
        mobileSearchToggle.addEventListener('click', function() {
            const searchBar = document.getElementById('mobileSearchBar');
            searchBar.classList.toggle('hidden');
        });
    }
    
    // Penutupan otomatis dropdown saat resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.classList.add('hidden');
            }
            
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });
} 