<div class="form-check form-check-reverse form-switch">
    <input type="checkbox" role="swich"
        id="{{ $input->id }}"
        name="{{ $input->name }}"
        class="form-check-input"
        value="{{ $input->value ?? 'on' }}"
        {{ $input->required ? 'required' : '' }}
        {{ $input->disabled ? 'disabled' : '' }}
        {{ $input->autofocus ? 'autofocus' : '' }}
        {{ $input->checked ? 'checked' : '' }}
    >

    @if ($input->label)
        <label class="form-check-label" for="{{ $input->id }}">
            {{ $input->label }}
        </label>
    @endif
</div>
