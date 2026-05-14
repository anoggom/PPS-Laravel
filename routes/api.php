<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DirectorController;
use App\Http\Controllers\Api\FilmController;

Route::prefix('auth')->group(function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/directors', [DirectorController::class, 'index']);
    Route::post('/directors', [DirectorController::class, 'store']);
    Route::get('/directors/{director}', [DirectorController::class, 'show']);
    Route::put('/directors/{director}', [DirectorController::class, 'update']);
    Route::patch('/directors/{director}', [DirectorController::class, 'update']);
    Route::delete('/directors/{director}', [DirectorController::class, 'destroy']);

    Route::get('/films', [FilmController::class, 'index']);
    Route::post('/films', [FilmController::class, 'store']);
    Route::get('/films/{film}', [FilmController::class, 'show']);
    Route::put('/films/{film}', [FilmController::class, 'update']);
    Route::patch('/films/{film}', [FilmController::class, 'update']);
    Route::delete('/films/{film}', [FilmController::class, 'destroy']);
});
