<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiAanakController extends Controller
{
    public function destroy($id)
{
    $anak = \App\Models\InformasiAnak::findOrFail($id);
    $anak->delete();

    return back()->with('success', 'Data anak berhasil dihapus.');
}

}
