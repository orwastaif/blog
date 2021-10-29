<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;




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

Route::get('/profile', [Authcontroller::class, 'profile'])->name('profile');
Route::get('/profile1', [Authcontroller::class, 'profile1'])->name('profile1');
Route::get('/resetpassword/{reset_code}', [Authcontroller::class, 'getResetPassword'])->name('getResetPassword');
Route::post('/resetpassword/{reset_code}', [Authcontroller::class, 'postResetPassword'])->name('postResetPassword');






