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

Route::resource('posts.likes', App\Http\Controllers\LikeController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth');

require __DIR__ . '/auth.php';
