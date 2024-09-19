<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\ProfileForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class Profile extends Component
{
    use WithFileUploads;
    use Toast;

    public ProfileForm $form;

    public function mount(): void
    {
        $this->form->setProfile(Auth::user());
    }

    public function save(): void
    {
        $this->form->update();

        $this->success('Profile successfully updated!!');
    }

    public function removeProfileAvatar(): void
    {
        $isRemoved = $this->form->removeProfileAvatar();

        if (!$isRemoved) {
            $this->error("Profile avatar not found!!");
        }

        $this->success("Profile avatar successfully remove!!");
    }

    public function cancelEditProfile(): void
    {
        $this->redirectRoute('home');
    }

    public function render(): View
    {
        return view('livewire.users.profile');
    }
}
