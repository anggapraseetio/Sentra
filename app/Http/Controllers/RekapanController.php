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
            'ID Laporan', 'Kategori', 'Tanggal Dibuat',
            'Nama Anak', 'Umur Anak', 'JK Anak', 'Pendidikan Anak',
            'Nama Pelapor', 'NIK Pelapor', 'Alamat Pelapor', 'Hubungan dgn Korban',
            'Nama Terlapor', 'NIK Terlapor', 'Alamat Terlapor', 'Umur Terlapor', 'JK Terlapor', 'Hubungan dgn Korban',
            'Nama Penerima', 'NIK Penerima', 'Alamat Penerima', 'Umur Penerima', 'JK Penerima', 'Pendidikan Penerima', 'Hubungan dgn Terlapor',
            'Tanggal Kejadian', 'Tempat Kejadian', 'Kronologi', 'Bukti'
        ];

        $sheet->fromArray($headers, null, 'A1');

        foreach ($dataLaporan as $i => $p) {
            $sheet->fromArray([
                $p->id_laporan, $p->kategori, optional($p->created_at)->format('Y-m-d'),
                $p->nama_anak ?? '-', $p->penerimaManfaat->informasiAnak->umur ?? '-', $p->penerimaManfaat->informasiAnak->jenis_kelamin ?? '-', $p->penerimaManfaat->informasiAnak->pendidikan ?? '-',
                $p->pelapor->nama ?? '-', $p->pelapor->nik ?? '-', $p->pelapor->alamat ?? '-', $p->pelapor->hubungan_dengan_korban ?? '-',
                $p->terlapor->nama ?? '-', $p->terlapor->nik ?? '-', $p->terlapor->alamat ?? '-', $p->terlapor->umur ?? '-', $p->terlapor->jenis_kelamin ?? '-', $p->terlapor->hubungan_dengan_korban ?? '-',
                $p->penerimaManfaat->nama ?? '-', $p->penerimaManfaat->nik ?? '-', $p->penerimaManfaat->alamat ?? '-', $p->penerimaManfaat->umur ?? '-', $p->penerimaManfaat->jenis_kelamin ?? '-', $p->penerimaManfaat->pendidikan ?? '-', $p->penerimaManfaat->hubungan_dengan_terlapor ?? '-',
                $p->detailKasus->tanggal ?? '-', $p->detailKasus->tempat_kejadian ?? '-', $p->detailKasus->kronologi ?? '-', $p->detailKasus->bukti ?? '-',
            ], null, 'A' . ($i + 2));
        }

        $this->applyStyle($sheet, count($headers), $dataLaporan->count() + 1);

        return $this->downloadSpreadsheet($spreadsheet, 'rekapan_laporan');
    }

    public function exportMultiSheet(Request $request)
    {
        $dataLaporan = $this->filteredQuery($request)->get();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0); // Remove default

        $this->addSheet($spreadsheet, 'Rekapan Umum', ['ID Laporan', 'Kategori', 'Tanggal Dibuat'],
            $dataLaporan->map(fn($d) => [$d->id_laporan, $d->kategori, optional($d->created_at)->format('Y-m-d')]));

        $this->addSheet($spreadsheet, 'Detail Pelapor', ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Hubungan'],
            $dataLaporan->map(fn($d) => [$d->id_laporan, $d->pelapor->nama ?? '-', $d->pelapor->nik ?? '-', $d->pelapor->alamat ?? '-', $d->pelapor->hubungan_dengan_korban ?? '-']));

        $this->addSheet($spreadsheet, 'Informasi Anak', ['ID Laporan', 'Nama', 'Umur', 'JK', 'Pendidikan'],
            $dataLaporan->map(function ($d) {
                $anak = $d->penerimaManfaat->informasiAnak ?? null;
                return [$d->id_laporan, $anak->nama ?? '-', $anak->umur ?? '-', $anak->jenis_kelamin ?? '-', $anak->pendidikan ?? '-'];
            }));

        $this->addSheet($spreadsheet, 'Detail Terlapor', ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Umur', 'JK', 'Hubungan'],
            $dataLaporan->map(fn($d) => [$d->id_laporan, $d->terlapor->nama ?? '-', $d->terlapor->nik ?? '-', $d->terlapor->alamat ?? '-', $d->terlapor->umur ?? '-', $d->terlapor->jenis_kelamin ?? '-', $d->terlapor->hubungan_dengan_korban ?? '-']));

        $this->addSheet($spreadsheet, 'Penerima Manfaat', ['ID Laporan', 'Nama', 'NIK', 'Alamat', 'Umur', 'JK', 'Pendidikan', 'Hubungan'],
            $dataLaporan->map(fn($d) => [$d->id_laporan, $d->penerimaManfaat->nama ?? '-', $d->penerimaManfaat->nik ?? '-', $d->penerimaManfaat->alamat ?? '-', $d->penerimaManfaat->umur ?? '-', $d->penerimaManfaat->jenis_kelamin ?? '-', $d->penerimaManfaat->pendidikan ?? '-', $d->penerimaManfaat->hubungan_dengan_terlapor ?? '-']));

        $this->addSheet($spreadsheet, 'Detail Kasus', ['ID Laporan', 'Tanggal Kejadian', 'Tempat', 'Kronologi', 'Bukti'],
            $dataLaporan->map(fn($d) => [$d->id_laporan, $d->detailKasus->tanggal ?? '-', $d->detailKasus->tempat_kejadian ?? '-', $d->detailKasus->kronologi ?? '-', $d->detailKasus->bukti ?? '-']));

        return $this->downloadSpreadsheet($spreadsheet, 'rekapan_multi');
    }

    private function filteredQuery(Request $request)
    {
        $query = Rekapan::with(['pelapor', 'terlapor', 'detailKasus', 'penerimaManfaat.informasiAnak']);

        if ($request->filled('search')) {
            $query->whereHas('pelapor', fn($q) => $q->where('nama', 'like', '%' . $request->search . '%')->orWhere('nik', 'like', '%' . $request->search . '%'));
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        return $query;
    }

    private function applyStyle($sheet, $columnCount, $lastRow)
    {
        $style = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['wrapText' => true]
        ];

        $colEnd = Coordinate::stringFromColumnIndex($columnCount);
        $sheet->getStyle("A1:{$colEnd}1")->applyFromArray($style);
        $sheet->getStyle("A1:{$colEnd}{$lastRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("A1:{$colEnd}{$lastRow}")->getAlignment()->setWrapText(true);

        foreach (range('A', $colEnd) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    private function addSheet(Spreadsheet $spreadsheet, string $title, array $headers, $rows)
    {
        $sheet = new Worksheet($spreadsheet, $title);
        $spreadsheet->addSheet($sheet);
        $sheet->fromArray($headers, null, 'A1');
        $sheet->fromArray($rows->toArray(), null, 'A2');

        $colEnd = Coordinate::stringFromColumnIndex(count($headers));
        $this->applyStyle($sheet, count($headers), count($rows) + 1);
    }

    private function downloadSpreadsheet(Spreadsheet $spreadsheet, string $filenamePrefix)
    {
        $writer = new Xlsx($spreadsheet);
        $fileName = $filenamePrefix . '_' . now()->format('Ymd_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $filenamePrefix);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
