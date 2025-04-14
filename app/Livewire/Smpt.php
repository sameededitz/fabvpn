<?php

namespace App\Livewire;

use Livewire\Component;

class Smpt extends Component
{
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.smpt')
        ->extends('layouts.app')
        ->section('content');
    }
}
