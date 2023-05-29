<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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


// Show welcome page
Route::view('/','welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('isAdmin')->group (function() {
    // Admin Home Controller
    Route::get('/admin',[AdminController::class,'index']);

    // Admin Pages for User
    Route::get('/admin/users/create',[AdminController::class,'createPage']);
    Route::get('/admin/users/show/{id}',[AdminController::class,'show']);
    Route::get('/admin/users/edit/{id}',[AdminController::class,'editPage']);

    // Admin Operations Related to User
    Route::post('/admin/users/create',[AdminController::class,'create']);
    Route::post('/admin/users/edit/{id}',[AdminController::class,'edit']);
    Route::get('/admin/users/delete/{id}', [AdminController::class,'delete']);
});


Route::middleware('auth')->group (function() {
  
    // Post Pages
    Route::get('/posts',[PostController::class,'index']);

    //User Pages
    Route::get('/users/profile/edit', [UserController::class,'editProfilePage']);


    // User Operations
    Route::get('/users/profile', [UserController::class,'showProfile']);
    Route::post('/users/profile/edit', [UserController::class,'editProfile']);

    // Post Pages
    Route::get('/posts/create',[PostController::class,'createPage']);
    Route::get('/posts/edit/{id}',[PostController::class,'editPage']);
    Route::get('/posts/show/{id}',[PostController::class,'showPage']);

    // Post Operations
    Route::post('/posts/create',[PostController::class,'create']);
    Route::post('/posts/edit/{id}',[PostController::class,'edit']);
    Route::get('/posts/delete/{id}',[PostController::class,'delete']);


});


