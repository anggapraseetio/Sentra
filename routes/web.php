<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\InformasiAnakController;
use App\Http\Controllers\GantiSandiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Mail;


//HANYA YANG BELUM LOGIN YANG BISA AKSES
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/resetpassword', [PageController::class, 'reset_pw'])->name('resetpw');
    Route::get('/resetpassword1', [PageController::class, 'otp'])->name('inputOTP');
    Route::get('/resetpassword2', [PageController::class, 'new_pw'])->name('newpassword');

    Route::get('/', [LandingPageController::class, 'index'])->name('index');
    

    Route::get('/layanan/perempuan', function () {
        return view('frontend.layanan.perempuan');
    });
    Route::get('/layanan/anak', function () {
        return view('frontend.layanan.anak');
    });
    Route::get('/layanan/kesejahteraan', function () {
        return view('frontend.layanan.kesejahteraan');
    });
    Route::get('/layanan/edukasi', function () {
        return view('frontend.layanan.edukasi');
    });
});


//HANYA YANG LOGIN YANG BISA AKSES
Route::middleware(['auth'])->group(function () {

    Route::controller(InformasiController::class)->group(function () {
        Route::get('/informasi', 'index')->name('informasi.index');
        Route::post('/informasi', 'store')->name('informasi.store');
        Route::get('/informasi/{id}/edit', 'edit')->name('informasi.edit');
        Route::put('/informasi/{id}', 'update')->name('informasi.update');
        Route::delete('/informasi/{id}', 'destroy')->name('informasi.destroy');
    });


// Routes untuk reset password
Route::middleware('auth')->group(function () {
    Route::get('/reset-password', [App\Http\Controllers\GantiSandiController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password/confirm', [App\Http\Controllers\GantiSandiController::class, 'confirm'])->name('password.confirm');
    Route::post('/reset-password/reset', [App\Http\Controllers\GantiSandiController::class, 'reset'])->name('password.reset');
    Route::post('/password/close-modal', [App\Http\Controllers\GantiSandiController::class, 'closeModal'])->name('password.close-modal');
});

Route::middleware(['auth'])->group(function () {
    // Menampilkan halaman notifikasi
    Route::get('/admin/notifikasi', [App\Http\Controllers\NotifikasiController::class, 'index'])
        ->name('admin.notifikasi');
    
    // Menampilkan dropdown notifikasi (untuk navbar)
    Route::get('/admin/notifikasi/dropdown', [App\Http\Controllers\NotifikasiController::class, 'showNotifikasi'])
        ->name('admin.notifikasi.dropdown');
    
    // Menandai notifikasi sudah dibaca
    Route::post('/admin/notifikasi/{id}/read', [App\Http\Controllers\NotifikasiController::class, 'markAsRead'])
        ->name('admin.notifikasi.mark-read');
    
    // Menerima laporan dari notifikasi
    Route::post('/admin/notifikasi/{id_notif}/terima-laporan/{id_laporan}', [App\Http\Controllers\NotifikasiController::class, 'terimaLaporan'])
        ->name('admin.notifikasi.terima-laporan');
    
    // Mendapatkan jumlah notifikasi belum dibaca (untuk refresh otomatis)
    Route::get('/admin/notifikasi/count', [App\Http\Controllers\NotifikasiController::class, 'getCount'])
        ->name('admin.notifikasi.count');
});
    //Rekapan
    Route::get('/rekapan', [RekapanController::class, 'index'])->name('rekapan');
    Route::get('rekapan/data', [RekapanController::class, 'getData'])->name('rekapan.data');
    Route::get('/rekapan/export', [RekapanController::class, 'export'])->name('rekapan.export');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan_selesai', [LaporanController::class, 'laporan_selesai'])->name('selesai');
    Route::get('/laporan/{id}', [LaporanController::class, 'laporan_show'])->name('laporan.show');
    
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::get('/laporan', [LaporanController::class, 'proses'])->name('laporan_proses');
    Route::put('/laporan/proseskan/{id}', [LaporanController::class, 'proseskan'])->name('laporan.proseskan');
    Route::put('/laporan/{id}/selesai', [LaporanController::class, 'selesai'])->name('laporan.selesai');
    Route::get('/laporan/{id_laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id_laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/anak/{id}', [InformasiAnakController::class, 'destroy'])->name('anak.destroy');



    //Rekapan
    Route::get('/rekapan', [RekapanController::class, 'index'])->name('rekapan');
    Route::post('/rekapan/export', [RekapanController::class, 'exportSimple'])->name('rekapan.export');
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('index');
    })->name('logout');
});

Route::middleware('web')->group(function () {
    // Alur OTP
    Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
    Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
    Route::post('/otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');

    // Alur Reset Password (dipisah ke controller baru)
    Route::get('/new-password', [ResetPasswordController::class, 'showNewPasswordForm'])->name('password.new');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('otp.reset');
});
