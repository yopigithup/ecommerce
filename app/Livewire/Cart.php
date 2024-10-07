<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]       // <-- Here is the `empty` layout
#[Title('Cart')]
class Cart extends Component
{
    public $products = [];
    public $showCart = false;

    public function mount()
    {
        $this->products = session()->get('cart', []);
    }
    public function toggleCart()
    {
        $this->showCart = !$this->showCart;
    }

    public function addToCart($name, $image, $price)
    {
        $product = [
            'name' => $name,
            'image' => $image,
            'price' => $price,
        ];

        session()->push('cart', $product);
        $this->products = session()->get('cart', []);
    }

    public function removeFromCart($productName)
    {
        $this->products = array_filter($this->products, function ($product) use ($productName) {
            return $product['name'] !== $productName;
        });

        session()->put('cart', $this->products);
    }

    public function trashCart()
    {
        // Logic to clear the cart
        session()->forget('cart');
        $this->products = [];
    }

    public function cart()
    {
        return redirect()->route('cart.index'); // Ensure this route is defined
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
