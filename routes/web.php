<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [DashboardController::class, 'view'])->name('dashboard');

Route::post('login', [UserController::class, 'login']);

Route::post('register', [UserController::class, 'register']);

Route::post('logout', [UserController::class, 'logout']);
