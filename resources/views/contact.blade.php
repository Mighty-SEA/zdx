@extends('layouts.app')

@section('meta_tags')
    <title>Kontak Kami - PT. Zindan Diantar Express</title>
    <link rel="icon" href="{{ asset('asset/logo.png') }}">
    <meta name="description" content="Hubungi ZDX Cargo untuk informasi layanan pengiriman dan pertanyaan lainnya.">
    <meta name="keywords" content="kontak zdx, hubungi zdx, alamat zdx, telepon zdx, email zdx">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/contact') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/contact') }}">
    <meta property="og:title" content="Kontak Kami - PT. Zindan Diantar Express">
    <meta property="og:description" content="Hubungi ZDX Cargo untuk informasi layanan pengiriman dan pertanyaan lainnya.">
@endsection

@section('content')
           <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="absolute bottom-0 w-full h-12 text-white">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-2 text-gray-500 text-sm mb-8">
                <a href="/" class="hover:text-[#FF6000]">Home</a>
                <span>•</span>
                <span class="text-[#FF6000]">Contact Us</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Get In Touch Section -->
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Get In Touch</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <!-- Phone Contact Card -->
                    <div class="bg-white rounded-lg shadow-lg p-8 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl text-center">
                        <div class="w-16 h-16 bg-[#FF6000]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Phone</h3>
                        @if(isset($contactInfo) && $contactInfo->contact_phone)
                            <p class="text-gray-600 mb-2">{{ $contactInfo->contact_phone }}</p>
                        @else
                            <p class="text-gray-600 mb-2">021 3871 1144</p>
                            <p class="text-gray-600">021 3871 1181</p>
                        @endif
                    </div>
                    
                    <!-- Email Contact Card -->
                    <div class="bg-white rounded-lg shadow-lg p-8 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl text-center">
                        <div class="w-16 h-16 bg-[#FF6000]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Mail</h3>
                        <p class="text-gray-600">{{ isset($contactInfo) && $contactInfo->contact_email ? $contactInfo->contact_email : 'info@zdx.co.id' }}</p>
                    </div>
                    
                    <!-- Social Media Card -->
                    <div class="bg-white rounded-lg shadow-lg p-8 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl text-center">
                        <div class="w-16 h-16 bg-[#FF6000]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#FF6000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Social Media</h3>
                        <div class="flex justify-center space-x-4 mt-2">
                            @if(isset($contactInfo) && $contactInfo->contact_facebook)
                                <a href="{{ $contactInfo->contact_facebook }}" target="_blank" class="text-gray-400 hover:text-[#FF6000] transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="#" class="text-gray-400 hover:text-[#FF6000] transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                            @endif
                            
                            @if(isset($contactInfo) && $contactInfo->contact_instagram)
                                <a href="{{ $contactInfo->contact_instagram }}" target="_blank" class="text-gray-400 hover:text-[#FF6000] transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="#" class="text-gray-400 hover:text-[#FF6000] transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"></path>
                                    </svg>
                                </a>
                            @endif
                            
                            @if(isset($contactInfo) && $contactInfo->contact_twitter)
                                <a href="{{ $contactInfo->contact_twitter }}" target="_blank" class="text-gray-400 hover:text-[#FF6000] transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="#" class="text-gray-400 hover:text-[#FF6000] transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map & Contact Form -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-20">
                <!-- Map -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-96 bg-gray-100">
                        @if(isset($contactInfo) && $contactInfo->contact_maps_link)
                            <iframe src="{{ $contactInfo->contact_maps_link }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @else
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8641829579854!2d106.95815701476935!3d-6.282267895453966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698dd7a8c2e3ed%3A0x66c7add95def62a!2sJl.%20Swatantra%20I%2C%20Jatirasa%2C%20Kec.%20Jatiasih%2C%20Kota%20Bks%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1634567890123!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @endif
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Send Us a Message</h2>
                    </div>
                    <div class="p-6">
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="tel" name="phone" id="phone" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700">Subjek</label>
                                <input type="text" name="subject" id="subject" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                                <textarea id="message" name="message" rows="4" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-[#FF6000] to-[#FF8C00] hover:from-[#E65100] hover:to-[#FF6000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6000]">
                                    Kirim Pesan
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="bg-gradient-to-r from-[#E65100] to-[#FF6000] rounded-lg shadow-lg overflow-hidden">
                <div class="p-10 text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">Butuh Bantuan Segera?</h2>
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto">
                        Tim customer service kami siap membantu Anda dengan kebutuhan pengiriman. Hubungi kami sekarang untuk mendapatkan solusi pengiriman terbaik.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="tel:{{ isset($contactInfo) && $contactInfo->contact_phone ? $contactInfo->contact_phone : '0213871144' }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-[#FF6000] bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            Telepon Kami
                        </a>
                        <a href="mailto:{{ isset($contactInfo) && $contactInfo->contact_email ? $contactInfo->contact_email : 'info@zdx.co.id' }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF8C00] hover:bg-[#E65100] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF8C00]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            Email Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 