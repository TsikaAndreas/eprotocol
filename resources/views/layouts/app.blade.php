<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/basic.min.css') }}">
        @stack('head-styles')
        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @stack('head-scripts')
    </head>
    <body class="font-sans">

    <div class="page_wrapper">
        <x-layouts.sidebar></x-layouts.sidebar>
        <div class="main_container">
            <x-layouts.navigation></x-layouts.navigation>
            <div class="container">
                {{ $slot }}
            </div>
            @stack('modals')
        </div>
        <footer>
            <div>
                <script type="text/javascript" src="{{ asset('js/basic.min.js') }}"></script>
                @stack('footer-scripts')
            </div>
        </footer>
    </div>
    </body>
</html>
