@if($href)
    <a href="{{ $href }}"
@else
    <button @endif
            class="inline-block font-medium py-2 px-2 transition ease-in-out duration-150 mb-2 flex flex-row justify-center
   {{ $buttonClass }}
   @if ($disabled)
   bg-gray-500 hover:bg-gray-500 cursor-not-allowed
   @else
   hover:scale-105
   @endif
    {{ $roundedClass }}
   "
            @if ($disabled)
                onclick="event.preventDefault();" aria-disabled="true"
        @endif
    >
        @if ($icon)
            <i class="{{ $icon }} @if($text) mr-2 @endif"></i>
            @endif
            {{ $text }}
            @if($href) </a>
        @else </button>
@endif

