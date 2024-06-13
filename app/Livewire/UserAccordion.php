<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserAccordion extends Component
{
    public $usuarios;

    public function mount()
    {
        $this->usuarios = User::all();
    }

    public function render()
    {
        return view('livewire.user-accordion');
    }
}