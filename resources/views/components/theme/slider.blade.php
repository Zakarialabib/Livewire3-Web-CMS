@props(['sliders'])
<section x-data="{
    active: 0,
    totalSlides: {{ count($sliders) }},
    slideInterval: 5000,
    autoplay: null,
    touchStartX: 0,
    touchEndX: 0,

    init() {
        this.startAutoplay();
    },

    startAutoplay() {
        this.autoplay = setInterval(() => {
            this.nextSlide();
        }, this.slideInterval);
    },

    stopAutoplay() {
        clearInterval(this.autoplay);
        this.autoplay = null;
    },

    nextSlide() {
        this.stopAutoplay();
        this.active = (this.active + 1) % this.totalSlides;
        this.startAutoplay();
    },

    prevSlide() {
        this.stopAutoplay();
        this.active = (this.active - 1 + this.totalSlides) % this.totalSlides;
        this.startAutoplay();
    },

    goToSlide(index) {
        this.stopAutoplay();
        this.active = index;
        this.startAutoplay();
    },

    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
    },

    handleTouchEnd(e) {
        this.touchEndX = e.changedTouches[0].clientX;
        this.handleSwipeGesture();
    },

    handleSwipeGesture() {
        const threshold = 100;
        const deltaX = this.touchEndX - this.touchStartX;

        if (Math.abs(deltaX) > threshold) {
            if (deltaX > 0) {
                this.prevSlide();
            } else {
                this.nextSlide();
            }
        }
    }
}">
    <div class="relative overflow-hidden min-h-[40rem] bg-black">
        <div class="flex transition-all duration-500 relative" :style="{ left: -(active * 100) + '%' }">
            @foreach ($sliders as $index => $slider)
                <div class="relative min-w-full flex items-center md:h-[300px] min-h-[40rem]">
                    <picture>
                        <source media="(max-width: 800px)" srcset="{{ asset('images/sliders/' . $slider->image) }}">
                        <source media="(max-width: 1920px)" srcset="{{ asset('images/sliders/' . $slider->image) }}">
                        <img src="{{ asset('images/sliders/' . $slider->image) }}" alt="{{ $slider->title }}"
                            class="block absolute inset-0 w-full h-full object-cover object-center z-0">
                    </picture>
                    <div class="absolute bottom-0 w-full h-1/2 z-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div
                        class="flex flex-col max-w-[1400px] items-center mx-auto my-auto text-center relative z-10 px-16 xl:px-24 md:px-18">
                        @if ($slider->subtitle)
                            <div class="my-4 font-bold text-base text-white leading-[0.95]">
                                {{ $slider->subtitle }}
                            </div>
                        @endif
                        <div class="mb-10 lg:text-5xl text-3xl font-heading font-bold text-white leading-normal">
                            {{ $slider->title }}
                        </div>
                        @if ($slider->description)
                            <div class="text-md text-white leading-normal lg:text-sm lg:py-10">
                                {!! $slider->description !!}
                            </div>
                        @endif
                        <div class="flex justify-center text-center mt-10">
                            @if ($slider->link)
                                <button class="items-start cursor-pointer text-center">
                                    <a href="{{ $slider->link }}"
                                        class="flex items-center z-10 relative transition-all duration-200 group px-[22px] py-[15px] lg:px-[32px] lg:py-[22px] rounded-xl bg-green-700 dark:bg-blue-700 text-white hover:bg-green-500 dark:hover:bg-blue-500 hover:text-gray-100 text-heading-6 tracking-wide hover:from-green-500 hover:to-green-700 active:from-green-600 active:to-green-800 focus:ring-green-300">
                                        <span class="block font-semibold">{{ __('Get Start') }}
                                        </span>
                                        <i
                                            class="fas fa-arrow-right ml-[7px] w-[12px] filter-white group-hover:filter-black" /></i>
                                    </a>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
            @foreach ($sliders as $index => $slider)
                <div class="w-14 h-1 bg-gray-300 dark:bg-dark-eval-2 hover:bg-green-700 dark:hover:bg-blue-700  cursor-pointer transition-colors  bg-opacity-50"
                    :class="{ '!bg-green-500': active === {{ $index }} }"
                    @click="goToSlide({{ $index }})"></div>
            @endforeach
        </div>
        <div class="absolute top-1/2 -translate-y-1/2 right-5 text-white dark:text-black hover:text-green-700 dark:hover:text-blue-700 opacity-50 p-4 text-4xl z-10 cursor-pointer transition-colors"
            @click="nextSlide">
            <i class="fa fa-angle-right"></i>
        </div>
        <div class="absolute top-1/2 -translate-y-1/2 left-5 text-white dark:text-black hover:text-green-700 dark:hover:text-blue-700 opacity-50 p-4 text-4xl z-10 cursor-pointer transition-colors"
            @click="prevSlide">
            <i class="fa fa-angle-left"></i>
        </div>
    </div>
</section>
