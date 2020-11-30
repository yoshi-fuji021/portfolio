<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\SearchPlaceController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchLibraryController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// CRUD機能
Route::resource('place', PlaceController::class);
// 検索機能
Route::post('place/search', SearchPlaceController::class)->name('place.search');

// いいね機能
Route::get('/place/like/{id}', [LikeController::class, 'like'])->name('place.like');
Route::get('/place/unlike/{id}', [LikeController::class, 'unlike'])->name('place.unlike');

//検索機能 
Route::get('library/search', SearchLibraryController::class)->name('library.search');
