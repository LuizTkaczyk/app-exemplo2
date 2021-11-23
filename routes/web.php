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

//editando um post no banco
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); //name usado na index para informar a rota

Route::any('/post/search', [PostController::class, 'search'])->name('posts.search');

Route::put('/posts/{id}',[PostController::class, 'update'])->name('posts.update');

//rota para editar um post
Route::get( 'post/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');

//rota para deletar o post
Route::delete('/posts/{id}',[PostController::class, 'destroy'])->name('posts.destroy');

Route::get('posts/{id}',[PostController::class, 'show'])->name('posts.show');

//rota para criar uma postagem
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); //name usado na index para informar a rota




Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


Route::get('/', function () {
    return view('welcome');
});
