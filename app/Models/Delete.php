<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Delete extends Model
{
    use HasFactory;

    protected $table = 'your_table_name'; // Gantilah dengan nama tabel yang sesuai

    protected $fillable = [
        'column1', 'column2', 'column3', // Sesuaikan dengan kolom atau atribut yang Anda miliki
    ];

    // Jika Anda memiliki atribut tanggal yang diatur sebagai tanggal
    protected $dates = [
        'created_at', 'updated_at',
        // Tambahkan atribut tanggal lain yang perlu diatur sebagai tanggal
    ];

    // Jika Anda memiliki relasi dengan tabel lain, tambahkan metode relasi di sini
    // Contoh: public function relatedTable() { ... }
}
