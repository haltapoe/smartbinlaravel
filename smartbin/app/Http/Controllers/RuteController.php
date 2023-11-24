<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rute;

class RuteController extends Controller
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

    public function getSmartbinData()
    {
        return view('get-rute');
    }
}
