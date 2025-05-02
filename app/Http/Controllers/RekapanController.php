<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Yajra\DataTables\Facades\DataTables;

class RekapanController extends Controller
{
    public function index(){
        return view('backend.layout.page_admin.rekapan');
    }

    public function getData (Request $request) {
        if ($request->ajax()) {
            $data = Laporan::select(['id', 'kategori', 'nama', 'nik', 'created_at']);
            return DataTables::of($data) ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            }) -> make(true);
        }
    }
}
