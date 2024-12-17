<?php
use App\Http\Controllers\Instructor\SessionLogController;
use App\Http\Controllers\Instructor\HomeController;
use App\Http\Controllers\Instructor\YogaSessionController;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\RequestsController;
use Illuminate\Support\Facades\Route;

Route::prefix('instructor')->middleware('auth:instructor')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('instructor.dashboard');

    Route::get('/yoga-sessions/{id}', [YogaSessionController::class, 'show'])
        ->name('instructor.session-view');

    Route::patch('/yoga-sessions/{id}/accept', [YogaSessionController::class, 'accept'])
        ->name('yoga-sessions.accept');

    Route::patch('/yoga-sessions/{id}/decline', [YogaSessionController::class, 'decline'])
        ->name('yoga-sessions.decline');

    Route::patch('/yoga-sessions/{id}/cancel', [YogaSessionController::class, 'cancel'])
        ->name('instructor.yoga-sessions.cancel');

    Route::get('/requests', [RequestsController::class, 'index'])
        ->name('instructor.requests');

    Route::get('/sessions-log', [SessionLogController::class, 'index'])
        ->name('instructor.sessions-log');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('instructor.profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('instructor.profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('instructor.profile.update');
});



