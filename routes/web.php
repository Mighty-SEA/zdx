<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/kontak', function () {
    return view('contact');
});