<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('home');
});

Route::get('/layanan', function () {
    return view('services');
});

Route::get('/tarif', function () {
    return view('rates');
});

Route::get('/tracking', function () {
    return view('tracking');
});

Route::get('/customer', function () {
    return view('customer');
});

Route::get('/profil', function () {
    return view('profile');
});

Route::get('/kontak', function () {
    return view('contact');
});

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
        Route::get('/seo', function () {
            return view('admin.seo');
        })->name('admin.seo');
        
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