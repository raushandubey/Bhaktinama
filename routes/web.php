<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/pandit', function () {
    return view('pandit');
});

Route::get('/appointment', function () {
    return view('appointment');
});

Route::get('/history', function () {
    return view('history');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/schedule', function () {
    return view('schedule');
});

Route::get('/signup', function () {
    return view('signup');
});
