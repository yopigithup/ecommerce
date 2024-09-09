<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="editUser">
        <x-input label="Full name" wire:model="name" />
        <x-input label="E-mail" wire:model="email" />
        <x-input label="Phone" wire:model="phone" />

        <x-slot:actions>
            <x-button label="Edit user" class="btn-primary" type="submit" spinner="editUser" />
        </x-slot:actions>
    </x-form>

</div>
