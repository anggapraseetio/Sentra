<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{  
    public function laporan_selesai()
    {
        $laporan = Laporan::with('detail_pelapor')->whereIn('status', ['selesai', 'dirujuk'])->get();
        return view('backend.layout.page_admin.laporan.selesai_laporan', compact('laporan'));
    } 

// Method untuk menampilkan preview laporan dalam modal
public function laporan_preview($id)
{
    $laporan = Laporan::with([
        'detail_pelapor',
        'detail_penerima_manfaat',
        'detail_penerima_manfaat.informasi_anak',
        'detail_terlapor',
        'detail_kasus'
    ])->where('id_laporan', $id)->firstOrFail();
    
    // Return hanya content untuk modal (tanpa layout)
    return view('backend.layout.page_admin.laporan.preview_content', compact('laporan'));
}

// Method lama tetap ada untuk keperluan lain jika diperlukan
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
        try {
            $laporan = Laporan::where('id_laporan', $id)->firstOrFail();
            
            // Pastikan laporan sudah diproses dulu
            if ($laporan->status !== 'diproses') {
                if (request()->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Laporan harus diproses terlebih dahulu sebelum diselesaikan.'
                    ], 422);
                }
                
                return redirect()->route('laporan_proses')->with('error', 'Laporan harus diproses terlebih dahulu.');
            }
            
            // Update status menjadi selesai
            $laporan->status = 'selesai';
            $laporan->save();
            
            // Cek apakah request AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil diselesaikan.'
                ]);
            }
            
            return redirect()->route('laporan_proses')->with('success', 'Laporan diselesaikan!');
            
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyelesaikan laporan: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('laporan_proses')->with('error', 'Gagal menyelesaikan laporan.');
        }
    }


public function rujuk($id)
    {
        try {
            $laporan = Laporan::where('id_laporan', $id)->firstOrFail();
            
            // Pastikan laporan sudah diproses dulu
            if ($laporan->status !== 'diproses') {
                if (request()->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Laporan harus diproses terlebih dahulu sebelum dirujuk.'
                    ], 422);
                }
                
                return redirect()->route('laporan_proses')->with('error', 'Laporan harus diproses terlebih dahulu.');
            }
            
            // Update status menjadi dirujuk
            $laporan->status = 'dirujuk';
            $laporan->save();
            
            // Cek apakah request AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil dirujuk.'
                ]);
            }
            
            return redirect()->route('laporan_proses')->with('success', 'Laporan dirujuk!');
            
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal merujuk laporan: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('laporan_proses')->with('error', 'Gagal merujuk laporan.');
        }
    }
public function proseskan($id)
    {
        try {
            $laporan = Laporan::where('id_laporan', $id)->firstOrFail();
            
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Proses Laporan...',
                    'redirect_url' => route('laporan.edit', $id)
                ]);
            }

            return redirect()->route('laporan.edit', $id);
            
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Laporan tidak ditemukan: ' . $e->getMessage()
                ], 404);
            }
            
            return redirect()->route('laporan_proses')->with('error', 'Laporan tidak ditemukan.');
        }
    }

    
    public function edit($id)
    {
        try {
            $laporan = Laporan::with([
                'detail_pelapor', 
                'detail_penerima_manfaat.informasi_anak', 
                'detail_terlapor', 
                'detail_kasus'
            ])->where('id_laporan', $id)->firstOrFail();

            return view('backend.layout.page_admin.laporan.edit_laporan', compact('laporan'));
            
        } catch (\Exception $e) {
            return redirect()->route('laporan_proses')->with('error', 'Laporan tidak ditemukan.');
        }
    }

public function update(Request $request, $id_laporan)
{
    try {
        $validatedData = $request->validate([
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

        $laporan = Laporan::with([
            'detail_pelapor',
            'detail_penerima_manfaat.informasi_anak',
            'detail_terlapor',
            'detail_kasus',
        ])->findOrFail($id_laporan);

        $laporan->kategori = $request->kategori;
        if ($laporan->status === 'diterima') {
            $laporan->status = 'diproses';
        }
        $laporan->save();

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

        $penerima = null;
        if ($request->has('penerima') && $request->penerima['nama']) {
            if ($laporan->detail_penerima_manfaat) {
                $laporan->detail_penerima_manfaat->update([
                    'nik' => $request->penerima['nik'],
                    'nama' => $request->penerima['nama'],
                    'tempat_lahir' => $request->penerima['ttl'],
                    'tanggal_lahir' => $request->penerima['tanggal'],
                    'umur' => $request->penerima['umur'],
                    'jenis_kelamin' => $request->penerima['jk'],
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
                    'jenis_kelamin' => $request->penerima['jk'],
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

        if ($request->has('terlapor') && $request->terlapor['nama']) {
            if ($laporan->detail_terlapor) {
                $laporan->detail_terlapor->update([
                    'nik' => $request->terlapor['nik'],
                    'nama' => $request->terlapor['nama'],
                    'umur' => $request->terlapor['umur'],
                    'alamat' => $request->terlapor['alamat'],
                    'jenis_kelamin' => $request->terlapor['jk'],
                    'hubungan_dengan_korban' => $request->terlapor['hubungan'],
                    'informasi_tambahan' => $request->terlapor['informasi_tambahan'],
                ]);
            } else {
                $laporan->detail_terlapor()->create([
                    'nik' => $request->terlapor['nik'],
                    'nama' => $request->terlapor['nama'],
                    'umur' => $request->terlapor['umur'],
                    'alamat' => $request->terlapor['alamat'],
                    'jenis_kelamin' => $request->terlapor['jk'],
                    'hubungan_dengan_korban' => $request->terlapor['hubungan'],
                    'informasi_tambahan' => $request->terlapor['informasi_tambahan'],
                ]);
            }
        }

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

        if ($penerima && $request->has('anak')) {
            $existingAnakIds = [];
            if (is_array($request->anak)) {
                foreach ($request->anak as $dataAnak) {
                    if (empty($dataAnak['nama']) || empty($dataAnak['tanggal']) || 
                        empty($dataAnak['umur']) || empty($dataAnak['jenis_kelamin']) || 
                        empty($dataAnak['pendidikan']) || empty($dataAnak['agama']) || 
                        empty($dataAnak['status'])) {
                        continue;
                    }
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
                            $existingAnakIds[] = $dataAnak['id'];
                        }
                    } else {
                        $anakBaru = $penerima->informasi_anak()->create([
                            'nama' => $dataAnak['nama'],
                            'tanggal_lahir' => $dataAnak['tanggal'],
                            'umur' => $dataAnak['umur'],
                            'jenis_kelamin' => $dataAnak['jenis_kelamin'],
                            'pendidikan' => $dataAnak['pendidikan'],
                            'agama' => $dataAnak['agama'],
                            'status' => $dataAnak['status'],
                        ]);
                        $existingAnakIds[] = $anakBaru->id_anak;
                    }
                }
                if (count($existingAnakIds) > 0) {
                    $penerima->informasi_anak()->whereNotIn('id_anak', $existingAnakIds)->delete();
                }
            } else {
                $penerima->informasi_anak()->delete();
            }
        }

        return redirect()->route('laporan_proses')
            ->with('success', 'Laporan berhasil diproses.');

    } catch (\Exception $e) {
        return redirect()->route('laporan_proses')
            ->with('error', 'Gagal mengupdate laporan.');
    }
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

    return redirect()->route('selesai')->with('success', 'Data laporan berhasil dihapus.');
}



}
