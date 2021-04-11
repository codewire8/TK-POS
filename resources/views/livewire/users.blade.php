<div class="p-6">

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    role
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->role }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-jet-edit-button wire:click="updateShowModal({{ $item->id }})">
                                        {{ __('Edit') }}
                                    </x-jet-edit-button>
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

    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Update User') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                    wire:keydown.enter="update" />

                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
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
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Save Changes') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>

<script>
    window.addEventListener('response', event => {
        Toast.fire({icon: event.detail.icon, title: event.detail.title });
    })

</script>
