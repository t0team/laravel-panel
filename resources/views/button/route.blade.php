@php
    $neededs = T0team\LaravelPanel\Helper::needed($row ?? [], $button->route['needed']);
@endphp

<a href="{!! route($button->route['name'], $neededs, false) !!}"
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
