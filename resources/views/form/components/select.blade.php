@if ($input->label)
    <label class="form-label" for="{{ $input->id }}">
        {{ $input->label }}
    </label>
@endif

<select
    id="{{ $input->id }}"
    name="{{ $input->name }}"
    class="form-select"
    {{ $input->required ? 'required' : '' }}
    {{ $input->disabled ? 'disabled' : '' }}
    {{ $input->readonly ? 'readonly' : '' }}
    {{ $input->autofocus ? 'autofocus' : '' }}
    {{ $input->multiple ? 'multiple' : '' }}
>
    @foreach ($input->options as $option)
        <option
            value="{{ $option->value ?? '' }}"
            {{ $option->selected ? 'selected' : '' }}
            {{ $option->disabled ? 'disabled' : '' }}
        >
            {{ $option->label }}
        </option>
    @endforeach
</select>
