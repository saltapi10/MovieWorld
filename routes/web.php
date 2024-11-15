<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;

Route::get('/', [DashboardController::class, 'view'])->name('dashboard');

Route::post('login', [UserController::class, 'login']);

Route::post('register', [UserController::class, 'register']);

Route::post('logout', [UserController::class, 'logout']);

Route::post('movie-create', [MovieController::class, 'create']);

Route::post('movie-reaction', [MovieController::class, 'reaction']);

Route::get('user-movies/{id}', [MovieController::class, 'userMovies']);

Route::get('/set-sort-type-movies/{order}', [MovieController::class, 'setSortTypeMovies']);
