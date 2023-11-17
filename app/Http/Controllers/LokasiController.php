<?php

namespace App\Http\Controllers;

use App\Models\Lokasi:
use Illuminate\Http\Request;


class LokasiController extends Controller
{
    public function getLokasi()
    {
        //mengambil model lokasi
        $lokasi = Lokasi::getLokasi();

        //mengambil data
        return response()->json(['lokasi' => $lokasi]);
    }
}
