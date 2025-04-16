<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\PageSeoController;
use App\Http\Controllers\Admin\AdminController;

// Frontend Routes
Route::get('/', [PageController::class, 'home']);
Route::get('/layanan', [PageController::class, 'services']);
Route::get('/tarif', [PageController::class, 'rates']);
Route::get('/tracking', [PageController::class, 'tracking']);
Route::get('/customer', [PageController::class, 'customer']);
Route::get('/profile', [PageController::class, 'profile']);
Route::get('/kontak', [PageController::class, 'contact']);

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
    
    // Admin Users
    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');
    
    // Admin Roles
    Route::get('/roles', function () {
        return view('admin.roles');
    })->name('users.roles');
    
    // Admin Settings
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
    
    // Admin Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');
});