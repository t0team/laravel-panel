@if ($input->label)
    <label class="form-label" for="{{ $input->id }}">
        {{ $input->label }}
    </label>
@endif

<input type="{{ $input->type }}"
    id="{{ $input->id }}"
    name="{{ $input->name }}" 
    class="form-control {{ implode(' ', $input->classes) }}" 
    value="{{ $input->value ?? '' }}"
    placeholder="{{ $input->placeholder ?? '' }}"
    size="{{ $input->size ?? '' }}"
    minlength="{{ $input->minlength ?? '' }}"
    maxlength="{{ $input->maxLength ?? '' }}"
    min="{{ $input->min ?? '' }}"
    max="{{ $input->max ?? '' }}"
    accept="{{ $input->accept ?? '' }}" 
    {{ $input->required ? 'required' : '' }}
    {{ $input->disabled ? 'disabled' : '' }} 
    {{ $input->readonly ? 'readonly' : '' }}
    {{ $input->autofocus ? 'autofocus' : '' }} 
    {{ $input->autocomplete ? 'autocomplete' : '' }}
    {{ $input->multiple ? 'multiple' : '' }}
>
