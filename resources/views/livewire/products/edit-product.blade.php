<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="editProduct">
        <x-input label="Name" wire:model="name" />

        <x-choices label="Category" wire:model="category_id" :options="$categoriesSearchable" single searchable />
        <x-input label="Cost-price" wire:model="cost_price" />
        <x-input label="Sell price" wire:model="sell_price" />
        <x-textarea label="Description" wire:model="description" hint="Max 1000 chars" rows="5" inline />

        <x-toggle label="Status" wire:model="status" />

        <x-slot:actions>
            <x-button label="Edit Product" class="btn-primary" type="submit" spinner="editProduct" />
        </x-slot:actions>
    </x-form>

</div>
