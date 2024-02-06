<div class="alert-container">
    <div>
        @if ($message)
            <div class="@switch($type)
        @case('success')
            alert-success
            @break
        @case('error')
            alert-error
            @break
        @case('warning')
           alert-warning
            @break
        @case('info')
            alert-info
            @break
        @default
            alert-default
        @endswitch alert-spacing">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
