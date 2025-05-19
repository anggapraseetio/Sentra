<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
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
        $dataLaporan = Laporan::with([
            'detail_pelapor',
            'detail_terlapor',
            'detail_penerima_manfaat.informasi_anak',
            'detail_kasus'
        ])
        ->where('status', 'selesai')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('backend.layout.page_admin.rekapan', compact('dataLaporan'));
    }

    public function handleExport(Request $request)
    {
        $request->validate([
            'export_type' => 'required|in:simple,multi'
        ]);

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
            'ID Laporan', 'Kategori', 'Tanggal Laporan', 'Status',
            'Nama Anak', 'Umur Anak', 'Jenis Kelamin Anak', 'Pendidikan Anak',
            'Nama Pelapor', 'NIK Pelapor', 'Alamat Pelapor', 'Hubungan dengan Korban',
            'Nama Terlapor', 'NIK Terlapor', 'Alamat Terlapor', 'Umur Terlapor', 'Jenis Kelamin Terlapor', 'Hubungan dengan Korban',
            'Nama Penerima', 'NIK Penerima', 'Alamat Penerima', 'Umur Penerima', 'Jenis Kelamin Penerima', 'Pendidikan Penerima', 'Hubungan dengan Terlapor',
            'Tanggal Kejadian', 'Tempat Kejadian', 'Kronologi'
        ];

        $sheet->fromArray($headers, null, 'A1');
        $row = 2;

        foreach ($dataLaporan as $p) {
            $anakList = $p->detail_penerima_manfaat->informasi_anak ?? collect();

            $sheet->fromArray([
                $p->id_laporan,
                $p->kategori,
                optional($p->created_at)->format('Y-m-d'),
                $p->status,

                $anakList->pluck('nama')->filter()->implode("\n") ?: '-',
                $anakList->pluck('umur')->filter()->implode("\n") ?: '-',
                $anakList->pluck('jenis_kelamin')->filter()->implode("\n") ?: '-',
                $anakList->pluck('pendidikan')->filter()->implode("\n") ?: '-',

                $p->detail_pelapor->nama ?? '-',
                "'" . ($p->detail_pelapor->nik ?? '-'),
                $p->detail_pelapor->alamat ?? '-',
                $p->detail_pelapor->hubungan_dengan_korban ?? '-',

                $p->detail_terlapor->nama ?? '-',
                "'" . ($p->detail_terlapor->nik ?? '-'),
                $p->detail_terlapor->alamat ?? '-',
                $p->detail_terlapor->umur ?? '-',
                $p->detail_terlapor->jenis_kelamin ?? '-',
                $p->detail_terlapor->hubungan_dengan_korban ?? '-',

                $p->detail_penerima_manfaat->nama ?? '-',
                "'" . ($p->detail_penerima_manfaat->nik ?? '-'),
                $p->detail_penerima_manfaat->alamat ?? '-',
                $p->detail_penerima_manfaat->umur ?? '-',
                $p->detail_penerima_manfaat->jenis_kelamin ?? '-',
                $p->detail_penerima_manfaat->pendidikan ?? '-',
                $p->detail_penerima_manfaat->hubungan_dengan_terlapor ?? '-',

                $p->detail_kasus->tanggal ?? '-',
                $p->detail_kasus->tempat_kejadian ?? '-',
                $p->detail_kasus->kronologi ?? '-',
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
                    $d->id_laporan, $d->kategori, optional($d->created_at)->format('Y-m-d'), $d->status
                ])->toArray()
            ],
            [
                'title' => 'Detail Pelapor',
                'headers' => ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Hubungan'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->detail_pelapor->nama ?? '-', "'" . ($d->detail_pelapor->nik ?? '-'),
                    $d->detail_pelapor->alamat ?? '-', $d->detail_pelapor->hubungan_dengan_korban ?? '-'
                ])->toArray()
            ],
            [
                'title' => 'Informasi Anak',
                'headers' => ['ID Laporan', 'Nama Anak', 'Umur Anak', 'JK Anak', 'Pendidikan Anak'],
                'rows' => $dataLaporan->map(function ($d) {
                    $anak = $d->detail_penerima_manfaat->informasi_anak ?? collect();

                    return [
                        $d->id_laporan,
                        $anak->pluck('nama')->filter()->implode("\n") ?: '-',
                        $anak->pluck('umur')->filter()->implode("\n") ?: '-',
                        $anak->pluck('jenis_kelamin')->filter()->implode("\n") ?: '-',
                        $anak->pluck('pendidikan')->filter()->implode("\n") ?: '-'
                    ];
                })->toArray()
            ],
            [
                'title' => 'Detail Terlapor',
                'headers' => ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Umur', 'JK', 'Hubungan'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->detail_terlapor->nama ?? '-', "'" . ($d->detail_terlapor->nik ?? '-'),
                    $d->detail_terlapor->alamat ?? '-', $d->detail_terlapor->umur ?? '-',
                    $d->detail_terlapor->jenis_kelamin ?? '-', $d->detail_terlapor->hubungan_dengan_korban ?? '-'
                ])->toArray()
            ],
            [
                'title' => 'Penerima Manfaat',
                'headers' => ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Umur', 'JK', 'Pendidikan', 'Hubungan'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->detail_penerima_manfaat->nama ?? '-', "'" . ($d->detail_penerima_manfaat->nik ?? '-'),
                    $d->detail_penerima_manfaat->alamat ?? '-', $d->detail_penerima_manfaat->umur ?? '-',
                    $d->detail_penerima_manfaat->jenis_kelamin ?? '-', $d->detail_penerima_manfaat->pendidikan ?? '-',
                    $d->detail_penerima_manfaat->hubungan_dengan_terlapor ?? '-'
                ])->toArray()
            ],
            [
                'title' => 'Detail Kasus',
                'headers' => ['ID Laporan', 'Tanggal Kejadian', 'Tempat', 'Kronologi'],
                'rows' => $dataLaporan->map(fn($d) => [
                    $d->id_laporan, $d->detail_kasus->tanggal ?? '-', $d->detail_kasus->tempat_kejadian ?? '-',
                    $d->detail_kasus->kronologi ?? '-'
                ])->toArray()
            ]
        ];

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
        return Laporan::with([
            'detail_pelapor',
            'detail_terlapor',
            'detail_kasus',
            'detail_penerima_manfaat.informasi_anak'
        ])
        ->where('status', 'selesai')
        ->when($request->filled('search'), fn($q) =>
            $q->whereHas('detail_pelapor', fn($sub) =>
                $sub->where('nama', 'like', "%{$request->search}%")
                    ->orWhere('nik', 'like', "%{$request->search}%")
            )
        )
        ->when($request->filled('start_date'), fn($q) =>
            $q->whereDate('created_at', '>=', $request->start_date)
        )
        ->when($request->filled('end_date'), fn($q) =>
            $q->whereDate('created_at', '<=', $request->end_date)
        )
        ->when($request->filled('kategori'), fn($q) =>
            $q->where('kategori', $request->kategori)
        )
        ->when($request->filled('status') && $request->status !== 'selesai', fn($q) =>
            $q->where('status', $request->status)
        );
    }

    private function applyStyle($sheet, $columnCount, $lastRow)
    {
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9E1F2']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ],
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
