<div class="grid grid-cols-2 gap-10 mx-auto">
    <div>
        <img src="{{ asset($product->url) }}" width="500" class="mx-auto rounded-lg shadow-sm">
    </div>

    <div>

        <div class="text-2xl font-bold">
            {{ $product->name }}
        </div>

        <div class="flex flex-wrap gap-3 mt-5">
            <div class="badge badge-neutral">
                ETB {{ $product->sell_price }}
            </div>
        </div>

        <div class="flex gap-3 mt-8">

            @if (!$isProductExistInCart)
                <button wire:key="{{ $product->id }}" wire:click="addToCartItem({{ $product->id }})"
                    class="normal-case btn btn-primary" type="button" wire:target="addToCartItem({{ $product->id }})"
                    wire:loading.attr="disabled">


                    <span wire:loading="" wire:target="addToCartItem({{ $product->id }})"
                        class="w-5 h-5 loading loading-spinner"></span>


                    <!-- ICON -->
                    <span class="block" wire:loading.class="hidden" wire:target="addToCartItem({{ $product->id }})">
                        <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                            data-darkreader-inline-stroke="" style="--darkreader-inline-stroke: currentColor;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                            </path>
                        </svg>
                    </span>

                    <span class="">
                        Add to cart
                    </span>
                </button>
            @else
                <button wire:key="{{ $product->id }}" wire:click="removeToCartItem({{ $product->id }})"
                    class="normal-case btn btn-primary btn-outline btn-error" type="button"
                    wire:target="removeToCartItem({{ $product->id }})" wire:loading.attr="disabled">


                    <span wire:loading="" wire:target="removeToCartItem({{ $product->id }})"
                        class="w-5 h-5 loading loading-spinner"></span>


                    <!-- ICON -->
                    <span class="block" wire:loading.class="hidden"
                        wire:target="removeToCartItem({{ $product->id }})">
                        <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                            data-darkreader-inline-stroke="" style="--darkreader-inline-stroke: currentColor;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                            </path>
                        </svg>
                    </span>

                    <span class="">
                        Remove from cart
                    </span>
                </button>
            @endif
        </div>

        <div class="my-8">
            {{ $product->description }}
        </div>
    </div>
</div>
