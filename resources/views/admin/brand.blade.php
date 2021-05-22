<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <div class="h-screen">
        <div class="w-full mx-auto py-8 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('brands')
            </div>
        </div>
    </div>
</x-app-layout>