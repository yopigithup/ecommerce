<!--

<div class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg">
    <h2 class="mb-4 text-2xl font-semibold">Checkout</h2>

    <div class="p-4 mb-4 border border-gray-200 rounded-md">
        <span class="block text-lg font-medium">
            Total Amount: <strong class="text-indigo-600">{{ number_format($amount, 2) }} ETB</strong>
        </span>
    </div>

    <div class="flex justify-center mt-6">
        <button wire:click="sendPaymentRequest" class="btn btn-primary">
            Pay Now
        </button>
    </div>

    @if (session()->has('error'))
<div class="p-4 mt-4 text-red-700 bg-red-100 border border-red-300 rounded-md">
            {{ session('error') }}
        </div>
@endif

    @if (session()->has('success'))
<div class="p-4 mt-4 text-green-700 bg-green-100 border border-green-300 rounded-md">
            {{ session('success') }}
        </div>
@endif

    @if ($response)
<div class="p-4 mt-4 border border-gray-200 rounded-md">
            <strong>Response:</strong>
            <pre>{{ json_encode($response, JSON_PRETTY_PRINT) }}</pre>
        </div>
@endif
</div>
-->
