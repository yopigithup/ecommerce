<?php

namespace App\Livewire;

use App\Models\Customer as Client;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.guest')]
#[Title('Login')]
class Customer extends Component
{
    #[Rule('required')]
    public string $name = '';

    #[Rule('required|email|unique:users')]
    public string $email = '';

    #[Rule('required|confirmed')]
    public string $password = '';

    #[Rule('required')]
    public string $password_confirmation = '';

    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/');
        }
    }

    public function register()
    {
        $this->validate();

        $data = $this->except('password_confirmation');


        $user = Client::create($data);


        auth()->login($user);

        request()->session()->regenerate();

        return redirect('/');
    }
    public function render()
    {
        return view('livewire.customer');
    }
}
