<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('Dear Future Me', 'Dear Future Me') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
                <wireui:scripts />

    </head>
    <body class="font-sans antialiased text-gray-900 bg-primary-200 ">
        <div class="flex flex-col items-center justify-center min-h-screen pt-6 m-auto bg-primary-100">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="w-full max-w-md px-12 py-4 mx-4 mt-6 overflow-hidden bg-white rounded-lg shadow-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
