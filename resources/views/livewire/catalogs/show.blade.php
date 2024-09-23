<div class="mx-auto grid grid-cols-2 gap-10">
    <div>
        <img src="{{ asset($product->url) }}" width="500" class="rounded-lg mx-auto shadow-sm">
    </div>

    <div>

        <div class="font-bold text-2xl">
            {{ $product->name }}
        </div>

        <div class="mt-5 flex flex-wrap gap-3">
            <div class="badge badge-neutral">
                ETB {{ $product->sell_price }}
            </div>
        </div>

        <div class="flex gap-3 mt-8">

            <button wire:key="d176932603aca2e73db1659096251971" wire:click="toggleCartItem({{ $product->id }})"
                class="btn normal-case btn-primary" type="button" wire:target="toggleCartItem({{ $product->id }})"
                wire:loading.attr="disabled">

                <!-- SPINNER LEFT -->
                <span wire:loading="" wire:target="toggleCartItem({{ $product->id }})"
                    class="loading loading-spinner w-5 h-5"></span>

                <!-- ICON -->
                <span class="block" wire:loading.class="hidden" wire:target="toggleCartItem({{ $product->id }})">
                    <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-darkreader-inline-stroke=""
                        style="--darkreader-inline-stroke: currentColor;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                        </path>
                    </svg>
                </span>

                <!-- LABEL / SLOT -->
                <span class="">
                    Add to cart
                </span>

                <!-- ICON RIGHT -->

                <!-- SPINNER RIGHT -->

            </button>

            <!--  Force tailwind compile tooltip classes   -->
            <span class="hidden">
                <span class="lg:tooltip lg:tooltip-left lg:tooltip-right lg:tooltip-bottom lg:tooltip-top"></span>
            </span>

            <button wire:key="6369f3e133b66be12230cdd46283f7f7" wire:click="toggleLike({{ $product->id }})"
                class="btn normal-case !inline-flex lg:tooltip lg:tooltip-top btn-square" type="button"
                data-tip="Wishlist" wire:target="toggleLike({{ $product->id }})" wire:loading.attr="disabled">

                <!-- SPINNER LEFT -->
                <span wire:loading="" wire:target="toggleLike({{ $product->id }})"
                    class="loading loading-spinner w-5 h-5"></span>

                <!-- ICON -->
                <span class="block" wire:loading.class="hidden" wire:target="toggleLike({{ $product->id }})">
                    <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-darkreader-inline-stroke=""
                        style="--darkreader-inline-stroke: currentColor;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z">
                        </path>
                    </svg>
                </span>

                <!-- LABEL / SLOT -->


                <!-- ICON RIGHT -->

                <!-- SPINNER RIGHT -->

            </button>

            <!--  Force tailwind compile tooltip classes   -->
            <span class="hidden">
                <span class="lg:tooltip lg:tooltip-left lg:tooltip-right lg:tooltip-bottom lg:tooltip-top"></span>
            </span>
        </div>

        <div class="my-8">
            {{ $product->description }}
        </div>
    </div>
</div>
