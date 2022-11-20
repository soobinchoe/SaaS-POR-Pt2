<?php

use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StaticPageController;
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

Route::get('/', [StaticPageController::class, 'home'])->name('home');
Route::get('/books', [BookController::class, 'index']);
//Route::get('/dashboard', [StaticPageController::class, 'dashboard'])->name('dashboard');
//Route::resource('books', BookAPIController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
