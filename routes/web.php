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
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\CommodityController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CompanyMediaController;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\StructureController;
use App\Models\Blog;

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
Route::get('/order-now', [PageController::class, 'orderNow'])->name('order.now');

// Blog Routes
Route::get('/blog', [PageController::class, 'blogs']);
Route::get('/blog/category/{category}', [PageController::class, 'blogByCategory']);
Route::get('/blog/tag/{tag}', [PageController::class, 'blogByTag']);

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
    
    // Update Aplikasi
    Route::post('/update/perform', [App\Http\Controllers\Admin\UpdateController::class, 'update'])->name('update.perform');
    
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
    Route::post('/rates/bulk-delete', [RateController::class, 'bulkDelete'])->name('rates.bulk-delete');
    
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
    
    // Redirect profile-content ke tab company pada halaman pengaturan
    Route::get('/profile-content', function() {
        return redirect()->route('admin.settings', ['#company'], 301);
    })->name('profile-content.index');
    Route::get('/profile-content/{id}/edit', function($id) {
        return redirect()->route('admin.settings', ['#company'], 301);
    })->name('profile-content.edit');
    
    // Admin Users
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/reset-password', [App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('users.reset-password');
    
    // Admin Profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/profile/photo', [App\Http\Controllers\Admin\ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::get('/profile/activities', [App\Http\Controllers\Admin\ProfileController::class, 'getActivities'])->name('profile.activities');
    
    // Admin Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::delete('/services/{id}/image', [ServiceController::class, 'deleteImage'])->name('services.delete-image');
    
    // Admin Partners (Pelanggan / Partner)
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::put('/partners/{id}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    // Commodity Management
    Route::resource('commodity', CommodityController::class);

    Route::get('/home-content', [HomeContentController::class, 'index'])->name('home-content.index');
    Route::get('/home-content/{id}/edit', [HomeContentController::class, 'edit'])->name('home-content.edit');
    Route::put('/home-content/{id}', [HomeContentController::class, 'update'])->name('home-content.update');
    Route::post('/home-content/order', [HomeContentController::class, 'updateOrder'])->name('home-content.order');
    
    // Admin Profile Content
    Route::get('/profile-content', [ProfileContentController::class, 'index'])->name('profile-content.index');
    Route::get('/profile-content/{id}/edit', [ProfileContentController::class, 'edit'])->name('profile-content.edit');
    Route::put('/profile-content/{id}', [ProfileContentController::class, 'update'])->name('profile-content.update');
    Route::post('/profile-content/order', [ProfileContentController::class, 'updateOrder'])->name('profile-content.order');

    // Rute untuk upload media perusahaan
    Route::post('/company-media/logo/upload', [CompanyMediaController::class, 'uploadLogo'])->name('company-media.logo.upload');
    Route::post('/company-media/structure/upload', [CompanyMediaController::class, 'uploadStructure'])->name('company-media.structure.upload');
    Route::post('/company-media/logistics/upload', [CompanyMediaController::class, 'uploadLogistics'])->name('company-media.logistics.upload');
    Route::post('/company-media/delete', [CompanyMediaController::class, 'deleteMedia'])->name('company-media.delete');

    // Admin Blog
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\BlogController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\BlogController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [\App\Http\Controllers\Admin\BlogController::class, 'trash'])->name('trash');
        Route::post('/{id}/restore', [\App\Http\Controllers\Admin\BlogController::class, 'restore'])->name('restore');
    });
});

// Daftar rute yang harus dikecualikan dari penanganan blog
$excludedRoutes = [
    'login', 'admin', 'layanan', 'services', 'tarif', 'rates', 'tracking', 
    'customer', 'commodity', 'komoditas', 'profile', 'kontak', 
    'contact', 'blog', 'order-now'
];

// Fungsi untuk memeriksa apakah slug ada di dalam database blog
Route::get('/{slug}', function($slug) use ($excludedRoutes) {
    // Jika slug adalah salah satu dari rute yang dikecualikan, lewati
    if (in_array($slug, $excludedRoutes)) {
        return abort(404);
    }
    
    // Cari blog dengan slug tersebut
    $blog = Blog::where('slug', $slug)
        ->where('status', 'published')
        ->first();
    
    // Jika blog ditemukan, tampilkan dengan controller yang sama
    if ($blog) {
        return app(PageController::class)->blogDetail($slug);
    }
    
    // Jika tidak ditemukan, tampilkan 404
    return abort(404);
})->where('slug', '[a-z0-9-]+'); // Pastikan format slug sesuai