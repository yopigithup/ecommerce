<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
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

        // Initialize quantity for each cart item
        foreach ($this->carts as $cart) {
            $cart->quantity = $cart->quantity ?? 1; // Default to 1 if not set
        }
    }

    public function incrementQuantity($cartId)
    {
        $cartItem = CartModel::find($cartId);
        $cartItem->quantity++;
        $cartItem->save();
        $this->getCarts(); // Refresh the cart items
    }

    public function decrementQuantity($cartId)
    {
        $cartItem = CartModel::find($cartId);
        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
        }
        $this->getCarts(); // Refresh the cart items
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
        // Logic to add to cart, assuming quantity is 1 for new items
        $product = [
            'name' => $name,
            'image' => $image,
            'price' => $price,
            'quantity' => 1,
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
        session()->forget('cart');
        $this->carts = [];
    }

    public function calculateTotals()
    {
        $subtotal = $this->carts->sum(function ($cart) {
            return $cart->product->sell_price * $cart->quantity;
        });

        $shipping = 4.99; // Example shipping cost
        $total = $subtotal + $shipping;

        return [
            'subtotal' => $subtotal,
            'total' => $total,
        ];
    }

    public function render()
    {
        return view('livewire.cart', [
            'totals' => $this->calculateTotals(),
        ]);
    }
}
