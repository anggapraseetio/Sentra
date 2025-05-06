<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RekapanController extends Controller
{
    public function index()
    {
        return view('backend.layout.page_admin.rekapan');
    }
    
}