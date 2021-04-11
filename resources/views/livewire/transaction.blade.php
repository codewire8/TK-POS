<div class="flex">

    <div class="w-5/6 bg-white">
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-8 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-bold text-gray-500 uppercase">
                        transaction no.:
                    </dt>
                    <dt class="text-sm font-bold text-red-500 uppercase">
                        000000000000000
                    </dt>
                </div>
                <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-8 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-bold text-gray-500 uppercase">
                        transaction date
                    </dt>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ date('mo-d-Y') }}
                    </dt>
                </div>
                <div class="bg-gray-50 flex-row px-6 py-4 ">
                    <div class="w-1/6 text-sm font-bold text-gray-500 uppercase">
                        [f8] barcode
                    </div>
                    <div class="w-5/6 text-sm font-bold text-gray-500 uppercase">
                        <x-jet-input class="block mt-1 w-full" type="text" />
                    </div>
                </div>
            </dl>
        </div>
    </div>

    <div class="w-1/6 bg-white shadow-md">
        <div class="space-y-0 p-2">
            <div class="block">
                <x-jet-menu-button>
                    <svg class="h-5 w-5 relative" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <span class="pl-2">{{ __('[f1] new transaction') }}</span>
                </x-jet-menu-button>
            </div>
            <div class="block">
                <x-jet-menu-button>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span class="pl-2">{{ __('[f2] search product') }}</span>
                </x-jet-menu-button>
            </div>
            <div class="block">
                <x-jet-menu-button>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="pl-2">{{ __('[f3] add discount') }}</span>
                </x-jet-menu-button>
            </div>
            <div class="block">
                <x-jet-menu-button>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="pl-2">{{ __('[f4] settle payment') }}</span>
                </x-jet-menu-button>
            </div>
            <div class="block">
                <x-jet-menu-button>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="pl-2">{{ __('[f5] clear cart') }}</span>
                </x-jet-menu-button>
            </div>
            <div class="block">
                <x-jet-menu-button>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <span class="pl-2">{{ __('[f6] daily sales') }}</span>
                </x-jet-menu-button>
            </div>
            <div class="block">
                <x-jet-menu-button>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <span class="pl-2">{{ __('[f7] change password') }}</span>
                </x-jet-menu-button>
            </div>
            <li class="block">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="inline-flex w-full text-xs bg-gray-500 text-white font-semibold conten-center uppercase px-6 py-5 rounded-none tracking-widest hover:bg-yellow-300 active:bg-yellow-500 focus:outline-none  focus:border-yellow-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                        href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="pl-2">{{ __('Logout') }}</span>
                    </a>
                </form>
            </li>
        </div>
    </div>
</div>
