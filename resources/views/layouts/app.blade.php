<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('head-styles')
        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @stack('head-scripts')
    </head>
    <body class="font-sans">

    <div class="page_wrapper" style="min-height: 100vh;">
        <x-layouts.sidebar></x-layouts.sidebar>
        <div class="main_container">
            <x-layouts.navigation></x-layouts.navigation>
            <div class="container">
                {{ $slot }}
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/basic.min.js') }}"></script>
        @stack('footer-scripts')
    </div>
    </body>
</html>
