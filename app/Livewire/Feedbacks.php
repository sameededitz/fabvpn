<?php

namespace App\Livewire;

use Livewire\Component;

class Feedbacks extends Component
{
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.feedbacks')
        ->extends('layouts.app')
        ->section('content');
    }
}
