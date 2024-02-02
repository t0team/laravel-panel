@if ($input->label)
    <label class="form-label" for="{{ $input->id }}">
        {{ $input->label }}
    </label>
@endif

<select
    id="{{ $input->id }}"
    name="{{ $input->name }}"
    class="form-select {{ implode(' ', $input->classes) }} @error($input->name) is-invalid @enderror"
    {{ $input->required ? 'required' : '' }}
    {{ $input->disabled ? 'disabled' : '' }}
    {{ $input->readonly ? 'readonly' : '' }}
    {{ $input->autofocus ? 'autofocus' : '' }}
    {{ $input->multiple ? 'multiple' : '' }}
>
    @foreach ($input->options as $option)
        <option
            value="{{ $option->value ?? '' }}"
            {{ ($option->selected || $input?->value == $option?->value) ? 'selected' : '' }}
            {{ $option->disabled ? 'disabled' : '' }}
        >
            {{ $option->label }}
        </option>
    @endforeach
</select>

@error($input->name)
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
@enderror
