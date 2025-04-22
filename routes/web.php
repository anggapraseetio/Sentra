<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;


//HANYA YANG BELUM LOGIN YANG BISA AKSES
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/resetpassword', [PageController::class, 'reset_pw'])->name('resetpw');
    Route::get('/resetpassword1', [PageController::class, 'otp'])->name('inputOTP');
    Route::get('/resetpassword2', [PageController::class, 'new_pw'])->name('newpassword');

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
});

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
//HANYA YANG LOGIN YANG BISA AKSES
Route::middleware(['auth'])->group(function () {
    Route::get('/tables', [PageController::class, 'table'])->name('tables');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});





