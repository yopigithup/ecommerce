<div>
    {{-- bg-slate-200 text-slate-800 --}}
    <div class="flex flex-1 flex-wrap gap-5 items-center">
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
                class="btn btn-ghost btn-sm w-full" />

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

    <div class="grid md:grid-cols-3 lg:grid-cols-3 gap-10">
        @foreach ($products as $product)
            <x-card title="{{ $product->sell_price }} Birr">
                {{ $product->name }}
                <x-slot:figure>
                    <img src="{{ asset($product->url) }}" />
                </x-slot:figure>
                <x-slot:menu>
                    <x-icon name="o-heart" wire:click="whishList({{ $product->id }})" class="cursor-pointer" />
                </x-slot:menu>
                <x-slot:actions>
                    <x-button label="Show" wire:click="show({{ $product->id }})" class="btn-primary" />
                </x-slot:actions>
            </x-card>
        @endforeach

    </div>

    <div x-intersect="$wire.loadMore()" />

    <div x-show="$wire.loading">
        <div class="flex w-52 flex-col gap-4 mt-3">
            <div class="skeleton h-32 w-full"></div>
            <div class="skeleton h-4 w-28"></div>
            <div class="skeleton h-4 w-full"></div>
            <div class="skeleton h-4 w-full"></div>
        </div>
    </div>
</div>
