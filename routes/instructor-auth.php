<?php

use App\Http\Controllers\Instructor\HomeController;
use App\Http\Controllers\Instructor\Auth\LoginController;
use App\Http\Controllers\Instructor\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('instructor')->middleware('guest:instructor')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('instructor.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('instructor.login');

    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('instructor')->middleware('auth:instructor')->group(function () {

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('instructor.logout');
});