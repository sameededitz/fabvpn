<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class AllUsers extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $users = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhereDate('created_at', $this->search);
        })
        ->where('role', '!=', 'admin')
        //     ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-users', compact('users'))
        ->extends('layouts.app')
        ->section('content');
    }
}
