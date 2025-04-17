<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Services\AnalyticsService;

class AnalyticsAlert extends Component
{
    /**
     * Flag apakah Google Analytics sudah dikonfigurasi
     */
    public bool $isConfigured;
    
    /**
     * Create a new component instance.
     */
    public function __construct(AnalyticsService $analyticsService)
    {
        $this->isConfigured = $analyticsService->isConfigured();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.analytics-alert');
    }
} 