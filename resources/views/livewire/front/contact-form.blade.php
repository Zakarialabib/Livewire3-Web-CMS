<div>
    <form wire:submit="store">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="flex flex-col justify-center mb-2 gap-2 px-4 max-w-xl mx-auto">
            <div>
                @if ($page === 'Ecoles')
                    <x-input class="flex-1 placeholder:text-gray-400 placeholder:text-md py-2 px-[30px]" type="text"
                        wire:model="school_name" id="school_name" name="school_name" :placeholder="__('School Name')"
                        value="{{ old('school_name') }}" autocomplete="school_name" required />
                @elseif($page === 'Team Building')
                    <x-input class="flex-1 placeholder:text-gray-400 placeholder:text-md py-2 px-[30px]" type="text"
                        wire:model="company_name" id="company_name" name="company_name"
                        :placeholder="__('Company Name')" value="{{ old('company_name') }}" required
                        autocomplete="company_name" />
                @endif
            </div>

            <div>
                @php
                    if ($this->page === 'Team Building') {
                        $placeholder = __('Manager Name');
                    }

                    $placeholder = __('Name');
                @endphp

                <x-input class="flex-1 placeholder:text-gray-400 placeholder:text-md py-2 px-[30px]" type="text"
                    wire:model="name" id="name" name="name" :placeholder="$placeholder" required
                    value="{{ old('name') }}" autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />
            </div>
            <div>
                <x-input class="flex-1 placeholder:text-gray-400 placeholder:text-md py-2 px-[30px]" type="email"
                    wire:model="email" id="email" name="email" placeholder="{{ __('Email') }}" required
                    value="{{ old('email') }}" autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" for="email" class="mt-2" />
            </div>
            <div>
                <x-input class="flex-1 placeholder:text-gray-400 placeholder:text-md py-2 px-[30px]" type="text"
                    wire:model="phone_number" id="phone_number" name="phone_number"
                    placeholder="{{ __('Phone number') }}" value="{{ old('phone_number') }}" autocomplete="mobile" />

                <x-input-error :messages="$errors->get('phone_number')" for="phone_number" class="mt-2" />
            </div>
            <div>
                <textarea id="message" wire:model="message" name="message" placeholder="Message" value="{{ old('message') }}"
                    rows="2"
                    class="w-full h-48 bg-white rounded border border-transparent focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-2 px-[30px] leading-6 transition-colors duration-200 ease-in-out"></textarea>
                <x-input-error :messages="$errors->get('message')" for="subject" class="mt-2" />
            </div>
            <button
                class="flex items-center z-10 relative transition-all duration-200 group px-[22px] py-[15px] lg:px-[32px] lg:py-[22px] rounded-xl bg-green-600 dark:bg-blue-700 hover:bg-green-500 dark:hover:bg-blue-600 text-white hover:text-green-800 text-heading-6 tracking-wide  hover:from-green-500 hover:to-green-700 active:from-green-600 active:to-green-800 focus:ring-green-300 justify-center">
                <span>
                    <div wire:loading wire:target="submit">
                        <x-loading />
                    </div>
                    <span>{{ __('Send Message') }}</span>
                    <i class="fas fa-arrow-right ml-[7px] w-[12px] filter-white group-hover:filter-black"></i>
                </span>
            </button>
        </div>
    </form>
</div>
