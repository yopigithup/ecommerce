<?php

namespace App\Livewire\Catalog;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.guest')]
#[Title('Product show')]
class Show  extends Component
{

    use Toast;

    public ?Product $product;

    public bool $isProductExistInCart = false;

    public function mount(?Product $product)
    {
        $this->product = $product;

        // Cart::find(); searching user id

        $this->isProductExistInCart = Cart::where(['customer_id' => auth()->id(), 'product_id' => $product->id])->first() ? true : false;
    }

    public function addToCartItem($product)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        Cart::firstORCreate(
            [
                'customer_id' => auth()->id(),
                'product_id' => $product
            ],

            [
                'customer_id' => auth()->id(),
                'product_id' => $product,
                'qty' => 1,
            ],
        );

        $this->isProductExistInCart = true;

        $this->dispatch('cart-updated');

        $this->toast("Cart updated.", "Cart updated.", position: 'toast-bottom');
    }

    #[On('item-removed')]
    public function itemRemoved()
    {
        $this->isProductExistInCart = false;
    }

    public function removeToCartItem($product)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        Cart::where(['customer_id' => auth()->id(), 'product_id' => $product])->first()->delete();


        $this->toast("Cart deleted.", "Cart deleted.", position: 'toast-bottom');

        $this->isProductExistInCart = false;

        $this->dispatch('cart-updated');
    }


    public function toggleLike($product)
    {
        ($product . 'like');
    }

    public function render()
    {
        return view('livewire.catalogs.show', [
            "product" => $this->product
        ]);
    }
}
