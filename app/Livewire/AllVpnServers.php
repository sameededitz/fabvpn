<?php

namespace App\Livewire;

use Livewire\Component;

class AllVpnServers extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-vpn-servers')
        ->extends('layouts.app')
        ->section('content');
    }
}
