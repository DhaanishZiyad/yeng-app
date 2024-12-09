<?php

use App\Http\Controllers\Instructor\HomeController;
use App\Http\Controllers\Instructor\YogaSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('instructor')->middleware('auth:instructor')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('instructor.dashboard');

    Route::patch('/yoga-sessions/{id}/accept', [YogaSessionController::class, 'accept'])
        ->name('yoga-sessions.accept');

    Route::patch('/yoga-sessions/{id}/decline', [YogaSessionController::class, 'decline'])
        ->name('yoga-sessions.decline');




});



