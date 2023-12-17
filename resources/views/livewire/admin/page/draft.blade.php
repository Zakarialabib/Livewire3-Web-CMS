<div x-data="{ sortable: null }" x-init="sortable = new Sortable($refs.menuList, {
    handle: '.drag-handle',
    animation: 150,
    onEnd: function(e) {
        const items = Array.from(e.to.children);
        const ids = items.map(item => item.dataset.id);
        @this.updateMenuOrder(ids);
    }
})">
    <h3 class="text-lg font-semibold mb-2">{{ __('Sections') }}</h3>
    <div x-ref="menuList">
        @php
            $pageSections = Helpers::getSectionByCategory($pageSetting->page_id);
        @endphp
        @forelse ($pageSections as $section)
            <div class="border border-gray-300 rounded-md shadow-sm mb-2 p-2 w-full" wire:loading.class.delay="opacity-50"
                wire:key="section-{{ $section->id }}" data-id="{{ $section->id }}">
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <div class="drag-handle cursor-move">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                        <h3 class="text-lg font-medium cursor-pointer mb-1">
                            {{ $section->title }}
                        </h3>
                    </div>
                </div>
            </div>
            @if ($section->id && $section->page_id)
                <div class="flex flex-row items-center my-auto gap-4">
                    <div class="w-1/2">
                        <x-label for="page" :value="__('Page')" />
                        <select wire:model="page_id"
                            class="p-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                            name="page_id">
                            <option value="">{{ __('Select a Page') }}
                            </option>
                            @foreach ($this->sections as $section)
                                <option value="{{ $section->id }}" @if ($pageSetting->page_id === $section->page_id) selected @endif>
                                    {{ $section->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('page_id')" for="page_id" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-button type="button" primary
                            wire:click="addSection( { id : {{ $section->id }} }, {  page_id : {{ $pageSetting->page_id }} })">
                            {{ __('Add Section') }}
                        </x-button>
                    </div>
                </div>
            @endif
        @empty
            <div class="mb-2 p-2 w-full">
                <p class="text-center text-gray-600">
                    {{ __('No sections found.') }}
                </p>
            </div>
        @endforelse
        {{-- Add a new section --}}
        <div class="border border-gray-300 rounded-md shadow-sm mb-2 p-2 w-full">
            <div class="flex justify-between">
                <div class="flex gap-4">
                    <div class="drag-handle cursor-move">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <h3 class="text-lg font-medium cursor-pointer mb-1">
                        {{ __('New Section') }}
                    </h3>
                </div>
            </div>
            <div class="flex flex-row items-center my-auto gap-4">
                <div class="w-1/2">
                    <x-label for="page" :value="__('Page')" />
                    <select wire:model="page_id"
                        class="p-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                        name="page_id" >
                        <option value="">{{ __('Select a Page') }}
                        </option>
                        @foreach ($this->pages as $page)
                            <option value="{{ $page->id }}" @if ($pageSetting->page_id === $page->id) selected @endif>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('page_id')" for="page_id" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-button type="button" primary
                        wire:click="addSection(null, {  page_id : {{ $pageSetting->page_id }} })">
                        Add Section
                    </x-button>
                </div>
            </div>
        </div>
        {{-- End of new section --}}
    </div>
</div>







@foreach ($layout as $index => $item)
    @if ($config === 'section')
        <form wire:submit.prevent="updateSection({{ $index }})">
            <x-layout-section :pageSetting="$pageSetting" :layout_config="$config">
                <div class="border border-gray-300 rounded-md shadow-sm mb-2 p-2
            wire:loading.class.delay="opacity-50"
                    wire:key="section-{{ $index }}" data-id="{{ $index }}" x-data="{ isMenuOpen: false }">
                    <div class="flex justify-between">
                        <div class="flex gap-4">
                            <div class="drag-handle cursor-move">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <h3 class="text-lg font-medium cursor-pointer mb-1">
                                {{ $config }}
                                {{ $item_id }}
                            </h3>
                        </div>
                        <div class="space-x-2">
                            <x-button primary type="button" @click="isMenuOpen = !isMenuOpen">
                                <i class="fa"
                                    :class="{
                                        'fa-caret-up': isMenuOpen,
                                        'fa-caret-down':
                                            !isMenuOpen
                                    }"
                                    aria-hidden="true"></i>
                            </x-button>
                            <x-button type="button" danger wire:click="deleteSection({{ $index }})"
                                class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </x-button>
                        </div>
                    </div>

                    <!-- Section settings UI here -->
                    <div x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 opacity-0 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="-translate-y-4 scale-95">

                        <div class="grid xl;grid-cols-2 sm-grid-cols-1 gap-6 w-full">
                            <div>
                                <x-label for="section-id-{{ $index }}" :value="'Section'" />
                                <select wire:model.live="layout_config.{{ $index }}.section_id"
                                    {{-- wire:change="updateSectionId({{ $index }})" --}} name="section_id"
                                    class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="" selected>
                                        {{ __('Select a Section') }}
                                    </option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            @if ($config['section_id'] === $section->id) selected @endif>
                                            {{ $section->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="section-font-size-{{ $index }}" :value="'Font Size'" />

                                <select wire:model.live="layout_config.{{ $index }}.font_size"
                                    id="section-font-size{{ $index }}"
                                    name="section-font-size{{ $index }}"
                                    class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                    <option value="" selected>
                                        {{ __('Select a Font Size') }}
                                    </option>
                                    @foreach ($fontSizes as $fontSize)
                                        <option value="{{ $fontSize }}">
                                            {{ $fontSize }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-gray-600 text-{{ $layout_config[$index]['font_size'] }}">
                                    Font Size:
                                    {{ $layout_config[$index]['font_size'] }}
                                </div>
                            </div>
                            <div>
                                <x-label for="section-width-{{ $index }}" :value="'Column Width'" />
                                <input wire:model.live="layout_config.{{ $index }}.width" type="range"
                                    id="section-width{{ $index }}" name="section-width{{ $index }}"
                                    min="1" max="100" class="w-full" />
                                <div class="text-gray-600 text-sm">
                                    Width:
                                    {{ $layout_config[$index]['width'] }}
                                </div>
                            </div>
                            <div>
                                <x-label for="section-height-{{ $index }}" :value="'Column height'" />
                                <input wire:model.live="layout_config.{{ $index }}.height" type="range"
                                    id="section-height{{ $index }}" name="section-height{{ $index }}"
                                    min="1" max="100" class="w-full" />
                                <div class="text-gray-600 text-sm">
                                    height:
                                    {{ $layout_config[$index]['height'] }}
                                </div>
                            </div>

                            <div>
                                <x-label for="section-padding-{{ $index }}" :value="'Padding (px)'" />
                                <input wire:model.live="layout_config.{{ $index }}.padding" type="range"
                                    id="section-padding{{ $index }}"
                                    name="section-padding{{ $index }}" min="0" max="100"
                                    class="w-full" />
                                <div class="text-gray-600 text-sm">
                                    Padding:
                                    {{ $layout_config[$index]['padding'] }}px
                                </div>
                            </div>
                            <div>
                                <!-- Section Margin Range Slider -->
                                <x-label for="section-margin-{{ $index }}" :value="'Margin (px)'" />
                                <input wire:model.live="layout_config.{{ $index }}.margin" type="range"
                                    min="0" max="100" id="section-margin{{ $index }}"
                                    name="section-margin{{ $index }}" class="w-full" />
                                <div class="text-gray-600 text-sm">
                                    Margin:
                                    {{ $layout_config[$index]['margin'] }}px
                                </div>
                            </div>
                            <div>
                                <x-label for="section-bg-color-{{ $index }}" :value="'Background color'" />
                                <input wire:model="layout_config.{{ $index }}.background_color" type="color"
                                    id="section-bg-color{{ $index }}"
                                    name="section-bg-color{{ $index }}" />
                            </div>
                            <div>
                                <x-label for="section-text-color-{{ $index }}" :value="'Text Color'" />
                                <input wire:model="layout_config.{{ $index }}.text_color" type="color"
                                    id="section-text-color{{ $index }}"
                                    name="section-text-color{{ $index }}" />
                            </div>

                            {{-- apply range slider  --}}
                            <div>
                                <x-label for="section-border-width-{{ $index }}" :value="'Border Width'" />
                                <input wire:model="layout_config.{{ $index }}.border.width" type="range"
                                    min="0" max="100" class="w-full"
                                    name="border_width{{ $index }}" />
                            </div>
                            <div>
                                <x-label for="section-border-color-{{ $index }}" :value="'Border Color'" />
                                <input wire:model="layout_config.{{ $index }}.border.color" type="color"
                                    name="border_color{{ $index }}" />
                            </div>
                            <div>
                                <x-label for="section-border-style-{{ $index }}" :value="'Border Style'" />
                                <input wire:model="layout_config.{{ $index }}.border.style" type="text"
                                    name="border_style{{ $index }}" />
                            </div>

                            <div>
                                <x-label for="section-border-radius-{{ $index }}" :value="'Border Radius'" />
                                <input wire:model="layout_config.{{ $index }}.border.radius" type="range"
                                    min="0" max="100" class="w-full"
                                    name="border_radius{{ $index }}" />
                            </div>

                            <div>
                                <x-label for="section-box-shadow-{{ $index }}" :value="'Box Shadow'" />
                                <input wire:model="layout_config.{{ $index }}.box_shadow" type="number"
                                    name="box_shadow{{ $index }}" />
                            </div>

                        </div>
                    </div>
                </div>
            </x-layout-section>
        </form>
    @endif
@endforeach











@if ($layout_config['type'] === 'section')
    <form wire:submit.prevent="updateSection({{ $index }})">
        <x-layout-section :pageSetting="$pageSetting" :layout_config="$layout_config">
            <div class="border border-gray-300 rounded-md shadow-sm mb-2 p-2
                wire:loading.class.delay="opacity-50"
                wire:key="section-{{ $index }}" data-id="{{ $index }}" x-data="{ isMenuOpen: false }">
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <div class="drag-handle cursor-move">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                        <h3 class="text-lg font-medium cursor-pointer mb-1">
                            {{ $layout_config['type'] }}
                            {{ $layout_config['item_id'] }}
                        </h3>
                    </div>
                    <div class="space-x-2">
                        <x-button primary type="button" @click="isMenuOpen = !isMenuOpen">
                            <i class="fa"
                                :class="{
                                    'fa-caret-up': isMenuOpen,
                                    'fa-caret-down':
                                        !isMenuOpen
                                }"
                                aria-hidden="true"></i>
                        </x-button>
                        <x-button type="button" danger wire:click="deleteSection({{ $index }})"
                            class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </x-button>
                    </div>
                </div>

                <!-- Section settings UI here -->
                <div x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200 opacity-0 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="-translate-y-4 scale-95">

                    <div class="grid xl;grid-cols-2 sm-grid-cols-1 gap-6 w-full">
                        <div>
                            <x-label for="section-id" :value="'Section'" />
                            <select wire:model.live="layout_config.item_id" name="section_id"
                                class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                <option value="" selected>
                                    {{ __('Select a Section') }}
                                </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}"
                                        @if ($layout_config['item_id'] === $section->id) selected @endif>
                                        {{ $section->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-label for="section-font-size" :value="'Font Size'" />

                            <select wire:model.live="layout_config.item_style.font_size" id="section-font-size"
                                name="section-font-size"
                                class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                                <option value="" selected>
                                    {{ __('Select a Font Size') }}
                                </option>
                                @foreach ($fontSizes as $fontSize)
                                    <option value="{{ $fontSize }}">
                                        {{ $fontSize }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-gray-600 text-{{ $layout_config['item_style']['font_size'] }}">
                                Font Size:
                                {{ $layout_config['item_style']['font_size'] }}
                            </div>
                        </div>
                        <div>
                            <x-label for="section-width" :value="'Column Width'" />
                            <input wire:model.live="layout_config.item_style.width" type="range" id="section-width"
                                name="section-width" min="1" max="100" class="w-full" />
                            <div class="text-gray-600 text-sm">
                                Width:
                                {{ $layout_config['item_style']['width'] }}
                            </div>
                        </div>
                        <div>
                            <x-label for="section-height" :value="'Column height'" />
                            <input wire:model.live="layout_config.item_style.height" type="range"
                                id="section-height" name="section-height" min="1" max="100"
                                class="w-full" />
                            <div class="text-gray-600 text-sm">
                                height:
                                {{ $layout_config['item_style']['height'] }}
                            </div>
                        </div>

                        <div>
                            <x-label for="section-padding" :value="'Padding (px)'" />
                            <input wire:model.live="layout_config.item_style.padding" type="range"
                                id="section-padding" name="section-padding" min="0" max="100"
                                class="w-full" />
                            <div class="text-gray-600 text-sm">
                                Padding:
                                {{ $layout_config['item_style']['padding'] }}px
                            </div>
                        </div>
                        <div>
                            <!-- Section Margin Range Slider -->
                            <x-label for="section-margin" :value="'Margin (px)'" />
                            <input wire:model.live="layout_config.item_style.margin" type="range" min="0"
                                max="100" id="section-margin" name="section-margin" class="w-full" />
                            <div class="text-gray-600 text-sm">
                                Margin:
                                {{ $layout_config['item_style']['margin'] }}px
                            </div>
                        </div>
                        <div>
                            <x-label for="section-bg-color" :value="'Background color'" />
                            <input wire:model="layout_config.item_style.background_color" type="color"
                                id="section-bg-color" name="section-bg-color" />
                        </div>
                        <div>
                            <x-label for="section-text-color" :value="'Text Color'" />
                            <input wire:model="layout_config.item_style.text_color" type="color"
                                id="section-text-color" name="section-text-color" />
                        </div>

                        {{-- apply range slider  --}}
                        <div>
                            <x-label for="section-border-width" :value="'Border Width'" />
                            <input wire:model="layout_config.item_style.border.width" type="range" min="0"
                                max="100" class="w-full" name="border_width" />
                        </div>
                        <div>
                            <x-label for="section-border-color" :value="'Border Color'" />
                            <input wire:model="layout_config.item_style.border.color" type="color"
                                name="border_color" />
                        </div>
                        <div>
                            <x-label for="section-border-style" :value="'Border Style'" />
                            <input wire:model="layout_config.item_style.border.style" type="text"
                                name="border_style" />
                        </div>

                        <div>
                            <x-label for="section-border-radius" :value="'Border Radius'" />
                            <input wire:model="layout_config.item_style.border.radius" type="range" min="0"
                                max="100" class="w-full" name="border_radius" />
                        </div>

                        <div>
                            <x-label for="section-box-shadow" :value="'Box Shadow'" />
                            <input wire:model="layout_config.item_style.box_shadow" type="number"
                                name="box_shadow" />
                        </div>

                    </div>
                </div>
            </div>
        </x-layout-section>
    </form>
@endif
