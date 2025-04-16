<?php

use App\Livewire\Admin\ServerAdd;
use App\Livewire\Admin\AllServers;
use App\Livewire\Admin\ServerEdit;
use App\Livewire\Admin\SubServerAdd;
use App\Livewire\Admin\AllSubServers;
use App\Livewire\Admin\AllVpsServers;
use App\Livewire\Admin\SubServerEdit;
use App\Livewire\Admin\VpsManager;
use App\Livewire\Admin\VpsServersAdd;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('/vps-servers', AllVpsServers::class)->name('vps-servers.all');
    Route::get('/vps-servers/create', VpsServersAdd::class)->name('vps-servers.add');
    Route::get('/vps-servers/{vpsServer}/manage', VpsManager::class)->name('vps-servers.manage');

    Route::get('/servers', AllServers::class)->name('servers.all');
    Route::get('/servers/create', ServerAdd::class)->name('servers.add');
    Route::get('/servers/{server}/edit', ServerEdit::class)->name('servers.edit');

    Route::get('/server/{server}/sub-servers', AllSubServers::class)->name('all.sub-servers');
    Route::get('/server/{server}/sub-servers/create', SubServerAdd::class)->name('sub-server.add');
    Route::get('/server/{server}/sub-servers/{subServer}/edit', SubServerEdit::class)->name('sub-server.edit');
});
