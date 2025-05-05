<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\RekapanController;


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


//HANYA YANG LOGIN YANG BISA AKSES
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan_selesai', [LaporanController::class, 'laporan_selesai'])->name('selesai');
    Route::get('/laporan/{id}', [LaporanController::class, 'laporan_show'])->name('laporan.show');;
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::get('/laporan', [LaporanController::class, 'proses'])->name('laporan_proses');
    Route::put('/laporan/{id}/selesai', [LaporanController::class, 'selesai'])->name('laporan.selesai');
    Route::get('/laporan/{id_laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id_laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/anak/{id}', [InformasiAnakController::class, 'destroy'])->name('anak.destroy');


    Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/rekapan', [RekapanController::class, 'index'])->name('rekapan');


    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});





