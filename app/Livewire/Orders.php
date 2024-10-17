<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Collection;
use Livewire\Component;

class Orders extends Component
{

    public function orders(): Collection
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

        return auth()->user()->orders;
    }
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'cost_price', 'label' => 'cost_price', 'sortable' => false],
            ['key' => 'sell_price', 'label' => 'sell_price', 'sortable' => false],
        ];
    }
    public function render()
    {
        return view(
            'livewire.orders',
            [
                'orders' => $this->orders(),
                'headers' => $this->headers()
            ]
        );
    }
}
