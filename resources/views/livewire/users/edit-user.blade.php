<div class="mt-10 mx-auto px-9">

    <x-form wire:submit="editUser">
        {{-- Full error bag --}}
        {{-- All attributes are optional, remove it and give a try --}}
        {{-- <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" /> --}}

        <x-input label="Full name" wire:model="name" />
        <x-input label="E-mail" wire:model="email" />

        <x-slot:actions>
            <x-button label="Edit user" class="btn-primary" type="submit" spinner="editUser" />
        </x-slot:actions>
    </x-form>


</div>
