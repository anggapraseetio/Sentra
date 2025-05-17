<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{LaporanMobile, DetailPelapor, DetailTerlapor, DetailPenerimaManfaat, DetailKasus, InformasiAnak};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Log;

class LaporanControllerMobile extends Controller
{

    // TRACKING LAPORAN
    public function trackReport(Request $request)
    {
        $data = $request->validate([
            'id_laporan' => 'required|exists:laporan,id_laporan'
        ]);

        $laporan = LaporanMobile::with([
            'detailPelapor',
            'detailTerlapor',
            'detailPenerimaManfaat',
            'detailKasus',
            'informasiAnak'
        ])
            ->where('id_laporan', $data['id_laporan'])
            ->first();

        if (!$laporan) {
            return response()->json([
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Laporan ditemukan',
            'status' => $laporan->status,
            'laporan' => $laporan
        ]);
    }


    // POST LAPORAN
    public function postReport(Request $request)
    {
        $data = $request->validate([
            'id_akun' => 'required|exists:akun,id_akun',
            'kategori' => 'required|string',
            'lokasi' => 'required|string',
            'status' => 'required|in:dikirim,diterima,diproses,selesai',
            'detail_pelapor' => 'required|array',
            'detail_terlapor' => 'required|array',
            'detail_penerima_manfaat' => 'required|array',
            'detail_kasus' => 'required|array',
            'informasi_anak' => 'required|array'
        ]);

        // 1. Create laporan
        $laporan = LaporanMobile::create($data);

        // 2. Create detail pelapor
        $laporan->detailPelapor()->create($data['detail_pelapor']);

        // 3. Create detail terlapor
        $laporan->detailTerlapor()->create($data['detail_terlapor']);

        // 4. Create detail penerima manfaat dan ambil id_penerima
        $penerimaManfaat = $laporan->detailPenerimaManfaat()->create($data['detail_penerima_manfaat']);

        // 5. Create detail kasus
        $laporan->detailKasus()->create($data['detail_kasus']);

        foreach ($data['informasi_anak'] as $anak) {
            // Tambahkan id_penerima ke tiap anak
            $anak['id_penerima'] = $penerimaManfaat->id_penerima;

            // Optional: skip jika data anak kosong
            if (!empty($anak['nama'])) {
                $penerimaManfaat->informasiAnak()->create($anak);
            }
        }
        $notificationController = new NotificationControllerMobile();
        $notificationRequest = new Request([
            'id_laporan' => $laporan->id,
            'user_id' => $data['id_akun'],
            'status' => $data['status'],
        ]);
        $notificationController->reportUpdate($notificationRequest);

        return response()->json(['message' => 'Laporan berhasil dikirim', 'laporan' => $laporan]);

    }



    // MONITORING RATA-RATA PERSENTASE LAPORAN DALAM 1 TAHUN
    public function reportStatistics()
    {
        $year = Carbon::now()->year;

        // Ambil data mentah untuk debugging
        $rawData = LaporanMobile::whereYear('created_at', $year)
            ->selectRaw("DATE_FORMAT(created_at, '%b') as month, kategori, COUNT(*) as count")
            ->groupBy('month', 'kategori')
            ->get();

        Log::info('Raw data from query: ' . json_encode($rawData));

        $statistics = $rawData
            ->groupBy('month')
            ->map(function ($monthData) {
                $result = $monthData->mapWithKeys(function ($item) {
                    $category = $item->kategori;
                    $count = (int) $item->count;
                    Log::info("Processing month: {$item->month}, category: {$category}, count: {$count}");
                    return [$category => $count];
                })->toArray();
                Log::info("Processed month data: " . json_encode($result));
                return $result;
            })->toArray();

        Log::info('Final statistics: ' . json_encode($statistics));

        return response()->json([
            'message' => 'Jumlah laporan per kategori per bulan tahun ini',
            'data' => $statistics
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    // AMBIL SEMUA LAPORAN BERDASARKAN USER
    public function getUserReports($id_akun)
    {

        $laporan = LaporanMobile::where('id_akun', $id_akun)
            ->with(['detailPelapor', 'detailTerlapor', 'detailPenerimaManfaat', 'detailKasus', 'informasiAnak'])
            ->get();

        return response()->json(['message' => 'Laporan ditemukan', 'laporan' => $laporan]);
    }

    // AMBIL SEMUA LAPORAN BERDASARKAN USER DAN KATEGORI
    public function getUserReportsByCategory($id_akun, $status)
    {

        $laporan = LaporanMobile::where('id_akun', $id_akun)
            ->where('status', $status)
            ->with(['detailPelapor', 'detailTerlapor', 'detailPenerimaManfaat', 'detailKasus', 'informasiAnak'])
            ->get();

        return response()->json(['message' => 'Laporan ditemukan', 'laporan' => $laporan]);
    }
    public function quickAccess(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_akun' => 'required|integer',
            'nik' => 'required|string|max:100',
            'nama' => 'required|string|max:150',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $id_laporan = DB::table('laporan')->insertGetId([
                'id_akun' => $validated['id_akun'],
                'kategori' => 'unset',
                'status' => 'dikirim',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert ke tabel detail_pelapor
            DB::table('detail_pelapor')->insert([
                'id_laporan' => $id_laporan,
                'nik' => $validated['nik'],
                'nama' => $validated['nama'],
                'alamat' => $validated['alamat'],
                'hubungan_dengan_korban' => '-', // Default karena laporan cepat
                'no_telp' => $validated['no_telp'],
            ]);

            // Insert ke tabel detail_kasus
            DB::table('detail_kasus')->insert([
                'id_laporan' => $id_laporan,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'tempat_kejadian' => '-', // Default kosong
                'kronologi' => $validated['deskripsi']
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Laporan cepat berhasil dikirim.',
                'data' => [
                    'id_laporan' => $id_laporan,
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat laporan cepat.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function Search(Request $request)
    {
        $keyword = $request->query('keyword');
        $idAkun = $request->query('id_akun'); 

        $laporan = LaporanMobile::with([
            'detailPelapor',
            'detailTerlapor',
            'detailPenerimaManfaat',
            'detailKasus',
            'detailPenerimaManfaat.informasiAnak'
        ])
            ->search($keyword, $idAkun) 
            ->get();

        return response()->json($laporan);
    }

}