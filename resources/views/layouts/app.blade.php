<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name') }} | @yield('title', 'Home')</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        [x-cloak]{
            display: none !important;
        }
    </style>

    @stack('head-scripts')
</head>
<body class="flex flex-col min-h-screen bg-gray-100 @if(config('wave.dev_bar')){{ 'pb-10' }}@endif">

    <div class="flex">

        <div class="flex-1">

            <div>
                @yield('header')
                {{ $header ?? '' }}
            </div>

            <main class="flex-grow">
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>


    @yield('javascript')
    


    @livewireScripts



</body>
</html>
