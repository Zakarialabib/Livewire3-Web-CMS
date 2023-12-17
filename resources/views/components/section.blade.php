@props(['section'])

<div class="px-[12px] md:px-[36px] xl:px-0 mt-0 z-10 relative mx-auto py-[60px] max-w-[1320px] lg:flex lg:items-center">
    <div class="lg:w-[60%] lg:mr-[150px]">
        <span class="inline-block bg-green-200 hover:bg-green-400 text-gray-800 py-4 px-8 rounded-[50px] text-sm mb-6">
            {{ $section->subtitle }}
        </span>
        <h1
            class="text-left font-bold lg:text-display-3 md:text-[45px] md:leading-[52px] text-[35px] leading-[42px] mb-6">
            {{ $section->title }}
        </h1>
        <p class="text-quote md:text-lead-lg text-gray-500 pr-[40px] lg:pr-[60px] mb-[44px] md:w-[36ch]">
            {!! $section->description !!}
        </p>
        <div class="flex items-center justify-start mb-[50px]">
            @if ($section->link)
                <button type="button">
                    <a class="flex items-center z-10 relative transition-all duration-200 group px-[16px] py-[10px] lg:px-[22px] lg:py-[16px] rounded-[50px] bg-gray-900 text-white dark:text-gray-800 hover:bg-gray-100 hover:text-gray-900 text-heading-6 tracking-wide mr-[22px]"
                        href="{{ $section->link }}">
                        <span
                            class="block text-inherit w-full h-full rounded-[50px] text-lg font-semibold">{{ $section->label }}</span>
                        <i class="fas fa-arrow-right ml-[7px] w-[12px] filter-white group-hover:filter-black"></i></a>
                </button>
            @endif
            <i class="fas fa-arrow-right ml-[7px] w-[12px]"></i>
        </div>
    </div>
    <div class="hidden relative lg:block">
        <img class="animate-hero-thumb-sm-animation max-w-[512px] max-h-[689px]"
            src="{{ asset('images/section/' . $section->image) }}" alt="{{ $section->name }}">
    </div>
</div>
