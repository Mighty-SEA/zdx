<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\ProfileContent;

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
        // Berbagi informasi kontak ke semua view
        View::composer('*', function ($view) {
            // Cache data selama 1 jam untuk mengurangi query database
            $companyInfo = Cache::remember('company_info', 3600, function () {
                return ProfileContent::where('section', 'about')
                    ->where('is_active', true)
                    ->first();
            });

            $view->with('companyInfo', $companyInfo);
        });
    }
}
