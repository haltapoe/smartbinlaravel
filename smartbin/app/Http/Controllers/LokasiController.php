<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function getLokasi()
    {
        return view('get-lokasi');
    }
}
