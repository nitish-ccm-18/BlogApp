<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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

// Admin Home Controller
Route::get('/admin',[AdminController::class,'index']);

// Admin Create User
Route::get('/admin/user/create',[AdminController::class,'createPage']);
Route::post('/admin/user/create',[AdminController::class,'create']);

// Show User Page
Route::get('/admin/user/show/{id}',[AdminController::class,'show']);

// Edit User page
Route::get('/admin/user/edit/{id}',[AdminController::class,'editPage']);
Route::post('/admin/user/edit/{id}',[AdminController::class,'edit']);

//Delete User
Route::get('/admin/user/delete/{id}', [AdminController::class,'delete']);