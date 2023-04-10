@switch ($button->buttonType)
    @case('route')
        @include('panel::button.route', ['button' => $button, 'row' => $row ?? []])
    @break

    @case('url')
        @include('panel::button.url', ['button' => $button])
    @break

    @case('modal')
        @include('panel::button.modal', [
            'button' => $button,
            'modal' => $button->modal,
            'row' => $row ?? [],
            'loop' => $loop ?? null,
        ])
    @break
@endswitch
