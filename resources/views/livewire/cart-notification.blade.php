<x-dropdown right>
    <x-slot:trigger>
        <x-button label="" icon="o-shopping-cart" class="btn-ghost btn-sm" responsive>
            <x-badge value="{{ $carts->count() }}" class="font-mono badge-primary" />
        </x-button>
    </x-slot:trigger>

    @foreach ($carts as $cart)
        <div class="flex items-center justify-between gap-36">
            <x-avatar :image="$cart->product->url" :title="$cart->product->name" :subtitle="$cart->product->sell_price" class="!w-15 my-6" />
            <x-button label="Trash" icon="o-trash" wire:key="{{ $cart->id }}"
                wire:click="removeFromCart({{ $cart->id }})"
                class="normal-case btn btn-ghost btn-sm btn-error btn-outline" type="button">
            </x-button>
        </div>
    @endforeach
    @if ($carts->isNotEmpty())
        <div class="flex items-center justify-between my-5 gap-25">

            <span>{{ $carts->count() }} item(s)</span>
            <span>{{ $carts->sum(fn($cart) => $cart->product->sell_price) }} ETB</span>

        </div>

        <x-menu-separator />

        <div class="flex items-center justify-between my-5 gap-25">
            <x-button label="Trash" icon="o-trash" wire:click="trashCart" class="btn btn-primary btn-error btn-outline"
                type="button" />

            <x-button label="Go to cart" icon="o-arrow-right" wire:click="cart" class="normal-case btn btn-ghost btn-sm"
                type="button" />

        </div>
    @endif
</x-dropdown>
