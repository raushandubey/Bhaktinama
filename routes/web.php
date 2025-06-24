<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes - redirect to login if not authenticated
Route::middleware(['auth'])->group(function () {
    Route::get('/pandit', function () {
        return view('pandit');
    })->name('pandit');
    
    Route::get('/appointment', function () {
        return view('appointment');
    })->name('appointment');
    
    Route::get('/history', function () {
        return view('history');
    })->name('history');
    
    Route::get('/schedule', function () {
        return view('schedule');
    })->name('schedule');
});

// Redirect unauthenticated users to login
Route::fallback(function () {
    return redirect('/index');
});
