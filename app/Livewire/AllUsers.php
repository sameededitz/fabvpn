<?php

namespace App\Livewire;

use Livewire\Component;

class AllUsers extends Component
{
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-users')
        ->extends('layouts.app')
        ->section('content');
    }
}
