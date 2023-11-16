<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KapasitassampahController extends Controller
{
    public function getCentimeterData()
    {
        return view('get-centimeter-data');
    }
}
