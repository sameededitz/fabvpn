<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use Livewire\Component;

class ManageUser extends Component
{
    public User $user;
    public $plans, $selectedPlan;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->plans = Plan::all();
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.manage-user')
            ->extends('layouts.app')
            ->section('content');
    }
}
