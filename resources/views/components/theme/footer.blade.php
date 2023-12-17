<footer class="w-full mt-auto bg-green-50 dark:bg-dark-eval-1 text-green-900 dark:text-gray-100">

    <div class="bg-green-100 dark:bg-dark-eval-3 py-10">
        <livewire:front.newsletters-form />
    </div>

    <div class="px-6 mb-6 pt-10">
        <div
            class="grid gap-y-10 gap-x-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center text-center justify-center">
            <div class="relative items-center align-middle text-center justify-center">
                <ul class="flex flex-col gap-3 font-bold items-center justify-between text-center ">
                    <img loading="lazy" src="{{ asset('images/' . Helpers::settings('site_logo')) }}"
                        alt="{{ Helpers::settings('company_name') }}"
                        class="flex flex-col items-center justify-between text-center"
                        style="height:45%;width:45%; justify-items: center;">
                </ul>
                <p
                    class="mt-4 tracking-wide uppercase inline-flex font-bold text-lg text-gray-500 hover:text-sky-800 dark:text-slate-400 dark:hover:text-sky-400">
                    Follow us
                </p>
                <ul class="my-6 flex items-center text-center  justify-center gap-8">
                    <li>
                        <a href="{{ Helpers::settings('social_facebook') }}" target="_blank"
                            class="text-green-900 dark:text-green-400 text-lg hover:text-green-400 dark:hover:text-blue-600 hover:underline focus:underline uppercase">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Helpers::settings('social_instagram') }}" target="_blank"
                            class="text-green-900 dark:text-green-400 text-lg hover:text-green-400 dark:hover:text-blue-600 hover:underline focus:underline uppercase">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Helpers::settings('social_linkedin') }}" target="_blank"
                            class="text-green-900 dark:text-green-400 text-lg hover:text-green-400 dark:hover:text-blue-600 hover:underline focus:underline uppercase">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Helpers::settings('social_tiktok') }}" target="_blank"
                            class="text-green-900 dark:text-green-400 text-lg hover:text-green-400 dark:hover:text-blue-600 hover:underline focus:underline uppercase">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Helpers::settings('social_whatsapp') }}" target="_blank"
                            class="text-green-900 dark:text-green-400 text-lg hover:text-green-400 dark:hover:text-blue-600 hover:underline focus:underline uppercase">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="relative items-center align-middle text-center justify-center">
                <p
                    class="my-4 tracking-wide uppercase inline-flex font-bold text-lg text-gray-500 hover:text-sky-800 dark:text-slate-400 dark:hover:text-sky-400">
                    {{ __('Footer Section 1') }}
                </p>
                <div class="flex flex-col gap-y-4">
                    @foreach (Helpers::getFooterSection1Menu() as $index => $item)
                        <a href="{{ $item['url'] }}" wire:navigate
                            @if ($item['new_window']) target="__blank" @endif
                            class="text-base font-['Rubik'] font-normal text-green-950 dark:text-gray-100 hover:text-green-400 hover:underline focus:underline uppercase">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="flex flex-col gap-y-4 py-4">
                    <p class="text-base text-gray-600 dark:text-gray-100">
                        <span class="text-heading-6 pr-4 text-green-600 dark:text-blue-600">
                            {{ __('Address') }}
                        </span>
                        {{ Helpers::settings('company_address') }}
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-100">
                        <span class="text-heading-6 pr-4 text-green-600 dark:text-blue-600">
                            {{ __('Phone number') }}
                        </span>
                        {{ Helpers::settings('company_phone') }}
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-100">
                        <span class="text-heading-6 pr-4 text-green-600 dark:text-blue-600">
                            {{ __('Email') }}
                        </span>
                        {{ Helpers::settings('company_email_address') }}
                    </p>
                    {{-- <p class="md:w-96 sm:w-auto">
                        <a href="https://goo.gl/maps/wCGxzSLCvkaMhUP99" target="__blank">
                            <img class="relative flex w-full h-full" src="{{ asset('images/map.png') }}"
                                loading="lazy" alt="map">
                        </a>
                    </p> --}}
                </div>

            </div>
        </div>
    </div>

    <div class="bg-green-800 dark:bg-blue-800 text-white dark:text-black py-5 border-t-2 border-transparent">
        <div
            class="px-6 text-black dark:text-white flex flex-col items-center justify-between text-center font-bold gap-4 md:flex-row">
            <div class="text-white">
                {{ Helpers::settings('company_name') }} -
                Copyright ©
                <span class="curr-year">
                    {{ date('Y') }}
                </span>
            </div>
            <div>
                <span class="text-white mr-2">Développé par</span>
                <a href="https://github.com/zakarialabib" target="__blank"
                    class="text-sm mr-2 uppercase text-green-400 hover:underline hover:text-green-200">
                    Zakarialabib
                </a>
            </div>
        </div>
    </div>
</footer>
