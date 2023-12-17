@props(['item', 'view', 'route', 'imagePath'])

@if ($view == 'list')
    <div
        class="flex flex-wrap items-center bg-gray-50 rounded-lg w-full border-2 border-green-800 transition duration-300 ease-in-out delay-200 transform shadow-md md:hover:scale-105 mb-4">
        <a href="{{ route($route, $item->slug) }}"
            class="w-full lg:w-1/2 flex items-center md:items-start relative h-full transition-all duration-300 group-hover:scale-110 group-hover:opacity-75"
            style="background-image: url( {{ $imagePath }} )
                ;background-size: cover;background-position: center;height:27rem">
            @if ($item->type)
                <div
                    class="absolute top-0 left-0 p-4 bg-green-600 dark:bg-blue-700 hover:bg-green-500 dark:hover:bg-blue-600 text-white text-center shadow-xl rounded-br-xl">
                    <p class="font-medium leading-leading-tight">
                        {{ $item->type->label() }}
                    </p>
                </div>
            @endif
        </a>
        <div class="w-full lg:w-1/2 py-10 relative">
            <div class="px-4 text-center">
                <a class="block mb-4 text-2xl leading-6 text-gray-800 hover:text-gray-900 font-bold hover:underline"
                    href="{{ route($route, $item->slug) }}">
                    {{ $item->name }}
                </a>
                <div class="flex flex-wrap py-4 gap-8 justify-center items-center">
                    @if ($item->price > 0)
                        <p class="flex items-center">
                            <span class="text-base md:text-lg capitalize">{{ $item->price }} Dh</span>
                        </p>
                    @endif

                    <div class="py-2 w-full">
                        <a href="{{ route($route, $item->slug) }}"
                            class="flex items-center z-10 relative transition-all duration-200 group px-[15px] py-[10px] lg:px-[20px] lg:py-[15px] rounded-xl bg-green-800 dark:bg-gray-500 text-white hover:bg-green-100 hover:text-green-800 text-heading-6 tracking-wide hover:from-green-500 hover:to-green-700 active:from-green-600 active:to-green-800 focus:ring-green-300 justify-center">
                            <span class="block font-semibold">
                                {{ __('Book now') }}
                            </span>
                            <i class="fas fa-arrow-right ml-[7px] w-[12px] filter-white group-hover:filter-black" /></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($view == 'wide')
    <div
        class="flex flex-wrap items-center w-full clear-both text-gray-700 float-left break-words bg-gray-50 rounded-lg border-1 border-gray-100 transform shadow-2xl">
        <a href="{{ route($route, $item->slug) }}"
            class="w-full lg:w-1/2 flex items-center md:items-start relative h-full transition-all duration-300 group-hover:scale-110 group-hover:opacity-75"
            style="background-image: url( {{ $imagePath }} );background-size: cover;background-position: center;height:27rem">
            @if ($item->type)
                <div
                    class="absolute top-0 left-0 p-4 bg-green-600 dark:bg-blue-700 hover:bg-green-500 dark:hover:bg-blue-600 text-white text-center shadow-xl rounded-br-xl">
                    <p class="font-medium leading-leading-tight">
                        {{ $item->type->label() }}
                    </p>
                </div>
            @endif
        </a>

        <div class="w-full lg:w-1/2 relative">
            <div class="w-full items-center flex-col justify-between my-10 px-12">
                <ul class="flex flex-col">
                    @if ($item->price > 0)
                        <li class="text-gray-500 text-sm font-bold mb-3">
                            {{ $item->price }}
                        </li>
                    @endif
                    <li>
                        <a href="{{ route($route, $item->slug) }}"
                            class="text-gray-700 text-bold text-4xl font-semibold mb-3 cursor-pointer">
                            {{ $item->name }}
                        </a>
                    </li>

                </ul>
                <div class="scroll-smooth">
                    <a href="{{ route($route, $item->slug) }}"
                        class="bottom-0 block text-center cursor-pointer border-2 border-green-600 py-3 text-lg front-bold text-green-600 transition ease-in-out duration-300 hover:bg-green-800 hover:text-green-100 focus:bg-green-800 font-semibold uppercase items-center justify-center px-8 z-[1]">
                        {{ __('Book now') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
