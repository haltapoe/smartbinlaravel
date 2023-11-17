<?php

namespace App\Http\Controllers;

use App\Models\Http\Request;
use Illuminate\Http\Request;

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
