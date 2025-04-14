<?php

namespace App\Livewire;

use Livewire\Component;

class AllAdmins extends Component
{
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-admins')
        ->extends('layouts.app')
        ->section('content');
    }
}
