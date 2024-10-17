<div
    class="max-w-lg p-6 mx-auto transition-transform transform rounded-lg shadow-lg bg-gradient-to-br from-indigo-200 to-blue-300 hover:scale-105">
    <h2 class="mb-4 text-3xl font-bold text-center text-white">Checkout</h2>

    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-md shadow-md">
        <span class="block text-lg font-medium text-gray-700">
            Invoice Number: <strong>{{ $order->invoice_number }}</strong>
        </span>
        <span class="block text-lg font-medium text-gray-700">
            Total Amount: <strong class="text-green-600">${{ number_format($order->total_price, 2) }}</strong>
        </span>
    </div>

    <div class="flex justify-center mt-6">
        <button wire:click="initiatePayment"
            class="w-full py-2 text-lg font-bold text-white transition duration-200 bg-indigo-600 rounded-md hover:bg-indigo-700">
            Pay Now
        </button>

        {{-- <form action="{{ route('order') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                class="inline-flex items-center px-3 py-2 mx-4 border border-transparent rounded-md shadow-sm bg-gradient-to-r from-white to-blue-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <i class="fa fa-money"></i> Pay Now
            </button> --}}
        {{-- </form> --}}
    </div>

    @if (session()->has('message'))
        <div class="mt-4 text-center text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <div class="mt-6 text-center text-gray-600">
        <p>Your payment is secure and encrypted.</p>
        <p>If you have any questions, feel free to <a href="#" class="text-indigo-600 underline">contact us</a>.
        </p>
    </div>
</div>
