@props(['partners'])
<div>
    <div class="px-[12px] md:px-[36px] xl:px-0 mt-[70px]">
        <div class="text-center">
            <h2
                class="font-bold font-chivo mx-auto text-[35px] leading-[44px] md:text-[46px] md:leading-[52px] lg:text-heading-1 text-gray-900 mb-5 md:mb-[30px] max-w-[725px]">
                See why we are trusted the world over
            </h2>
            <p class="text-quote md:text-lead-lg text-gray-600 mx-auto max-w-[976px]">
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum —
                semper quis lectus nulla.
            </p>
        </div>
        <div
            class="flex items-center gap-5 justify-center flex-wrap mx-auto w-full mt-[90px] sm:w-[80%] xl:w-full mb-[58px]">
            <p class="text-gray-600 font-bold bg-gray-100 rounded-full border-transparent transition-all duration-200 cursor-pointer tab-item font-chivo text-sm px-5 py-[10px] text-[14px] leading-[18px] lg:text-[18px] lg:leading-[22px] lg:px-[32px] lg:py-[22px] hover:bg-transparent hover:text-green-900 border-[2px] hover:border-green-900 hover:translate-y-[-2px] active"
                id="{{ $partner->name }}">
                {{ $partner->name }}
            </p>
        </div>
        <div class="tab-content lg:gap-[30px] lg:flex bg-bg-2 branding">
            <div class="p-5 md:p-[60px] lg:w-1/2">
                <h2 class="font-bold font-chivo text-[28px] leading-[32px] md:text-heading-2 mb-[30px]">
                    Optimize and scale, easy to start
                </h2>
                <p class="text-excerpt mb-[40px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <button type="button"> <a
                        class="flex items-center z-10 relative transition-all duration-200 group px-[16px] py-[10px] lg:px-[22px] lg:py-[16px] rounded-[50px] bg-white text-gray-900 hover:bg-gray-900 hover:text-white w-fit"
                        href="#"><span
                            class="block text-inherit w-full h-full rounded-[50px] text-lg font-chivo font-semibold">Learn
                            More</span><i> <img class="ml-[7px] w-[12px] filter-black group-hover:filter-white"
                                src="./assets/images/icons/icon-right.svg" alt="arrow right icon"></i></a></button>
            </div>
            <div class="relative lg:w-1/2"><img class="h-full w-full object-cover" src="./assets/images/thumbnail-1.png"
                    alt="Agon"><img class="absolute top-0 right-0" src="./assets/images/icons/pattern-3.svg"
                    alt="pattern">
                <button
                    class="rounded-full bg-white grid place-items-center absolute play-video w-[135px] h-[135px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 lg:left-0"><img
                        src="./assets/images/icons/icon-play.svg" alt="play button" width="30"></button>
            </div>
        </div>
    </div>
</div>
