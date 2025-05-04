<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class RekapanController extends Controller {
    public function index() {
        return view('backend.layout.page-admin.rekapan');
    }

    public function getData(Request $request) {
        $data = Laporan::select(['id', 'kategori', 'nama', 'nik', 'tanggal_dibuat']);

        return DataTables::of($data)->make(true);
    }
}
