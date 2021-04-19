@props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, defaultDate: 'today'}"])

<div wire:ignore>
    <div class="relative">
        <input x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input
            {{ $attributes->merge(['class' => 'border-gray-300
        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full']) }} />
        <div class="absolute top-0 right-0 px-3 py-2">
            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
    </div>

</div>
