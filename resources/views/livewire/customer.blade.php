<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <img src="/logo.jpeg" alt="app logo">
    </div>

    <x-form wire:submit="register">
        <x-input label="Name" wire:model="name" icon="o-user" inline />
        <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
        <x-input label="Password" wire:model="password" type="password" icon="o-key" inline />
        <x-input label="Confirm Password" wire:model="password_confirmation" type="password" icon="o-key" inline />

        <x-slot:actions>
            <x-button label="Already registered?" class="btn-ghost" link="/login" />
            <x-button label="Register" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="register" />
        </x-slot:actions>
    </x-form>
</div>
