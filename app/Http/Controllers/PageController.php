<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login(){
        return view('backend.login.login');
    }

    public function reset_pw(){
        return view('backend.login.reset_pasword');
    }

    public function otp(){
        return view('backend.login.otp');
    }

    public function new_pw(){
        return view('backend.login.new_password');
    }
    
    public function dashboard(){
        return view('backend.layout.page_admin.dashboard');
    }

    public function laporan_proses(){
        return view('backend.layout.page_admin.laporan.proses_laporan');
    }
}
