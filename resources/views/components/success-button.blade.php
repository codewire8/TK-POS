<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 bg-purple-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 active:bg-purple-500 focus:outline-none focus:border-purple-500 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
