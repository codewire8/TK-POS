<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stock-In') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
<div class="bg-white h-full overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('stock-entries')
            </div>
        </div>
    </div>
</x-app-layout>
