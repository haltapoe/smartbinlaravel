<?php

namespace App\Http\Controllers;

use App\Models\SavedData;
use Illuminate\Http\Request;

class SavedDataController extends Controller
{
    public function deleteSelected(Request $request)
    {
        $selectedRows = $request->input('selectedRows');

        // Lakukan penghapusan data dari database
        foreach ($selectedRows as $selectedRow) {
            // Sesuaikan ini dengan kolom yang benar
            SavedData::where('id', $selectedRow['id'])->delete();
        }

        // Perbarui data yang akan ditampilkan
        $savedDataList = SavedData::all();

        // Kembalikan tampilan dengan data yang diperbarui
        return view('nama_tampilan', compact('savedDataList'))->with('status', 'success')->with('message', 'Data deleted successfully');
    }
}