<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dear Future Me | Welcome </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative flex items-center justify-center min-h-screen bg-center bg-primary-100 selection:bg-primary-700 selection:text-white">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif
        <div class="flex flex-col justify-center w-auto p-10 mx-5 text-center text-black align-middle bg-white rounded-lg">
            <x-application-logo class="h-24 mx-auto"></x-application-logo>
            <h1 class="text-3xl font-bold md:text-8xl text-primary-500">DearFutureMe</h1>
            <h2 class="mb-10 text-2xl">Leave a message for your future self!</h2>

           
            <div class="mt-5">
            <p>Log in or Register to get started:</p>
                <x-button href="{{ route('login') }}" secondary outline lg font-bold class="mx-2 mt-2 font-bold">Log in</x-button>
       <x-button href="{{ route('register') }}" primary lg font-bold class="w-auto mx-2 mt-2 font-bold" spinner>Register</x-button>
            </div>
        </div>


<a class="absolute z-50 transition-all ease-in-out hover:scale-105 bottom-5" href="https://craigjwilliams.co.uk" target="_blank">Built By <span class="font-bold underline">Craig J Williams</span></a></p>
</body>

</html>
