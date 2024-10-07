<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Chapa\Chapa\Facades\Chapa as Chapa;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if there is enough stock available
        if ($product->qty < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $totalPrice = $product->sell_price * $request->quantity;

        // Create the order initially as not paid
        $order = Order::create([
            'customer_id' => Auth::id(),
            'product_id' => $product->id,
            'total_price' => $totalPrice,
            'status' => 0, // Not paid
        ]);

        // Reduce the product quantity
        $product->qty -= $request->quantity; // Fix typo from $request->qantity
        $product->save();

        // $email = Auth::user()->email;

        // // Ensure the email is present
        // if (empty($email)) {
        //     return redirect()->back()->with('error', 'Email is required for payment.');
        // }

        $data = [
            'amount' => $totalPrice,
            'email' => 'zullhila979@gmail.com',
            'tx_ref' => uniqid(),
            'currency' => 'ETB',
            'first_name' => Auth::user()->name,
            'last_name' => '', // Add if available
            'customization' => [
                'title' => 'Order Payment',
                'description' => 'Payment for your cart items.',
            ],
        ];

        // Initialize payment and handle exceptions
        try {
            $payment = Chapa::initializePayment($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error initializing payment: ' . $e->getMessage());
        }

        // Check payment status and update order status if successful
        if ($payment['status'] === 'success') {
            $order->status = 1; // Update the status to "paid"
            $order->save(); // Save the changes to the order
            return redirect($payment['data']['checkout_url']);
        } else {
            return redirect()->back()->with('error', 'Failed to initialize payment.');
        }
    }

    public function showOrders()
    {
        // Fetch all orders, you can add pagination if needed
        $orders = Order::all(); // Or use pagination: Order::paginate(10);
        return view('orders.table', compact('orders'));
    }
}
