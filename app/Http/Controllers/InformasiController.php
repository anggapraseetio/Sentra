<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index(){
        return view('backend.layout.page_admin.informasi');
    }
}
