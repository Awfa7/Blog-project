<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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

Route::get('/', [PostController::class,'index'])->name('home');
Route::get('posts/{post:slug}',[PostController::class,'show']);

Route::middleware('guest')->group(function() {
  Route::get('register',[RegisterController::class,'create']);
  Route::post('register',[RegisterController::class,'store']);
  Route::get('login',[SessionsController::class,'create']);
  Route::post('login',[SessionsController::class,'store']);
});

Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);

Route::post('logout',[SessionsController::class,'destroy'])->middleware('auth');


// Admin
Route::middleware('can:admin')->group(function() {
  Route::resource('admin/posts' , AdminPostController::class)->except('show');
  // Route::post('admin/posts',[AdminPostController::class,'store']);
  // Route::get('admin/posts/create',[AdminPostController::class,'create']);
  // Route::get('admin/posts',[AdminPostController::class,'index']);
  // Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit']);
  // Route::patch('admin/posts/{post}',[AdminPostController::class,'update']);
  // Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy']);
});








/*

use can middleware :

Route::post('admin/posts',[AdminPostController::class,'store'])->middleware('can:admin');
Route::get('admin/posts/create',[AdminPostController::class,'create'])->middleware('can:admin');
Route::get('admin/posts',[AdminPostController::class,'index'])->middleware('can:admin');
Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit'])->middleware('can:admin');
Route::patch('admin/posts/{post}',[AdminPostController::class,'update'])->middleware('can:admin');
Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy'])->middleware('can:admin');


use make:middleware :

Route::post('admin/posts',[AdminPostController::class,'store'])->middleware('admin');
Route::get('admin/posts/create',[AdminPostController::class,'create'])->middleware('admin');
Route::get('admin/posts',[AdminPostController::class,'index'])->middleware('admin');
Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit'])->middleware('admin');
Route::patch('admin/posts/{post}',[AdminPostController::class,'update'])->middleware('admin');
Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy'])->middleware('admin');

*/