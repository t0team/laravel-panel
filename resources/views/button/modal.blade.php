@php
    if (isset($modal->customKey)) {
        if (isset($row[$primaryKey])) {
            $uniqueId = "{$modal->customKey}_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $row[$primaryKey]);
        } elseif (isset($loop?->index)) {
            $uniqueId = "{$modal->customKey}_{$loop->index}";
        } else {
            $uniqueId = $modal->customKey;
        }
    } else {
        if (isset($row[$primaryKey])) {
            $uniqueId = "{$modal->id}_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $row[$primaryKey]);
        } elseif (isset($loop?->index)) {
            $uniqueId = "{$modal->id}_{$loop->index}";
        } else {
            $uniqueId = "{$modal->id}_" . Str::random(5);
        }
    }
@endphp

<button type="button" data-bs-toggle="modal" data-bs-target="#modal_{{ $uniqueId }}"
    class="btn btn-{{ $button->outLine ? 'outline-' : '' }}{{ $button->color }} btn-{{ $button->size }}"
    {{ $button->disabled ? 'disabled' : '' }} {{ $button->hidden ? 'hidden' : '' }}>

    @if ($button->icon)
        <i class="{{ $button->icon }}"></i>
    @endif

    {{ $button->label }}

</button>

@if (!$modal->open)
    <!-- Modal -->
    <div class="modal fade" id="modal_{{ $uniqueId }}" tabindex="-1" aria-hidden="true"
        @if ($modal->staticBackdrop) data-bs-backdrop="static" data-bs-keyboard="false" @endif>
        <div
            class="modal-dialog modal-dialog-scrollable modal-{{ $modal->size }} @if ($modal->verticalCenter) modal-dialog-centered @endif @if ($modal->fullscreen) modal-fullscreen @endif">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ $modal->title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if ($modal->form)
                        @php
                            if (strpos($modal->form->address, 'http') === 0) {
                                $formAddress = $modal->form->address;
                            } else {
                                $formNeededs = T0team\LaravelPanel\Helper::needed($row ?? [], $modal->form->needed);
                            
                                $formAddress = route($modal->form->address, $formNeededs ?? [], false);
                            
                                if ($modal->form->method == 'GET') {
                                    $formMethod = 'GET';
                                    $laravelMethod = 'GET';
                                } else {
                                    $formMethod = 'POST';
                                    $laravelMethod = $modal->form->method;
                                }
                            }
                        @endphp
                        <form action="{{ $formAddress }}" method="{{ $formMethod }}" enctype="multipart/form-data"
                            id="form_{{ $uniqueId }}">
                            @csrf
                            @method($laravelMethod)
                    @endif

                    @foreach ($modal->body as $body)
                        @switch ($body['type'])
                            @case('text')
                                @if ($body['htmlTag'])
                                    <{{ $body['htmlTag'] }}>
                                @endif
                                {{ $body['text'] }}
                                @if ($body['htmlTag'])
                                    </{{ $body['htmlTag'] }}>
                                @endif
                            @break

                            @case('html')
                                {!! $body['html'] !!}
                            @break

                            @case('button')
                                @include('panel::button.index', [
                                    'button' => $body['button'],
                                    'row' => $row ?? [],
                                    'loop' => $loop ?? null,
                                ])
                            @break

                            @case('newLine')
                                <br>
                            @break

                            @case('input')
                                @php
                                    $value = null;
                                    if (isset($body['input']->tableProperty)) {
                                        $value = $row;
                                        foreach (explode('->', $body['input']->tableProperty) as $p) {
                                            if (isset($value[$p])) {
                                                $value = $value[$p];
                                            } else {
                                                $value = null;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="mb-3">
                                    @include("panel::form.components.{$body['input']->file}", [
                                        'input' => (object) array_merge((array) $body['input'], [
                                            'checked' => $value == '1' || $value == 'on' || $value == 'true',
                                            'value' => $value,
                                        ]),
                                    ])
                                </div>
                            @break

                            @case('tableProperty')
                                @isset($row[$body['property']])
                                    @if ($body['htmlTag'])
                                        <{{ $body['htmlTag'] }}>
                                    @endif
                                    {!! $row[$body['property']] !!}
                                    @if ($body['htmlTag'])
                                        </{{ $body['htmlTag'] }}>
                                    @endif
                                @endisset
                            @break
                        @endswitch
                    @endforeach

                    @if ($modal->form)
                        </form>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-{{ $modal->close->size ?? 'md' }}" data-bs-dismiss="modal">
                        {{ $modal->close->label ?? 'Close' }}
                    </button>

                    @if ($modal->form)
                        <button type="submit" form="form_{{ $uniqueId }}"
                            class="btn btn-{{ $modal->form->submit->color ?? 'primary' }} btn-{{ $modal->form->submit->size ?? 'md' }}">
                            {{ $modal->form->submit->label ?? 'Submit' }}
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endif
