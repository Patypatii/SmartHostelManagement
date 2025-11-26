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

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        return app(AdminController::class)->index();
    } elseif ($user->role === 'student') {
        return app(StudentController::class)->index();
    }
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings');
    Route::patch('/bookings/{id}', [App\Http\Controllers\BookingController::class, 'updateStatus'])->name('bookings.update');
    
    // Reports
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/occupancy', [App\Http\Controllers\ReportController::class, 'occupancy'])->name('reports.occupancy');
    Route::get('/reports/occupancy/export', [App\Http\Controllers\ReportController::class, 'exportOccupancy'])->name('reports.occupancy.export');
    Route::get('/reports/revenue', [App\Http\Controllers\ReportController::class, 'revenue'])->name('reports.revenue');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/rooms', [App\Http\Controllers\StudentController::class, 'rooms'])->name('rooms');
    Route::get('/rooms/{id}', [App\Http\Controllers\StudentController::class, 'show'])->name('rooms.show');
    Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    
    // Payments
    Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{booking}/pay', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/{booking}/pay', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\StaffController::class, 'dashboard'])->name('dashboard');
    
    // Complaints
    Route::get('/complaints', [App\Http\Controllers\StaffController::class, 'complaints'])->name('complaints.index');
    Route::patch('/complaints/{id}', [App\Http\Controllers\StaffController::class, 'updateComplaint'])->name('complaints.update');
    
    // Visitors
    Route::get('/visitors', [App\Http\Controllers\StaffController::class, 'visitors'])->name('visitors.index');
    Route::patch('/visitors/{id}', [App\Http\Controllers\StaffController::class, 'updateVisitor'])->name('visitors.update');
});

require __DIR__.'/auth.php';

