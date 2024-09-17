<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class CreateCategory extends Component
{
    use Toast;

    public ?Category $category;
    public string $name;
    public ?string $description;
    public ?string $status;


    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
        ];
    }


    public function mount() {}

    public function createCategory()
    {
        $this->validate();
        $password = Str::password();

        Category::create(
            [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => "password",
                'email_verified_at' => Carbon::now(),
            ]
        );

        // channels (sms, email, slack, ....)

        $this->toast("Category add", "Category successfully added", position: 'toast-bottom');

        return redirect()->to('/users');
    }
    public function render()
    {
        return view('livewire.users.create-user');
    }
}
