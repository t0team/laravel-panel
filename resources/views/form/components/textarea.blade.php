@if ($input->label)
    <label class="form-label" for="{{ $input->id }}">
        {{ $input->label }}
    </label>
@endif

<textarea
    id="{{ $input->id }}"
    name="{{ $input->name }}" 
    class="form-control {{ implode(' ', $input->classes) }} @error($input->name) is-invalid @enderror" 
    rows="{{ $input->rows ?? '' }}"
    cols="{{ $input->cols ?? '' }}"
    placeholder="{{ $input->placeholder ?? '' }}"
    maxlength="{{ $input->maxLength ?? '' }}"
    {{ $input->required ? 'required' : '' }}
    {{ $input->disabled ? 'disabled' : '' }} 
    {{ $input->readonly ? 'readonly' : '' }}
    {{ $input->autofocus ? 'autofocus' : '' }} 
>{{ $input->withOldValue ? old($input->name, $input->value ?? '') : $input->value ?? '' }}</textarea>

@error($input->name)
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
@enderror