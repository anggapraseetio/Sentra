<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    // Tampilkan form untuk mengisi password baru
    public function showNewPasswordForm()
    {
        $email = session('verified_email');

        if (!$email) {
            return redirect()->route('otp.form')->withErrors([
                'otp' => 'Silakan verifikasi OTP terlebih dahulu.'
            ]);
        }

        return view('backend.login.new_password', ['email' => $email]);
    }

    // Simpan password baru ke database
    public function reset(Request $request)
    {
        $request->validate([
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',    
            'regex:/[A-Z]/', 
            'regex:/[0-9]/',      
            'confirmed',
        ],
    ], [
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ]);

        $email = session('verified_email');

        if (!$email) {
            return redirect()->route('otp.form')->withErrors([
                'otp' => 'Sesi OTP tidak ditemukan, silakan ulangi proses.'
            ]);
        }

        // Update password di tabel akun
        DB::table('akun')->where('email', $email)->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expiry' => null,
        ]);

        // Hapus session setelah berhasil reset
        session()->forget(['verified_email', 'email']);

        return redirect()->route('login')->with('message', 'Password berhasil direset. Silakan login.');
    }
}
