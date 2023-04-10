<a href="{{ $button->url }}"
    class="btn btn-{{ $button->outLine ? 'outline-' : '' }}{{ $button->color }} btn-{{ $button->size }} {{ $button->disabled ? 'disabled' : '' }}"
    rel="{{ $button->rel }}"
    target="{{ $button->target }}"
    {{ $button->hidden ? 'hidden' : '' }}
>

    @if ($button->icon)
        <i class="{{ $button->icon }}"></i>
    @endif

    {{ $button->label }}

</a>
