<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\View\Components\AnalyticsAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Daftarkan komponen
        Blade::component('analytics-alert', AnalyticsAlert::class);

        // Berbagi data logo untuk semua view dengan cache
        View::composer('*', function ($view) {
            // Ambil URL logo dari cache, atau generate jika belum ada
            $logoUrl = Cache::remember('company_logo_url', 86400, function () {
                // Cek apakah file logo ada di storage
                if (Storage::disk('public')->exists('logos/logo1.png')) {
                    // Tambahkan versi statis ke URL untuk memastikan browser menggunakan cache
                    return Storage::url('logos/logo1.png');
                }
                return asset('asset/logo.png');
            });
            
            $view->with('logoUrl', $logoUrl);
        });
    }
}
