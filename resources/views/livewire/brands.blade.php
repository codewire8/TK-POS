<div class="p-6">

    {{-- Create button --}}

    <div class="grid grid-cols-2">
<div class="py-5 relative">
            <div class="relative mt-3 md:mt-0">
                <input type="text"
                    class="bg-white rounded-md w-1/2 px-4 pl-8 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-gray-300 focus:border-indigo-300"
                    wire:model.debounce.500ms="query" x-ref="query" @keydown.window="
                                                                                                                if (event.keyCode === 113) {
                                                                                                                                                                                    event.preventDefault();
                                                                                                                                                                                    $refs.query.focus();
                                                                                                                                                                                }
                                                                                                                "
                    placeholder="Search (Press '[F2]' to focus)">
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
                {{ __('New Brand') }}
</x-jet-button>
        </div>
    </div>

    {{-- The data table --}}


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
<div class="shadow overflow-hidden border-b border-gray-300 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    brand
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
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
<div class="flex item-center justify-end">
                                        <div class="w-4 mr-2 text-gray-500 transform hover:text-purple-500 hover:scale-110 cursor-pointer"
                                            wire:click="updateShowModal({{ $item->id }})">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap=" round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 text-gray-500 transform hover:text-purple-500 hover:scale-110 cursor-pointer"
                                            wire:click="deleteShowModal({{ $item->id }})">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
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
{{ __('Brand') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="label" value="{{ __('Brand') }}" />
                @if ($modelId)
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                    wire:keydown.enter="update" />
                @else
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                    wire:keydown.enter="create" />
                @endif
                @error('name') <span class="error">{{ $message }}</span> @enderror
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
{{ __('Brand') }}
        </x-slot>

        <x-slot name="content">
{{ __('Are you sure you want to delete this brand?') }}
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
    Toast.fire({icon: event.detail.icon, title: event.detail.title });
    })
</script>
