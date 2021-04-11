<div class="p-6">

    {{-- Create button --}}

    <div class="grid grid-cols-2">
        <div class="py-5">
            <x-jet-button wire:click="createShowModal">
                {{ __('New Permission') }}
            </x-jet-button>
        </div>
        <div class="text-right py-5">
            <input wire:model="query" type="text"
                class="border-gray-300 focus:border-indigo-300 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-2/5"
                placeholder="Search permission...">

        </div>
    </div>

    {{-- The data table --}}


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    route name
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
                                    {{ $item->role }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap  text-sm text-gray-500 font-medium">
                                    {{ $item->route_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-jet-edit-button wire:click="updateShowModal({{ $item->id }})">
                                        {{ __('Edit') }}
                                    </x-jet-edit-button>
                                    <x-jet-delete-action-button wire:click="deleteShowModal({{ $item->id }})">
                                        {{ __('Delete') }}
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
            {{ __('Save User Permission') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="type" value="{{ __('Role') }}" />
                <select wire:model="role"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                    <option value="">-- Select a Role --</option>
                    @foreach (App\Models\User::userRoleList() as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="routeName" value="{{ __('Route Name') }}" />
                <select wire:model="routeName" id="routeName"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                    <option value="">-- Select a Route --</option>
                    @foreach (App\Models\UserPermission::routeNameList() as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('routeName') <span class="text-red-500">{{ $message }}</span> @enderror
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
            {{ __('Delete User Permission') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this permission?') }}
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
