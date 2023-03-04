<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    
    <title>{{ config('app.name'). ' - Course Slider' }}</title>
    

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    @if(isset($seo->description))
        <meta name="description" content="{{ $seo->description }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles

    @stack('head-scripts')
</head>
<body>

    {{ $slot }}

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>
</html>
