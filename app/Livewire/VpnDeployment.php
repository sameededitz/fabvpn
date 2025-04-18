<?php

namespace App\Livewire;

use Livewire\Component;

class VpnDeployment extends Component
{
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.vpn-deployment')
        ->extends('layouts.admin')
        ->section('content');
    }
}
