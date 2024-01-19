<div class="my-4 {{ $cardClasses }}">
    @if ($header)
        {{ $header }}
    @elseif ($title || $action)
        <div class="bg-primary-100 rounded-t-xl {{ $headerClasses }}">
            <h3 class="font-bold whitespace-normal text-md text-secondary-700 ">{{ $title }}</h3>

            @if ($action)
                {{ $action }}
            @endif
        </div>
    @endif

    <div {{ $attributes->merge(['class' => "{$padding} text-secondary-700 rounded-b-xl grow"]) }}>
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="{{ $footerClasses }}">
            {{ $footer }}
        </div>
    @endif
</div>
