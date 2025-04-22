<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(){
        return view('backend.login.login');
    }

    function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akses hanya untuk admin.',
                ]);
            }
        
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        

        return back()->withErrors([
            'login' => 'Email atau password Anda salah.',
        ]);
    }

}
