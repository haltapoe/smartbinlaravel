<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\KapasitassampahController;
use App\Http\Controllers\HomeController; // Tambahkan baris ini jika belum ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Inilah tempat Anda dapat mendaftarkan rute web untuk aplikasi Anda. Semua
| rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| diarahkan ke grup middleware "web". Buatlah sesuatu yang hebat!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Rute-menu
// Lokasi
Route::get('/get-lokasi', [LokasiController::class, 'getLokasi']);
// Rute
Route::get('/get-rute', [RuteController::class, 'getRute']);
// Kapasitas Sampah
Route::get('/get-centimeter-data', [KapasitassampahController::class, 'getCentimeterData']);
