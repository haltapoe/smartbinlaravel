<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saved_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus satu baris data dari tabel 'saved_data' berdasarkan kondisi tertentu.
        DB::table('saved_data')
            ->where('alamat', '=', 'nilai_kondisi1')
            ->where('tanggal', '=', 'nilai_kondisi2')
            ->where('indikator_sampah', '=', 'nilai_kondisi3')
            ->where('kapasitas', '=', 'nilai_kondisi4')
            ->where('titik_koordinat', '=', 'nilai_kondisi5')
            ->delete();
    }
};
