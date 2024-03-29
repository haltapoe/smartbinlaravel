<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedData extends Model
{
    use HasFactory;
    protected $fillable = ['alamat', 'tanggal', 'indikator_sampah', 'kapasitas', 'titik_koordinat'];
}
