<div class="p-6">
    <div class="grid grid-cols-1 pb-3">
        <div class="relative flex justify-start items-center">
            <div class="md:mt-0">
                <x-jet-label value="{{ __('Start Date') }}" />
                <x-jet-date-input class="block w-full" wire:model.defer="startDate" type="text" />
            </div>
            <div class="md:mt-0 mx-3">
                <x-jet-label value="{{ __('End Date') }}" />
                <x-jet-date-input class="block w-full" wire:model.defer="endDate" type="text" />
            </div>
            <div class="md:mt-5">
                <x-jet-success-button wire:click="read">
                    <svg wire:loading="read" class="h-4 w-4 mr-1 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Filter') }}
                </x-jet-success-button>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow-sm overflow-hidden border border-gray-200 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    ref #
                                </th>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    pcode
                                </th>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    description
                                </th>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    stock in by
                                </th>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    stock in date
                                </th>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    qty
                                </th>
                                <th scope="col" class="px-6 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    vendor
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->refno }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->flavor->pcode }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ Str::limit($item->description, 20) }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->stock_in_by }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ \Carbon\Carbon::parse($item->stock_in_date)->format('F j, Y') }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->qty }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->vendor->name }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No results found!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        {{ $data->links() }}
    </div>
</div>