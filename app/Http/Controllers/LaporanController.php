<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function laporan_selesai()
    {
        $laporan = Laporan::with('detail_pelapor')->where('status', 'selesai')->get();
        return view('backend.layout.page_admin.laporan.selesai_laporan', compact('laporan'));
    } 

    public function laporan_show($id)
    {
        $laporan = Laporan::with([
            'detail_pelapor',
            'detail_penerima_manfaat',
            'detail_penerima_manfaat.informasi_anak',
            'detail_terlapor',
            'detail_kasus'
        ])->where('id_laporan', $id)->firstOrFail();
        
        return view('backend.layout.page_admin.laporan.preview_laporan', compact('laporan'));
    }  

    public function proses()
    {
        $laporan = Laporan::with('detail_pelapor')->whereIn('status', ['diproses', 'diterima'])->get();
        return view('backend.layout.page_admin.laporan.proses_laporan', compact('laporan'));
    }    

public function selesai($id)
{
    $laporan = Laporan::find($id);
    $laporan->status = 'selesai';
    $laporan->save();

    return redirect()->route('laporan_proses')->with('success', 'Laporan diselesaikan!');
}

public function proseskan($id)
{
    $laporan = Laporan::findOrFail($id);

    // Jika status masih 'diterima', ubah menjadi 'diproses'
    if ($laporan->status === 'diterima') {
        $laporan->status = 'diproses';
        $laporan->save();
    }

    // Arahkan ke halaman edit laporan
    return redirect()->route('laporan.edit', $id);
}


public function edit($id_laporan)
{
    $laporan = Laporan::with(['detail_pelapor', 'detail_penerima_manfaat.informasi_anak', 'detail_terlapor', 'detail_kasus'])
                      ->where('id_laporan', $id_laporan)
                      ->firstOrFail();

    return view('backend.layout.page_admin.laporan.edit_laporan', compact('laporan'));
}

public function update(Request $request, $id_laporan)
{
    // Validasi data yang diperlukan
    $request->validate([
        'kategori' => 'required',
        'pelapor.nama' => 'required',
        'pelapor.nik' => 'required',
        'pelapor.telepon' => 'required',
        'pelapor.alamat' => 'required',
        'kasus.kronologi' => 'required',
    ], [
        'kategori.required' => 'Kategori laporan harus diisi',
        'pelapor.nama.required' => 'Nama pelapor harus diisi',
        'pelapor.nik.required' => 'NIK pelapor harus diisi',
        'pelapor.telepon.required' => 'Nomor telepon pelapor harus diisi',
        'pelapor.alamat.required' => 'Alamat pelapor harus diisi',
        'kasus.kronologi.required' => 'Kronologi kejadian harus diisi',
    ]);

    // Ambil data laporan beserta semua relasinya
    $laporan = Laporan::with([
        'detail_pelapor',
        'detail_penerima_manfaat.informasi_anak',
        'detail_terlapor',
        'detail_kasus',
    ])->findOrFail($id_laporan);

    // Update data laporan utama
    $laporan->kategori = $request->kategori;
    $laporan->save();

    // Simpan atau update detail pelapor
    if ($laporan->detail_pelapor) {
        $laporan->detail_pelapor->update([
            'nik' => $request->pelapor['nik'],
            'nama' => $request->pelapor['nama'],
            'alamat' => $request->pelapor['alamat'],
            'hubungan_dengan_korban' => $request->pelapor['hubungan'],
            'no_telp' => $request->pelapor['telepon']
        ]);
    } else {
        $laporan->detail_pelapor()->create([
            'nik' => $request->pelapor['nik'],
            'nama' => $request->pelapor['nama'],
            'alamat' => $request->pelapor['alamat'],
            'hubungan_dengan_korban' => $request->pelapor['hubungan'],
            'no_telp' => $request->pelapor['telepon']
        ]);
    }

    // Simpan atau update detail penerima manfaat
    $penerima = null;
    if ($request->has('penerima') && $request->penerima['nama']) {
        if ($laporan->detail_penerima_manfaat) {
            $laporan->detail_penerima_manfaat->update([
                'nik' => $request->penerima['nik'],
                'nama' => $request->penerima['nama'],
                'tempat_lahir' => $request->penerima['ttl'],
                'tanggal_lahir' => $request->penerima['tanggal'],
                'umur' => $request->penerima['umur'],
                'jk' => $request->penerima['jk'],
                'pekerjaan' => $request->penerima['pekerjaan'],
                'agama' => $request->penerima['agama'],
                'pendidikan' => $request->penerima['pendidikan'],
                'alamat' => $request->penerima['alamat'],
                'hubungan_dengan_terlapor' => $request->penerima['hubungan_terlapor'],
                'notelp' => $request->penerima['telepon'],
                'informasi_tambahan' => $request->penerima['informasi_tambahan'],
            ]);
            $penerima = $laporan->detail_penerima_manfaat;
        } else {
            $penerima = $laporan->detail_penerima_manfaat()->create([
                'nik' => $request->penerima['nik'],
                'nama' => $request->penerima['nama'],
                'tempat_lahir' => $request->penerima['ttl'],
                'tanggal_lahir' => $request->penerima['tanggal'],
                'umur' => $request->penerima['umur'],
                'jk' => $request->penerima['jk'],
                'pekerjaan' => $request->penerima['pekerjaan'],
                'agama' => $request->penerima['agama'],
                'pendidikan' => $request->penerima['pendidikan'],
                'alamat' => $request->penerima['alamat'],
                'hubungan_dengan_terlapor' => $request->penerima['hubungan_terlapor'],
                'notelp' => $request->penerima['telepon'],
                'informasi_tambahan' => $request->penerima['informasi_tambahan'],
            ]);
        }
    }

    // Simpan atau update detail terlapor
    if ($request->has('terlapor') && $request->terlapor['nama']) {
        if ($laporan->detail_terlapor) {
            $laporan->detail_terlapor->update([
                'nik' => $request->terlapor['nik'],
                'nama' => $request->terlapor['nama'],
                'umur' => $request->terlapor['umur'],
                'alamat' => $request->terlapor['alamat'],
                'jk' => $request->terlapor['jk'],
                'hubungan_dengan_korban' => $request->terlapor['hubungan'],
                'informasi_tambahan' => $request->terlapor['informasi_tambahan'],
            ]);
        } else {
            $laporan->detail_terlapor()->create([
                'nik' => $request->terlapor['nik'],
                'nama' => $request->terlapor['nama'],
                'umur' => $request->terlapor['umur'],
                'alamat' => $request->terlapor['alamat'],
                'jk' => $request->terlapor['jk'],
                'hubungan_dengan_korban' => $request->terlapor['hubungan'],
                'informasi_tambahan' => $request->terlapor['informasi_tambahan'],
            ]);
        }
    }

    // Simpan atau update detail kasus
    if ($request->has('kasus') && $request->kasus['kronologi']) {
        if ($laporan->detail_kasus) {
            $laporan->detail_kasus->update([
                'tanggal' => $request->kasus['tanggal'],
                'tempat_kejadian' => $request->kasus['tempat'],
                'kronologi' => $request->kasus['kronologi'],
            ]);
        } else {
            $laporan->detail_kasus()->create([
                'tanggal' => $request->kasus['tanggal'],
                'tempat_kejadian' => $request->kasus['tempat'],
                'kronologi' => $request->kasus['kronologi'],
            ]);
        }
    }

    // Simpan atau update informasi anak hanya jika penerima manfaat ada
    if ($penerima && $request->has('anak')) {
        // Buat array untuk menyimpan ID anak yang dikirim dalam request
        $existingAnakIds = [];
        
        if (is_array($request->anak)) {
            foreach ($request->anak as $index => $dataAnak) {
                // Validasi data anak
                if (empty($dataAnak['nama']) || empty($dataAnak['tanggal']) || 
                    empty($dataAnak['umur']) || empty($dataAnak['jenis_kelamin']) || 
                    empty($dataAnak['pendidikan']) || empty($dataAnak['agama']) || 
                    empty($dataAnak['status'])) {
                    continue; // Lewati data yang tidak lengkap
                }
                
                // Jika ada ID, berarti anak sudah ada sebelumnya
                if (isset($dataAnak['id'])) {
                    $anak = $penerima->informasi_anak()->find($dataAnak['id']);
                    if ($anak) {
                        $anak->update([
                            'nama' => $dataAnak['nama'],
                            'tanggal_lahir' => $dataAnak['tanggal'],
                            'umur' => $dataAnak['umur'],
                            'jenis_kelamin' => $dataAnak['jenis_kelamin'],
                            'pendidikan' => $dataAnak['pendidikan'],
                            'agama' => $dataAnak['agama'],
                            'status' => $dataAnak['status'],
                        ]);
                        $existingAnakIds[] = $dataAnak['id']; // Gunakan ID dari request
                    }
                } else {
                    // Ini adalah anak baru
                    $anakBaru = $penerima->informasi_anak()->create([
                        'nama' => $dataAnak['nama'],
                        'tanggal_lahir' => $dataAnak['tanggal'],
                        'umur' => $dataAnak['umur'],
                        'jenis_kelamin' => $dataAnak['jenis_kelamin'],
                        'pendidikan' => $dataAnak['pendidikan'],
                        'agama' => $dataAnak['agama'],
                        'status' => $dataAnak['status'],
                    ]);
                    $existingAnakIds[] = $anakBaru->id_anak; // Pastikan menggunakan nama primary key yang benar
                }
            }
            
            // Hapus anak yang tidak ada dalam request (yang sudah dihapus oleh user)
            // Hanya jika ada data anak yang dikirim dan pastikan gunakan nama primary key yang benar
            if (count($existingAnakIds) > 0) {
                $penerima->informasi_anak()->whereNotIn('id_anak', $existingAnakIds)->delete();
            }
        } else {
            // Jika tidak ada data anak dalam request, hapus semua anak
            $penerima->informasi_anak()->delete();
        }
    }

    return redirect()->route('laporan_proses')->with('success', 'Laporan berhasil diperbarui.');
}


public function destroy($id)
{
    $laporan = Laporan::with([
        'detail_pelapor',
        'detail_penerima_manfaat.informasi_anak',
        'detail_terlapor',
        'detail_kasus'
    ])->findOrFail($id);

    // Hapus informasi anak (jika ada)
    if ($laporan->detail_penerima_manfaat) {
        $laporan->detail_penerima_manfaat->informasi_anak()->delete();
    }

    // Hapus detail penerima manfaat
    if ($laporan->detail_penerima_manfaat) {
        $laporan->detail_penerima_manfaat->delete();
    }

    // Hapus detail pelapor
    if ($laporan->detail_pelapor) {
        $laporan->detail_pelapor->delete();
    }

    // Hapus detail terlapor
    if ($laporan->detail_terlapor) {
        $laporan->detail_terlapor->delete();
    }

    // Hapus detail kasus
    if ($laporan->detail_kasus) {
        $laporan->detail_kasus->delete();
    }

    // Hapus laporan utama
    $laporan->delete();

    return redirect()->route('selesai')->with('success', 'Data laporan dan semua relasi berhasil dihapus.');
}



}
