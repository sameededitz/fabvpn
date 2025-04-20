<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('login');
    }
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created';
});
