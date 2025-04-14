<?php

namespace App\Livewire;

use Livewire\Component;

class CreateUser extends Component
{
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-user')
        ->extends('layouts.app')
        ->section('content');
    }
}
