
@if($href)
    <a href="{{ $href }}"
       {{ $attributes->merge(['class' => "inline-block font-medium py-2 px-2 transition ease-in-out duration-150  flex flex-row justify-center $buttonClass $roundedClass " . ($disabled ? 'bg-gray-500 hover:bg-gray-500 cursor-not-allowed' : 'hover:scale-105')]) }}
       @if ($disabled)
           onclick="event.preventDefault();" aria-disabled="true"
        @endif
    >
        @if ($icon)
            <i class="{{ $icon }} @if($text) mr-2 @endif"></i>
        @endif
        {{ $text }}
    </a>
@else
    <button
        {{ $attributes->merge(['class' => "inline-block font-medium py-2 px-2 transition ease-in-out duration-150 flex flex-row justify-center $buttonClass $roundedClass " . ($disabled ? 'bg-gray-500 hover:bg-gray-500 cursor-not-allowed' : 'hover:scale-105')]) }}
        @if ($disabled)
            disabled aria-disabled="true"
        @endif
    >
        @if ($icon)
            <i class="{{ $icon }} @if($text) mr-2 @endif"></i>
        @endif
        {{ $text }}
    </button>
@endif
