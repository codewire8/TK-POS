<!DOCTYPE html>
<html x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{asset('js/init-alpine.js')}}" defer></script>

    @livewireStyles

</head>

<body>
    <div class="flex bg-gray-100 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @if (auth()->user()->role === 'admin')
        @include('layouts.menu')
        @include('layouts.mobile-menu')
        @else
        @endif
        <div class="w-full">
            @include('layouts.navigation-dropdown')
            <main class="overflow-y-auto">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </div>
</body>

</html>