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

        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully']);
    }

    // Metode lain yang mungkin diperlukan
}
