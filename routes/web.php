<?php
use App\Http\Controllers\SessionLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorListController;
use App\Http\Controllers\YogaSessionController;
use App\Http\Controllers\Instructor\AvailabilityController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/instructor', function () {
    return view('instructor-welcome'); // Instructor page
});

// User Routes

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/booking', [YogaSessionController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('booking');

Route::post('/get-available-times', [AvailabilityController::class, 'getAvailableTimes'])
    ->name('get-available-times');

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

Route::get('/instructors/{id}', [InstructorListController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('instructors.show');

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

Route::get('/store/home', [StoreController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('store.homepage');

// Admin Routes

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users');

    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])
        ->name('admin.users.destroy');
    
    Route::delete('/admin/instructors/{id}', [AdminController::class, 'destroyInstructor'])
        ->name('admin.instructors.destroy');

    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('admin.products');

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/admin/products/store', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{id}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy');


});

require __DIR__.'/instructor-web.php';

require __DIR__.'/auth.php';

require __DIR__.'/instructor-auth.php';

