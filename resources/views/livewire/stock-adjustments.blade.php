<div class="p-6">

    <div class="relative flex justify-start items-center pb-3">
        <div class="md:mt-0">
            <x-jet-search-input type="text" x-ref="query" wire:model.defer="query" wire:keydown.enter="read" @keydown.window="if (event.keyCode === 113) { event.preventDefault(); $refs.query.focus(); }" />
        </div>
        <div class="md:mt-0 mx-3">
            <x-jet-secondary-button wire:click="read">
                <svg wire:loading="read" class="h-4 w-4 mr-1 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                </svg>
                {{ __('filter') }}
            </x-jet-secondary-button>
        </div>
    </div>

    {{-- The data table --}}

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow border-b rounded-md border-gray-200 overflow-auto">
                    <table class="min-w-full divide-y divide-x divide-gray-200">
                        <thead class="bg-gray-600">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    pcode
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    barcode
                                </th>
                                <th scope="col" class="mx-auto py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    description
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    brand
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    category
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    price
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    stock on hand
                                </th>
                                <th scope="col" class="relative">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->pcode }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->barcode }}
                                </td>
                                <td class="mx-auto py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->name . ' ( ' . $item->size->name . ' )' }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-center text-gray-500 font-medium">
                                    {{ $item->brand->name }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-center text-sm text-gray-500 font-medium">
                                    {{ $item->category->name }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-center text-sm text-gray-500 font-medium">
                                    {{ $item->price }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-center text-sm text-gray-500 font-medium">
                                    {{ $item->qty }}
                                </td>
                                <td class="mx-2 py-2 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex item-center">
                                        <div wire:click.prevent="getSelectedProduct({{ $item->id }})" class="w-4 mr-2 text-gray-500 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                            <svg class="h-4 w-4 transform rotate-90" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="text-right">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="refno" value="{{ __('REFERENCE NO.') }}" />
                                    <x-jet-input id="refno" wire:model.defer="refno" class="block mt-1 w-full bg-gray-100" type="text" disabled />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="refno" value="{{ __('ACTION') }}" />
                                    <select id="brand" wire:model.defer="action" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">---</option>
                                        <option value="ADD TO INVENTORY">ADD TO INVENTORY</option>
                                        <option value="REMOVE FROM INVENTOTY">REMOVE FROM INVENTOTY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-6 gap-6 py-2">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="pcode" value="{{ __('PRODUCT CODE') }}" />
                                    <x-jet-input id="pcode" wire:model.defer="pcode" class="block mt-1 w-full bg-gray-100" type="text" disabled />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="remarks" value="{{ __('REMARKS') }}" />
                                    <x-jet-input id="remarks" class="block mt-1 w-full" type="text" />
                                </div>
                            </div>
                            <div class="grid grid-cols-6 gap-6 py-2">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="desc" value="{{ __('DESCRIPTION') }}" />
                                    <x-jet-input id="desc" wire:model.defer="desc" class="block mt-1 w-full bg-gray-100" type="text" disabled />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="user" value="{{ __('USER') }}" />
                                    <x-jet-input id="user" value="{{ Auth::user()->name }}" class="block mt-1 w-full bg-gray-100" type="text" disabled />
                                </div>
                            </div>
                            <div class="grid grid-cols-6 gap-6 py-2">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="qty" value="{{ __('QUANTITY') }}" />
                                    <x-jet-input id="qty" class="block mt-1 w-full" type="number" />
                                </div>
                                <div class="mt-6">
                                    <x-jet-success-button wire:click.prevent="create">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        {{ __('Save') }}
                                    </x-jet-success-button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>