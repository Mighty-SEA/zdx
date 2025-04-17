<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta Tags Dasar -->
    <title>Login - ZDX Cargo Admin</title>
    <meta name="description" content="ZDX Cargo - Login Panel Admin">
    <meta name="robots" content="noindex, nofollow">
    
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
    
    <div class="max-w-4xl w-full mx-auto flex rounded-xl shadow-2xl overflow-hidden relative z-10">
        <!-- Left Side - Image and Branding -->
        <div class="hidden md:block w-1/2 bg-gradient-to-br from-[#FF6000] to-[#E65100] p-12 text-white">
            <div class="h-full flex flex-col">
                <div class="flex items-center space-x-3">
                    <div class="bg-white text-[#FF6000] p-2 rounded-lg">
                        <i class="fas fa-shipping-fast text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold animate-float">ZDX Cargo</span>
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
            
            <form method="POST" action="{{ route('login') }}" class="animate-fade-in-up" style="animation-delay: 0.3s">
                @csrf
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope text-[#FF6000]"></i>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6000] focus:border-[#FF6000] @error('email') border-red-500 @enderror" placeholder="admin@zdxcargo.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-lock text-[#FF6000]"></i>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6000] focus:border-[#FF6000] @error('password') border-red-500 @enderror" placeholder="••••••••" required>
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
                
                <!-- Login Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-[#FF6000] to-[#FF8C00] text-white py-2.5 rounded-lg font-medium transition-all hover:shadow-lg transform hover:scale-[1.02]">
                    Masuk
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-500 animate-fade-in-up" style="animation-delay: 0.6s">
                <p>2024 &copy; ZDX Cargo. Semua hak dilindungi.</p>
            </div>
        </div>
    </div>
    
    <!-- Particle effect (Latar belakang dengan titik-titik) -->
    <div id="particles-js" class="absolute inset-0 z-0"></div>
    
    <!-- Script untuk particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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