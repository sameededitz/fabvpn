<?php

namespace App\Livewire;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;
class AllPurchases extends Component
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
        $purchases =Purchase::query()
            ->when($this->search, function ($query) {
                $query->where('user_id', 'like', '%' . $this->search . '%')
                    ->orWhere('plan_id', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-purchases', compact('purchases'))
        ->extends('layouts.app')
        ->section('content');
    }
}
