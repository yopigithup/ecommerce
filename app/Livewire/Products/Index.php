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
        $this->redirectRoute('product.update', ['product' => $product]);
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'cost_price', 'label' => 'cost_price', 'class' => 'w-64'],
            ['key' => 'sell_price', 'label' => 'sell_price', 'class' => 'w-64'],
            ['key' => 'status', 'label' => 'status', 'class' => 'w-64'],

        ];
    }

    public function products(): Collection
    {
        // return collect([
        //     ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
        //     ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
        //     ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        // ])
        //     ->sortBy([[...array_values($this->sortBy)]])
        //     ->when($this->search, function (Collection $collection) {
        //         return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
        //     });

        return Product::query()->when($this->search, function ($query) {
            return $query->where('name', 'like', "%{$this->search}%")
                // ->orWhere('Category_id', 'like', "%{$this->search}%")
            ;
        })
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name',]); //['id', 'name', 'email']
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
