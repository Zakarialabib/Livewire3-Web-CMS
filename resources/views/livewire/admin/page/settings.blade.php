<div>
    @section('title', __('Page Settings'))
    <x-card>
        <h1 class="text-2xl my-2 pb-4 font-bold">
            {{ __('Page Settings') }}
        </h1>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4">
                <x-theme.accordion :title="__('Add Section to page')">
                    <form wire:submit="save">
                        <div class="w-full px-4 grid grid-cols-2 gap-4">
                            <div class="col-span-full">
                                <x-label for="page_create" :value="__('Page Type')" />
                                <select wire:model.live="page_type" id="page_create" name="page_create"
                                    class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="" selected>{{ __('Select a Page') }}</option>
                                    @foreach (App\Enums\PageType::values() as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('page_type')" for="page_create" class="mt-2" />
                            </div>
                            <div class="col-span-full">
                                <x-label for="page_create" :value="__('Page')" />
                                <select wire:model.live="page_id" id="page_create" name="page_create"
                                    class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="" selected>{{ __('Select a Page') }}</option>
                                    @foreach ($this->pages as $page)
                                        <option value="{{ $page->id }}">
                                            {{ $page->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('page')" for="page_create" class="mt-2" />
                            </div>

                            <div class="col-span-full">
                                <x-label for="selectedSectionId" :value="__('Select Section')" />
                                <select wire:model.live="selectedSectionId" name="createSection" required
                                    class="p-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="" selected>
                                        {{ __('Select a Section') }}</option>
                                    @foreach ($this->sections as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('section_id')" for="selectedSectionId" class="mt-2" />
                            </div>

                            <div class="col-span-full">
                                <x-label for="selectedTemplate" :value="__('Select Templates')" />
                                <select wire:model.live="selectedTemplate" name="selectTemplate" required
                                    class="p-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="" selected>
                                        {{ __('Select a Section') }}</option>
                                    @foreach ($this->templates as $index => $template)
                                        <option value="{{ $index }}">
                                            {{ $template['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('section_id')" for="selectedSectionId" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="create_layout_type" :value="__('Page Layout Type')" />
                                <select wire:model.live="layout_type" name="create_layout_type" id="create_layout_type"
                                    class="p-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="">
                                        {{ __('Select Layout Type') }}
                                    </option>
                                    @foreach ($layoutTypes as $layoutType)
                                        <option value="{{ $layoutType }}">
                                            {{ $layoutType }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-label for="create_sizing" :value="__('Section Sizing')" />
                                <select wire:model.live="sizing" name="create_sizing" id="create_sizing"
                                    class="p-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                    <option value="35">33%</option>
                                    <option value="50">50%</option>
                                    <option value="75">75%</option>
                                    <option value="100">Full/100%</option>
                                </select>

                            </div>
                            <div class="col-span-full">
                                <x-label for="bg_color" :value="__('Select Background color')" />
                                <div class="grid grid-cols-6 gap-4 py-4">
                                    @foreach ($colors as $color)
                                        <button type="button"
                                            class="w-6 h-6 rounded-full bg-{{ $color }}-500 cursor-pointer"
                                            wire:click="selectColor('{{ $color }}')"></button>
                                    @endforeach
                                </div>
                                @if ($selectedColor)
                                    <label for="colorScheme" class="block font-medium mt-4 mb-2">Color
                                        Variations:</label>
                                    <div class="grid grid-cols-6 gap-4">
                                        @foreach ($colorOptions as $index => $colorOption)
                                            <div class="relative">
                                                <button type="button"
                                                    class="w-6 h-6 rounded-full bg-{{ $selectedColor }}-{{ $colorOption }} cursor-pointer"
                                                    wire:click="selectBgColor('{{ $selectedColor }}-{{ $colorOption }}')">
                                                </button>
                                                <span
                                                    class="text-sm font-medium text-gray-500">{{ $colorOption }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Selected Background color Circle -->
                                    <div class="bg-{{ $bg_color }} w-10 h-10 rounded-full mt-2">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 w-full px-4">
                            <x-button type="submit" wire:loading.attr="disabled" primary
                                class="w-full flex justify-center" wire:target="save">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </x-theme.accordion>
            </div>

            <div class="w-full md:w-3/4">
                <div class="mb-4 px-6" x-data="{ isMenuOpen: null }">
                    <x-table>
                        <x-slot name="thead">
                            <x-table.th>
                                #
                            </x-table.th>
                            <x-table.th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Page Name / Type') }}
                            </x-table.th>
                            <x-table.th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Layout Type') }}
                            </x-table.th>
                            <x-table.th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Status') }}
                            </x-table.th>
                            <x-table.th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </x-table.th>
                        </x-slot>
                        <x-table.tbody>
                            @foreach ($this->settings as $index => $pageSetting)
                                <tr class="hover:bg-gray-50" wire:key="setting-{{ $pageSetting->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button
                                            x-on:click="isMenuOpen = (isMenuOpen === {{ $index }}) ? null : {{ $index }}">
                                            <i class="fa fa-caret-down"
                                                :class="{
                                                    'fa-caret-up': isMenuOpen === {{ $index }},
                                                    'fa-caret-down': isMenuOpen !== {{ $index }}
                                                }"
                                                aria-hidden="true">
                                            </i>
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $pageSetting->page->title ?? '' }} - {{ $pageSetting->page_type->label() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $pageSetting->layout_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $pageSetting->status ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <x-button type="button" danger
                                            wire:click="delete( { id : {{ $pageSetting->id }} })"
                                            class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </x-button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50" x-show="isMenuOpen === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95" x-cloak>

                                    <td colspan="5" class="px-6 py-4">
                                        <div x-data="{ sortable: null }" x-init="sortable = new Sortable($el, {
                                            handle: '.drag-handle',
                                            animation: 150,
                                            onEnd: (e) => {
                                                const items = Array.from(e.to.children);
                                                const ids = items.map((item) => item.dataset.id);
                                                @this.reorderSections(ids);
                                            }
                                        })">
                                            <div class="flex flex-{{ $pageSetting->layout_type }}">
                                                @php
                                                    $layout = json_decode($pageSetting->layout_config, true);
                                                @endphp
                                                @foreach ($layout as $key => $layout_config)
                                                    <div class="border border-gray-300 rounded-md shadow-sm mb-2 p-2 relative 
                                                        text-{{ $layout_config['item_style']['font_size'] ?? 'sm' }} bg-{{ $layout_config['item_style']['background_color'] ?? 'transparent' }}"
                                                        style="
                                                     width: {{ $layout_config['item_style']['width'] ?? '100%' }}%;
                                                     height: {{ $layout_config['item_style']['height'] ?? 'auto' }}%;
                                                     color: {{ $layout_config['item_style']['text_color'] ?? 'black' }};
                                                     padding: {{ $layout_config['item_style']['padding'] ?? '' }}px;
                                                     margin: {{ $layout_config['item_style']['margin'] ?? '' }}px;
                                                     border: {{ $layout_config['item_style']['border']['width'] ?? '' }}px {{ $layout_config['item_style']['border']['style'] ?? '' }} {{ $layout_config['item_style']['border']['color'] ?? '' }};
                                                     border-radius: {{ $layout_config['item_style']['border_radius'] ?? '' }}px;
                                                     box-shadow: {{ $layout_config['item_style']['box_shadow'] ?? '' }};"
                                                        wire:loading.class.delay="opacity-50"
                                                        wire:key="layout_config.{{ $key }}"
                                                        data-id="{{ $key }}" x-data="{ isMenuOpen: false }">
                                                        <form wire:submit="updateSection">
                                                            <div class="flex justify-between">
                                                                <div class="flex gap-4">
                                                                    <div class="drag-handle cursor-move">
                                                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                                                    </div>
                                                                    <h3
                                                                        class="text-lg font-medium cursor-pointer mb-1">
                                                                        {{ $layout_config['type'] }} -
                                                                        {{ Helpers::getSectionTitle($layout_config['item_id']) ?? '' }}
                                                                    </h3>
                                                                </div>
                                                                <div class="space-x-2">
                                                                    <x-button primary type="button"
                                                                        wire:click="editSection('{{ $layout_config['type'] }}', {{ $pageSetting->id }}, {{ $key }})"
                                                                        @click="isMenuOpen = !isMenuOpen">
                                                                        <i class="fa fa-edit"
                                                                            :class="{
                                                                                'fa-caret-up': isMenuOpen,
                                                                                'fa-caret-down': !isMenuOpen
                                                                            }"
                                                                            aria-hidden="true"></i>
                                                                    </x-button>
                                                                    <x-button type="button" danger
                                                                        wire:click="deleteSection('{{ $layout_config['type'] }}', {{ $pageSetting->id }} , {{ $key }})"
                                                                        class="text-red-600 hover:text-red-900">
                                                                        <i class="fas fa-trash"></i>
                                                                    </x-button>
                                                                </div>
                                                            </div>

                                                            <div x-show="isMenuOpen"
                                                                x-transition:enter="transition ease-out duration-300 transform origin-top"
                                                                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                                                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                                                x-transition:leave="transition ease-in duration-200 opacity-0 transform origin-top"
                                                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                                                x-transition:leave-end="-translate-y-4 scale-95">
                                                                <div
                                                                    class="grid xl;grid-cols-2 sm-grid-cols-1 py-4 gap-6 w-full">
                                                                    <div>
                                                                        <x-label for="item_id" :value="__('Section')" />
                                                                        <select
                                                                            wire:model.live="layout_config.{{ $key }}.item_id"
                                                                            name="item_id"
                                                                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                                                            <option value="" selected>
                                                                                {{ __('Select a Section') }}
                                                                            </option>
                                                                            @foreach ($this->sections as $section)
                                                                                <option value="{{ $section->id }}"
                                                                                    @if ($layout_config['item_id'] === $section->id) selected @endif>
                                                                                    {{ $section->title }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-font-size"
                                                                            :value="__('Font Size')" />
                                                                        <select
                                                                            wire:model.live="layout_config.{{ $key }}.item_style.font_size"
                                                                            id="section-font-size"
                                                                            name="section-font-size"
                                                                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                                                            <option value="" selected>
                                                                                {{ __('Select a Font Size') }}
                                                                            </option>
                                                                            @foreach ($fontSizes as $fontSize)
                                                                                <option value="{{ $fontSize }}"
                                                                                    @if ($layout_config['item_style']['font_size'] === $fontSize) selected @endif>
                                                                                    {{ $fontSize }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div
                                                                            class="text-gray-600 text-{{ $layout_config['item_style']['font_size'] }}">
                                                                            Font Size:
                                                                            {{ $layout_config['item_style']['font_size'] }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-width"
                                                                            :value="__('Column Width')" />
                                                                        <input
                                                                            wire:model.live="layout_config.{{ $key }}.item_style.width"
                                                                            type="range" id="section-width"
                                                                            name="section-width" min="1"
                                                                            max="100" class="w-full" />
                                                                        <div class="text-gray-600 text-sm">
                                                                            Width:
                                                                            {{ $layout_config['item_style']['width'] }}
                                                                        </div>
                                                                    </div>

                                                                    <div>
                                                                        <x-label for="section-height"
                                                                            :value="__('Column height')" />
                                                                        <input
                                                                            wire:model.live="layout_config.{{ $key }}.item_style.height"
                                                                            type="range" id="section-height"
                                                                            name="section-height" min="1"
                                                                            max="100" class="w-full" />
                                                                        <div class="text-gray-600 text-sm">
                                                                            height:
                                                                            {{ $layout_config['item_style']['height'] }}
                                                                        </div>
                                                                    </div>

                                                                    <div>
                                                                        <x-label for="section-padding"
                                                                            :value="__('Padding (px)')" />
                                                                        <input
                                                                            wire:model.live="layout_config.{{ $key }}.item_style.padding"
                                                                            type="range" id="section-padding"
                                                                            name="section-padding" min="0"
                                                                            max="100" class="w-full" />
                                                                        <div class="text-gray-600 text-sm">
                                                                            Padding:
                                                                            {{ $layout_config['item_style']['padding'] }}px
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <!-- Section Margin Range Slider -->
                                                                        <x-label for="section-margin"
                                                                            :value="__('Margin (px)')" />
                                                                        <input
                                                                            wire:model.live="layout_config.{{ $key }}.item_style.margin"
                                                                            type="range" min="0"
                                                                            max="100" id="section-margin"
                                                                            name="section-margin" class="w-full" />
                                                                        <div class="text-gray-600 text-sm">
                                                                            Margin:
                                                                            {{ $layout_config['item_style']['margin'] }}px
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-bg-color"
                                                                            :value="__('Background color')" />
                                                                        <input
                                                                            wire:model="layout_config.{{ $key }}.item_style.background_color"
                                                                            type="color" id="section-bg-color"
                                                                            name="section-bg-color" />
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-text-color"
                                                                            :value="__('Text Color')" />
                                                                        <input
                                                                            wire:model="layout_config.{{ $key }}.item_style.text_color"
                                                                            type="color" id="section-text-color"
                                                                            name="section-text-color" />
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-border-width"
                                                                            :value="__('Border Width')" />
                                                                        <input
                                                                            wire:model="layout_config.{{ $key }}.item_style.border.width"
                                                                            type="range" min="0"
                                                                            max="100" class="w-full"
                                                                            name="border_width" />
                                                                        <div class="text-gray-600 text-sm">
                                                                            Border Width :
                                                                            {{ $layout_config['item_style']['border']['width'] }}px
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-border-color"
                                                                            :value="__('Border Color')" />
                                                                        <input
                                                                            wire:model="layout_config.{{ $key }}.item_style.border.color"
                                                                            type="color" name="border_color" />
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="section-border-style"
                                                                            :value="__('Border Style')" />
                                                                        <select
                                                                            wire:model="layout_config.{{ $key }}.item_style.border.style"
                                                                            name="border_style">
                                                                            <option value="">
                                                                                {{ __('Select a border style') }}
                                                                            </option>
                                                                            <option value="solid">Solid
                                                                            </option>
                                                                            <option value="dashed">Dashed
                                                                            </option>
                                                                            <option value="dotted">Dotted
                                                                            </option>
                                                                            <option value="double">Double
                                                                            </option>
                                                                            <option value="groove">Groove
                                                                            </option>
                                                                            <option value="ridge">Ridge
                                                                            </option>
                                                                            <option value="inset">Inset
                                                                            </option>
                                                                            <option value="outset">Outset
                                                                            </option>
                                                                            <option value="none">None
                                                                            </option>
                                                                        </select>


                                                                    </div>

                                                                    <div>
                                                                        <x-label for="section-border-radius"
                                                                            :value="__('Border Radius')" />
                                                                        <input
                                                                            wire:model="layout_config.{{ $key }}.item_style.border.radius"
                                                                            type="range" min="0"
                                                                            max="100" class="w-full"
                                                                            name="border_radius" />
                                                                    </div>

                                                                    <div>
                                                                        <x-label for="section-box-shadow"
                                                                            :value="__('Box Shadow')" />
                                                                        <input
                                                                            wire:model="layout_config.{{ $key }}.item_style.box_shadow"
                                                                            type="number" name="box_shadow" />
                                                                    </div>
                                                                </div>
                                                                <x-button type="submit" primary
                                                                    wire:loading.attr="disabled"
                                                                    wire:target="updateSection" class="w-full">
                                                                    {{ __('save') }}
                                                                </x-button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                </div>
                {{ $this->settings->links() }}
            </div>
        </div>
    </x-card>
</div>
