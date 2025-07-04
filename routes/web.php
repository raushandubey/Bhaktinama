<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PanditController;

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

// Pandit Authentication Routes
Route::get('/pdlogin', [AuthController::class, 'showPanditLogin'])->name('panditlogin');
Route::post('/pdlogin', [AuthController::class, 'loginPandit'])->name('panditlogin.post');
Route::get('/pdsignup', [AuthController::class, 'showPanditSignup'])->name('panditsignup');
Route::post('/pdsignup', [AuthController::class, 'registerPandit'])->name('panditsignup.post');

// Password Reset Routes
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'verifyUserForPasswordReset'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset'); // Token is not used but part of Laravel's convention
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

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

    // Pandit Dashboard and Profile Routes
    Route::get('/pandit/dashboard', function () {
        // Check if user is authenticated and is a pandit
        if (!Auth::check() || Auth::user()->role !== 'pandit') {
            return redirect('/pdlogin')->with('error', 'You must be logged in as a pandit to access this page.');
        }
        return view('pandit.dashboard');
    })->name('pandit.dashboard');

    // Pandit Profile Routes
    Route::get('/pandit/profile/edit', [PanditController::class, 'showUpdateProfile'])->name('pandit.profile.edit');
    Route::put('/pandit/profile/update', [PanditController::class, 'updateProfile'])->name('pandit.profile.update');
    Route::get('/pandit/profile/updated', function () {
        return view('pandit.profile-updated');
    })->name('pandit.profile.updated');
});

// Pandit Routes
Route::get('/panditsignup', function () {
    return view('panditsignup');
})->name('pandit.signup');

Route::post('/pandit/register', [PanditController::class, 'register'])->name('pandit.register');
Route::get('/panditlogin', function () {
    return view('panditlogin');
})->name('pandit.login');

// Fallback for unauthenticated users
Route::fallback(function () {
    return redirect()->route('home');
});