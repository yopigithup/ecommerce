<div>
    <div class="flex flex-wrap items-center flex-1 gap-5">
        <div class="w-full lg:w-auto">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </div>

        <x-dropdown class="btn-outline">
            <x-slot:trigger>
                <x-button class="btn-outline">
                    Category
                    @if (count($this->categories_id))
                        <x-badge value="{{ count($this->categories_id) }}" class="badge-neutral" />
                    @endif
                    <x-icon name="o-chevron-down" />
                </x-button>
            </x-slot:trigger>

            <x-button label="Clear" icon="o-x-mark" @click="$wire.set('categories_id', [])"
                class="w-full btn btn-ghost btn-sm" />

            <x-menu-separator />

            @foreach ($categories as $category)
                <x-menu-item>
                    <x-checkbox label="{{ $category->name }}" value="{{ $category->id }}"
                        wire:model.live="categories_id" @click.stop="" />
                </x-menu-item>
            @endforeach
        </x-dropdown>

        @if (count($categories_id))
            <x-button label="Clear" icon="o-x-mark" wire:click="clearFilters" class="btn" />
        @endif
    </div>

    <x-hr wire:target="search,categories_id,clearFilters" />

    <div class="grid gap-10 md:grid-cols-3 lg:grid-cols-3">
        @foreach ($products as $product)
            <x-card title="{{ $product->sell_price }} Birr">
                <h3>{{ $product->name }}</h3>
                <x-slot:figure>
                    <a wire:navigate href="{{ route('product.show', ['product' => $product->id]) }}"
                        class="cursor-pointer ">
                        <img src="{{ asset($product->url) }}" alt="{{ $product->name }}" />
                    </a>
                </x-slot:figure>
                <x-slot:menu>
                    <x-icon name="o-heart" class="cursor-pointer" />
                </x-slot:menu>

                <x-slot:menu>
                    <x-icon name="o-heart" wire:click="whishList({{ $product->id }})" class="cursor-pointer" />
                </x-slot:menu>

                <x-slot:actions>
                    <x-button label="Show" wire:click="show({{ $product->id }})" class="btn btn-outline btn-sm" />
                </x-slot:actions>


            </x-card>
        @endforeach
    </div>

    <div x-intersect="$wire.loadMore()" />

    <div x-show="$wire.loading">
        <div class="flex flex-col gap-4 mt-3 w-52">
            <div class="w-full h-32 skeleton"></div>
            <div class="h-4 skeleton w-28"></div>
            <div class="w-full h-4 skeleton"></div>
            <div class="w-full h-4 skeleton"></div>
        </div>
    </div>
</div>
