<?php
use App\Http\Controllers\SessionLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorListController;
use App\Http\Controllers\YogaSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/instructor', function () {
    return view('instructor-welcome'); // Instructor page
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/booking', [YogaSessionController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('booking');

Route::post('/yoga-sessions', [YogaSessionController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('yoga-sessions.store');

Route::patch('/yoga-sessions/{id}/cancel', [YogaSessionController::class, 'cancel'])
    ->middleware(['auth', 'verified'])
    ->name('user.yoga-sessions.cancel');

Route::get('/yoga-sessions/{id}', [YogaSessionController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('session-view');

Route::get('/yoga-sessions/{id}/edit', [YogaSessionController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('yoga-sessions.edit');

Route::put('/yoga-sessions/{id}', [YogaSessionController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('yoga-sessions.update');


Route::post('/yoga-sessions/clear-declined', [YogaSessionController::class, 'clearDeclined'])
    ->middleware(['auth', 'verified'])
    ->name('sessions.clear.declined');

Route::post('/yoga-sessions/clear-cancelled', [YogaSessionController::class, 'clearCancelled'])
    ->middleware(['auth', 'verified'])
    ->name('sessions.clear.cancelled');

Route::get('/instructor-list', [InstructorListController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('instructor-list');

Route::get('/sessions-log', [SessionLogController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('sessions-log');

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update');

require __DIR__.'/instructor-web.php';

require __DIR__.'/auth.php';

require __DIR__.'/instructor-auth.php';

