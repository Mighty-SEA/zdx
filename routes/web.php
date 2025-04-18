<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\PageSeoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AnalyticsSettingsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\HomeContentController;
use Illuminate\Http\Request;

// Frontend Routes
Route::get('/', [PageController::class, 'home']);
Route::get('/layanan', [PageController::class, 'services']);
Route::get('/layanan/{slug}', [PageController::class, 'serviceDetail']);
Route::get('/services', [PageController::class, 'services']);
Route::get('/tarif', [PageController::class, 'rates']);
Route::get('/rates', [PageController::class, 'rates']);
Route::get('/tracking', [PageController::class, 'tracking']);
Route::post('/track-shipment', [PageController::class, 'trackShipment'])->name('track.shipment');
Route::get('/customer', [PageController::class, 'customer']);
Route::get('/commodity', [PageController::class, 'commodity']);
Route::get('/komoditas', [PageController::class, 'commodity']);
Route::get('/profile', [PageController::class, 'profile']);
Route::get('/kontak', [PageController::class, 'contact']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/search-rates', [PageController::class, 'searchRates'])->name('search.rates');
Route::post('/get-cities', [PageController::class, 'getCities'])->name('get.cities');
Route::post('/get-kelurahans', [PageController::class, 'getKelurahans'])->name('get.kelurahans');
Route::post('/calculate-rates', [PageController::class, 'calculateRates'])->name('calculate.rates');

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // SEO routes
    Route::get('/seo', [PageSeoController::class, 'index'])->name('seo');
    Route::get('/seo/page/{id}/edit', [PageSeoController::class, 'edit'])->name('seo.edit');
    Route::post('/seo/page/{id}', [PageSeoController::class, 'update'])->name('seo.update');
    Route::get('/seo/initialize', [PageSeoController::class, 'initializeDefaults'])->name('seo.initialize');
    Route::get('/seo/sync-services', [PageSeoController::class, 'syncServices'])->name('seo.sync-services');
    
    // Robots.txt routes
    Route::get('/seo/robots', [PageSeoController::class, 'showRobots'])->name('seo.robots');
    Route::post('/seo/robots', [PageSeoController::class, 'updateRobots'])->name('seo.robots.update');
    
    // Sitemap routes
    Route::get('/seo/sitemap', [PageSeoController::class, 'showSitemap'])->name('seo.sitemap');
    Route::post('/seo/sitemap/generate', [PageSeoController::class, 'generateSitemap'])->name('seo.sitemap.generate');
    Route::post('/seo/sitemap/update', [PageSeoController::class, 'updateSitemap'])->name('seo.sitemap.update');

    // Admin Rates
    Route::get('/rates', [RateController::class, 'index'])->name('rates');
    Route::get('/rates/create', [RateController::class, 'create'])->name('rates.create');
    Route::post('/rates', [RateController::class, 'store'])->name('rates.store');
    Route::get('/rates/{id}/edit', [RateController::class, 'edit'])->name('rates.edit');
    Route::put('/rates/{id}', [RateController::class, 'update'])->name('rates.update');
    Route::delete('/rates/{id}', [RateController::class, 'destroy'])->name('rates.destroy');
    Route::post('/rates/import', [RateController::class, 'import'])->name('rates.import');
    Route::get('/rates/download-template', [RateController::class, 'downloadTemplate'])->name('rates.download-template');
    Route::delete('/rates/bulk-delete', [RateController::class, 'bulkDelete'])->name('rates.bulk-delete');
    
    // Notifications Routes
    Route::get('/notifications', [NotificationController::class, 'all'])->name('notifications');
    Route::get('/notifications/data', [NotificationController::class, 'index'])->name('notifications.data');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    
    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/analytics', [SettingsController::class, 'storeAnalytics'])->name('settings.analytics');
    Route::post('/settings/company', [SettingsController::class, 'storeCompany'])->name('settings.company');
    Route::post('/settings/api', [SettingsController::class, 'storeApi'])->name('settings.api');
    Route::post('/settings/tracking', [SettingsController::class, 'storeTracking'])->name('settings.tracking');
    Route::post('/settings/tracking/test', [SettingsController::class, 'testTracking'])->name('settings.tracking.test');
    
    // Redirect analytics-settings ke tab analytics pada halaman pengaturan
    Route::get('/analytics-settings', function() {
        return redirect()->route('admin.settings', ['#analytics'], 301);
    })->name('analytics-settings.index');
    Route::post('/analytics-settings', function(Request $request) {
        return redirect()->route('admin.settings.analytics', $request->all(), 301);
    })->name('analytics-settings.store');
    
    // Admin Users
    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');
    
    // Admin Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');
    
    // Admin Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    
    // Admin Partners (Pelanggan / Partner)
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::put('/partners/{id}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    
    // Admin Home Content
    Route::get('/home-content', [HomeContentController::class, 'index'])->name('home-content.index');
    Route::get('/home-content/{id}/edit', [HomeContentController::class, 'edit'])->name('home-content.edit');
    Route::put('/home-content/{id}', [HomeContentController::class, 'update'])->name('home-content.update');
    Route::post('/home-content/order', [HomeContentController::class, 'updateOrder'])->name('home-content.order');
});