<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Mendapatkan semua notifikasi untuk admin dan tampilkan di view
    public function index()
    {
        $notifikasi = Notifikasi::where('id_akun', Auth::id())
                                ->where('tipe', 'admin')
                                ->where('status', 'terkirim')
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('backend.layout.page_admin.notifikasi', compact('notifikasi'));
    }
    
    // Menampilkan daftar notifikasi di dropdown navbar
    public function showNotifikasi()
    {
        $notifikasi = Notifikasi::where('id_akun', Auth::id())
                                ->where('tipe', 'admin')
                                ->where('status', 'terkirim')
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();
        
        $count = Notifikasi::where('id_akun', Auth::id())
                          ->where('tipe', 'admin')
                          ->where('status', 'terkirim')
                          ->count();
        
        return view('backend.components.notifikasi_dropdown', compact('notifikasi', 'count'));
    }
    
    // Mengubah status notifikasi menjadi dibaca
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::find($id);
        
        if ($notifikasi) {
            $notifikasi->status = 'dibaca';
            $notifikasi->save();
            
            return redirect()->back()->with('success', 'Notifikasi telah dibaca');
        }
        
        return redirect()->back()->with('error', 'Notifikasi tidak ditemukan');
    }
    
    // Menerima laporan dari notifikasi
    public function terimaLaporan($id_notif, $id_laporan)
    {
        // Update status notifikasi
        $notifikasi = Notifikasi::find($id_notif);
        if ($notifikasi) {
            $notifikasi->status = 'dibaca';
            $notifikasi->save();
        }
        
        // Update status laporan
        $laporan = Laporan::find($id_laporan);
        if ($laporan) {
            $laporan->status = 'diterima';
            $laporan->save();
            
            return redirect()->back()->with('success', 'Laporan berhasil diterima');
        }
        
        return redirect()->back()->with('error', 'Laporan tidak ditemukan');
    }
    
    // Fungsi untuk mengambil jumlah notifikasi yang belum dibaca (untuk ajax minimal)
    public function getCount()
    {
        $count = Notifikasi::where('id_akun', Auth::id())
                          ->where('tipe', 'admin')
                          ->where('status', 'terkirim')
                          ->count();
        
        return response()->json(['count' => $count]);
    }
}