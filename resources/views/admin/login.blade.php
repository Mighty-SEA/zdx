<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta Tags Dasar -->
    <title>Login - ZDX Cargo Admin</title>
    <meta name="description" content="ZDX Cargo - Login Panel Admin">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Security Meta Tags -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <!-- CSP dinonaktifkan sementara untuk mengatasi masalah dengan ikon Font Awesome -->
    <!-- 
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data:;">
    -->
    
    <!-- Preload Font Awesome -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/webfonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-pattern {
            background-color: #f3f4f6;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FF6000' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            opacity: 0;
            animation: fade-in-up 0.8s ease forwards;
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        /* Fallback icon styles jika Font Awesome tidak dimuat */
        .icon-fallback {
            display: inline-block;
            width: 1em;
            height: 1em;
            text-align: center;
        }
        
        .icon-envelope::before { content: "✉️"; }
        .icon-lock::before { content: "🔒"; }
        .icon-eye::before { content: "👁️"; }
        .icon-eye-slash::before { content: "👁️‍🗨️"; }
        .icon-exclamation-triangle::before { content: "⚠️"; }
        .icon-shield::before { content: "🛡️"; }
        .icon-clock::before { content: "⏰"; }
        .icon-shipping::before { content: "🚚"; }
        .icon-users::before { content: "👥"; }
        .icon-chart::before { content: "📈"; }
        .icon-home::before { content: "🏠"; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background dengan efek gradient yang lebih menarik -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#FF6000] via-[#FF8C00] to-[#E65100]">
        <!-- Pattern overlay untuk tekstur -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNGM2LjYyNyAwIDEyLTUuMzczIDEyLTEyUzQyLjYyNyAxMCAzNiAxMCAyNCAxNS4zNzMgMjQgMjJzNS4zNzMgMTIgMTIgMTJ6IiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIvPjwvZz48L3N2Zz4=')] opacity-10"></div>
    </div>

    <!-- Floating Elements dengan efek blur -->
    <div class="absolute top-1/4 left-1/4 w-32 h-32 md:w-80 md:h-80 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-1/3 right-1/4 w-36 h-36 md:w-96 md:h-96 bg-[#FF8C00] rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-1/4 left-1/3 w-40 h-40 md:w-96 md:h-96 bg-[#E65100] rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    
    <!-- Peringatan jika koneksi tidak aman -->
    <div id="insecure-warning" class="hidden fixed top-0 left-0 right-0 bg-red-600 text-white py-2 px-4 text-center z-50">
        <i class="fas fa-exclamation-triangle mr-2 icon-fallback icon-exclamation-triangle"></i> Peringatan: Koneksi ini tidak aman. Harap gunakan HTTPS untuk keamanan data Anda.
    </div>
    
    <div class="max-w-4xl w-full mx-auto flex rounded-xl shadow-2xl overflow-hidden relative z-10">
        <!-- Left Side - Image and Branding -->
        <div class="hidden md:block w-1/2 bg-gradient-to-br from-[#FF6000] to-[#E65100] p-12 text-white">
            <div class="h-full flex flex-col">
                <div class="flex items-center space-x-3">
                    <div class=" text-[#FF6000] p-2 rounded-lg">
                        <img id="header-logo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->exists('logos/logo1.png') ? \Illuminate\Support\Facades\Storage::url('logos/logo1.png').'?v='.time() : asset('asset/logo.png') }}" alt="{{ $companyInfo->company_name ?? 'ZINDAN DIANTAR EXPRESS' }}" class="h-12 w-auto transform transition-all duration-300 group-hover:scale-105">
                    </div>
                </div>
                
                <div class="mt-auto">
                    <h1 class="text-3xl font-bold mb-4 animate-fade-in-up" style="animation-delay: 0.3s">Selamat Datang di Panel Admin</h1>
                    <p class="text-white/90 mb-6 animate-fade-in-up" style="animation-delay: 0.6s">Kelola pengiriman, pelacakan, dan semua operasi cargo Anda dari satu dashboard terpadu.</p>
                    
                    <div class="space-y-4 animate-fade-in-up" style="animation-delay: 0.9s">
                        <div class="flex items-center">
                            <div class="bg-[#FF8C00] bg-opacity-30 rounded-full p-2 mr-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <span>Analitik real-time</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-[#FF8C00] bg-opacity-30 rounded-full p-2 mr-3">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span>Manajemen pengiriman</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-[#FF8C00] bg-opacity-30 rounded-full p-2 mr-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <span>Manajemen pengguna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="w-full md:w-1/2 bg-white/90 backdrop-blur-sm p-8 lg:p-12">
            <div class="mb-8 text-center md:text-left animate-fade-in-up">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Admin</h2>
                <p class="text-gray-600">Masukkan kredensial Anda untuk akses dashboard</p>
            </div>
            
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif
            
            @if(isset($throttled) && $throttled)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded mb-4" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="block sm:inline">{{ __('Terlalu banyak percobaan login. Silakan tunggu:') }}</span>
                </div>
                <div class="mt-2 text-center">
                    <div id="countdown-timer" class="text-3xl font-bold">{{ sprintf('%02d:%02d', floor($seconds / 60), $seconds % 60) }}</div>
                    <p class="text-sm mt-2">Halaman akan dimuat ulang secara otomatis setelah waktu tunggu selesai.</p>
                </div> 
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let totalSeconds = {{ $seconds }};
                    const timerEl = document.getElementById('countdown-timer');
                    const countdownInterval = setInterval(function() {
                        totalSeconds--;
                        if (totalSeconds <= 0) {
                            clearInterval(countdownInterval);
                            window.location.reload();
                            return;
                        }
                        const minutes = Math.floor(totalSeconds / 60);
                        const seconds = totalSeconds % 60;
                        timerEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                    }, 1000);
                });
            </script>
            @endif
            
            @if(!isset($throttled) || !$throttled)
            <form method="POST" action="{{ route('login') }}" class="animate-fade-in-up" style="animation-delay: 0.3s" autocomplete="off">
                @csrf
                <!-- CSRF Token Tersembunyi dengan Timestamp -->
                <input type="hidden" name="login_timestamp" value="{{ time() }}">
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope text-[#FF6000] icon-fallback icon-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6000] focus:border-[#FF6000] @error('email') border-red-500 @enderror" placeholder="admin@zdxcargo.com" value="{{ old('email') }}" required autofocus autocomplete="off" spellcheck="false">
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <button type="button" id="togglePassword" class="text-sm text-[#FF6000] hover:underline focus:outline-none">
                                <i class="fas fa-eye icon-fallback icon-eye"></i> <span>Tampilkan</span>
                            </button>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-lock text-[#FF6000] icon-fallback icon-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6000] focus:border-[#FF6000] @error('password') border-red-500 @enderror" placeholder="••••••••" required autocomplete="off">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <span id="passwordStrength" class="text-xs"></span>
                        </div>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-[#FF6000] focus:ring-[#FF6000] border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                </div>
                
                <!-- Peringatan Keamanan -->
                {{-- <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2 icon-fallback icon-shield"></i>
                        <p>Halaman ini aman dan terenkripsi. Pastikan alamat situs dimulai dengan https://</p>
                    </div>
                </div> --}}
                
                <!-- Login Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-2.5 rounded-lg font-medium transition-all hover:shadow-lg transform hover:scale-[1.02]">
                    Masuk
                </button>
            </form>
            @endif
            
            <!-- Inactive Session Warning -->
            <div id="timeout-warning" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-xl z-50 w-80 hidden">
                <div class="text-center">
                    <div class="text-amber-500 mb-4">
                        <i class="fas fa-clock text-4xl icon-fallback icon-clock"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Sesi Tidak Aktif</h3>
                    <p class="text-gray-600 mb-4">Halaman akan logout otomatis dalam <span id="timeout-counter" class="font-semibold">60</span> detik.</p>
                    <button id="continue-session" class="px-4 py-2 bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white rounded-lg">
                        Lanjutkan Sesi
                    </button>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-500 animate-fade-in-up" style="animation-delay: 0.6s">
                <p>2025 &copy; ZDX Cargo. Semua hak dilindungi.</p>
            </div>
        </div>
    </div>
    
    <!-- Particle effect (Latar belakang dengan titik-titik) -->
    <div id="particles-js" class="absolute inset-0 z-0"></div>
    
    <!-- Script untuk particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Periksa apakah koneksi aman (HTTPS)
            if (window.location.protocol !== 'https:' && window.location.hostname !== 'localhost' && window.location.hostname !== '127.0.0.1') {
                document.getElementById('insecure-warning').classList.remove('hidden');
            }
            
            // Toggle Password Visibility
            const toggleBtn = document.getElementById('togglePassword');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    const passwordInput = document.getElementById('password');
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    const icon = toggleBtn.querySelector('i');
                    const text = toggleBtn.querySelector('span');
                    if (type === 'text') {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                        icon.classList.remove('icon-eye');
                        icon.classList.add('icon-eye-slash');
                        text.textContent = 'Sembunyikan';
                    } else {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                        icon.classList.remove('icon-eye-slash');
                        icon.classList.add('icon-eye');
                        text.textContent = 'Tampilkan';
                    }
                });
            }
            
            // Session Timeout (5 menit)
            let idleTime = 0;
            const idleInterval = setInterval(timerIncrement, 60000); // setiap 1 menit
            const timeoutWarning = document.getElementById('timeout-warning');
            const timeoutCounter = document.getElementById('timeout-counter');
            let countdownInterval;
            
            function resetIdleTime() {
                idleTime = 0;
                if (timeoutWarning.classList.contains('block')) {
                    timeoutWarning.classList.remove('block');
                    timeoutWarning.classList.add('hidden');
                    clearInterval(countdownInterval);
                }
            }
            
            function timerIncrement() {
                idleTime = idleTime + 1;
                if (idleTime >= 5) { // 5 menit tidak aktif
                    showTimeoutWarning();
                }
            }
            
            function showTimeoutWarning() {
                timeoutWarning.classList.remove('hidden');
                timeoutWarning.classList.add('block');
                
                let secondsLeft = 60;
                timeoutCounter.textContent = secondsLeft;
                
                countdownInterval = setInterval(function() {
                    secondsLeft--;
                    timeoutCounter.textContent = secondsLeft;
                    
                    if (secondsLeft <= 0) {
                        clearInterval(countdownInterval);
                        window.location.href = '/logout';
                    }
                }, 1000);
            }
            
            // Reset idle time on user activity
            const resetEvents = ['mousemove', 'mousedown', 'keypress', 'touchmove', 'touchstart', 'scroll'];
            resetEvents.forEach(function(event) {
                document.addEventListener(event, resetIdleTime, false);
            });
            
            // Continue session button
            const continueButton = document.getElementById('continue-session');
            if (continueButton) {
                continueButton.addEventListener('click', function() {
                    resetIdleTime();
                });
            }
            
            // Initialize particles.js
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    "particles": {
                        "number": {
                            "value": 80,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": "#ffffff"
                        },
                        "shape": {
                            "type": "circle",
                            "stroke": {
                                "width": 0,
                                "color": "#000000"
                            }
                        },
                        "opacity": {
                            "value": 0.5,
                            "random": false
                        },
                        "size": {
                            "value": 3,
                            "random": true
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.4,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": 2,
                            "direction": "none",
                            "random": false,
                            "straight": false,
                            "out_mode": "out",
                            "bounce": false
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "repulse"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        }
                    },
                    "retina_detect": true
                });
            }
        });
    </script>
</body>
</html> 