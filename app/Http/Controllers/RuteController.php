<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Http\Request;

class RuteController extends Controller
{
    public function getSmartbinData()
    {
        //mengambil data
        $smartbinData = Rute::getRute();

        //ambil data dalam json
        return response()->json(['ruteData' => $ruteData]);
    }
}
