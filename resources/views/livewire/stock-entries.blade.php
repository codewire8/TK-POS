<div class="p-6">
    <div class="mt-10 sm:mt-0">

        <div class="md:grid md:grid-cols-2 md:gap-6">

            <div class="mt-5 md:mt-0 md:col-span-2">
                <h6>STOCK ENTRY</h6>
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-3">
                            <label for="company_website" class="block text-sm font-medium text-gray-700">
                                Reference No.
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-jet-input wire:model="refno" class="block w-full border" type="text" disabled />
                                <span wire:click="generateReferenceNo"
                                    class="inline-flex items-center px-3 border border-l-0  rounded-md border-gray-300 bg-gray-50 text-blue-500 text-sm cursor-pointer">
                                    Generate
                                </span>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="vendor" value="{{ __('Vendor') }}" />
                            @if (!is_null($vendors))
                            <select id="size" wire:model="vendorId" wire:change.debounce.500ms="getVendorDetails"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">---</option>
                                @foreach ($vendors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @endif
                            @error('vendor') <span class="error">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-6 gap-6 pt-2">

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Stock In By') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" />
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Contact Person') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" wire:model="contact_person" disabled />
                        </div>

                    </div>

                    <div class="grid grid-cols-6 gap-6 pt-2">

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Stock In Date') }}" />
                            <x-jet-date-input class="block mt-1 w-full" wire:model="stock_in_date" type="text" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label value="{{ __('Address') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" wire:model="address" disabled />
                        </div>

                    </div>

                    <div class="flex pt-4">
                        <x-jet-secondary-button wire:click="showProductListModal">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="ml-2">{{ __('browse products') }}</span>
                        </x-jet-secondary-button>
                    </div>

                </div>
            </div>

            <div class="flex flex-col">
                <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-1 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-500">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            ref #
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            pcode
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            description
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            qty
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            stock in date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            stock in by
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-2 text-left text-xs font-bold text-white uppercase">
                                            vendor
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <x-jet-modal-lg wire:model="modalFormVisible">
            <x-slot name="title">
                {{ __('Search Product') }}
            </x-slot>

            <x-slot name="content">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                PCode
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                Bar Code
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                Description
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                Brand
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                Category
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                Price
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">
                                                Qty
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only"></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">

                                            </td>

                                        </tr>

                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-modal-lg>

    </div>
