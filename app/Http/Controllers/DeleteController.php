<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedData;

class DeleteController extends Controller
{
    public function deleteData(Request $request)
    {
        $id = $request->input('id');

        // Sesuaikan dengan model dan atribut data yang Anda miliki
        SavedData::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully']);
    }
}
