<nav class="fixed top-0 right-0 z-10 flex justify-between w-full p-6 bg-white border-b border-gray-100 text-md sm:text-xl">
 <div class="flex items-center shrink-0">
                    <a href="{{ url('/') }}" wire:navigate>
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>
    <div class="text-end">
        @auth
            <a href="{{ url('/dashboard') }}" class="my-5 text-sm font-medium text-gray-800 hover:text-primary-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="mx-5 text-sm font-medium text-gray-800 hover:text-primary-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sm font-medium text-gray-800 hover:text-primary-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Register</a>
            @endif
        @endauth
    </div>
</nav>
