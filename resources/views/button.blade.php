@php
    switch ($button->buttonType) {
        case 'route':
            foreach ($button->route['needed'] as $need) {
                if (isset($row[$need])) {
                    $neededs[] = $row[$need];
                }
            }
            $url = route($button->route['name'], $neededs ?? [], false);
            break;

        case 'url':
            $url = $button->url;
            break;
    }
@endphp

<a href="{{ $url }}"
    class="btn btn-{{ $button->outLine ? 'outline-' : '' }}{{ $button->color }} {{ $button->disabled ? 'disabled' : '' }}"
    rel="{{ $button->rel }}"
    target="{{ $button->target }}"
>
    @if ($button->icon)
        <i class="{{ $button->icon }}"></i>
    @endif
    {{ $button->label }}
</a>
