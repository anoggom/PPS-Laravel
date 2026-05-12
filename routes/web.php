<?php

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/directors', [DirectorController::class, 'index']);
    Route::get('/directors/{director}', [DirectorController::class, 'show']);

    Route::get('/films', [FilmController::class, 'index']);
    Route::get('/films/{film}', [FilmController::class, 'show']);
});
