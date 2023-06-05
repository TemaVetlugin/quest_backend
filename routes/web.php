<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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


Auth::routes();
Route::get('/google', 'App\Http\Controllers\GoogleController@redirectToGoogle');
Route::get('/google/callback', 'App\Http\Controllers\GoogleController@handleGoogleCallback');
Route::get('/', 'App\Http\Controllers\IndexController')->where('page', '.*');
//Route::get('{page}', 'App\Http\Controllers\IndexController')->where('page', '.*');
