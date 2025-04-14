<?php

use App\Livewire\AllAdmins;
use App\Livewire\AllPlans;
use App\Livewire\AllPurchases;
use App\Livewire\AllUsers;
use App\Livewire\AllVpnServers;
use App\Livewire\Auth\Login;
use App\Livewire\CreateAdmin;
use App\Livewire\CreatePlan;
use App\Livewire\CreatePurchases;
use App\Livewire\CreateUser;
use App\Livewire\CreateVpnServers;
use App\Livewire\CreateVpsServers;
use App\Livewire\Feedbacks;
use App\Livewire\Smpt;
use App\Livewire\VpsServers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/all-vps-servers',VpsServers::class)->name('all-vps-servers');
Route::get('/create-vps-servers',CreateVpsServers::class)->name('create-vps-servers');
Route::get('/all-vpn-servers',AllVpnServers::class)->name('all-vpn-servers');
Route::get('/create-vpn-servers',CreateVpnServers::class)->name('create-vpn-servers');
Route::get('/all-plans',AllPlans::class)->name('all-plans');
Route::get('/create-plan',CreatePlan::class)->name('create-plan');
Route::get('/all-purchases',AllPurchases::class)->name('all-purchases');
Route::get('/create-purchase',CreatePurchases::class)->name('create-purchase');
Route::get('/feedbacks',Feedbacks::class)->name('feedbacks');
Route::get('/all-users',AllUsers::class)->name('all-users');
Route::get('/create-user',CreateUser::class)->name('create-user');
Route::get('/all-admins',AllAdmins::class)->name('all-admins');
Route::get('/create-admin',CreateAdmin::class)->name('create-admin');
Route::get('/smpt',Smpt::class)->name('smpt');
Route::get('/login', Login::class)->name('login')->middleware('guest');
