<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Mary\Traits\Toast;

class EditUser extends Component
{
    use Toast;
    public ?User $user;
    public string $name;
    public string $email;

    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'email' => ['required', 'email'], //unique
        ];
    }

    public function mount(string $userId)
    {
        $this->user = User::find($userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
    public function editUser()
    {
        $data = $this->validate();

        $this->user->update($data);

        $this->toast("User edited", "User with #{$this->user->id} is successfully edited", position: 'toast-bottom');

        $this->redirectRoute('users.index');
    }
    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
