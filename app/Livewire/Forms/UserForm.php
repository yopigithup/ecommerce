<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public User $user;
    public string $name;
    public string $email;

    public function setUser($user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function store(array $data) {}

    public function update(string $userId, array $data) {}
}
