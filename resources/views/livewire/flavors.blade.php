<div class="p-6">

    {{-- Create button --}}

    <div class="grid grid-cols-2">
<div class="py-5 relative">
            <div class="relative mt-3 md:mt-0">
                <input type="text"
                    class="bg-white rounded-md w-1/2 px-4 pl-8 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-gray-300 focus:border-indigo-300"
                    wire:model.debounce.500ms="search" x-ref="search" @keydown.window="
                                                                if (event.keyCode === 191) {
                                                                    event.preventDefault();
                                                                    $refs.search.focus();
                                                                }
                                                            " placeholder="Search product (Press '/' to focus)">
                <div class="absolute top-0">
                    <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
                        <path class="heroicon-ui"
                            d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
                    </svg>
                </div>
                <div wire:loading="search" class="spinner top-0 right-1/2 mr-4 mt-4"></div>
            </div>

        </div>
        <div class=" py-5 text-right">
            <x-jet-button wire:click="createShowModal">
                {{ __('New Product') }}
</x-jet-button>
        </div>
    </div>

    {{-- The data table --}}

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
<div class="shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
pcode
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
description
                                </th>
<th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    brand
                                </th>
<th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    category
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    price
                                </th>
<th scope="col" class="py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    re-order level
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
{{ $item->pcode }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
{{ $item->name . ' ( ' . $item->size->name . ' )' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium text-center">
                                        {{ $item->brand->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium text-center">
                                    {{ $item->category->name }}
                                </td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium text-center">
                                    {{ number_format($item->price, 2) }}
                                </td>
<td class="py-4 whitespace-nowrap text-sm text-gray-500 font-medium text-center">
                                    {{ $item->reorder }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-jet-edit-button wire:click="updateShowModal({{ $item->id }})">
                                        <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
<path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-jet-edit-button>
                                    <x-jet-delete-action-button wire:click="deleteShowModal({{ $item->id }})">
                                        <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-jet-delete-action-button>
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


    {{-- Modal Form --}}

    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Product') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
<x-jet-label for="bardcode" value="{{ __('Bar Code') }}" />
                <x-jet-input id="bardcode" class="block mt-1 w-full" type="text" wire:model="barcode" />
                </div>
                <div class="mt-4">
                @if ($modelId)
                <x-jet-label for="name" value="{{ __('Product') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                    wire:keydown.enter="update" />
                @else
                <x-jet-label for="name" value="{{ __('Product') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                    wire:keydown.enter="create" />
                @endif
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
<x-jet-label for="brand" value="{{ __('Brand') }}" />
                @if ($modelId)
<select id="brand" wire:model="brand"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
@foreach ($brands as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @else
<select id="brand" wire:model="brand"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
@foreach ($brands as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @endif
@error('brand') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="category" value="{{ __('Category') }}" />
<select id="category" wire:model="category"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
@foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
@error('category') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="size  " value="{{ __('Size') }}" />
                    <select id="size" wire:model="size"
class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                    @foreach ($sizes as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
</select>
                @error('size') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                @if ($modelId)
                <x-jet-label for="price" value="{{ __('Price') }}" />
<x-jet-input id="price" class="block mt-1 w-full" type="text" wire:model="price" wire:keydown.enter="update" />
                @else
<x-jet-label for="price" value="{{ __('Price') }}" />
                <x-jet-input id="price" class="block mt-1 w-full" type="text" wire:model="price" wire:keydown.enter="create" />
                @endif
                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
<div class="mt-4">
                @if ($modelId)
                <x-jet-label for="reorder" value="{{ __('Re-Order Level') }}" />
                <x-jet-input id="reorder" class="block mt-1 w-full" type="text" wire:model="reorder" wire:keydown.enter="update" />
                @else
                <x-jet-label for="reorder" value="{{ __('Re-Order Level') }}" />
                <x-jet-input id="reorder" class="block mt-1 w-full" type="text" wire:model="reorder" wire:keydown.enter="create" />
                @endif
                @error('reorder') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>
            @if ($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- The delte modal --}}

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Flavor') }}
        </x-slot>

        <x-slot name="content">
{{ __('Are you sure you want to delete this product?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>

<script>
    window.addEventListener('response', event => {
        Toast.fire({ icon: event.detail.icon, title: event.detail.title})
    })

</script>
