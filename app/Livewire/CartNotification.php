<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartNotification extends Component
{
    public $carts;

    // protected $listeners = ['cartUpdated' => 'fetchCartItems'];

    public function mount()
    {
        $this->fetchCartItems();
    }

    #[On('cart-updated')]
    public function fetchCartItems()
    {
        $this->carts = Cart::where('customer_id', auth()->id())->with('product')->get();
    }

    public function removeFromCart(Cart $cart)
    {
        $cart->delete();
        $this->fetchCartItems();
        $this->dispatch('item-removed');
    }

    public function cartDetails()
    {
        dd('cart details');
    }

    public function trashCart()
    {
        Cart::where('customer_id', auth()->id())->delete();

        $this->fetchCartItems();

        $this->dispatch('item-removed');
    }

    public function render()
    {
        return view('livewire.cart-notification');
    }
}
