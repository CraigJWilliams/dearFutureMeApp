<x-app-layout>

    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a New Message') }}
        </h1>
    </x-slot>

    <div class="py-12 overflow-visible">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-y-visible bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('message.store') }}" method="POST">
                        @csrf
                        <x-textarea name="message" class="my-2" label="Dear Future Me..." placeholder="Type your message to your future self here." />
                        <x-datetime-picker name="date_to_be_sent" without-time without-tips label="Send Date" placeholder="Send Date"
                            display-format="DD-MM-YYYY" :min="now()->subDays(-1)->format('Y-m-d H:i')"/>
                        <x-button type="submit" primary class="my-2 font-bold">Send</x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
