<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getLokasi()
    {
        return view('get-lokasi');
    }
}
