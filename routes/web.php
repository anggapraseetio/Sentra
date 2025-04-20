<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/index', function () {
    return view('frontend.index');
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
    return view('backend.dashboard.dashboard');
});

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/resetpassword', [PageController::class, 'reset_pw'])->name('resetpw');
Route::get('/resetpassword1', [PageController::class, 'otp'])->name('inputOTP');
Route::get('/resetpassword2', [PageController::class, 'new_pw'])->name('newpassword');
Route::get('/tables', [PageController::class, 'table'])->name('tables');


Route::post('/proses-login', [AuthController::class, 'login'])->name('proses.login');

