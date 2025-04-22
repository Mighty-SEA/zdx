<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\ProfileContent;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Berbagi informasi perusahaan ke semua view
        View::composer('*', function ($view) {
            // Cache data selama 1 jam untuk mengurangi query database
            $companyInfo = Cache::remember('company_info', 3600, function () {
                // Ambil data tentang perusahaan dari model Setting
                $settings = [
                    'company_name' => Setting::getValue('company_name', 'PT ZDX Cargo Indonesia'),
                    'company_address' => Setting::getValue('company_address', 'Jl. Gatot Subroto No. 123, Jakarta Selatan 12930'),
                    'company_address2' => Setting::getValue('company_address2', ''),
                    'company_address3' => Setting::getValue('company_address3', ''),
                    'company_phone' => Setting::getValue('company_phone', '021-12345678'),
                    'company_phone2' => Setting::getValue('company_phone2', ''),
                    'company_phone3' => Setting::getValue('company_phone3', ''),
                    'company_email' => Setting::getValue('company_email', 'info@zdxcargo.com'),
                    'company_tax_id' => Setting::getValue('company_tax_id', '01.234.567.8-901.000'),
                    'company_description' => Setting::getValue('company_description', 'ZDX Cargo adalah perusahaan jasa pengiriman terpercaya yang melayani kebutuhan logistik bisnis dan pribadi dengan jangkauan nasional dan internasional.'),
                    'company_logo' => Setting::getValue('company_logo', ''),
                    'company_website' => Setting::getValue('company_website', 'www.zdxcargo.co.id'),
                    'company_slogan' => Setting::getValue('company_slogan', 'Solusi Tepat Pengiriman Cepat'),
                    'contact_phone' => Setting::getValue('company_phone', '0858 1471 8888'),
                    'contact_phone2' => Setting::getValue('company_phone2', '0858 1471 8889'),
                    'contact_phone3' => Setting::getValue('company_phone3', '0858 1471 8890'),
                    'contact_email' => Setting::getValue('company_email', 'info@zdx.co.id'),
                    'contact_address' => Setting::getValue('company_address', 'Jl. Swatantra 1 RT 09 RW 05, Kel. Jatirasa, Kec. Jatiasih, Kota Bekasi - Jawa Barat 17424'),
                    'contact_facebook' => Setting::getValue('company_facebook', 'https://facebook.com/zdxcargo'),
                    'contact_instagram' => Setting::getValue('company_instagram', 'https://instagram.com/zdxcargo'),
                    'contact_twitter' => Setting::getValue('company_twitter', ''),
                    'contact_linkedin' => Setting::getValue('company_linkedin', ''),
                    'contact_youtube' => Setting::getValue('company_youtube', ''),
                ];

                // Convert array ke objek untuk mempertahankan kompatibilitas dengan kode yang ada
                return json_decode(json_encode($settings));
            });

            // Juga menyimpan data ProfileContent lama untuk kompatibilitas ke belakang
            $profileContent = Cache::remember('profile_content', 3600, function () {
                return ProfileContent::where('section', 'about')
                    ->where('is_active', true)
                    ->first();
            });

            $view->with('companyInfo', $companyInfo);
            $view->with('profileContent', $profileContent);
        });
    }
}
