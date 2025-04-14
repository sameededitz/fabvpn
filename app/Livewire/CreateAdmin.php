<?php

namespace App\Livewire;

use Livewire\Component;

class CreateAdmin extends Component
{
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-admin')
        ->extends('layouts.app')
        ->section('content');
    }
}
