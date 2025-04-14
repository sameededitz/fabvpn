<?php

namespace App\Livewire;

use Livewire\Component;

class CreateVpnServers extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-vpn-servers')
        ->extends('layouts.app')
        ->section('content');
    }
}
