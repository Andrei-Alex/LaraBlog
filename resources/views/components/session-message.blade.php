<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($message)
            <div class="@switch($type)
        @case('success')
            bg-green-100 text-green-800
            @break
        @case('error')
            bg-red-100 text-red-800
            @break
        @case('warning')
            bg-yellow-100 text-yellow-800
            @break
        @case('info')
            bg-blue-100 text-blue-800
            @break
        @default
            bg-gray-100 text-gray-800
    @endswitch p-4 mb-4 rounded">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
