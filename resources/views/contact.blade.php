@extends('layouts.app')

@section('meta_tags')
    <title>Kontak Kami - PT. Zindan Diantar Express</title>
    <meta name="description" content="Hubungi ZDX Cargo untuk informasi layanan pengiriman dan pertanyaan lainnya.">
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                    Hubungi Kami
                </h1>
                <p class="mt-4 text-xl text-gray-600">
                    Kami siap membantu Anda dengan segala kebutuhan logistik
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Kirim Pesan</h2>
                    </div>
                    <div class="p-6">
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" class="mt-1 focus:ring-[#FF6000] focus:border-[#FF6000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
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
                        </form>
        </div>
    </div>

                <!-- Contact Information -->
                <div class="space-y-8">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">Informasi Kontak</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Kantor Pusat</p>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Jl. Kapuk Raya No. 88<br>
                                            Jakarta Barat, DKI Jakarta 11720<br>
                                            Indonesia
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Telepon</p>
                                        <p class="mt-1 text-sm text-gray-600">+62 21-7654321</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Email</p>
                                        <p class="mt-1 text-sm text-gray-600">customer.service@zdx.co.id</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Jam Operasional</p>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Senin - Jumat: 08:00 - 17:00 WIB<br>
                                            Sabtu: 08:00 - 13:00 WIB<br>
                                            Minggu & Hari Libur: Tutup
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">Media Sosial</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-[#FF6000]">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-[#FF6000]">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-[#FF6000]">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-[#FF6000]">
                                    <span class="sr-only">LinkedIn</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    
            <!-- Map Section -->
            <div class="mt-12 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Lokasi Kami</h2>
                </div>
                <div class="h-96 bg-gray-300">
                    <!-- Replace with actual Google Maps embed code -->
                    <div class="w-full h-full flex items-center justify-center">
                        <p class="text-gray-600">Peta akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
            
            <!-- FAQ Section -->
            <div class="mt-12 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-[#FF6000] to-[#FF8C00] px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Pertanyaan Umum</h2>
                            </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)">
                                <span class="text-gray-900 font-medium">Bagaimana cara mendapatkan penawaran harga?</span>
                                <svg class="h-5 w-5 text-[#FF6000] transform rotate-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="mt-2 hidden">
                                <p class="text-gray-600">
                                    Anda dapat menghubungi tim marketing kami melalui email sales@zdx.co.id atau telepon ke nomor 021-7654321. Tim kami akan segera menghubungi Anda untuk membahas kebutuhan pengiriman Anda.
                                </p>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)">
                                <span class="text-gray-900 font-medium">Berapa lama estimasi pengiriman?</span>
                                <svg class="h-5 w-5 text-[#FF6000] transform rotate-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="mt-2 hidden">
                                <p class="text-gray-600">
                                    Estimasi pengiriman bervariasi tergantung tujuan pengiriman dan layanan yang dipilih. Anda bisa mendapatkan estimasi waktu pengiriman yang lebih akurat dengan menghubungi customer service kami.
                                </p>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(this)">
                                <span class="text-gray-900 font-medium">Bagaimana cara melacak pengiriman?</span>
                                <svg class="h-5 w-5 text-[#FF6000] transform rotate-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="mt-2 hidden">
                                <p class="text-gray-600">
                                    Anda dapat melacak pengiriman Anda melalui fitur tracking di website kami. Cukup masukkan nomor resi pada halaman tracking dan Anda akan melihat status terkini pengiriman Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector('svg');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
@endsection 