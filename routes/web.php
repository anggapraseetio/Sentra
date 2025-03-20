<?php

use Illuminate\Support\Facades\Route;

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