<a href="{{ $href }}"
   class="inline-block font-medium py-2 px-4 transition ease-in-out duration-150
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
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $text }}
</a>

