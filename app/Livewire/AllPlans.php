<?php

namespace App\Livewire;

use \App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class AllPlans extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deletePlan($planId)
    {
        $plan = Plan::find($planId);

        if ($plan) {
            $plan->delete();
            $this->dispatch('sweetAlert', title:'Plan Deleted', message: 'Plan has been deleted successfully.', type: 'success');
        } else {
            $this->dispatch('sweetAlert', title:'Plan Not Found', message: 'Plan not found.', type: 'error');
        }
    }

    public function render()
    {
        $plans = Plan::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-plans', compact('plans'))
            ->extends('layouts.app')
            ->section('content');
    }
}
