<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($productId)
    {
        // Load the product from the database

        $this->product = Product::findOrFail($productId);

        // Assuming you have a Product model
    }

    public function addToCart()
    {
        // Logic to add the product to the cart
        // You can use a session or a cart package
        session()->flash('message', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
