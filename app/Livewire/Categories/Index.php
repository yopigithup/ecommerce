<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;
use Livewire\Component;

class Index extends Component
{

    use Toast;

    public string $search = '';
    public bool $drawer = false;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'parent.name', 'label' => 'Category', 'class' => 'w-64'],
            ['key' => 'status', 'label' => 'Status', 'class' => 'w-1'],
            ['key' => 'created_at', 'label' => 'Created at', 'class' => 'w-1'],
        ];
    }

    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete(string $categoryId): void
    {
        Category::find($categoryId)->delete();

        $this->toast("Category deleted", "Category with #$categoryId is deleted", position: 'toast-bottom');
    }

    public function create()
    {
        $this->redirectRoute("categories.store");
    }

    public function edit(string $categoryId): void
    {
        $this->redirectRoute('categories.update', ['category' => $categoryId]);
    }

    public function categories(): Collection
    {
        // null, "", "0", "false", [], stdClass, Object,....
        //when('') ,if(), empty(), isset() , is_null(), ?? ,?:.....
        //constraint => filter
        $categories =  Category::query()->with(['parent'])
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'description', 'status', 'parent_id', 'created_at']);

        return $categories;
    }

    public function render()
    {
        return view(
            'livewire.categories.index',
            [
                'categories' => $this->categories(),
                'headers' => $this->headers()
            ]
        );
    }
}
