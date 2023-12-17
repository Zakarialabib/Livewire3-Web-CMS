<div class="py-2 bg-green-900 text-green-50">
    <div class="px-8 flex items-center justify-between">
        <p class="text-xs text-center font-semibold font-heading hover:text-gray-400 hover:underline">
            <i class="fa fa-phone mr-2"></i> {{ Helpers::settings('company_phone') }}
        </p>
        @if (Auth::check())
            <x-dropdown align="right" width="56">
                <x-slot name="trigger">
                    <div class="flex items-center text-white gap-2">
                        <i class="fa fa-caret-down"></i> {{ Auth::user()->name }}
                    </div>
                </x-slot>

                <x-slot name="content">
                    {{-- if admin show dashboard and settings else show logout --}}
                    @if (Auth::user()->HasRole('admin'))
                        <x-dropdown-link href="{{ route('admin.dashboard') }}">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('admin.settings.index')">
                            {{ __('Settings') }}
                        </x-dropdown-link>
                    @else
                        <x-dropdown-link href="{{ route('front.profile') }}">
                            {{ __('My account') }}
                        </x-dropdown-link>
                    @endif

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @else
            <div class="flex items-center text-white space-x-2">
                <a href="/login" 
                    class="mr-2 text-xs text-center cursor-pointer font-semibold font-heading hover:text-gray-400 hover:underline">{{ __('Login') }}
                </a>
                <a href="/register" 
                    class="ml-2 text-xs text-center cursor-pointer font-semibold font-heading hover:text-gray-400 hover:underline">
                    {{ __('Register') }}</a>
            </div>
        @endif
    </div>
</div>
