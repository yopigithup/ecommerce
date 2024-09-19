<div class="py-3">
    <x-form wire:submit="save">
        <div>
            <x-file wire:model="form.avatar_url" accept="image/png, image/jpeg">
                <img src="{{ $form?->avatar_url ? 'storage/' . $form->avatar_url : '/empty-user.jpg' }}"
                    class="h-40 rounded-lg" />
            </x-file>
            @if ($form?->avatar_url)
                <x-button label="Remove" class="btn btn-outline btn-sm mt-2" type="button"
                    wire:click="removeProfileAvatar" />
            @endif
        </div>

        <x-input label="Phone" wire:model.blur="form.phone" prefix="+251" />

        <x-textarea label="Bio" wire:model="form.bio" placeholder="Your story ..." hint="Max 1000 chars"
            rows="5" inline />

        <x-slot:actions>
            <x-button label="Cancel" class="btn btn-outline" type="button" wire:click="cancelEditProfile" />
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
