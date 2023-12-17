<div>
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Section') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit="store">
                <div class="grid grid-cols-2 gap-4 px-2">
                    <div>
                        <x-label for="title" :value="__('Title')" required />
                        <x-input type="text" name="title" wire:model="title" required placeholder="{{ __('Title') }}"
                            value="{{ old('title') }}" />
                        <x-input-error :messages="$errors->get('title')" for="title" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="page" :value="__('Page')" />
                        <select wire:model="page_id" name="page_id"
                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                            <option value="" selected>{{ __('Select a Page') }}</option>
                            @foreach ($this->pages as $page)
                                <option value="{{ $page->id }}">
                                    {{ $page->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('page')" for="page" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                        <select wire:model="type" class="block w-full px-2 py-1 border border-gray-300 rounded-md">
                            <option value="">
                                {{ __('Select a Type') }}
                            </option>
                            @foreach (App\Enums\PageType::values() as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" for="" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="featured_title" :value="__('Featured title')" />
                        <x-input type="text" name="featured_title" wire:model="featured_title"
                            placeholder="{{ __('Featured title') }}" value="{{ old('featured_title') }}" />
                        <x-input-error :messages="$errors->get('featured_title')" for="featured_title" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="subtitle" :value="__('Subtitle')" />
                        <x-input type="text" name="subtitle" wire:model="subtitle"
                            placeholder="{{ __('Subtitle') }}" value="{{ old('subtitle') }}" />
                        <x-input-error :messages="$errors->get('subtitle')" for="subtitle" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="label" :value="__('Label')" placeholder="{{ __('Text inside button') }}" />
                        <x-input wire:model="label" id="label" type="text" />
                        <x-input-error :messages="$errors->get('label')" for="label" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="link" :value="__('Link')" placeholder="{{ __('Link button') }}" />
                        <x-input wire:model="link" id="link" type="text" />
                        <x-input-error :messages="$errors->get('link')" for="link" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="bg_color" :value="__('Background color')" />
                        <input wire:model="bg_color" id="bg_color" type="color">
                        <x-input-error :messages="$errors->get('bg_color')" for="bg_color" class="mt-2" />
                    </div>
                </div>

                <div class="w-full px-2">
                    <x-label for="description" :value="__('Description')" />
                    <x-trix name="description" wire:model="description" class="mt-1" />
                </div>

                <div class="w-full px-2">
                    <x-media-upload title="{{ __('Image') }}" name="image" wire:model="image" :file="$image"
                        path="images/sections/" single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                </div>

                <div class="text-center py-4">
                    <x-button type="submit" primary wire:loading.attr="disabled" wire:target="store">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
