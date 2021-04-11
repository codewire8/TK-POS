<header class="z-10 py-3 bg-purple-500 shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6  text-purple-600 dark:text-purple-300">

        <div class="flex">
            @if (auth()->user()->role === 'admin')
            <a class="text-lg font-bold text-gray-800 dark:text-gray-200 pb-1" href="/dashboard">
                <img aria-hidden="true" class="h-10 w-10" src="{{ asset('img/logo.png') }}" alt="TK Milk Tea Logo" />
            </a>
            @else
            <a class="text-lg font-bold text-gray-800 dark:text-gray-200 pb-1" href="/cashier">
                <img aria-hidden="true" class="h-10 w-10" src="{{ asset('img/logo.png') }}" alt="TK Milk Tea Logo" />
            </a>
            @endif
            <span class="font-bold text-white font-sans p-2">POS SOFTWARE</span>
        </div>

@if (auth()->user()->role === 'admin')
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6 text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
@endif
        </button>

        <!-- Search input -->
        <div class="flex justify-center flex-1 lg:mr-32">
            <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
            </div>
        </div>

    </div>
</header>
