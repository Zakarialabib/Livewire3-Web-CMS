@props(['pageSetting', 'layout_config', 'page' => ''])

<section class="flex flex-col md:flex-row">
    {{ $slot }}

    @foreach ($layout_config as $index => $layout)
        <div class="relative
    text-left sm:px-4 w-[{{ $layout['item_style']['width'] ?? '100%' }}%] xs:w-auto
    text-[{{ $layout['item_style']['font_size'] }}] bg-{{ $layout['item_style']['background_color'] ?? 'transparent' }}
    p-[{{ $layout['item_style']['padding'] ?? '' }}px] m-[{{ $layout['item_style']['margin'] ?? '' }}px] "
            style="
            height: {{ $layout['item_style']['height'] ?? 'auto' }}%;
            color: {{ $layout['item_style']['text_color'] ?? 'black' }};
            border: {{ $layout['item_style']['border']['width'] ?? '' }}px {{ $layout['item_style']['border']['style'] ?? '' }} {{ $layout['item_style']['border']['color'] ?? '' }};
            border-radius: {{ $layout['item_style']['border_radius'] ?? '' }}px;
            box-shadow: {{ $layout['item_style']['box_shadow'] ?? '' }};
            ">

            @if ($layout['item_config']['status'])
                <article class="prose">
                    <h3>{{ $layout['item_config']['title'] ?? 'title' }}</h3>
                    <p>{{ $layout['item_config']['description'] }}</p>
                    <a href="{{ $layout['item_config']['link'] }}">
                        {{ $layout['item_config']['link_text'] }}
                    </a>
                    <i class="{{ $layout['item_config']['icon'] }}"></i>
                </article>
            @endif


            @if ($layout['type'] === 'section' && $layout['item_id'])
                @php($section = Helpers::getSection($layout['item_id']))

                <div class="bg-green-50 pt-10 pb-4 px-6 mx-auto relative max-w-full text-center md:text-left">
                    <p class="text-capitalized text-gray-500 uppercase tracking-[2px] mb-[15px]">
                        {{ $section->subtitle }}
                    </p>
                    <h2
                        class="font-bold mx-auto text-2xl md:text-3xl lg:text-heading-1 text-gray-900 mb-5 md:mb-[30px]">
                        {{ $section->title }}
                    </h2>
                </div>

                @if (
                    $pageSetting->page_type->value === 'activity_page' ||
                        $pageSetting->page_type->value === 'workshop_page' ||
                        $pageSetting->page_type->value === 'package_page')
                    <div class="relative lg:flex lg:flex-col lg:gap-[30px]">
                        <div class="flex-1 order-1 mt-4">
                            <livewire:front.contact-form :type="$pageSetting->page_type" :page="$page" lazy />
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endforeach
</section>
