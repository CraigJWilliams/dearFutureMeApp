<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800" x-data="{ name: '{{ auth()->user()->name }}' }"
            x-on:profile-updated.window="name = $event.detail.name">
            <span x-text="'Welcome, ' + name"></span>
        </h1>

    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
{{ __('Messages sent from ') . auth()->user()->name . __(' in the past') }}
                    </h2>

                    <p class="mt-1 mb-6 text-sm text-gray-600">
                        {{ __("Any messages you've sent in the past will appear here.") }}
                    </p>

                    @if (!empty($nextDueMessageInfo))
    <p>{{ $nextDueMessageInfo }}</p>
@endif


 @if ($messages->isNotEmpty())
    @foreach ($messages as $message)
        <x-card x-data="{ name: '{{ auth()->user()->name }}' }" x-on:profile-updated.window="name = $event.detail.name"
            title="Message sent on {{ $message->date_to_be_sent->format('F j, Y') }}">
            <p>{!! nl2br(e($message->message)) !!}</p>
            <form action="{{ route('message.delete', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full h-5 ">
                    <x-icon name="trash" class="w-5 h-5 mt-auto ml-auto transition-all ease-in-out delay-50 hover:text-red-500" />
                </button>
            </form>
        </x-card>
    @endforeach
@else
    <p class="mb-2 text-sm text-gray-600">{{ $displayMessage }}</p>
@endif



                    <x-button class="mt-6 font-bold" primary href="{{ route('create-message') }}">Create New Message</x-button>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
