<?php

namespace App\Livewire;

use Livewire\Component;

class AllPurchases extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-purchases')
        ->extends('layouts.app')
        ->section('content');
    }
}
