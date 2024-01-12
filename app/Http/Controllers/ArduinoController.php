<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpSerial;

class ArduinoController extends Controller
{
    public function readDataFromArduino()
    {
        $serial = new PhpSerial;

        // Tentukan port yang digunakan oleh Arduino
        $serial->deviceSet("COM3");

        // Konfigurasi serial port
        $serial->confBaudRate(9600);
        $serial->confParity("none");
        $serial->confCharacterLength(8);
        $serial->confStopBits(1);

        // Buka koneksi serial
        $serial->deviceOpen();

        // Baca data dari Arduino
        $data = $serial->readPort();

        // Tutup koneksi serial
        $serial->deviceClose();

        // Lakukan sesuatu dengan data yang dibaca
        // ...

        return response()->json(['data' => $data]);
    }
}
