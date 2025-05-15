<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    /**
     * Menampilkan halaman informasi dengan daftar informasi
     */
    public function index()
    {
        $informasiList = Informasi::all();
        return view('backend.layout.page_admin.informasi', compact('informasiList'));
    }

    /**
     * Menyimpan informasi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:100',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ];

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = Str::slug($request->judul) . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/informasi'), $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        // Simpan informasi
        Informasi::create($data);

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit informasi
     */
    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasiList = Informasi::all();
        return view('backend.layout.page_admin.informasi', compact('informasi', 'informasiList'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'judul' => 'required|max:100',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Cari informasi yang akan diupdate
        $informasi = Informasi::findOrFail($id);

        // Inisialisasi data update
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ];

        // Proses upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($informasi->gambar && File::exists(public_path('uploads/informasi/' . $informasi->gambar))) {
                File::delete(public_path('uploads/informasi/' . $informasi->gambar));
            }

            // Upload gambar baru
            $gambar = $request->file('gambar');
            $namaGambar = Str::slug($request->judul) . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/informasi'), $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        // Update informasi
        $informasi->update($data);

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil diperbarui');
    }

    /**
     * Menghapus informasi
     */
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($informasi->gambar && File::exists(public_path('uploads/informasi/' . $informasi->gambar))) {
            File::delete(public_path('uploads/informasi/' . $informasi->gambar));
        }

        // Hapus data informasi
        $informasi->delete();

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil dihapus');
    }
}