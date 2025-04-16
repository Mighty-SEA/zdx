<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\SeoSetting;
use App\Models\PageSeo;

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
        // Share global SEO settings with all views
        View::composer('*', function ($view) {
            $seoSettings = SeoSetting::first();
            $view->with('globalSeo', $seoSettings);
        });
        
        // Add a custom Blade directive for getting PageSeo for current route
        Blade::directive('pageSeo', function ($expression) {
            return "<?php \$pageSeo = \App\Models\PageSeo::where('route', request()->path() === '/' ? '' : request()->path())->first(); ?>";
        });
    }
}
