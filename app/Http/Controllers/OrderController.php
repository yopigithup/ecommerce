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
        $data = [
            'amount' => 100,
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
            // $order->status = 1; // Update the status to "paid"
            // $order->save(); // Save the changes to the order
            return redirect($payment['data']['checkout_url']);
        } else {
            return redirect()->back()->with('error', 'Failed to initialize payment.');
        }
    }

    // public function showOrders()
    // {
    //     // Fetch all orders, you can add pagination if needed
    //     $orders = Order::all(); // Or use pagination: Order::paginate(10);
    //     return view('orders.table', compact('orders'));
    // }
}
