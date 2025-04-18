<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\View\Components\AnalyticsAlert;

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

        // Directive untuk elemen yang dapat diedit
        Blade::directive('editable', function ($expression) {
            $params = explode(',', $expression);
            
            if (count($params) < 3) {
                return "<?php echo 'Invalid editable directive parameters'; ?>";
            }
            
            $sectionIdentifier = trim($params[0]);
            $contentType = trim($params[1]);
            $defaultContent = trim($params[2]);
            $pageIdentifier = isset($params[3]) ? trim($params[3]) : "request()->path() === '/' ? 'home' : request()->path()";
            
            return "<?php
                \$pageIdentifier = {$pageIdentifier};
                \$sectionIdentifier = {$sectionIdentifier};
                \$contentType = {$contentType};
                \$defaultContent = {$defaultContent};
                
                \$content = app('\\App\\Services\\ContentService')->getContent(\$pageIdentifier, \$sectionIdentifier, \$defaultContent);
                echo '<span data-editable=\"' . \$contentType . '\" data-section=\"' . \$sectionIdentifier . '\">' . \$content . '</span>';
            ?>";
        });
    }
}
