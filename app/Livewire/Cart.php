<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]       // <-- Here is the `empty` layout
#[Title('Cart')]
class Cart extends Component
{
    public $carts = [];

    public $showCart = false;

    public function mount()
    {
        $this->getCarts();
    }

    public function getCarts()
    {
        $this->carts = CartModel::where('customer_id', auth()->id())->with('product')->get();
    }

    public function delete(CartModel $cartId)
    {
        $cartId->delete();

        $this->getCarts();
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
        $this->carts = session()->get('cart', []);
    }

    public function removeFromCart($productName)
    {
        $this->carts = array_filter($this->carts, function ($product) use ($productName) {
            return $product['name'] !== $productName;
        });

        session()->put('cart', $this->carts);
    }

    public function trashCart()
    {
        // Logic to clear the cart
        session()->forget('cart');
        $this->carts = [];
    }

    public function cart()
    {
        return redirect()->route('cart.index'); // Ensure this route is defined
    }

    public function render()
    {

        return view(
            'livewire.cart'
        );
    }
}
