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
        $purchases = Purchase::query()
            ->when($this->search, fn($query) => $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $this->search . '%')))
            // ->when($this->statusFilter, fn($query) => $query->where('status', $this->statusFilter))
            // ->when($this->amountFilter, fn($query) => $query->where('amount_paid', '<=', $this->amountFilter))
            // ->latest()
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-purchases', compact('purchases'))
            ->extends('layouts.app')
            ->section('content');
    }
}
