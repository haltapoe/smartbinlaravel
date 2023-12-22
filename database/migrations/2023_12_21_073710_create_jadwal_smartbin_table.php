<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_smartbin', function (Blueprint $table) {
            $table->id();
            $table->string('alamat');
            $table->date('tanggal');
            $table->string('indikator_sampah');
            $table->string('kapasitas');
            $table->string('titik_koordinat');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_smartbin');
    }
};
