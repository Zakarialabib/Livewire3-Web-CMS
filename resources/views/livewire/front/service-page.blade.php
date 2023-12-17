<div>
    @section('title', $service->name)
    {{-- @dd($pageSetting) --}}
    @if ($pageSetting)
        <x-layout-section :pageSetting="$pageSetting" :layout_config="$layout_config" :page="$service->name">
    @endif

    <div class="md:w-3/4 sm:w-full py-6 px-8 border-r-2 border-gray-50 border-dashed">
        <h1 class="font-bold text-center md:text-left lg:text-heading-1 text-2xl md:text-5xl mb-6">
            {{ $service->name }}
        </h1>
        <div class="mx-auto py-6">
            <div class="lg:grid xl:grid-cols-1 md:grid-cols-2 lg:gap-[30px] xl:gap-[50px]">
                <div class="relative flex justify-center">
                    <img class="rounded-2xl mb-[30px] lg:mb-0 lg:flex-1 border"
                        src="{{ asset('images/services/' . $service->image) }}" alt="{{ $service->name }}">
                </div>
                <div class="flex-1 order-1">
                    <span
                        class="inline-block bg-green-800 hover:bg-green-50 text-green-50 hover:text-green-800 py-2 px-8 rounded-[50px] text-sm mb-6 cursor-pointer">
                        {{ $service->type->label() }}
                    </span>

                    <article class="prose-2xl sm:prose-lg md:prose-xl lg:prose-2xl xl:prose-3xl mx-auto">
                        {!! $service->description !!}
                    </article>
                </div>
            </div>
        </div>

    </div>

    @if ($pageSetting)
        </x-layout-section>
    @endif
</div>
