<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/signup', [AuthController::class, 'signup'])->name('api.signup');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('api.refresh');
});
