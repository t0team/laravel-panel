@switch ($button->buttonType)
    @case('route')
        @include('panel::button.route', ['button' => $button, 'row' => $row ?? []])
    @break

    @case('url')
        @include('panel::button.url', ['button' => $button])
    @break
@endswitch
