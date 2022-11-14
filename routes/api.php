<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\AuthorAPIController;
use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\API\GenreAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    /* Prefix the given routes with /authors */
    Route::prefix('authors')->group(function() {

        Route::get("{id}", [AuthorAPIController::class, 'show']);
        Route::post('/', [AuthorAPIController::class, 'store']);
        Route::get('/', [AuthorAPIController::class, 'index']);
        Route::put('/{id}', [AuthorAPIController::class, 'update']);
        Route::delete('/{id}', [AuthorAPIController::class, 'destroy']);
    });

    /* Prefix the given routes with /genres */
    Route::prefix('genres')->group(function() {

        Route::get("{id}", [GenreAPIController::class, 'show']);
        Route::post('/', [GenreAPIController::class, 'store']);
        Route::get('/', [GenreAPIController::class, 'index']);
        Route::put('/{id}', [GenreAPIController::class, 'update']);
        Route::delete('/{id}', [GenreAPIController::class, 'destroy']);
    });

    /* Prefix the given routes with /books */
    Route::prefix('books')->group(function() {

        Route::get("{id}", [BookAPIController::class, 'show']);
        Route::post('/', [BookAPIController::class, 'store']);
        Route::get('/', [BookAPIController::class, 'index']);
        Route::put('/{id}', [BookAPIController::class, 'update']);
        Route::delete('/{id}', [BookAPIController::class, 'destroy']);
    });

    Route::post('/logout', [AuthAPIController::class, 'logout']);
});

Route::apiResource('users', UserAPIController::class);
Route::apiResource('publishers', \App\Http\Controllers\API\PublisherAPIController::class);
//Route::apiResource('authors', AuthorAPIController::class);
//Route::resource('books', BookAPIController::class);
//Route::resource('genres', \App\Http\Controllers\API\GenreAPIController::class);
Route::post('register',[AuthAPIController::class,'register']);
Route::post('login', [AuthAPIController::class, 'login']);

