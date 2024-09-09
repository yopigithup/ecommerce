<?php

namespace App\Livewire\Products;

use App\Models\User;
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
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
            ['key' => 'phone', 'label' => 'Phone', 'sortable' => false],
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

        return User::query()->when($this->search, function ($query) {
            return $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
        })
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'email', 'phone']); //['id', 'name', 'email']
    }

    public function render()
    {
        return view(
            'livewire.products.index',
            [
                'users' => $this->products(),
                'headers' => $this->headers()
            ]
        );
    }
}
