@extends('layouts.admin')

@section('title', 'Edit Robots.txt')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Robots.txt</h2>
            <p class="text-gray-600 mt-1">Kelola file robots.txt - file yang memberikan petunjuk kepada mesin pencari tentang cara menjelajahi situs Anda.</p>
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
                <h3 class="text-lg font-medium text-gray-900">Tentang file robots.txt</h3>
                <div class="mt-2 text-sm text-gray-600">
                    <p>File robots.txt berisi instruksi untuk robot/crawler mesin pencari seperti Google tentang cara menjelajahi situs Anda.</p>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        <li>Gunakan <code class="text-xs bg-gray-200 px-1 py-0.5 rounded">User-agent: *</code> untuk menyertakan semua robot pencari.</li>
                        <li>Gunakan <code class="text-xs bg-gray-200 px-1 py-0.5 rounded">Allow: /</code> untuk mengizinkan semua halaman diindeks.</li>
                        <li>Gunakan <code class="text-xs bg-gray-200 px-1 py-0.5 rounded">Disallow: /admin/</code> untuk mencegah halaman tertentu diindeks.</li>
                        <li>Tambahkan tautan ke sitemap dengan <code class="text-xs bg-gray-200 px-1 py-0.5 rounded">Sitemap: {{ url('sitemap.xml') }}</code></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.seo.robots.update') }}" method="POST">
        @csrf
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <div class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-robot text-indigo-600 mr-2"></i>
                    robots.txt
                </div>
                <div class="flex items-center">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-sm">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
            <div class="p-4">
                <textarea name="robots_content" id="robots_content" rows="15" class="font-mono w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">{{ $robotsContent }}</textarea>
                
                <div class="mt-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Template:</h4>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" class="template-btn text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded transition-colors duration-200"
                            data-template="default">Default</button>
                        <button type="button" class="template-btn text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded transition-colors duration-200"
                            data-template="block-admin">Block Admin Area</button>
                        <button type="button" class="template-btn text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded transition-colors duration-200"
                            data-template="block-images">Block Image Indexing</button>
                        <button type="button" class="template-btn text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-2 py-1 rounded transition-colors duration-200"
                            data-template="block-files">Block File Downloads</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const robotsContent = document.getElementById('robots_content');
    const templateButtons = document.querySelectorAll('.template-btn');
    
    const templates = {
        default: `User-agent: *
Allow: /

Sitemap: {{ url('sitemap.xml') }}`,
        'block-admin': `User-agent: *
Allow: /
Disallow: /admin/
Disallow: /login/
Disallow: /register/

Sitemap: {{ url('sitemap.xml') }}`,
        'block-images': `User-agent: *
Allow: /
Disallow: /*.jpg$
Disallow: /*.jpeg$
Disallow: /*.png$
Disallow: /*.gif$

Sitemap: {{ url('sitemap.xml') }}`,
        'block-files': `User-agent: *
Allow: /
Disallow: /*.pdf$
Disallow: /*.doc$
Disallow: /*.docx$
Disallow: /*.xls$
Disallow: /*.xlsx$
Disallow: /*.zip$
Disallow: /*.rar$

Sitemap: {{ url('sitemap.xml') }}`
    };
    
    templateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const templateName = this.getAttribute('data-template');
            if (confirm('Apakah Anda yakin ingin mengganti konten saat ini dengan template?')) {
                robotsContent.value = templates[templateName];
            }
        });
    });
});
</script>
@endpush 