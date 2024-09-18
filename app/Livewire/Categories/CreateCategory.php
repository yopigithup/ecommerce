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

    public string $name;
    public ?string $description;
    public ?string $status;


    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'description' => 'required|max:6500',
            'status' => 'boolean',
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
                'description' => $this->descrption,
                'status' => $this->status,
            ]
        );

        // channels (sms, email, slack, ....)

        $this->toast("Category add", "Category successfully added", position: 'toast-bottom');

        return redirect()->to('/categories');
    }
    public function render()
    {
        return view('livewire.Categories.create-category');
    }
}
