<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/home', function () {
    return view('frontend.home');
});

Route::get('/layanan/perempuan', function () {
    return view('frontend.layanan.perempuan');
});
Route::get('/layanan/anak', function () {
    return view('frontend.layanan.anak');
});
Route::get('/layanan/kesejahteraan', function () {
    Return view('frontend.layanan.kesejahteraan');
});
Route::get('/layanan/edukasi', function () {
    return view('frontend.layanan.edukasi');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
});

Route::get('/login', function () {
    return view('backend.login');
});

Route::get('/tables', [PageController::class, 'table'])->name('tables');

