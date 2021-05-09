<div class="p-6">
    <div class="sm:mt-0">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <h6>STOCK ENTRY</h6>
                <div class="px-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="company_website" class="block text-sm font-medium text-gray-700">
                                Reference No.
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-jet-input wire:model="refno"
                                    class="block w-full {{ $errors->has('refno') ? 'border-red-300' : '' }}" type="text"
                                    disabled />
                                <span wire:click="generateReferenceNo"
                                    class="inline-flex items-center px-3 border border-l-0  rounded-md border-gray-300 bg-gray-50 text-blue-500 text-sm cursor-pointer">
                                    Generate
                                </span>
                            </div>
                            @error('refno') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Vendor') }}" />
                            @if (!is_null($vendors))
                            <select wire:model="vendorId" wire:change.debounce.500ms="getVendorDetails"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full {{ $errors->has('vendorId') ? 'border-red-300' : '' }}">
                                <option value="">---</option>
                                @foreach ($vendors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @endif
                            @error('vendorId') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-6 gap-6 pt-2">

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Stock In By') }}" />
                            <x-jet-input
                                class="block mt-1 w-full {{ $errors->has('stock_in_by') ? 'border-red-300' : '' }}"
                                type="text" wire:model.debounce.500ms="stock_in_by" />
                            @error('stock_in_by') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Contact Person') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" wire:model="contact_person" disabled />
                        </div>

                    </div>

                    <div class="grid grid-cols-6 gap-6 pt-2">

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Stock In Date') }}" />
                            <x-jet-date-input class="block mt-1 w-full" wire:model.debounce.500ms="stock_in_date"
                                type="text" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Address') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" wire:model="address" disabled />
                        </div>

                    </div>

                    <div class="flex pt-4">
                        <x-jet-success-button wire:click="showProductListModal">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="ml-1">{{ __('browse products') }}</span>
                        </x-jet-success-button>

                        @error('productId')<small class="text-red-500 pt-2 mx-2">{{ $message }}</small> @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="md:grid md:grid-cols-1 md:gap-6">
            <div class="px-4 bg-white sm:p-6">
                <div class="-my-8 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div
                            class="shadow border-b rounded-md border-gray-200 h-96 overflow-auto scrollbar scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 scrollbar-thumb-rounded-full">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-600">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            pcode
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            description
                                        </th>
                                        <th scope="col"
                                            class="py-2 text-center text-xs font-medium text-white uppercase tracking-wider">
                                            qty
                                        </th>
                                        <th scope="col" class="px-3 relative py-2">
                                            <span class="sr-only"></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (!empty($items))
                                    @foreach ($this->items as $key => $item)
                                    <tr>
                                        <td class="px-6 py-0 whitespace-nowrap text-sm text-gray-500 font-medium">
                                            {{ $item['productCode'] }}
                                        </td>
                                        <td class="px-6 py-0 whitespace-nowrap text-sm text-gray-500 font-medium">
                                            {{ $item['productDescription']}}
                                        </td>
                                        <td
                                            class="px-6 py-0 whitespace-nowrap text-center text-sm text-gray-500 font-medium">

                                            <div class="flex item-center justify-center">

                                                <svg wire:click.prevent="decrement({{ $item['pId'] }})"
                                                    class="h-5 w-5 mr-1 mt-2 cursor-pointer transform rotate-180 fill-current text-green-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <input type="text" wire:model.defer="items.{{ $key }}.qty"
                                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 text-center focus:ring-opacity-50 text-xs rounded-md shadow-sm w-16"
                                                    value="{{ $item['qty']}}" type="text">

                                                <svg wire:click.prevent="increment({{ $item['pId'] }})"
                                                    class="h-5 w-5 ml-1 mt-2 cursor-pointer fill-current text-green-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                            </div>

                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex item-center justify-end">
                                                <div wire:click="removeSelectedItem({{ $key }})"
                                                    class="w-4 mr-2 text-gray-500 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex my-6">
            <x-jet-button class="ml-5" wire:click.prevent="create">
                {{ __('Save') }}
            </x-jet-button>
        </div>


    </div>

    <x-jet-modal-lg wire:model="modalFormVisible">
        <x-slot name="title">
            <div class="grid grid-cols-2">
                <div class="relative">
                    {{ __('Search Product') }}
                </div>
                <div class="relative flex justify-end">
                    <div class="md:mt-0">
                        <input type="text"
                            class="bg-white rounded-2xl w-72 px-4 pl-8 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-gray-300 focus:border-indigo-300"
                            wire:model.debounce.500ms="query" x-ref="query" @keydown.window="
                    if (event.keyCode === 113) {
                                                                                        event.preventDefault();
                                                                                        $refs.query.focus();
                                                                                    }
                    " placeholder="Search (Press '[F2]' to focus)">
                        <div class="absolute top-0">
                            <svg class="fill-current w-4 text-gray-500 mt-2 ml-3" viewBox="0 0 24 24">
                                <path class="heroicon-ui"
                                    d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
                            </svg>
                        </div>
                        <div wire:loading="query" class="spinner top-0 right-0 left-96 mt-4"></div>
                    </div>
                </div>

            </div>
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-600">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            pcode
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            description
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only"></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if ($products->count())
                                    @foreach ($products as $item)
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->pcode }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                            {{ $item->name . ' ( ' . $item->size->name . ' )' }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex item-center justify-end">
                                                <div wire:click="addSelectedItem({{ $item->id }})"
                                                    class="w-4 mr-2 text-gray-500 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No results
                                            found!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                {{ $products->links() }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-modal-lg>

</div>

<script>
    window.addEventListener('response', event => {
        Toast.fire({ icon: event.detail.icon, title: event.detail.title})
    })
</script>
