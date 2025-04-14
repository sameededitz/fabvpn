<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePlan extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-plan')
        ->extends('layouts.app')
        ->section('content');
    }
}
