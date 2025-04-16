@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h2>
            <p class="text-gray-600 mt-1">Kelola pengaturan umum aplikasi ZDX Cargo.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </div>

    <!-- Main Content Area with Flex Layout -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Column (Settings Navigation) - 1/4 width on large screens -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Menu Pengaturan</h3>
                </div>
                <nav class="p-2">
                    <a href="#general" id="nav-general" class="flex items-center px-4 py-3 rounded-lg text-indigo-600 bg-indigo-50 mb-1">
                        <i class="fas fa-cog w-5 mr-2"></i>
                        <span>Umum</span>
                    </a>
                    <a href="#company" id="nav-company" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-building w-5 mr-2"></i>
                        <span>Informasi Perusahaan</span>
                    </a>
                    <a href="#email" id="nav-email" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-envelope w-5 mr-2"></i>
                        <span>Email</span>
                    </a>
                    <a href="#shipping" id="nav-shipping" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-truck w-5 mr-2"></i>
                        <span>Pengiriman</span>
                    </a>
                    <a href="#payment" id="nav-payment" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-credit-card w-5 mr-2"></i>
                        <span>Pembayaran</span>
                    </a>
                    <a href="#security" id="nav-security" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-shield-alt w-5 mr-2"></i>
                        <span>Keamanan</span>
                    </a>
                    <a href="#backup" id="nav-backup" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 mb-1">
                        <i class="fas fa-database w-5 mr-2"></i>
                        <span>Backup & Restore</span>
                    </a>
                    <a href="#api" id="nav-api" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-code w-5 mr-2"></i>
                        <span>API</span>
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Right Column (Settings Content) - 3/4 width on large screens -->
        <div class="lg:w-3/4">
            <!-- Settings Content Sections -->
            <div id="setting-content">
                <!-- General Settings -->
                <div id="content-general" class="bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Umum</h3>
                        <p class="text-sm text-gray-600">Konfigurasi pengaturan dasar aplikasi</p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-5">
                        <div>
                            <label for="site_title" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Website
                            </label>
                            <input type="text" id="site_title" name="site_title" value="ZDX Cargo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            <p class="mt-1 text-xs text-gray-500">Nama yang akan ditampilkan di title browser</p>
                        </div>
                        
                        <div>
                            <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-1">
                                Tagline Website
                            </label>
                            <input type="text" id="site_tagline" name="site_tagline" value="Jasa Pengiriman Terpercaya"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Logo
                            </label>
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gray-100 mr-3 rounded border border-gray-300 overflow-hidden flex items-center justify-center">
                                    <i class="fas fa-shipping-fast text-3xl text-gray-400"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2">
                                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-1.5 px-3 rounded transition-colors duration-200">
                                            Ganti Logo
                                        </button>
                                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium py-1.5 px-3 rounded transition-colors duration-200">
                                            Hapus
                                        </button>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, SVG. Ukuran maksimal: 2MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="timezone" class="block text-sm font-medium text-gray-700 mb-1">
                                Zona Waktu
                            </label>
                            <select id="timezone" name="timezone" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <option value="Asia/Jakarta" selected>Asia/Jakarta (GMT+7)</option>
                                <option value="Asia/Makassar">Asia/Makassar (GMT+8)</option>
                                <option value="Asia/Jayapura">Asia/Jayapura (GMT+9)</option>
                                <option value="Asia/Singapore">Asia/Singapore (GMT+8)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="date_format" class="block text-sm font-medium text-gray-700 mb-1">
                                Format Tanggal
                            </label>
                            <select id="date_format" name="date_format" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <option value="d/m/Y" selected>DD/MM/YYYY (31/12/2023)</option>
                                <option value="m/d/Y">MM/DD/YYYY (12/31/2023)</option>
                                <option value="Y-m-d">YYYY-MM-DD (2023-12-31)</option>
                                <option value="d F Y">DD MMMM YYYY (31 Desember 2023)</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Company Information -->
                <div id="content-company" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Perusahaan</h3>
                        <p class="text-sm text-gray-600">Detail informasi perusahaan yang akan ditampilkan</p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-5">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Perusahaan
                            </label>
                            <input type="text" id="company_name" name="company_name" value="PT ZDX Cargo Indonesia"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat
                            </label>
                            <textarea id="company_address" name="company_address" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">Jl. Gatot Subroto No. 123, Jakarta Selatan 12930</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Telepon
                                </label>
                                <input type="text" id="company_phone" name="company_phone" value="021-12345678"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            </div>
                            
                            <div>
                                <label for="company_email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email
                                </label>
                                <input type="email" id="company_email" name="company_email" value="info@zdxcargo.com"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            </div>
                        </div>
                        
                        <div>
                            <label for="company_tax_id" class="block text-sm font-medium text-gray-700 mb-1">
                                NPWP
                            </label>
                            <input type="text" id="company_tax_id" name="company_tax_id" value="01.234.567.8-901.000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi Perusahaan
                            </label>
                            <textarea id="company_description" name="company_description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">ZDX Cargo adalah perusahaan jasa pengiriman terpercaya yang melayani kebutuhan logistik bisnis dan pribadi dengan jangkauan nasional dan internasional. Didukung armada yang lengkap dan sistem pelacakan modern.</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Settings Sections (Hidden by Default) -->
                <div id="content-email" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Email</h3>
                        <p class="text-sm text-gray-600">Konfigurasi pengaturan email dan notifikasi</p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-5">
                        <div>
                            <label for="mail_driver" class="block text-sm font-medium text-gray-700 mb-1">
                                Mail Driver
                            </label>
                            <select id="mail_driver" name="mail_driver" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                <option value="smtp" selected>SMTP</option>
                                <option value="sendmail">Sendmail</option>
                                <option value="mailgun">Mailgun</option>
                                <option value="postmark">Postmark</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="mail_host" class="block text-sm font-medium text-gray-700 mb-1">
                                SMTP Host
                            </label>
                            <input type="text" id="mail_host" name="mail_host" value="smtp.mailtrap.io"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="mail_port" class="block text-sm font-medium text-gray-700 mb-1">
                                    SMTP Port
                                </label>
                                <input type="text" id="mail_port" name="mail_port" value="2525"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            </div>
                            
                            <div>
                                <label for="mail_encryption" class="block text-sm font-medium text-gray-700 mb-1">
                                    Enkripsi
                                </label>
                                <select id="mail_encryption" name="mail_encryption" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    <option value="null">Tidak Ada</option>
                                    <option value="tls" selected>TLS</option>
                                    <option value="ssl">SSL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="mail_username" class="block text-sm font-medium text-gray-700 mb-1">
                                    Username
                                </label>
                                <input type="text" id="mail_username" name="mail_username" value="3e4f567890abcd"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            </div>
                            
                            <div>
                                <label for="mail_password" class="block text-sm font-medium text-gray-700 mb-1">
                                    Password
                                </label>
                                <input type="password" id="mail_password" name="mail_password" value="••••••••••••"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                            </div>
                        </div>
                        
                        <div>
                            <label for="mail_from_address" class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat Pengirim
                            </label>
                            <input type="email" id="mail_from_address" name="mail_from_address" value="noreply@zdxcargo.com"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="mail_from_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Pengirim
                            </label>
                            <input type="text" id="mail_from_name" name="mail_from_name" value="ZDX Cargo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        </div>
                        
                        <div class="mt-2">
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded transition-colors duration-200">
                                Kirim Email Tes
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Placeholder for other settings sections -->
                <div id="content-shipping" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Pengiriman</h3>
                        <p class="text-sm text-gray-600">Konfigurasi opsi dan preferensi pengiriman</p>
                    </div>
                    
                    <div class="text-center py-8">
                        <i class="fas fa-truck text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Pengaturan pengiriman akan tersedia segera</p>
                    </div>
                </div>
                
                <div id="content-payment" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Pembayaran</h3>
                        <p class="text-sm text-gray-600">Konfigurasi metode dan gateway pembayaran</p>
                    </div>
                    
                    <div class="text-center py-8">
                        <i class="fas fa-credit-card text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Pengaturan pembayaran akan tersedia segera</p>
                    </div>
                </div>
                
                <div id="content-security" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan Keamanan</h3>
                        <p class="text-sm text-gray-600">Konfigurasi opsi keamanan dan privasi</p>
                    </div>
                    
                    <div class="text-center py-8">
                        <i class="fas fa-shield-alt text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Pengaturan keamanan akan tersedia segera</p>
                    </div>
                </div>
                
                <div id="content-backup" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Backup & Restore</h3>
                        <p class="text-sm text-gray-600">Kelola backup dan restore data aplikasi</p>
                    </div>
                    
                    <div class="text-center py-8">
                        <i class="fas fa-database text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Pengaturan backup akan tersedia segera</p>
                    </div>
                </div>
                
                <div id="content-api" class="hidden bg-white rounded-lg shadow-sm p-5 border border-gray-200 mb-6">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Pengaturan API</h3>
                        <p class="text-sm text-gray-600">Kelola API keys dan integrasi</p>
                    </div>
                    
                    <div class="text-center py-8">
                        <i class="fas fa-code text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Pengaturan API akan tersedia segera</p>
                    </div>
                </div>
            </div>
            
            <!-- Save Button -->
            <div class="flex justify-end">
                <div class="flex space-x-3">
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg transition-all duration-200">
                        Batal
                    </button>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg flex items-center shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const sections = ['general', 'company', 'email', 'shipping', 'payment', 'security', 'backup', 'api'];
        
        sections.forEach(section => {
            const navItem = document.getElementById(`nav-${section}`);
            if (navItem) {
                navItem.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Hide all section contents
                    sections.forEach(s => {
                        const contentEl = document.getElementById(`content-${s}`);
                        if (contentEl) {
                            contentEl.classList.add('hidden');
                        }
                        
                        const navEl = document.getElementById(`nav-${s}`);
                        if (navEl) {
                            navEl.classList.remove('text-indigo-600', 'bg-indigo-50');
                            navEl.classList.add('text-gray-700', 'hover:bg-gray-50');
                        }
                    });
                    
                    // Show selected section content
                    const currentContent = document.getElementById(`content-${section}`);
                    if (currentContent) {
                        currentContent.classList.remove('hidden');
                    }
                    
                    // Update nav item style
                    navItem.classList.remove('text-gray-700', 'hover:bg-gray-50');
                    navItem.classList.add('text-indigo-600', 'bg-indigo-50');
                });
            }
        });
    });
</script>
@endpush
@endsection 