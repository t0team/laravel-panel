@if ($input->label)
    <label class="form-label" for="{{ $input->id }}">
        {{ $input->label }}
    </label>
@endif

<input type="range"
    id="{{ $input->id }}"
    name="{{ $input->name }}"
    class="form-range {{ implode(' ', $input->classes) }} @error($input->name) is-invalid @enderror"
    value="{{ $input->withOldValue ? old($input->name, $input->value ?? '') : $input->value ?? '' }}"
    min="{{ $input->min ?? '' }}"
    max="{{ $input->max ?? '' }}"
    step="{{ $input->step ?? '' }}"
    {{ $input->required ? 'required' : '' }}
    {{ $input->disabled ? 'disabled' : '' }}
    {{ $input->readonly ? 'readonly' : '' }}
    {{ $input->autofocus ? 'autofocus' : '' }}
>

@error($input->name)
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
@enderror