<div>
    @section('title', __('Dashboard'))
    <div class="px-10 py-6 bg-white border-b border-gray-200">
        <h1 class="text-3xl font-semibold mb-6">{{ __('Dashboard') }}</h1>

        <div class="grid grid-cols-4 gap-6">

            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.services') }}">
                        {{ __('Service') }}
                    </a>
                </h2>
            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.sections') }}">
                        {{ __('Sections') }}
                    </a>
                </h2>
            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.pages') }}">
                        {{ __('Pages') }}
                    </a>
                </h2>
            </div>
        </div>

        <div class="flex flex-row gap-4 mt-4 ">
            <div class="w-full border bg-gray-50 p-2">
                <h3>
                    <a href="{{ route('admin.contacts') }}"
                        class="hover:text-blue-400 hover:underline focus:text-blue-400">
                        {{ __('Recent Contact') }}
                    </a>
                </h3>
                <x-table>
                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th>{{ __('Client Name') }}</x-table.th>
                            <x-table.th>{{ __('Type') }}</x-table.th>
                            <x-table.th>{{ __('Subject') }}</x-table.th>
                            <x-table.th>{{ __('Created at') }}</x-table.th>
                        </x-table.tr>
                        <x-table.tbody>
                            @foreach ($recentContacts as $contact)
                                <x-table.tr wire:key="{{ $contact->id }}">
                                    <x-table.td>
                                        {{ $contact->name }}
                                    </x-table.td>
                                    <x-table.td>{{ $contact->type->label() }}</x-table.td>
                                    <x-table.td>{{ $contact->subject }}</x-table.td>
                                    <x-table.td>{{ $contact->created_at }}</x-table.td>
                                </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</div>
