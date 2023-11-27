<?php


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\LokasiController;
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
Route::get('/home', [HomeController::class, 'index']);
Route::get('/get-lokasi', [LokasiController::class, 'getLokasi']);
Route::get('/get-rute', [RuteController::class, 'getRute']);
Route::get('/get-centimeter-data', [KapasitassampahController::class, 'getCentimeterData']);