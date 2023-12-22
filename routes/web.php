<?php


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KapasitassampahController;
use App\Http\Controllers\SavedDataController;

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
Route::get('/get-centimeter-data', [KapasitassampahController::class, 'getCentimeterData'])->name('get-centimeter-data');
Route::post('/delete-endpoint', [SavedDataController::class, 'deleteSelected']);
