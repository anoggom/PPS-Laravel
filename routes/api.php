<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DirectorController;
use App\Http\Controllers\Api\FilmController;

Route::prefix('auth')->group(function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::middleware('auth:api')->group(function () {
    Route::get('/directors', [DirectorController::class, 'index']);
    Route::get('/directors/{director}', [DirectorController::class, 'show']);
    Route::get('/films', [FilmController::class, 'index']);
    Route::get('/films/{film}', [FilmController::class, 'show']);
});
