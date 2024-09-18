<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
    public ?string $parent_id;
    public ?string $description;
    public ?bool $status = false;

    public Collection $categoriesSearchable;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->categoriesSearchable = Category::query()
            ->where('name', 'like', "%$value%")
            ->take(15)
            ->orderBy('name')
            ->get();
    }


    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'description' => 'required|max:6500',
            'parent_id' => 'nullable',
            'status' => 'boolean',
        ];
    }


    public function createCategory()
    {
        $data =  $this->validate();

        Category::create($data);

        $this->toast("Category add", "Category successfully added", position: 'toast-bottom');

        return redirect()->to('/categories');
    }
    public function render()
    {
        return view('livewire.Categories.create-category');
    }
}
