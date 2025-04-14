<?php

namespace App\Livewire;

use Livewire\Component;

class VpsServers extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.vps-servers')
        ->extends('layouts.app')
        ->section('content');
    }
}
