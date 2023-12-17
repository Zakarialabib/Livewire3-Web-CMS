<div>
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Service') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit="store">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="title" :value="__('Title')" />
                        <input type="text" name="title" wire:model="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                        <x-input-error :messages="$errors->get('title')" for="title" class="mt-2" />
                    </div>
                </div>

                <div class="w-full">
                    <x-label for="content" :value="__('Description')" />
                    <x-trix name="createContent" wire:model="content" class="mt-1" />
                    <x-input-error :messages="$errors->get('content')" for="content" class="mt-2" />
                </div>

                <div class="w-full">
                    <x-media-upload title="{{ __('Image') }}" name="image" wire:model="image" :file="$image"
                        path="images/services/" single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                </div>

                <div class="text-center py-4">
                    <x-button type="submit" primary>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
