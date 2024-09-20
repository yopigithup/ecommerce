<?php

namespace App\Livewire\Catalog;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Product show')]
class Show  extends Component
{

    public ?Product $product;

    public function mount(?Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.catalogs.show', [
            "product" => $this->product
        ]);
    }
}
