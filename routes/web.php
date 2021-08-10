<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// // GOOGLE
Route::get('sign-in/google', 'SocialController@google');
Route::get('sign-in/google/redirect', 'SocialController@googleRedirect');

// // GITHUB
Route::get('sign-in/github', 'SocialController@github');
// Route::get('sign-in/github/redirect', 'SocialController@githubRedirect');