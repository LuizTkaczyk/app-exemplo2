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


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); //name usado na index para informa a rota

//rota para criar uma postagem
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); //name usado na index para informa a rota

Route::get('/', function () {
    return view('welcome');
});
