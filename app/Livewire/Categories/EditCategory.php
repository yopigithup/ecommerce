<?php

namespace App\Livewire\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class EditCategory extends Component
{
    use Toast;

    public ?Category $category;
    public string $name = "";
    public ?string $parent_id = null;
    public ?string $description = "";
    public ?bool $status = false;

    public Collection $categoriesSearchable;


    public function search(string $value = '')
    {
        $this->categoriesSearchable = Category::query()
            ->where('name', 'like', "%$value%")
            ->take(11)
            ->orderBy('name')
            ->get();
    }


    public function rules(): array
    {
        return [
            'name' => 'required|max:190',
            'parent_id' => 'nullable',
            'description' => 'nullable|max:6500',
            'status' => 'boolean',
        ];
    }

    public function mount(?Category $category)
    {
        $this->category = $category;
        $this->name = $this->category->name;
        $this->parent_id = $this->category->parent_id;
        $this->description = $this->category->description;
        $this->status = $this->category->status;

        $this->search();
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
