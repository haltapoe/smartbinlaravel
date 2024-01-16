<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedData;

class SaveDatacontroller extends Controller
{
    public function store(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'alamat' => 'required',
            'tanggal' => 'required',
            'indikator_sampah' => 'required',
            'kapasitas' => 'required',
            'titik_koordinat' => 'required'
            // Sesuaikan dengan aturan validasi lainnya
        ]);

        // Simpan data baru
        SavedData::create($request->all());

        return redirect()->route('data.index')->with('success', 'Data berhasil disimpan.');
    }

    public function destroy($id)
    {
        // Temukan data berdasarkan ID dan hapus
        $savedData = SavedData::findOrFail($id);
        $savedData->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus.');
    }
}
