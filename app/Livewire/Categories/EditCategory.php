<?php

namespace App\Livewire\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class EditCategory extends Component
{
    use Toast;

    public ?Category $category;
    public string $name = "";
    public ?string $description = "";
    public ?bool $status = false;


    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'description' => 'required|max:6500',
            'status' => 'boolean',
        ];
    }

    public function mount(?Category $category)
    {
        // $this->category = Category::find($categoryId);
        $this->category = $category;
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->status = $this->category->status;
    }

    public function editCategory()
    {
        $data = $this->validate();

        $this->category->update($data);

        $this->toast("Category edited", "Category with #{$this->category->id} is successfully edited", position: 'toast-bottom');

        $this->redirectRoute('categories.index');
    }
    public function render()
    {
        return view('livewire.categories.edit-category');
    }
}
