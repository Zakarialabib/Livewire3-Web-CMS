@props(['title', 'options'])
<section class="py-18 2xl:py-36 font-medium overflow-hidden bg-green-50" x-data="{
    expandFaq: null,
    slideIndex: 0,
    totalSlides: {{ count($options) }},
    nextSlide() {
        this.slideIndex = (this.slideIndex + 1) % this.totalSlides;
    },
    prevSlide() {
        this.slideIndex = (this.slideIndex - 1 + this.totalSlides) % this.totalSlides;
    },
    goToSlide(index) {
        this.slideIndex = index;
    }
}">
    <div class="container relative px-4 py-10 mx-auto">

        <h2 class="mb-10 font-heading text-9xl md:text-10xl xl:text-11xl leading-tight">
            {{ $title }}
        </h2>
        <div class="flex transition-all duration-500 relative" :style="{ left: -(slideIndex * 100) + '%' }">
            @foreach ($options as $index => $option)
                <div class="flex-shrink-0 px-4 lg:px-1 w-full lg:w-1/3">
                    <div class="relative py-9 px-16 h-full bg-white rounded-3xl">
                        <h3 class="font-heading mb-4 text-3xl md:text-4xl font-bold leading-tighter">
                            {{ $option->title }}</h3>
                        <a @click="expandFaq = {{ $index }}"
                            class="absolute -bottom-6 right-10 w-12 h-12 bg-green-500 dark:bg-gray-700 rounded-full cursor-pointer flex items-center justify-center">
                            <i class="fa fa-arrow-down text-white"></i>
                        </a>
                        <div x-show="expandFaq === {{ $index }}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="py-10 mt-6 border-t border-gray-200">
                            <p class="text-md">{!! $option->description !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex items-center mx-auto w-full md:w-1/2 xl:w-full max-w-max">
            <a @click="prevSlide" class="mr-4 lg:mr-8 xl:mr-24 cursor-pointer">
                <i class="fa fa-arrow-left"></i>
            </a>
            <div class="flex mx-auto w-56 lg:w-96 bg-gray-100" style="height: 2px;">
                @foreach ($options as $index => $option)
                    <div class="w-14 h-1 bg-gray-300 cursor-pointer transition-colors hover:bg-red-500 bg-opacity-50"
                        :class="{ 'bg-red-500': slideIndex === {{ $index }} }"
                        @click="goToSlide({{ $index }})"></div>
                @endforeach
            </div>
            <a @click="nextSlide" class="ml-4 lg:ml-8 xl:ml-24 cursor-pointer">
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
