<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class LandingPageController extends Controller
{
     public function index(Request $request)
    {
        $informasiList = Informasi::latest()->take(6)->get();

        return view('frontend.index',compact('informasiList'));
    }

    public function show($slug)
    {
        return view('frontend.detail_informasi', compact('informasi'));
    }

}
