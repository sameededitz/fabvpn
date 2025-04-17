<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash', function () {
    return view('admin.dashboard');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';