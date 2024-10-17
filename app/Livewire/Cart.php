<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
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

    public function incrementQuantity(CartModel $cartItem)
    {
        $cartItem->increment('qty');

        $this->getCarts(); // Refresh the cart items
    }

    public function checkout($totalAmount)
    {

        DB::transaction(function () use ($totalAmount) {
            $orderExist = Order::where('customer_id', auth()->id())->where('status', 'pending')->first();
            if (empty($orderExist)) {
                //create order
                $order = new Order();
                $order->invoice_number = random_int(100000, 999999);
                $order->total_price = $totalAmount;
                $order->customer_id = auth()->id();
                $order->status = 'pending';
                $order->save();
            } else {
                $orderExist->update(['total_price' => $totalAmount]);
                $orderExist->orderItems()->delete();
            }


            foreach ($this->carts as $cart) {
                //create order detail
                OrderItem::firstOrCreate([
                    'order_id' => $orderExist ? $orderExist->id : $order->id,
                    'product_id' => $cart->product->id,
                    'qty' => $cart->qty,
                ]);
            }


            CartModel::where('customer_id', auth()->id())->delete();

            return $this->redirectRoute('checkout', ['order' => $orderExist ?? $order]);
        });
    }

    public function decrementQuantity(CartModel $cartItem)
    {
        $qty = (int)$cartItem->qty;

        if ($qty > 1) {
            $cartItem->decrement('qty');
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
