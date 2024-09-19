<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="editProduct">
        <x-input label="Name" wire:model="name" />

        <x-choices label="Category" wire:model="category_id" :options="$productsSearchable" single searchable />
        <x-input label="Cost-price" wire:model="Cost Price" />
        <x-input label="Sell price" wire:model="Sell price" />
        <x-textarea label="Description" wire:model="description" hint="Max 1000 chars" rows="5" inline />

        <x-toggle label="Status" wire:model="status" />

        <x-slot:actions>
            <x-button label="Edit Product" class="btn-primary" type="submit" spinner="editProduct" />
        </x-slot:actions>
    </x-form>

</div>
