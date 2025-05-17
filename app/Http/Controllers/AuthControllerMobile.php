<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthControllerMobile extends Controller
{
    //LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'notelp' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('notelp', $credentials['notelp'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'No Telp atau password salah'], 401);
        }

        return response()->json(['message' => 'Login berhasil', 'user' => $user]);
    }

    //REGISTER
    public function register(Request $request)
    {
        $data = $request->validate([
            'notelp' => 'required|unique:akun,notelp',
            'nama' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin,guest'
            
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json(['message' => 'Registrasi berhasil', 'user' => $user]);
    }

    //LUPA PASSWORD
    public function forgotPassword(Request $request)
    {
        $request->validate(['notelp' => 'required']);

        $user = User::where('notelp', $request->notelp)->first();
        if (!$user) {
            return response()->json(['message' => 'No Telp tidak ditemukan'], 404);
        }

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp, 'otp_expiry' => now()->addMinutes(15)]);

        return response()->json(['message' => 'OTP telah dikirim']);
    }

    //RESET PASSWORD
    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'notelp' => 'required',
            'otp' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::where('notelp', $data['notelp'])
            ->where('otp', $data['otp'])
            ->where('otp_expiry', '>', now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'OTP tidak valid atau kadaluarsa'], 400);
        }

        $user->update(['password' => Hash::make($data['password']), 'otp' => null, 'otp_expiry' => null]);

        return response()->json(['message' => 'Password berhasil direset']);
    }

    //PENGECEKAN DARURAT
    public function emergencyCheck(Request $request)
    {
        $data = $request->validate([
            'notelp' => 'required',
            'answer' => 'required'
        ]);

        $user = User::where('notelp', $data['notelp'])
            ->where('answquest', $data['answer'])
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Jawaban tidak sesuai'], 400);
        }

        return response()->json(['message' => 'Verifikasi berhasil']);
    }
}