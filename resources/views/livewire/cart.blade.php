<div>
    <div class="flex flex-col mb-5 sm:mb-8 sm:divide-y sm:border-t sm:border-b">
        <h2 class="mb-2 text-2xl font-bold text-center text-gray-700 md:mb-2 sm:text-2xl"> Cart</h2>

        @if ($carts->isEmpty())
            <div class="mb-6 sm:mb-10 lg:mb-16">
                <h2 class="mb-4 text-2xl font-bold text-center text-gray-800 md:mb-6 lg:text-3xl">
                    Cart empty!!
                </h2>
            </div>
        @else
            @foreach ($carts as $cart)
                <div class="py-5 sm:py-8">
                    <div class="flex flex-wrap gap-4 sm:py-2.5 lg:gap-6">
                        <div class="sm:-my-2.5">
                            <a href="#"
                                class="relative block w-24 h-40 overflow-hidden bg-gray-100 rounded-lg group sm:h-56 sm:w-40">
                                <img src="{{ $cart->product->url }}" loading="lazy" alt="{{ $cart->product->name }}"
                                    class="object-cover object-center w-full h-full transition duration-200 group-hover:scale-110" />
                            </a>
                        </div>
                        <div class="flex flex-col justify-between flex-1">
                            <div>
                                <span
                                    class="block mb-1 font-bold text-gray-800 md:text-lg">{{ $cart->product->sell_price }}
                                    ETB</span>
                                <span class="flex items-center gap-1 text-sm text-gray-500">In stock</span>
                            </div>
                        </div>
                        <div class="flex justify-between w-full pt-4 border-t sm:w-auto sm:border-none sm:pt-0">
                            <div class="flex flex-col items-start gap-2">
                                <div class="flex w-20 h-12 overflow-hidden border rounded">
                                    <input type="number" value="{{ $cart->quantity }}"
                                        class="w-full px-4 py-2 transition duration-100 outline-none ring-inset ring-indigo-300 focus:ring"
                                        readonly />
                                    <div class="flex flex-col border-l divide-y">
                                        <button wire:click="incrementQuantity({{ $cart->id }})"
                                            class="flex items-center justify-center flex-1 w-6 leading-none transition duration-100 bg-white select-none hover:bg-gray-100 active:bg-gray-200">+</button>
                                        <button wire:click="decrementQuantity({{ $cart->id }})"
                                            class="flex items-center justify-center flex-1 w-6 leading-none transition duration-100 bg-white select-none hover:bg-gray-100 active:bg-gray-200">-</button>
                                    </div>
                                </div>
                                <button wire:click="delete({{ $cart->id }})"
                                    class="text-sm font-semibold text-indigo-500 transition duration-100 select-none hover:text-indigo-600 active:text-indigo-700">Delete</button>
                            </div>
                            <div class="pt-3 ml-4 sm:pt-2 md:ml-8 lg:ml-16">
                                <span
                                    class="block font-bold text-gray-800 md:text-lg">{{ $cart->product->sell_price * $cart->quantity }}
                                    ETB</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Totals section -->
    @if (!$carts->isEmpty())
        <div class="flex flex-col items-end gap-4">
            <div class="w-full p-4 bg-gray-100 rounded-lg sm:max-w-xs">
                <div class="space-y-1">
                    <div class="flex justify-between gap-4 text-gray-500">
                        <span>Subtotal</span>
                        <span>{{ $totals['subtotal'] }} ETB</span>
                    </div>
                    <div class="flex justify-between gap-4 text-gray-500">
                        <span>Shipping</span>
                        <span>4.99 ETB</span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t">
                    <div class="flex items-start justify-between gap-4 text-gray-800">
                        <span class="text-lg font-bold">Total</span>
                        <span class="flex flex-col items-end">
                            <span class="text-lg font-bold">{{ $totals['total'] }} ETB</span>
                            <span class="text-sm text-gray-500">including VAT</span>
                        </span>
                    </div>
                </div>
            </div>
            <button
                class="inline-block px-8 py-3 text-sm font-semibold text-center text-white transition duration-100 bg-indigo-500 rounded-lg outline-none ring-indigo-300 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">Check
                out</button>
        </div>
    @endif
</div>
