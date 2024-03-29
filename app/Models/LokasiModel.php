<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facedes\DB;

class Lokasi extends Model
{
        protected $table = 'smartbin'; //perhatikan nama tabel yg kalian pakai
    
        public static function getLokasi()
        {
            //ambil data dari db
            return FacadesDB::connection('pgsql')->table('smartbin')->select('lat', 'long')->get();
        }
}