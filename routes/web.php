<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Profile->Only authenticated user can see this page
Route::get('/users/profile', [UserController::class,'showProfile'])->middleware('auth');


// Get User Profile Edit Page
Route::get('/users/profile/edit', [UserController::class,'editProfilePage'])->middleware('auth');

// Edit Profile->Only authenticated user can see this page
Route::post('/users/profile/edit', [UserController::class,'editProfile'])->middleware('auth');


