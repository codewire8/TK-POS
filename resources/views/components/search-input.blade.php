@props(['disabled' => false])

<div class="relative">
    <input autocomplete="off" placeholder="Press '[F2]' to focus"
        {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white rounded-md
    w-full pl-8 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-gray-300
    focus:border-indigo-300']) !!}>
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>
</div>
