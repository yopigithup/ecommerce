<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;
use Livewire\Component;

class Index extends Component
{
    use Toast;

    public string $search = '';
    public bool $drawer = false;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        //not secure and not authorized for education purpose only;
        Product::find($id)->delete();

        $this->toast("Product deleted", "User with #$id is deleted", position: 'toast-bottom');
    }

    public function create()
    {
        $this->redirectRoute("products.store");
    }

    public function edit($product): void
    {
        $this->redirectRoute('products.update', ['product' => $product]);
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'code', 'label' => 'Code', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'category.name', 'label' => 'Category', 'class' => 'w-64'],
            ['key' => 'cost_price', 'label' => 'Cost price', 'class' => 'w-64'],
            ['key' => 'sell_price', 'label' => 'Sell price', 'class' => 'w-64'],
            ['key' => 'status', 'label' => 'status', 'class' => 'w-64'],
            ['key' => 'created_at', 'label' => 'Created at', 'class' => 'w-64'],

        ];
    }

    public function products(): Collection
    {
        return Product::query()->when($this->search, function ($query) {
            return $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%")
            ;
        })
            ->orderBy('created_at', 'desc')
            ->get(['id', 'code', 'name', 'category_id', 'cost_price', 'sell_price', 'status', 'created_at']);
    }

    public function render()
    {
        return view(
            'livewire.products.index',
            [
                'products' => $this->products(),
                'headers' => $this->headers()
            ]
        );
    }
}
