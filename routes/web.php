<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tvcontroller;
use App\Http\Controllers\Actorcontroller;

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
Route::controller(Moviescontroller::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/movies/{movie}', 'show')->name('show');
});
Route::controller(tvcontroller::class)->group(function () {
    Route::get('tvshows', 'index')->name('tv.index');
    Route::get('/tv/{id}', 'show')->name('tv.show');
});
Route::controller(Actorcontroller::class)->group(function () {
    Route::get('/actors', 'index')->name('actor.index');
    Route::get('/actors/page/{page?}', 'index');
    Route::get('/actors/{actor}', 'show')->name('actors.show');
});


