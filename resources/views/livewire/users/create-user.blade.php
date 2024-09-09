<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="createUser">
        <x-input label="Full name" wire:model="name" />
        <x-input label="E-mail" wire:model.blur="email" />
        <x-input label="Phone" wire:model="phone" />

        <x-slot:actions>
            <x-button label="Add user" class="btn-primary" type="submit" spinner="createUser" />
        </x-slot:actions>
    </x-form>

</div>
