<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function proses()
{
    $laporan = Laporan::where('status', 'diproses')->get();
    return view('backend.layout.page_admin.laporan.proses_laporan', compact('laporan'));
}

public function selesai($id)
{
    $laporan = Laporan::find($id);
    $laporan->status = 'selesai';
    $laporan->save();

    return redirect()->route('laporan_proses')->with('success', 'Laporan diselesaikan!');
}

public function edit($id_laporan)
{
    $laporan = Laporan::with(['detail_pelapor', 'detail_penerima_manfaat', 'detail_terlapor', 'detail_kasus'])
                      ->where('id_laporan', $id_laporan)
                      ->firstOrFail();

    return view('backend.layout.page_admin.laporan.edit_laporan', compact('laporan'));
}

public function update(Request $request, $id_laporan)
{
    $laporan = Laporan::findOrFail($id_laporan);

    // Update data laporan utama
    $laporan->kategori_laporan = $request->kategori_laporan;
    $laporan->tanggal = $request->tanggal;
    $laporan->save();

    // Update pelapor
    $laporan->detail_pelapor->update([
        'nik' => $request->pelapor['nik'],
        'nama' => $request->pelapor['nama'],
        'umur' => $request->pelapor['umur'],
        'alamat' => $request->pelapor['alamat'],
        'hubungan_dengan_korban' => $request->pelapor['hubungan'],
        'no_telp' => $request->pelapor['telepon'],
    ]);

    // Update penerima manfaat
    $laporan->detail_penerima_manfaat->update([
        'nik' => $request->penerima['nik'],
        'nama' => $request->penerima['nama'],
        'ttl' => $request->penerima['ttl'],
        'umur' => $request->penerima['umur'],
        'jk' => $request->penerima['jk'],
        'pekerjaan' => $request->penerima['pekerjaan'],
        'agama' => $request->penerima['agama'],
        'pendidikan' => $request->penerima['pendidikan'],
        'alamat' => $request->penerima['alamat'],
        'hubungan_terlapor' => $request->penerima['hubungan_terlapor'],
        'telepon' => $request->penerima['telepon'],
        'informasi_tambahan' => $request->penerima['informasi_tambahan'],
    ]);

    // Update terlapor
    $laporan->detail_terlapor->update([
        'nik' => $request->terlapor['nik'],
        'nama' => $request->terlapor['nama'],
        'umur' => $request->terlapor['umur'],
        'alamat' => $request->terlapor['alamat'],
        'jk' => $request->terlapor['jk'],
        'hubungan' => $request->terlapor['hubungan'],
        'informasi_tambahan' => $request->terlapor['informasi_tambahan'],
    ]);

    // Update detail kasus
    $laporan->detail_kasus->update([
        'tanggal' => $request->kasus['tanggal'],
        'tempat' => $request->kasus['tempat'],
        'kronologi' => $request->kasus['kronologi'],
        'bukti' => $request->kasus['bukti'],
    ]);

    return redirect()->route('laporan_proses')->with('success', 'Laporan berhasil diperbarui.');
}


}
