@livewire('cart-notification')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold"> Cart</h1>

        @if ($carts->isEmpty())
            <p class="text-gray-600">Your cart is empty.</p>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($carts as $cart)
                    <div class="p-4 border rounded-lg">
                        <img src="{{ asset($cart->product->url) }}" alt="{{ $cart->product->name }}"
                            class="object-cover w-full h-48 rounded-md">
                        <h2 class="mt-2 text-lg font-semibold">{{ $cart->product->name }}</h2>
                        <p class="text-gray-600">Price: {{ $cart->product->sell_price }} ETB</p>
                        <div class="flex items-center mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $cart->product->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15.27L16.18 19l-1.64-7.03L20 7.24l-7.19-.61L10 0 7.19 6.63 0 7.24l5.46 4.73L3.82 19z" />
                                </svg>
                            @endfor
                        </div>
                        <button wire:click="removeFromCart({{ $cart->id }})" class="mt-4 btn btn-danger">Remove</button>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold">Total: {{ $carts->sum(fn($cart) => $cart->product->sell_price) }} ETB</h2>
                <button wire:click="trashCart" class="mt-2 btn btn-error">Clear Cart</button>
                <button class="mt-2 btn btn-primary">Checkout</button> <!-- Add your checkout logic here -->
            </div>
        @endif
    </div>
@endsection
