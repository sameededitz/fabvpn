<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ChangePassword extends Component
{
    public function render()
    {
        return view('livewire.admin.change-password')
        ->extends('layouts.app')
        ->section('content');
    }
}
