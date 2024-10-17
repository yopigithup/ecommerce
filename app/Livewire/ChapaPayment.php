<?php
/*
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ChapaPayment extends Component
{
    public $order; // Order object

    public function mount($order)
    {
        $this->order = $order;
    }

    public function sendPaymentRequest()
    {
        $data = [
            'amount' => $this->order->total_price, // Use the order total
            'currency' => 'ETB', // Adjust as necessary
            'email' => 'customer@example.com', // You can customize or pass from the order
            'first_name' => 'Customer', // You can customize or pass from the order
            'last_name' => 'Name', // You can customize or pass from the order
            'phone_number' => '0912345678', // You can customize or pass from the order
            'tx_ref' => 'order-' . $this->order->id,
            'callback_url' => route('payment.callback'), // Adjust your callback route
            'return_url' => route('payment.success'), // Adjust your success route
            'customization' => [
                'title' => 'Payment for Order ' . $this->order->invoice_number,
                'description' => 'Payment for Order ' . $this->order->invoice_number,
            ],
            'meta' => [
                'hide_receipt' => 'true'
            ]
        ];

        // Send the request
        $response = Http::withToken('CHASECK-xxxxxxxxxxxxxxxx') // Replace with your API key
            ->post('https://api.chapa.co/v1/transaction/initialize', $data);

        if ($response->successful()) {
            $checkoutUrl = $response->json()['checkoutUrl'] ?? 'unknown';
            return redirect()->to($checkoutUrl); // Redirect to the checkout URL
        } else {
            // Handle error
            $this->dispatchBrowserEvent('payment-error', ['message' => 'Failed to initialize payment: ' . $response->body()]);
        }
    }

    public function render()
    {
        return view('livewire.chapa-payment');
    }
}

*/
