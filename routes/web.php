<?php

use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware'=>['auth']], function () {
    Route::resource('books', BookController::class);
    Route::get("/books/{book}/delete", [BookController::class, 'delete'])->name('books.delete');

    Route::resource('authors', AuthorController::class);
    Route::get("/authors/{author}/delete", [AuthorController::class, 'delete'])->name('authors.delete');


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
//    Route::resource('users', UserController::class);
//
//    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::get('/dashboard', [StaticPageController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
