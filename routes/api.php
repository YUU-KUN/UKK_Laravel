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

Route::middleware('auth:admin-api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getAkunAdmin', 'AuthController@getAkunAdmin')->middleware('auth:admin-api');
Route::get('getAkunSiswa', 'AuthController@getAkunSiswa')->middleware('auth:siswa-api');

Route::post('petugas/register', 'AuthController@registerPetugas');
Route::post('petugas/login', 'AuthController@loginPetugas');

Route::post('siswa/register', 'AuthController@registerSiswa');
Route::post('siswa/login', 'AuthController@loginSiswa');
// Route::get('/user', 'AuthController@user');

Route::resource('kelas', KelasController::class)->middleware('auth:admin-api'); // KELAS
Route::resource('spp', SPPController::class)->middleware('auth:admin-api'); // SPP
Route::resource('petugas', PetugasController::class)->middleware('auth:admin-api'); // PETUGAS
Route::resource('siswa', SiswaController::class)->middleware('auth:admin-api'); // SISWA
Route::get('pembayaran-siswa', 'PembayaranController@getPembayaranSiswa')->middleware('auth:siswa-api'); // PEMBAYARAN
Route::get('pembayaran-siswa/{id}', 'PembayaranController@getDetailPembayaranSiswa')->middleware('auth:siswa-api'); // PEMBAYARAN BY ID
Route::get('invoice/{id_pembayaran}', 'PembayaranController@laporan')->middleware('auth:admin-api'); // LAPORAN
Route::resource('pembayaran', PembayaranController::class)->middleware('auth:admin-api', ['except' => ['getDetailPembayaranSiswa', 'getPembayaranSiswa']]); // PEMBAYARAN

// GOOGLE
Route::get('sign-in/google', 'SocialController@google');
Route::get('sign-in/google/redirect', 'SocialController@googleRedirect');

// GITHUB
Route::get('sign-in/github', 'SocialController@github');
Route::get('sign-in/github/redirect', 'SocialController@githubRedirect');