<?php


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SavedDataController;
use App\Http\Controllers\SimpanRuteController;
use App\Http\Controllers\SmartbinVisitController;
use App\Http\Controllers\KapasitassampahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [Login::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/get-lokasi', [LokasiController::class, 'getLokasi'])->name('get-lokasi');
Route::get('/get-rute', [RuteController::class, 'getSmartbinData'])->name('get-rute');
Route::get('/smartbin-visit-rute', [SmartbinVisitController::class, 'getSmartbinData'])->name('smartbin-visit-rute');
Route::get('/get-centimeter-data', [KapasitassampahController::class, 'getCentimeterData'])->name('get-centimeter-data');
Route::post('/delete-endpoint', [SavedDataController::class, 'deleteSelected']);
Route::post('/delete-endpoint', 'DeleteController@deleteData');
Route::post('/simpan-rute', [SimpanRuteController::class, 'simpanData'])->name('simpan.rute');
Route::get('/tampilkan-formulir', [SimpanRuteController::class, 'tampilkanFormulir'])->name('tampilkan.formulir');
Route::post('/simpan-dan-tampilkan', [SimpanRuteController::class, 'simpanDanTampilkan'])->name('simpan.dan.tampilkan');
Route::get('/nama_tampilan', [SimpanRuteController::class, 'index'])->name('savedjadwal');
Route::post('/simpan-jadwal', [SimpanRuteController::class, 'store']);