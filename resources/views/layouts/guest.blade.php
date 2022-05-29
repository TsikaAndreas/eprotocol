<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="guest-layout-bg px-5 py-10">
            <x-layouts.language class="absolute top-2 left-1"></x-layouts.language>
            {{ $slot }}
        </div>
        <script type="text/javascript" src="{{ asset('js/basic.min.js') }}"></script>
    </body>
</html>
