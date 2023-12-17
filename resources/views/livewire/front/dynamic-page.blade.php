<div>
    @section('title', $page->title)

    @if ($settings['is_sliders'])
        <section class="w-full mx-auto bg-gray-900 h-auto relative">
            <x-theme.slider :sliders="$this->sliders" />
        </section>
    @endif
    <div class="bg-green-100 dark:bg-gray-800">

        <div class="px-6 flex flex-col justify-center bg-white">
            @if ($settings['is_title'])
                <h1
                    class="my-10 text-3xl md:text-4xl lg:text-5xl text-center leading-tight font-bold lg:text-heading-1 tracking-tighter uppercase cursor-pointer z-10 relative">
                    {{ $page->title }}
                </h1>
            @endif

            @if ($settings['is_description'])
                <article
                    class="my-6 prose-2xl sm:prose-lg md:prose-xl lg:prose-2xl xl:prose-3xl mx-auto px-4 sm:px-6 lg:px-8">
                    <livewire:utils.editor-js editor-id="myEditor" :value="$description" :read-only="true" class="w-full" />
                </article>
            @endif
        </div>
        @if ($settings['is_about'])
            <section class="bg-green-400 dark:bg-dark-eval-2 max-w-full" id="about">
                <div class="items-center w-full px-10 py-12 mx-auto md:px-12 lg:px-24">
                    <div class="flex flex-wrap items-center mx-auto">
                        <div class="md:w-full lg:max-w-lg lg:w-1/2 rounded-xl sm:flex sm:justify-center">
                            <div class="w-full max-w-lg">
                                @if ($this->aboutSection->image != null)
                                    <img src="{{ asset('images/sections/' . $this->aboutSection->image) }}"
                                        class="object-cover object-center mx-auto rounded-lg shadow-xl"
                                        alt="{{ $this->aboutSection->title }}" lazy />
                                @endif
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center lg:flex-grow lg:w-1/2 md:flex-grow px-5 md:w-full py-5 sm:w-full xl:mt-0">
                            <h1
                                class="text-4xl tracking-tight text-white dark:text-gray-800 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                                <span class="block xl:inline font-extrabold">{{ $this->aboutSection->title }}</span>
                                <span class="block text-green-800 dark:text-gray-100 xl:inline">
                                    {{ $this->aboutSection->subtitle }}
                                </span>
                            </h1>
                            <div
                                class="mt-3 mx-auto text-md text-center leading-loose text-white dark:text-gray-400 lg:pr-5 sm:text-md md:my-5 ">
                                {!! $this->aboutSection->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($settings['is_services'])
            <div class="dark:bg-gray-900">
                <div class="grid grid-cols-1 justify-center items-center mx-auto gap-8 px-10 py-16 lg:px-28">
                    <div class="pb-4">
                        <h2 class="text-3xl font-semibold text-green-400 dark:text-blue-400 uppercase tracking-wide">
                            {{ __('We provide you with') }}</h2>
                        <p class="mt-4 text-center text-lg text-gray-800 dark:text-gray-100">
                            {{ __('Commercial and logistical solutions, to serve small and large companies, we can facilitate the delivery of your order from our many points of sale and storage over the globe.') }}
                        </p>
                    </div>

                    <div
                        class="grid grid-cols-3 md:grid-cols-4 sm:grid-cols-2 bg-transpaent my-10 text-center gap-5 lg:px-5 d:mb-0 xl:mt-0">
                        @foreach ($this->services as $service)
                            <div
                                class="flex flex-col px-4 rounded-lg border-1 border-green-800 shadow-md w-full bg-white dark:bg-dark-eval-3">
                                <div class="w-full">
                                    @if ($service?->image)
                                        <img alt="{{ $service->title }}"
                                            src="{{ asset('images/services/' . $service->image) }}"
                                            class="w-full h-16 object-cover shadow-lg" lazy />
                                    @endif
                                </div>
                                <div
                                    class="py-4 px-2 w-full lg:max-w-lg first-letter:mt-2 text-base text-gray-800 dark:text-gray-100">
                                    {!! $service->content !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($settings['is_contact'])
            <div class="bg-gray-100 dark:bg-dark-eval-1 text-black dark:text-white relative px-16 py-10 text-center md:text-left"
                id="contact">
                <div class="mx-auto relative">
                    <img class="hidden md:flex absolute right-0 max-w-[129px] top-[-40px]"
                        src="{{ asset('images/mail.png') }}" alt="mail image" loading="lazy">
                    <p class="text-capitalized text-gray-800 dark:text-white uppercase tracking-[2px] mb-[15px]">
                        {{ $this->contactSection?->subtitle }}
                    </p>
                    <div class="inline-block text-center nd:text-left">
                        <div class="h-6 w-6 bg-green-500 dark:bg-blue-500 mx-auto rounded-full z-0 absolute"></div>
                        <h3
                            class="pb-10 text-3xl md:text-4xl lg:text-5xl leading-tight font-bold lg:text-heading-1  dark:text-gray-100 tracking-tighter uppercase cursor-pointer z-10 relative">
                            <span class="hover:underline transition duration-200 ease-in-out">
                                {{ $this->contactSection?->title }}
                            </span>
                        </h3>
                    </div>
                    <div class="text-base text-gray-600 dark:text-gray-100 mb-10">
                        {!! $this->contactSection?->description !!}
                    </div>
                </div>
                <div class="relative flex flex-col gap-8 mb-[15px] md:mb-[25px] md:flex-row md:gap-[50px]">
                    <div class="flex flex-col gap-[13px] mb-[15px] md:mb-[25px]">
                        <p class="text-base text-gray-600 dark:text-gray-100">
                            <span class="text-heading-6 pr-4 text-green-500 dark:text-blue-500">
                                {{ __('Address') }}
                            </span>
                            {{ Helpers::settings('company_address') }}
                        </p>
                        <p class="text-base text-gray-600 dark:text-gray-100">
                            <span class="text-heading-6 pr-4 text-green-500 dark:text-blue-500">
                                {{ __('Phone number') }}
                            </span>
                            {{ Helpers::settings('company_phone') }}
                        </p>
                        <p class="text-base text-gray-600 dark:text-gray-100">
                            <span class="text-heading-6 pr-4 text-green-500 dark:text-blue-500">
                                {{ __('Email') }}
                            </span>
                            {{ Helpers::settings('company_email_address') }}
                        </p>
                    </div>
                    <div class="flex-1">
                        <livewire:front.contact-form :type="$page->type" :page="$page->title" />
                    </div>
                </div>
            </div>
        @endif

        @if ($settings['is_gallery'])
            <section class="z-10 relative px-10 py-6" x-data="{ activeTab: false }">
                <div class="w-full px-6 text-center nd:text-left">
                    <div class=" h-6 w-6 bg-green-500  rounded-full z-0 absolute "></div>
                    <h3
                        class="pb-10 text-3xl md:text-4xl lg:text-5xl leading-tight font-bold lg:text-heading-1 tracking-tighter uppercase cursor-pointer z-10 relative">
                        <span class="hover:underline transition duration-200 ease-in-out">
                            {{ __('Gallery') }}
                        </span>
                    </h3>
                </div>
                <div
                    class="flex items-center gap-5 justify-center flex-wrap mx-auto w-full py-4 sm:w-[80%] xl:w-full mb-6">
                    @foreach (Helpers::getGalleries() as $gallery)
                        <button type="button"
                            :class="{ ' border-green-900 ': activeTab === '{{ $tag ?? $gallery->tag }}' }"
                            wire:click="selectedTag('{{ $gallery->tag }}')"
                            class="text-gray-600 font-bold bg-gray-50 rounded-full border-transparent transition-all duration-200 cursor-pointer tab-item font-chivo text-sm px-5 py-[10px] text-[14px] leading-[18px] lg:text-[18px] lg:leading-[22px] lg:px-[20px] lg:py-[16px] hover:bg-transparent hover:text-green-900 border-[2px] hover:border-green-900 hover:translate-y-[-2px]"
                            id="{{ $gallery->tag }}" x-on:click="activeTab = '{{ $gallery->tag }}'">
                            {{ $gallery->tag }}
                        </button>
                    @endforeach
                </div>
                <div
                    class="flex-1 w-full grid md:grid-cols-4 sm:sm-grid-cols-1 gap-[20px] md:gap-[30px] items-center py-10 transition-all duration-500 relative">
                    @foreach ($this->gallerySection as $gallery)
                        <div class="relative mx-5">
                            <div
                                class="rounded-2xl p-0 flex items-center bg-white z-10 relative flex-col lg:gap-[50px] lg:flex-row transition duration-300 ease-in-out delay-200 transform shadow-md md:hover:scale-105 ">
                                <div class="block self-stretch flex-1 aspect-[580/421]">
                                    <img class="h-full w-full object-cover rounded-2xl lg:rounded-tr-none lg:rounded-br-2xl"
                                        src="{{ asset('images/gallery/' . $gallery->image) }}">
                                </div>
                            </div>
                            <div class="w-full h-full z-0 -translate-y-[95%] translate-x-[2%] pt-[45px]">
                                <div
                                    class="w-full h-full rounded-2xl bg-opacity-50 transition-all duration-200 bg-bg-2 group-hover:-translate-x-[10px] group-hover:-translate-y-[10px]">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
