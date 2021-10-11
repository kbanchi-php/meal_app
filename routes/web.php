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

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])
    ->name('root');

Route::resource('posts', App\Http\Controllers\PostController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');

Route::resource('posts', App\Http\Controllers\PostController::class)
    ->only(['index', 'show']);

Route::post('posts/{post}/like', [
    App\Http\Controllers\LikeController::class, 'like'
])->middleware('auth')->name('posts.likes.like');

Route::delete('posts/{post}/unlike', [
    App\Http\Controllers\LikeController::class, 'unlike'
])->middleware('auth')->name('posts.likes.unlike');

require __DIR__ . '/auth.php';
