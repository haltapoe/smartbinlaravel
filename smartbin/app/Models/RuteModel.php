<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facedes\DB;

class Rute extends Model
{
    protected $table = 'smartbin';

    public static function getRute()
    {
        return DB::connection('pgsql')->table('smartbin')->select('lat', 'long', 'kilometer')->get();
    }
}
