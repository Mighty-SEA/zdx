@extends('layouts.admin')

@section('title', 'Kelola Sitemap')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Sitemap</h2>
            <p class="text-gray-600 mt-1">Sitemap membantu mesin pencari menemukan dan mengindeks semua halaman di situs web Anda.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.seo') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div class="bg-gray-50 p-5 rounded-xl mb-6 border border-gray-200">
        <div class="flex items-start mb-4">
            <div class="flex-shrink-0 mt-1">
                <i class="fas fa-info-circle text-blue-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-gray-900">Tentang Sitemap</h3>
                <div class="mt-2 text-sm text-gray-600">
                    <p>Sitemap membantu mesin pencari memahami struktur situs web Anda dan menemukan semua URL penting yang perlu diindeks.</p>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        <li>Sitemap dapat dibuat secara otomatis berdasarkan halaman yang ada.</li>
                        <li>Anda juga dapat mengedit XML secara langsung untuk kebutuhan khusus.</li>
                        <li>Sitemap ini harus disubmit ke <a href="https://search.google.com/search-console" target="_blank" class="text-blue-600 hover:underline">Google Search Console</a> untuk hasil optimal.</li>
                        <li>Tautan ke sitemap sebaiknya ditambahkan di file robots.txt.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Generate Sitemap Section -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-sitemap text-indigo-600 mr-2"></i>
                    Generate Sitemap Otomatis
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.seo.sitemap.generate') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-4">
                            Pilih halaman mana yang ingin Anda sertakan dalam sitemap dan tentukan prioritas serta frekuensi perubahannya.
                        </p>
                        
                        <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                            <div class="px-4 py-3 bg-gray-100 border-b border-gray-200">
                                <div class="grid grid-cols-12 gap-4 text-sm font-medium text-gray-700">
                                    <div class="col-span-1">Include</div>
                                    <div class="col-span-3">Halaman</div>
                                    <div class="col-span-4">URL</div>
                                    <div class="col-span-2">Prioritas</div>
                                    <div class="col-span-2">Frekuensi Perubahan</div>
                                </div>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach($pages as $page)
                                <div class="px-4 py-3 grid grid-cols-12 gap-4 items-center hover:bg-gray-50">
                                    <div class="col-span-1">
                                        <input type="checkbox" name="include_{{ $page->id }}" id="include_{{ $page->id }}" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                                    </div>
                                    <div class="col-span-3">
                                        <label for="include_{{ $page->id }}" class="text-gray-700">{{ $page->page_name }}</label>
                                    </div>
                                    <div class="col-span-4">
                                        <span class="text-sm text-gray-600">{{ url($page->page_identifier == 'home' ? '/' : $page->page_identifier) }}</span>
                                    </div>
                                    <div class="col-span-2">
                                        <select name="priority_{{ $page->id }}" class="block w-full text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="1.0" {{ $page->page_identifier == 'home' ? 'selected' : '' }}>1.0 (Tinggi)</option>
                                            <option value="0.8" {{ $page->page_identifier != 'home' ? 'selected' : '' }}>0.8</option>
                                            <option value="0.6">0.6</option>
                                            <option value="0.4">0.4</option>
                                            <option value="0.2">0.2 (Rendah)</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <select name="changefreq_{{ $page->id }}" class="block w-full text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="always">Selalu</option>
                                            <option value="hourly">Per jam</option>
                                            <option value="daily">Harian</option>
                                            <option value="weekly" {{ $page->page_identifier == 'home' ? 'selected' : '' }}>Mingguan</option>
                                            <option value="monthly" {{ $page->page_identifier != 'home' ? 'selected' : '' }}>Bulanan</option>
                                            <option value="yearly">Tahunan</option>
                                            <option value="never">Tidak pernah</option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="additional_urls" class="block text-sm font-medium text-gray-700 mb-1">
                            URL Tambahan <span class="text-xs text-gray-500">(satu URL per baris)</span>
                        </label>
                        <textarea id="additional_urls" name="additional_urls" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="https://www.zdxexpress.co.id/blog/article-1"></textarea>
                        <p class="mt-1 text-xs text-gray-500">Tambahkan URL tambahan yang tidak tercantum di atas yang ingin Anda sertakan dalam sitemap</p>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg flex items-center transition-all duration-200 shadow-sm">
                            <i class="fas fa-sync-alt mr-2"></i> Generate Sitemap
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Manual Edit Section -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-code text-indigo-600 mr-2"></i>
                    Edit XML Manual
                </h3>
            </div>
            <div class="p-6">
                @if($sitemapExists)
                <form action="{{ route('admin.seo.sitemap.update') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="sitemap_content" class="block text-sm font-medium text-gray-700 mb-1">
                            Konten XML
                        </label>
                        <textarea id="sitemap_content" name="sitemap_content" rows="15" class="font-mono text-sm w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">{{ $sitemapContent }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Edit konten XML sitemap secara langsung. Pastikan bahwa XML valid.</p>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg flex items-center transition-all duration-200 shadow-sm">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
                @else
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                    <p>Tidak ada file sitemap.xml ditemukan. Silakan gunakan fungsi "Generate Sitemap" di atas untuk membuat sitemap baru.</p>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Sitemap Info Section -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-link text-indigo-600 mr-2"></i>
                    Informasi Sitemap
                </h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-600">
                        URL Sitemap Anda: <a href="{{ url('sitemap.xml') }}" target="_blank" class="text-indigo-600 hover:underline font-medium">{{ url('sitemap.xml') }}</a>
                    </p>
                </div>
                
                <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">
                                Pastikan Anda mengirimkan sitemap ini ke <a href="https://search.google.com/search-console" target="_blank" class="font-medium underline">Google Search Console</a> 
                                untuk meningkatkan indeksasi halaman web Anda. Juga, pastikan tautan ke sitemap ini ada di file <a href="{{ route('admin.seo.robots') }}" class="font-medium underline">robots.txt</a> Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 