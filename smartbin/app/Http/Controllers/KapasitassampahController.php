<?php

namespace App\Http\Controllers;

use App\Models\Kapasitassampah;
use Illuminate\Http\Request;

class KapasitassampahController extends Controller
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

    public function getCentimeterData()
    {
        return view('get-centimeter-data');
    }
}
