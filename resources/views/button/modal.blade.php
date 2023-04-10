@php
    if (isset($modal->customKey)) {
        if (isset($row['id'])) {
            $uniqueId = "{$modal->customKey}_{$row['id']}";
        } elseif (isset($loop?->index)) {
            $uniqueId = "{$modal->customKey}_{$loop->index}";
        } else {
            $uniqueId = $modal->customKey;
        }
    } else {
        if (isset($row['id'])) {
            $uniqueId = "{$modal->id}_{$row['id']}";
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
                                foreach ($modal->form->needed as $need) {
                                    if (isset($row[$need])) {
                                        $formNeededs[] = $row[$need];
                                    }
                                }
                                $formAddress = route($modal->form->address, $formNeededs ?? [], false);
                            }
                        @endphp
                        <form action="{{ $formAddress }}" method="{{ $modal->form->method ?? 'POST' }}"
                            enctype="multipart/form-data" id="form_{{ $uniqueId }}">
                            @csrf
                            @method($modal->form->laravelMethod)
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
                                    if (isset($row[$body['input']->tableProperty])) {
                                        if (in_array($row[$body['input']->tableProperty], ['0', '1'])) {
                                            $body['input']->checked = $row[$body['input']->tableProperty];
                                        } else {
                                            $body['input']->value = $row[$body['input']->tableProperty];
                                        }
                                    }
                                @endphp
                                <div class="mb-3">
                                    @include("panel::form.components.{$body['input']->file}", [
                                        'input' => $body['input'],
                                    ])
                                </div>
                            @break

                            @case('tableProperty')
                                @isset($row[$body['property']])
                                    @if ($body['htmlTag'])
                                        <{{ $body['htmlTag'] }}>
                                    @endif
                                    {{ $row[$body['property']] }}
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
                        {{ $modal->close->label ?? 'بستن' }}
                    </button>

                    @if ($modal->form)
                        <button type="submit" form="form_{{ $uniqueId }}"
                            class="btn btn-{{ $modal->form->submit->color ?? 'primary' }} btn-{{ $modal->form->submit->size ?? 'md' }}">
                            {{ $modal->form->submit->label ?? 'ثبت' }}
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endif
