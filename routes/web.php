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
    ->name('yoga-sessions.cancel');

Route::get('/yoga-sessions/{id}', [YogaSessionController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('session-view');


Route::get('/instructor-list', [InstructorListController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('instructor-list');

Route::get('/sessions-log', [SessionLogController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('sessions-log');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






require __DIR__.'/instructor-web.php';

require __DIR__.'/auth.php';

require __DIR__.'/instructor-auth.php';

