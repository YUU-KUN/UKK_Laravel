<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('petugas/register', 'AuthController@registerPetugas');
Route::post('petugas/login', 'AuthController@loginPetugas');

Route::post('siswa/register', 'AuthController@registerSiswa');
Route::post('siswa/login', 'AuthController@loginSiswa');
// Route::get('/user', 'AuthController@user');

Route::resource('kelas', KelasController::class); // KELAS
Route::resource('spp', SPPController::class); // SPP
Route::resource('petugas', PetugasController::class); // PETUGAS
Route::resource('siswa', SiswaController::class); // SISWA
Route::get('pembayaran-siswa', 'PembayaranController@getPembayaranSiswa')->middleware('auth:siswa-api'); // PEMBAYARAN
Route::get('pembayaran-siswa/{id}', 'PembayaranController@getDetailPembayaranSiswa')->middleware('auth:siswa-api'); // PEMBAYARAN
Route::resource('pembayaran', PembayaranController::class); // PEMBAYARAN