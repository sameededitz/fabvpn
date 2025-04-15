<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Component;

class AllAdmins extends Component
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
                ->orWhere('role', 'like', '%' . $this->search . '%')
                ->orWhereDate('created_at', $this->search);
        })->where('role', '=', 'admin')
            // ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-admins' , compact('users'))
        ->extends('layouts.app')
        ->section('content');
    }
}
