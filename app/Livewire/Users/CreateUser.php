<?php

namespace App\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class CreateUser extends Component
{
    use Toast;
    public string $name;

    #[Validate('email')]
    public string $email;
    public string $phone;
    public string $type;
    public string $selectedUser;

    public array $types = [
        [
            "id" => 'admin',
            "name" => 'Admin'
        ],
        [
            "id" => 'user',
            "name" => 'User'
        ],
        [
            "id" => 'customer',
            "name" => 'Customer'
        ],
    ];

    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'email' => ['required', 'email', Rule::unique('users')],
            'phone' => ['required', Rule::unique('users')],
            'type' => ['required'],
        ];
    }


    public function mount() {}

    public function createUser()
    {
        $this->validate();

        $password = Str::password();

        User::create(
            [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'type' => $this->type,
                'password' => "password",
                'email_verified_at' => Carbon::now(),
            ]
        );

        // channels (sms, email, slack, ....)

        $this->toast("User add", "User successfully added", position: 'toast-bottom');

        return redirect()->to('/users');
    }
    public function render()
    {
        return view('livewire.users.create-user');
    }
}
