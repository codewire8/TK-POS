<button {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex
                    w-full
                    text-xs
                    bg-gray-500
                    text-white
                    font-semibold
                    conten-center
                    uppercase
                    px-6
                    py-5
                    rounded-none
                    tracking-widest
                    hover:bg-yellow-300
                    active:bg-yellow-500
                    focus:outline-none
                    focus:border-yellow-500
                    focus:shadow-outline-gray
                    disabled:opacity-25
                    transition
                    ease-in-out
                    duration-150'
                    ]) }}>
    {{ $slot }}
</button>
