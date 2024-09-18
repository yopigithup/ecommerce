<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="createProduct">
        <x-input label=" Name" wire:model="name" />
        <x-input label="Cost_price" wire:model="Cost_price" />
        <x-input label="Sell_price" wire:model="Sell_price" />
        <x-textarea label="Description" wire:model="description" placeholder="description ..." hint="Max 1000 chars"
            rows="5" inline />

        <x-toggle label="Status" wire:model="status" />
        <x-slot:actions>
            <x-button label="Add product" class="btn-primary" type="submit" spinner="createProduct" />
        </x-slot:actions>
    </x-form>

</div>
