<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rate;
use App\Models\Notification;
use App\Services\AnalyticsService;
use App\Services\BusinessStatsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected AnalyticsService $analyticsService;
    protected BusinessStatsService $businessStatsService;
    
    public function __construct(AnalyticsService $analyticsService, BusinessStatsService $businessStatsService)
    {
        $this->analyticsService = $analyticsService;
        $this->businessStatsService = $businessStatsService;
    }
    
    public function index()
    {
        // Data pengguna
        $userGrowthStats = $this->businessStatsService->getUserGrowthStats();
        $totalUsers = $userGrowthStats['total'];
        $userGrowthRate = $userGrowthStats['growth_rate'];
        
        // Data notifikasi
        $totalNotifications = Notification::count();
        $unreadNotifications = $this->businessStatsService->getUnreadNotificationsCount();
        
        // Data analytics
        $pageviews = $this->analyticsService->getPageviews();
        $pageviewGrowth = $this->analyticsService->getPageviewsGrowth();
        $bounceRate = $this->analyticsService->getBounceRate();
        $bounceRateChange = $this->analyticsService->getBounceRateChange();
        $avgDuration = $this->analyticsService->getAvgSessionDuration();
        $durationGrowth = $this->analyticsService->getAvgSessionDurationChange();
        
        // Data pengunjung
        $todaysVisitors = $this->analyticsService->getTodaysVisitors();
        $newVisitors = $this->analyticsService->getNewVisitors();
        $returningVisitors = $this->analyticsService->getReturningVisitors();
        $deviceDistribution = $this->analyticsService->getDeviceDistribution();
        
        // Top pages
        $topPages = $this->analyticsService->getTopPages();
        
        // Traffic sources
        $trafficSources = $this->analyticsService->getTrafficSources();
        
        // Chart data
        $trafficChartData = $this->analyticsService->getChartData();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'userGrowthRate',
            'userGrowthStats',
            'totalNotifications',
            'unreadNotifications',
            'pageviews',
            'pageviewGrowth',
            'bounceRate',
            'bounceRateChange',
            'avgDuration',
            'durationGrowth',
            'todaysVisitors',
            'newVisitors',
            'returningVisitors',
            'deviceDistribution',
            'topPages',
            'trafficSources',
            'trafficChartData'
        ));
    }
} 