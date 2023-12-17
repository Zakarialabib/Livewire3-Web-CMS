@props(['label', 'tooltipText', 'tooltipImage' => null])

<div class="mt-4 flex items-center" x-data="{ showTooltip: false }">
    <label for="" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false"
        @click="showTooltip = !showTooltip">
        {{ $label }}
    </label>

    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
        <input type="checkbox"
            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
            {{ $attributes }}>
        <label for=""
            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
    </div>

    <div x-show.transition.duration.200ms="showTooltip" @click.away="showTooltip = false"
        class="tooltip absolute bg-white p-2 rounded shadow-lg flex flex-col gap-6">
        <span class="tooltip-text">{{ $tooltipText }}</span>
        @isset($tooltipImage)
            <img src="{{ $tooltipImage }}" alt="{{ $tooltipText }}" class="w-32 mt-2">
        @endisset
    </div>
</div>
