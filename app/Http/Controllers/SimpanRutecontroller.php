<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedData;

class simpanRutecontroller extends Controller
{
    public function index()
    {
        $jadwals = SavedData::all();
        return view('inputDataModal', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $SavedData = SavedData::create($request->all());
        return redirect()->route('nama_route_tampilan')->with('success', 'Jadwal berhasil disimpan');
    }
    // public function simpanData(Request $request)
    // {
    //     // Validasi data jika diperlukan
    //     $request->validate([
    //         'alamat' => 'required|string',
    //         'tanggal' => 'required|date',
    //         'indikator_sampah' => 'required|string',
    //         'kapasitas' => 'required|integer',
    //         'titik_koordinat' => 'required|string'
    //     ]);

    //     // Simpan data ke dalam database
    //     SimpanRute::create([
    //         'alamat' => $request->alamat,
    //         'tanggal' => $request->tanggal,
    //         'indikator_sampah' => $request->indikator_sampah,
    //         'kapasitas' => $request->kapasitas,
    //         'titik_koordinat' => $request->titik_koordinat
    //     ]);

    //     // Simpan data ke database menggunakan model
    //     $data = $request->only(['alamat', 'tanggal', 'indikator', 'kapasitas', 'koordinat']);
    //     SimpanRute::simpanData($data);
    //     // Berikan respon bahwa data berhasil tersimpan
    //     return redirect()->back()->with('success', 'Data berhasil disimpan.');
    // }

    // public function tampilkanFormulir(Request $request)
    // {
    //     // Ambil data dari sesi (jika ada)
    //     $data = $request->session()->get('simpanRuteData');

    //     // Tampilkan formulir dengan data dari sesi (jika ada)
    //     return view('simpan_rute', ['data' => $data]);
    // }

    // public function simpanDanTampilkan(Request $request)
    // {
    //     $this->simpanData($request);
    //     $this->tampilkanFormulir($request);

    //     // Berikan respon bahwa data berhasil disimpan
    //     return redirect()->back()->with('success', 'Data berhasil disimpan dan formulir ditampilkan.');
    // }
}
