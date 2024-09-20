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
                    <img src="https://picsum.photos/500/200" />
                </x-slot:figure>
                <x-slot:menu>
                    <x-icon name="o-heart" class="cursor-pointer" />
                </x-slot:menu>
                <x-slot:actions>
                    <x-button label="Show" class="btn-primary" />
                </x-slot:actions>
            </x-card>
        @endforeach

        <x-card title="Apple - 10 Birr">
            Fresh and crunchy apples.
            <x-slot:figure>
                <img src="https://images.pexels.com/photos/70746/strawberries-red-fruit-royalty-free-70746.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    alt="Apple" />

            </x-slot:figure>
            <x-slot:menu>
                <x-icon name="o-heart" class="cursor-pointer" />
            </x-slot:menu>
            <x-slot:actions>
                <x-button label="Show" class="btn-primary" />
            </x-slot:actions>
        </x-card>

        <x-card title="Carrot - 5 Birr">
            Healthy and fresh carrots.
            <x-slot:figure>
                <img src="https://images.pexels.com/photos/1630588/pexels-photo-1630588.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    alt="Carrot" />
            </x-slot:figure>
            <x-slot:menu>
                <x-icon name="o-heart" class="cursor-pointer" />
            </x-slot:menu>
            <x-slot:actions>
                <x-button label="Show" class="btn-primary" />
            </x-slot:actions>
        </x-card>
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
