<?php

use App\Livewire\Admin\AllServers;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('/servers', AllServers::class)->name('servers.all');
});
