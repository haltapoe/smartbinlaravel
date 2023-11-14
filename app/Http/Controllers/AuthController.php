<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view('Register');
    }

    public function login(Request $request) {
        // Langkah 1: Validasi Input
        $request->validate([
            'email' => 'required|email', // Validasi email yang wajib diisi dan harus berformat email.
            'password' => 'required',    // Validasi password yang wajib diisi.
        ]);

        // Langkah 2: Mengambil Data Input
        $credentials = $request->only('email', 'password'); // Mengambil data 'email' dan 'password' dari permintaan.
    
        // Langkah 3: Coba Autentikasi
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
        
            // Dapatkan id pengguna yang saat ini masuk
            $id = Auth::user()->id;
            
            // Dapatkan objek pengguna yang saat ini masuk
            $currentUser = User::find($id);

            // Periksa apakah pengguna memiliki peran "admin"
            if ($currentUser->role_id == 1) {
                // Pengguna memiliki peran "admin", arahkan ke halaman admin
                return redirect()->intended('/admin/dashboard');
            } else {
                // Pengguna bukan admin, arahkan ke halaman dasbor biasa
                return redirect()->intended('/home');
            }
        } else {
            // Autentikasi gagal, kembalikan pengguna ke halaman login dengan pesan kesalahan
            return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
        }
    }
}
