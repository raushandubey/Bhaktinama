<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/index', function () {
    return view('index');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pandit', function () {
        return view('pandit');
    })->name('pandit');
    
    Route::get('/appointment', function () {
        return view('appointment');
    })->name('appointment');
    
    Route::get('/schedule', function () {
        return view('schedule');
    })->name('schedule');
    
    // Booking and Feedback Routes
    Route::get('/history', [BookingController::class, 'index'])->name('history');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::patch('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
});

// Fallback for unauthenticated users
Route::fallback(function () {
    return redirect()->route('home');
});
