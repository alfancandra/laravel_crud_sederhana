<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/posts',[PostController::class,'index'])->name('posts');

// Tambah data post
Route::get('/posts/add',[PostController::class,'add'])->name('addpost');
Route::post('/posts/add',[PostController::class,'store'])->name('storepost');
// Hapus Data
Route::get('/posts/delete/{id}',[PostController::class,'delete'])->name('deletepost');
// Edit Data
Route::get('/posts/edit/{id}',[PostController::class,'edit'])->name('editpost');
Route::post('/posts/edit',[PostController::class,'update'])->name('updatepost');