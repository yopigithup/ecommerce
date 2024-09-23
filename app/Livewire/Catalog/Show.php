<?php

namespace App\Livewire\Catalog;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.guest')]
#[Title('Product show')]
class Show  extends Component
{

    use Toast;


    public ?Product $product;

    public function mount(?Product $product)
    {
        $this->product = $product;
    }

    public function toggleCartItem($product)
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


        $this->toast("Cart updated.", "Cart updated.", position: 'toast-bottom');
    }

    public function toggleLike($product)
    {
        dd($product . 'like');
    }

    public function render()
    {
        return view('livewire.catalogs.show', [
            "product" => $this->product
        ]);
    }
}
