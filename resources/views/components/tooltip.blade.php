<div x-data="{ openTooltip: false }">
    <button @click="openTooltip = true" class="ml-2">select a color </button>
    <div x-show="openTooltip" @click.away="openTooltip = false">
        <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90" class="tooltip">
            {{ $slot }}
        </div>
    </div>
</div>
