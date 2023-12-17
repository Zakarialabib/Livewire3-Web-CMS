<div>
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Language') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit="create">
                <div class="grid grid-cols-2 py-6 gap-6 px-3 justify-center">
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" type="text" class="block mt-1 w-full" wire:model="name" />
                        <x-input-error :messages="$errors->first('name')" />
                    </div>
                    <div>
                        <x-label for="code" :value="__('Code')" />
                        <x-input id="code" type="text" class="block mt-1 w-full" wire:model="code" />
                        <x-input-error :messages="$errors->first('code')" />
                    </div>
                </div>
                <div class="w-full px-3 mb-4">
                    <x-button type="submit" primary class="w-full">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
