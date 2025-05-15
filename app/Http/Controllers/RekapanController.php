<?php

namespace App\Http\Controllers;

use App\Models\Rekapan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class RekapanController extends Controller
{
    public function index(Request $request)
    {
        $dataLaporan = $this->filteredQuery($request)->get();
        return view('backend.layout.page_admin.rekapan', compact('dataLaporan'));
    }

    public function handleExport(Request $request)
    {
        $request->validate(['export_type' => 'required|in:simple,multi']);

        return $request->export_type === 'multi'
            ? $this->exportMultiSheet($request)
            : $this->exportSimple($request);
    }

    public function exportSimple(Request $request)
    {
        $dataLaporan = $this->filteredQuery($request)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'ID Laporan', 'Kategori', 'Tanggal Dibuat', 'Status',
            'Nama Anak', 'Umur Anak', 'JK Anak', 'Pendidikan Anak',
            'Nama Pelapor', 'NIK Pelapor', 'Alamat Pelapor', 'Hubungan dgn Korban',
            'Nama Terlapor', 'NIK Terlapor', 'Alamat Terlapor', 'Umur Terlapor', 'JK Terlapor', 'Hubungan dgn Korban',
            'Nama Penerima', 'NIK Penerima', 'Alamat Penerima', 'Umur Penerima', 'JK Penerima', 'Pendidikan Penerima', 'Hubungan dgn Terlapor',
            'Tanggal Kejadian', 'Tempat Kejadian', 'Kronologi', 'Bukti'
        ];

        $sheet->fromArray($headers, null, 'A1');
        $row = 2;

        foreach ($dataLaporan as $p) {
            $sheet->fromArray([
                $p->id_laporan,
                $p->kategori,
                optional($p->created_at)->format('Y-m-d'),
                $p->status,

                $p->penerimaManfaat->informasiAnak->nama ?? '-',
                $p->penerimaManfaat->informasiAnak->umur ?? '-',
                $p->penerimaManfaat->informasiAnak->jenis_kelamin ?? '-',
                $p->penerimaManfaat->informasiAnak->pendidikan ?? '-',

                $p->pelapor->nama ?? '-',
                $p->pelapor->nik ?? '-',
                $p->pelapor->alamat ?? '-',
                $p->pelapor->hubungan_dengan_korban ?? '-',

                $p->terlapor->nama ?? '-',
                $p->terlapor->nik ?? '-',
                $p->terlapor->alamat ?? '-',
                $p->terlapor->umur ?? '-',
                $p->terlapor->jenis_kelamin ?? '-',
                $p->terlapor->hubungan_dengan_korban ?? '-',

                $p->penerimaManfaat->nama ?? '-',
                $p->penerimaManfaat->nik ?? '-',
                $p->penerimaManfaat->alamat ?? '-',
                $p->penerimaManfaat->umur ?? '-',
                $p->penerimaManfaat->jenis_kelamin ?? '-',
                $p->penerimaManfaat->pendidikan ?? '-',
                $p->penerimaManfaat->hubungan_dengan_terlapor ?? '-',

                $p->detailKasus->tanggal ?? '-',
                $p->detailKasus->tempat_kejadian ?? '-',
                $p->detailKasus->kronologi ?? '-',
                $p->detailKasus->bukti ?? '-',
            ], null, 'A' . $row++);
        }

        $this->applyStyle($sheet, count($headers), $row - 1);

        return $this->downloadExcel($spreadsheet, 'rekapan_laporan');
    }

    public function exportMultiSheet(Request $request)
    {
        $dataLaporan = $this->filteredQuery($request)->get();
        $spreadsheet = new Spreadsheet();

        $sheets = [
            [
                'title' => 'Rekapan Umum',
                'headers' => ['ID Laporan', 'Kategori', 'Tanggal Dibuat', 'Status'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->kategori, optional($d->created_at)->format('Y-m-d'), $d->status,
                ])->toArray()
            ],
            [
                'title' => 'Detail Pelapor',
                'headers' => ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Hubungan'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->pelapor->nama ?? '-', $d->pelapor->nik ?? '-',
                    $d->pelapor->alamat ?? '-', $d->pelapor->hubungan_dengan_korban ?? '-'
                ])->toArray()
            ],
            [
                'title' => 'Informasi Anak',
                'headers' => ['ID Laporan', 'Nama', 'Umur', 'JK', 'Pendidikan'],
                'rows' => $dataLaporan->map(function ($d) {
                    $anak = $d->penerimaManfaat->informasiAnak ?? null;
                    return [
                        $d->id_laporan,
                        $anak->nama ?? '-', $anak->umur ?? '-', $anak->jenis_kelamin ?? '-', $anak->pendidikan ?? '-'
                    ];
                })->toArray()
            ],
            [
                'title' => 'Detail Terlapor',
                'headers' => ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Umur', 'JK', 'Hubungan'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->terlapor->nama ?? '-', $d->terlapor->nik ?? '-',
                    $d->terlapor->alamat ?? '-', $d->terlapor->umur ?? '-',
                    $d->terlapor->jenis_kelamin ?? '-', $d->terlapor->hubungan_dengan_korban ?? '-'
                ])->toArray()
            ],
            [
                'title' => 'Penerima Manfaat',
                'headers' => ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Umur', 'JK', 'Pendidikan', 'Hubungan'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->penerimaManfaat->nama ?? '-', $d->penerimaManfaat->nik ?? '-',
                    $d->penerimaManfaat->alamat ?? '-', $d->penerimaManfaat->umur ?? '-',
                    $d->penerimaManfaat->jenis_kelamin ?? '-', $d->penerimaManfaat->pendidikan ?? '-',
                    $d->penerimaManfaat->hubungan_dengan_terlapor ?? '-'
                ])->toArray()
            ],
            [
                'title' => 'Detail Kasus',
                'headers' => ['ID Laporan', 'Tanggal Kejadian', 'Tempat', 'Kronologi', 'Bukti'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->detailKasus->tanggal ?? '-', $d->detailKasus->tempat_kejadian ?? '-',
                    $d->detailKasus->kronologi ?? '-', $d->detailKasus->bukti ?? '-'
                ])->toArray()
            ],
        ];

        // Buat dan tambahkan sheet
        foreach ($sheets as $index => $s) {
            $sheet = new Worksheet($spreadsheet, $s['title']);
            $spreadsheet->addSheet($sheet, $index);
            $sheet->fromArray($s['headers'], null, 'A1');
            $sheet->fromArray($s['rows'], null, 'A2');
            $this->applyStyle($sheet, count($s['headers']), count($s['rows']) + 1);
        }

        $spreadsheet->removeSheetByIndex(0); // Hapus sheet default

        return $this->downloadExcel($spreadsheet, 'rekapan_multi');
    }

    private function filteredQuery(Request $request)
    {
        return Rekapan::with(['pelapor', 'terlapor', 'detailKasus', 'penerimaManfaat.informasiAnak'])
            ->when($request->filled('search'), fn($q) =>
                $q->whereHas('pelapor', fn($sub) =>
                    $sub->where('nama', 'like', "%{$request->search}%")
                        ->orWhere('nik', 'like', "%{$request->search}%")))
            ->when($request->filled('start_date'), fn($q) =>
                $q->whereDate('created_at', '>=', $request->start_date))
            ->when($request->filled('end_date'), fn($q) =>
                $q->whereDate('created_at', '<=', $request->end_date))
            ->when($request->filled('kategori'), fn($q) =>
                $q->where('kategori', $request->kategori))
            ->when($request->filled('status'), fn($q) =>
                $q->where('status', $request->status));
    }

    private function applyStyle($sheet, $columnCount, $lastRow)
    {
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['wrapText' => true]
        ];

        $colEnd = Coordinate::stringFromColumnIndex($columnCount);
        $range = "A1:{$colEnd}{$lastRow}";

        $sheet->getStyle("A1:{$colEnd}1")->applyFromArray($headerStyle);
        $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($range)->getAlignment()->setWrapText(true);

        foreach (range(1, $columnCount) as $colIndex) {
            $col = Coordinate::stringFromColumnIndex($colIndex);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    private function downloadExcel(Spreadsheet $spreadsheet, string $baseFilename)
    {
        $writer = new Xlsx($spreadsheet);
        $filename = "{$baseFilename}_" . now()->format('Ymd_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
    
}
