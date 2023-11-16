<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function getRute()
    {
        return view('get-lokasi');
    }
}
