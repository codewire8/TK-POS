<div class="p-6">

    {{-- Create button --}}

    <div class="grid grid-cols-2">
        <div class="relative flex justify-start items-center pb-3">
            <div class="md:mt-0">
                <x-jet-search-input type="text" x-ref="query" wire:model.defer="query" wire:keydown.enter="read"
                    @keydown.window="if (event.keyCode === 113) { event.preventDefault(); $refs.query.focus(); }" />
            </div>
            <div class="md:mt-0 mx-3">
                <x-jet-secondary-button wire:click="read">
                    <svg wire:loading="read" class="h-4 w-4 mr-1 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ __('filter') }}
                </x-jet-secondary-button>
            </div>
        </div>
        <div class="pb-4 text-right">
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
                        <thead class="bg-gray-600">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
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
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
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
