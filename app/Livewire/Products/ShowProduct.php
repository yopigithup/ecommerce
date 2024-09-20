<?php

namespace App\Livewire\Products;

use Livewire\Component;

class ShowProduct  extends Component
{

    public $product;

    public function mount($product)
    {
        // dd($product);
    }

    public function render()
    {
        return view('livewire.products.show-product', [
            "product" => $this->product
        ]);
    }
}
