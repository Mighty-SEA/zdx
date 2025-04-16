<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\SeoController;

// Frontend Routes
Route::get('/', [PageController::class, 'home']);
Route::get('/layanan', [PageController::class, 'services']);
Route::get('/tarif', [PageController::class, 'rates']);
Route::get('/tracking', [PageController::class, 'tracking']);
Route::get('/customer', [PageController::class, 'customer']);
Route::get('/profil', [PageController::class, 'profile']);
Route::get('/kontak', [PageController::class, 'contact']);

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Login
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login')->middleware('guest');

    // Protected Admin Routes
    Route::middleware(['auth'])->group(function () {
        // Admin Dashboard
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        // Admin Rates
        Route::get('/rates', function () {
            return view('admin.rates');
        })->name('admin.rates');
        
        // Admin Users
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');
        
        // Admin Roles
        Route::get('/roles', function () {
            return view('admin.roles');
        })->name('admin.users.roles');
        
        // Admin SEO Management
        Route::get('/seo', [SeoController::class, 'index'])->name('admin.seo');
        Route::post('/seo/save', [SeoController::class, 'store'])->name('admin.seo.save');
        Route::get('/seo/page/{id}', [SeoController::class, 'getPageSeo'])->name('admin.seo.page');
        Route::post('/seo/page/{id}/save', [SeoController::class, 'storePage'])->name('admin.seo.page.save');
        Route::post('/seo/page/{id}/api', [SeoController::class, 'storePageApi'])->name('admin.seo.page.api.save');
        
        // Admin Settings
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('admin.settings');
        
        // Admin Profile
        Route::get('/profile', function () {
            return view('admin.profile');
        })->name('admin.profile');
    });
});