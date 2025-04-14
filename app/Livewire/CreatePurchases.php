<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePurchases extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-purchases')
        ->extends('layouts.app')
        ->section('content');
    }
}
