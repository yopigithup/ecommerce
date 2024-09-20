<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    public ?User $user;

    #[Validate]
    public ?string $phone;

    public ?string $bio;

    public $avatar_url;

    public function setProfile(?User $user): void
    {
        $this->user = $user;
        $this->avatar_url = $user->avatar_url;
        $this->bio = $user->bio;
        $this->phone = $user->phone;
    }

    public function rules(): array
    {
        return [
            'phone' => [
                'nullable',
                Rule::unique('users')->ignore($this->user),
                'regex:/^(\+251|251|0)?(9|7)(\d){8}$/'
            ],

            'bio' => 'nullable|max:65535',

            'avatar_url' => [
                Rule::when(
                    stripos($this->avatar_url, 'avatar') === false,
                    [
                        'nullable',
                        'image',
                        'mimes:jpeg,png,gif,webp',
                        'max:1024' //1MB
                    ],
                    [
                        'nullable',
                    ]
                ),

            ]
        ];
    }

    public function removeProfileAvatar(): bool
    {
        if (Storage::disk('public')->exists($this->user->avatar_url)) {
            Storage::disk('public')->delete($this->user->avatar_url);
            $this->user->update(['avatar_url' => null]);
            $this->reset('avatar_url');
            return true;
        }

        return false;
    }

    public function update()
    {
        $this->validate();

        $this->user->update($this->only(['phone', 'bio']));
        // true and false => profile update
        // true and true => new file upload
        if ($this->avatar_url && stripos($this->avatar_url, 'avatar') === false) {
            $url = $this->avatar_url->store('avatar', 'public');
            $this->user->update(['avatar_url' => $url]);
        }
    }

    public function store()
    {
        // User::create($this->all())
    }
}
