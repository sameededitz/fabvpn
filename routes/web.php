<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash', function () {
    return view('admin.dashboard');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');
