<?php


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SavedDataController;
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
Route::get('/data', [SavedDataController::class, 'index'])->name('data.index');
Route::post('/data', [SavedDataController::class, 'store'])->name('data.store');
Route::delete('/data/{id}', [SavedDataController::class, 'destroy'])->name('data.destroy');