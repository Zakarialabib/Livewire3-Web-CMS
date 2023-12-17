<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ mainState, darkMode: false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="preconnect" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="prefetch" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="prerender" href="{{ request()->getSchemeAndHttpHost() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Head Tags -->
    @if (Helpers::settings('head_tags'))
        {!! Helpers::settings('head_tags') !!}
    @endif

    <title>
        @yield('title') || {{ Helpers::settings('site_title') }}
    </title>


    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="title" content="{{ Helpers::settings('seo_meta_title') }}">
        <meta name="description" content="{{ Helpers::settings('seo_meta_description') }}">
        <meta property="og:title" content="{{ Helpers::settings('site_title') }}">
        <meta property="og:description" content="{{ Helpers::settings('seo_meta_description') }}">
        <meta property="og:url" content="/" />
    @endif

    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ Helpers::settings('company_name') }}" />
    <meta name="author" content="{{ Helpers::settings('company_name') }}">
    {{-- <link rel="canonical" href="{{ URL::current() }}"> --}}
    <meta name="robots" content="all,follow">

    <link rel="icon" href="{{ asset('images/' . Helpers::settings('site_favicon')) }}" type="image/x-icon">

    @vite('resources/css/app.css')

    @livewireStyles

    @stack('styles')

    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    @vite('resources/js/app.js')

    @livewireScriptConfig

    <x-livewire-alert::scripts />

    @stack('scripts')

</head>

<body :class="{ 'dark': darkMode }" class="antialiased bg-green-50 text-body font-['Rubik']" x-data="{
    'showContactModal': false,
    focusables() {
        let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
    autofocus() { let focusable = $el.querySelector('[autofocus]'); if (focusable) focusable.focus() },
}"
    @keydown.escape="showContactModal = false" x-cloak>
    <!-- Body Tags -->

    @if (Helpers::settings('body_tags'))
        {!! Helpers::settings('body_tags') !!}
    @endif

    {{-- <x-loading-mask /> --}}

    <section class="relative">

        <x-header vertical />

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset

        <x-theme.footer />

        <x-whatsapp />

        <div class="fixed z-90 bottom-10 left-10 flex justify-center items-center text-white">
            <button type="button"
                class="text-lg font-bold bg-green-600 dark:bg-blue-700 hover:bg-green-500 dark:hover:bg-blue-600 drop-shadow-lg inline-flex rounded-xl px-8 py-3 sm:px-6 sm:py-2"
                @click="showContactModal = true">
                <i class=" fa fa-question-circle text-lg mr-3"></i>
                {{ __('Contact us') }}
            </button>
        </div>

    </section>

    <div x-init="$watch('showContactModal', value => value && setTimeout(autofocus, 50))" x-on:close.stop="showContactModal = false"
        x-on:keydown.escape.window="showContactModal = false"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="showContactModal"
        class="fixed inset-0 overflow-y-auto px-4 py-6 z-50 sm:px-0">
        <div class="fixed inset-0 transform transition-all" x-on:click="showContactModal = false"
            x-show="showContactModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-sm sm:mx-auto"
            x-show="showContactModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="p-5 text-center sm:mt-0 sm:text-left">
                <h2 class="text-lg font-bold text-gray-900">
                    Contact us
                </h2>
            </div>

            <div class="mt-3 text-center sm:mt-0 mx-4">
                <livewire:front.contact-form />
            </div>
        </div>
    </div>

</body>

</html>
