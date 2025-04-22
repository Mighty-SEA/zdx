<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class CompanySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Informasi Dasar Perusahaan
        $this->createSetting('company_name', 'PT Zindan Diantar Express', 'company');
        $this->createSetting('company_slogan', 'Solusi Tepat Pengiriman Cepat', 'company');
        $this->createSetting('company_description', 'ZDX Cargo adalah perusahaan jasa pengiriman terpercaya yang melayani kebutuhan logistik bisnis dan pribadi dengan jangkauan nasional dan internasional.', 'company');
        $this->createSetting('company_website', 'www.zdx.co.id', 'company');
        $this->createSetting('company_tax_id', '01.234.567.8-901.000', 'company');
        
        // Alamat Perusahaan (3 lokasi)
        $this->createSetting('company_address', 'Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424', 'company');
        $this->createSetting('company_address2', 'Jl. Diponegoro, Jatimulya, Tambun Selatan, Bekasi Timur', 'company');
        $this->createSetting('company_address3', 'Regulated Cahaya Mas Utama Gedung BTS A-8 Soewarna Business Park Blok A Lot.8 Kota Tangerang', 'company');
        
        // Kontak Perusahaan
        $this->createSetting('company_email', 'info@zdx.co.id', 'company');
        $this->createSetting('company_phone', '0858 1471 8888', 'company');
        $this->createSetting('company_phone2', '0821 3000 0600', 'company');
        $this->createSetting('company_phone3', '', 'company');
        
        // Social Media
        $this->createSetting('company_facebook', 'https://facebook.com/zdxcargo', 'company');
        $this->createSetting('company_instagram', 'https://instagram.com/zdxcargo', 'company');
        $this->createSetting('company_twitter', '', 'company');
        $this->createSetting('company_linkedin', '', 'company');
        $this->createSetting('company_youtube', '', 'company');
        
        // Lokasi Maps
        $this->createSetting('company_latitude', '-6.282268', 'company');
        $this->createSetting('company_longitude', '106.960346', 'company');
        
        // Setting untuk kontak tampilan web
        $this->createSetting('contact_phone', '0858 1471 8888', 'company');
        $this->createSetting('contact_phone2', '0821 3000 0600', 'company');
        $this->createSetting('contact_email', 'info@zdx.co.id', 'company');
        $this->createSetting('contact_address', 'Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424', 'company');
        $this->createSetting('contact_facebook', 'https://facebook.com/zdxcargo', 'company');
        $this->createSetting('contact_instagram', 'https://instagram.com/zdxcargo', 'company');
        $this->createSetting('contact_twitter', '', 'company');
        $this->createSetting('contact_youtube', '', 'company');
    }
    
    /**
     * Buat setting jika belum ada
     */
    private function createSetting($key, $value, $group)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group
            ]
        );
    }
} 