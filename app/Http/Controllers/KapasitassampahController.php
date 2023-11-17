<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Http\Request;

class KapasitassampahController extends Controller
{
    public function getCentimeterData()
    {
        //mengunakan model
        $centimeterData = Kapasitassampah::getCentimeterData();
        //mengembalikan data dala json
        return response()->json(['centimeterData' => $centimeterData]);
    }
}
