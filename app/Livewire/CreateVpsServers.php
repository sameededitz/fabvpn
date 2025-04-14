<?php

namespace App\Livewire;

use Livewire\Component;

class CreateVpsServers extends Component
{
    public function render()
    {
          /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-vps-servers')
        ->extends('layouts.app')
        ->section('content');
    }
}
