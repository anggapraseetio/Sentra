<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class GantiSandiController extends Controller
{
    public function showResetForm(Request $request)
    {
        $step = $request->query('step', 'confirm');
        return redirect()->back()->with('password_modal', $step);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
        ], [
            'current_password.required' => 'Harap masukkan password Anda saat ini'
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)) {
            // Simpan sesi untuk menandai bahwa password sudah dikonfirmasi
            session(['password_confirmed' => true]);
            
            // Jika menggunakan ajax
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password valid',
                    'redirect' => $request->has('redirect_to') ? $request->redirect_to : route('dashboard')
                ]);
            }
            
            // Redirect ke form reset dengan fragment untuk membuka modal
            if ($request->has('redirect_to')) {
                return redirect($request->redirect_to)->with('password_modal', 'reset');
            }
            
            return redirect()->route('dashboard')->with('password_modal', 'reset');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukkan tidak valid',
                'errors' => ['current_password' => 'Password yang Anda masukkan tidak valid']
            ], 422);
        }
        
        return redirect()->back()
            ->with('password_modal', 'confirm')
            ->withErrors(['current_password' => 'Password yang Anda masukkan tidak valid'])
            ->withInput();
    }

public function reset(Request $request)
{
    // Cek apakah password sudah dikonfirmasi
    if (!session('password_confirmed')) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus konfirmasi password terlebih dahulu',
                'redirect' => route('password.show', ['step' => 'confirm'])
            ], 403);
        }
        
        return redirect()->route('dashboard')->with('password_modal', 'confirm');
    }

    $messages = [
        'password.required' => 'Password baru wajib diisi',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'password.min' => 'Password minimal harus 8 karakter',
        'password.letters' => 'Password harus mengandung huruf',
        'password.mixed' => 'Password harus mengandung huruf besar dan kecil',
        'password.numbers' => 'Password harus mengandung angka',
    ];

    try {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()],
        ], $messages);
        
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus semua sesi terkait
        session()->forget(['password_confirmed', 'password_modal']);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah'
            ]);
        }
        
        return redirect()->route('dashboard')
            ->with('success', 'Password berhasil diubah');
    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
        
        return redirect()->back()
            ->with('password_modal', 'reset')
            ->withErrors($e->errors())
            ->withInput();
    }
}

public function closeModal(Request $request)
{
    // Hapus semua sesi terkait modal
    session()->forget(['password_modal', 'password_confirmed']);
    
    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }
    
    return redirect()->back();
}
}