<x-app-layout>

    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Message Sent') }}
        </h1>
    </x-slot>

    <div class="py-12 overflow-visible">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-y-visible bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Message Sent!') }}
                    </h2>


                    <p class="mt-1 mb-6 text-sm text-gray-600">Your future self looks forward to hearing from you!</p>
                    @if (session('dateToBeSent'))
                        <p>Your message is due to be opened on {{ session('dateToBeSent') }}</p>
                    @else
                    @endif
                    <x-button class="mt-6 font-bold" primary href="{{ route('dashboard') }}">Dashboard</x-button>

                    <x-button class="mt-6 font-bold" secondary outline href="{{ route('create-message') }}">Create New
                        Message</x-button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
