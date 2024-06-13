<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Crm extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usuarios = User::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.crm', [
            'usuarios' => $usuarios,
        ]);
    }
}