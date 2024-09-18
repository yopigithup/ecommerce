<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="editCategory">
        <x-input label="Name" wire:model="name" />

        <x-choices label="Category" wire:model="parent_id" :options="$categoriesSearchable" single searchable />

        <x-textarea label="Description" wire:model="description" hint="Max 1000 chars" rows="5" inline />

        <x-toggle label="Status" wire:model="status" />

        <x-slot:actions>
            <x-button label="Edit user" class="btn-primary" type="submit" spinner="editCategory" />
        </x-slot:actions>
    </x-form>

</div>
