<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Home extends Component
{
    public function mount() {}

    public function render()
    {
        return view('livewire.home');
    }
}
