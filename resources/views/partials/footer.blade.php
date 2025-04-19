<!-- Footer -->
@php
    use Illuminate\Support\Str;
@endphp
<footer class="bg-accent text-white relative overflow-hidden">
    <!-- Wave Separator -->
    <div class="absolute top-0 left-0 w-full overflow-hidden">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="absolute top-0 w-full h-12 text-white">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
        </svg>
    </div>

    <!-- Pola Latar Belakang dengan Animasi -->
    <div class="absolute inset-0 overflow-hidden opacity-10">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="w-40 h-40 bg-[#FF6000] rounded-full absolute -top-20 -left-20 opacity-50 animate-pulse"></div>
            <div class="w-56 h-56 bg-[#FF6000] rounded-full absolute top-40 -right-20 opacity-30 animate-pulse" style="animation-delay: 1s"></div>
            <div class="w-32 h-32 bg-[#FF6000] rounded-full absolute bottom-10 left-1/4 opacity-40 animate-pulse" style="animation-delay: 2s"></div>
        </div>
    </div>

    <!-- Konten Utama Footer -->
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-10 relative">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-12">
            <!-- Tentang Perusahaan -->
            <div class="transform transition-all duration-500 hover:translate-y-[-5px]">
                <div class="flex items-center mb-5">
                    <img src="{{ asset('asset/logo.png') }}" alt="{{ $companyInfo->company_name ?? 'ZINDAN DIANTAR EXPRESS' }}" class="h-14 mr-3">
                    <div>
                        <h3 class="text-xl font-bold text-[#FF6000] tracking-wide">{{ $companyInfo->company_name ?? 'ZINDAN' }}</h3>
                        <p class="text-gray-400 text-xs tracking-wider">{{ $companyInfo->company_slogan ?? 'Solusi Tepat Pengiriman Cepat' }}</p>
                    </div>
                </div>
                <p class="text-white text-opacity-80 mb-6 leading-relaxed">{{ $companyInfo->company_description ?? 'PT. Zindan Diantar Express adalah perusahaan jasa pengiriman barang terpercaya dengan jaringan yang luas di seluruh Indonesia.' }}</p>
                <div class="flex items-start space-x-3 bg-[#FF6000] bg-opacity-5 p-4 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-map-marker-alt text-[#FF6000] mt-1 text-lg"></i>
                    <p class="text-white text-opacity-90">{{ $companyInfo->contact_address ?? 'Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424' }}</p>
                </div>
            </div>

            <!-- Layanan Perusahaan -->
            <div class="transform transition-all duration-500 hover:translate-y-[-5px]">
                <h4 class="text-lg font-semibold mb-5 text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-2 flex items-center">
                    <span class="bg-[#FF6000] w-2 h-6 rounded-sm mr-2"></span> Layanan Kami
                </h4>
                <ul class="space-y-3">
                    @php
                        $footerServices = \App\Models\Service::where('status', 'published')->take(3)->get();
                    @endphp
                    
                    @forelse($footerServices as $service)
                    <li>
                        <a href="/layanan/{{ $service->slug }}" class="group flex items-center text-white hover:text-[#FF6000] transition-all duration-300 p-2 hover:bg-white hover:bg-opacity-5 rounded-md">
                            <div class="w-8 h-8 rounded-md bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3 group-hover:bg-[#FF6000] group-hover:text-white transition-all duration-300">
                                @php
                                    $icon = 'fa-truck';
                                    if(Str::contains(strtolower($service->title), ['laut', 'kapal', 'ship'])) {
                                        $icon = 'fa-ship';
                                    } elseif(Str::contains(strtolower($service->title), ['udara', 'pesawat', 'plane', 'air'])) {
                                        $icon = 'fa-plane';
                                    } elseif(Str::contains(strtolower($service->title), ['gudang', 'warehouse', 'storage'])) {
                                        $icon = 'fa-warehouse';
                                    } elseif(Str::contains(strtolower($service->title), ['motor', 'bike'])) {
                                        $icon = 'fa-motorcycle';
                                    }
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <span>{{ $service->title }}</span>
                        </a>
                    </li>
                    @empty
                    <li>
                        <a href="/layanan" class="group flex items-center text-white hover:text-[#FF6000] transition-all duration-300 p-2 hover:bg-white hover:bg-opacity-5 rounded-md">
                            <div class="w-8 h-8 rounded-md bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3 group-hover:bg-[#FF6000] group-hover:text-white transition-all duration-300">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span>Pengiriman Darat</span>
                        </a>
                    </li>
                    <li>
                        <a href="/layanan" class="group flex items-center text-white hover:text-[#FF6000] transition-all duration-300 p-2 hover:bg-white hover:bg-opacity-5 rounded-md">
                            <div class="w-8 h-8 rounded-md bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3 group-hover:bg-[#FF6000] group-hover:text-white transition-all duration-300">
                                <i class="fas fa-ship"></i>
                            </div>
                            <span>Pengiriman Laut</span>
                        </a>
                    </li>
                    <li>
                        <a href="/layanan" class="group flex items-center text-white hover:text-[#FF6000] transition-all duration-300 p-2 hover:bg-white hover:bg-opacity-5 rounded-md">
                            <div class="w-8 h-8 rounded-md bg-[#FF6000] bg-opacity-10 flex items-center justify-center mr-3 group-hover:bg-[#FF6000] group-hover:text-white transition-all duration-300">
                                <i class="fas fa-plane"></i>
                            </div>
                            <span>Pengiriman Udara</span>
                        </a>
                    </li>
                    @endforelse
                </ul>
                
                <h4 class="text-lg font-semibold mb-4 mt-8 text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-2 flex items-center">
                    <span class="bg-[#FF6000] w-2 h-6 rounded-sm mr-2"></span> Halaman
                </h4>
                <div class="grid grid-cols-2 gap-y-3">
                    <a href="/profile" class="text-white hover:text-[#FF6000] transition-colors flex items-center">
                        <i class="fas fa-chevron-right mr-2 text-xs text-[#FF6000]"></i> Profile
                    </a>
                    <a href="/tarif" class="text-white hover:text-[#FF6000] transition-colors flex items-center">
                        <i class="fas fa-chevron-right mr-2 text-xs text-[#FF6000]"></i> Tarif
                    </a>
                    <a href="/tracking" class="text-white hover:text-[#FF6000] transition-colors flex items-center">
                        <i class="fas fa-chevron-right mr-2 text-xs text-[#FF6000]"></i> Tracking
                    </a>
                    <a href="/contact" class="text-white hover:text-[#FF6000] transition-colors flex items-center">
                        <i class="fas fa-chevron-right mr-2 text-xs text-[#FF6000]"></i> Contact Us
                    </a>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div class="transform transition-all duration-500 hover:translate-y-[-5px]">
                <h4 class="text-lg font-semibold mb-5 text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-2 flex items-center">
                    <span class="bg-[#FF6000] w-2 h-6 rounded-sm mr-2"></span> Hubungi Kami
                </h4>
                <ul class="space-y-4">
                    <li class="flex items-center text-white p-2 rounded-lg hover:bg-white hover:bg-opacity-5 transition-all duration-300">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center mr-4 shadow-glow">
                            <i class="fas fa-phone-alt text-white"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Telepon</p>
                            <p class="font-medium">{{ $companyInfo->contact_phone ?? '0858 1471 8888' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center text-white p-2 rounded-lg hover:bg-white hover:bg-opacity-5 transition-all duration-300">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center mr-4 shadow-glow">
                            <i class="fas fa-headset text-white"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Customer Service</p>
                            <p class="font-medium">{{ $companyInfo->contact_phone ?? '0858 1471 8888' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center text-white p-2 rounded-lg hover:bg-white hover:bg-opacity-5 transition-all duration-300">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center mr-4 shadow-glow">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Email</p>
                            <p class="font-medium">{{ $companyInfo->contact_email ?? 'info@zdx.co.id' }}</p>
                        </div>
                    </li>
                </ul>
                
                <h4 class="text-lg font-semibold mb-4 mt-8 text-[#FF6000] border-b border-[#FF6000] border-opacity-20 pb-2 flex items-center">
                    <span class="bg-[#FF6000] w-2 h-6 rounded-sm mr-2"></span> Media Sosial
                </h4>
                <div class="flex space-x-3 mt-4">
                    @if(!empty($companyInfo->contact_facebook))
                    <a href="{{ $companyInfo->contact_facebook }}" target="_blank" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    @else
                    <a href="#" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    @endif
                    
                    @if(!empty($companyInfo->contact_twitter))
                    <a href="{{ $companyInfo->contact_twitter }}" target="_blank" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-twitter text-white"></i>
                    </a>
                    @else
                    <a href="#" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-twitter text-white"></i>
                    </a>
                    @endif
                    
                    @if(!empty($companyInfo->contact_instagram))
                    <a href="{{ $companyInfo->contact_instagram }}" target="_blank" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    @else
                    <a href="#" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    @endif
                    
                    @if(!empty($companyInfo->contact_youtube))
                    <a href="{{ $companyInfo->contact_youtube }}" target="_blank" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-youtube text-white"></i>
                    </a>
                    @else
                    <a href="#" class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FF6000] to-[#FF8C00] flex items-center justify-center shadow-glow hover:scale-110 transition-all duration-300">
                        <i class="fab fa-linkedin-in text-white"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-white text-opacity-70">
            <p>&copy; Copyright {{ date('Y') }}. All Rights Reserved. {{ $companyInfo->company_name ?? 'PT. Zindan Diantar Express' }}</p>
        </div>
    </div>
</footer>

<!-- WhatsApp Button -->
@if(!empty($companyInfo->contact_phone))
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companyInfo->contact_phone) }}" target="_blank" class="whatsapp-button fixed bottom-6 right-6 z-50">
@else
<a href="https://wa.me/6285814718888" target="_blank" class="whatsapp-button fixed bottom-6 right-6 z-50">
@endif
    <div class="relative">
        <div class="ping-animation absolute inset-0 rounded-full"></div>
        <div class="flex items-center justify-center bg-[#25D366] rounded-full w-18 h-18 shadow-lg">
            <i class="fab fa-whatsapp text-white text-4xl"></i>
        </div>
    </div>
</a>

<style>
.shadow-glow {
    box-shadow: 0 0 15px rgba(255, 96, 0, 0.3);
}

.whatsapp-button {
    transition: all 0.3s ease;
}

.whatsapp-button:hover {
    transform: scale(1.05);
}

.ping-animation {
    background-color: #25D366;
    animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
}

@keyframes ping {
    0% {
        transform: scale(1);
        opacity: 0.7;
    }
    70%, 100% {
        transform: scale(1.5);
        opacity: 0;
    }
}
</style> 