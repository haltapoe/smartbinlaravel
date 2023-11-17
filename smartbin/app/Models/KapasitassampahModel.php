<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facedes\DB;

class Kapasitassampah extends Model
{
    protected $table = 'smartbin';

    public static function getCentimeterData()
    {
        return DB::connection('pgsql')->table('smartbin')->select('centimeter')->get();
    }
}
