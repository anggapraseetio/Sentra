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

    return redirect()->route('laporan.proses')->with('success', 'Laporan diselesaikan!');
}


}
