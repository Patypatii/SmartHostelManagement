<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        return app(AdminController::class)->index();
    } elseif ($user->role === 'student') {
        return app(StudentController::class)->index();
    }
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Student Routes
    Route::get('/student/rooms', [StudentController::class, 'rooms'])->name('student.rooms');
    Route::post('/student/book/{room}', [StudentController::class, 'book'])->name('student.book');
    
    // Payment Routes
    Route::get('/student/payments', [PaymentController::class, 'index'])->name('student.payments.index');
    Route::get('/student/pay/{booking}', [PaymentController::class, 'create'])->name('student.payments.create');
    Route::post('/student/pay/{booking}', [PaymentController::class, 'store'])->name('student.payments.store');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
        Route::post('/bookings/{booking}/approve', [AdminController::class, 'approveBooking'])->name('bookings.approve');
        Route::post('/bookings/{booking}/reject', [AdminController::class, 'rejectBooking'])->name('bookings.reject');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/occupancy', [ReportController::class, 'occupancy'])->name('reports.occupancy');
        Route::get('/reports/occupancy/export', [ReportController::class, 'exportOccupancy'])->name('reports.occupancy.export');
        Route::get('/reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
