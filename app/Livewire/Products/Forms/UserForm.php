<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;
    public string $name;

    #[Validate('email')]
    public string $email;
    public string $phone;

    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'phone' => ['required', Rule::unique('users')->ignore($this->user)],
        ];
    }

    public function setUser(?User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function store() {}

    public function update() {}
}
