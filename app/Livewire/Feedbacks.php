<?php

namespace App\Livewire;

use App\Models\UserFeedback;
use Livewire\Component;
use Livewire\WithPagination;

class Feedbacks extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $subject;
    public $message;

    public function mount()
    {
        $this->subject = null;
        $this->message = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $feedbacks = UserFeedback::query()
        ->when($this->search, fn($query) => $query->where('subject', 'like', '%' . $this->search . '%'))
        ->when($this->search, fn($query) => $query->where('email', 'like', '%' . $this->search . '%'))
        // ->latest()
        ->paginate($this->perPage);
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.feedbacks' , compact('feedbacks'))
        ->extends('layouts.app')
        ->section('content');
    }
}
