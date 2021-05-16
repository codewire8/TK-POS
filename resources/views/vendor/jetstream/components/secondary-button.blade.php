<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
