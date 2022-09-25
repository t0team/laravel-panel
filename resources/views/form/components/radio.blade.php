@foreach ($input->options as $option)
    <div class="form-check form-check-reverse">
        <input type="radio"
            id="{{ $input->id . '_' . $loop->index }}"
            name="{{ $input->name }}"
            class="form-check-input"
            value="{{ $option->value }}"
            {{ $option->required ? 'required' : '' }}
            {{ $option->disabled ? 'disabled' : '' }} 
            {{ $option->readonly ? 'readonly' : '' }}
            {{ $option->autofocus ? 'autofocus' : '' }} 
            {{ $option->checked ? 'checked' : '' }}
        >

        <label class="form-check-label" for="{{ $input->id . '_' . $loop->index }}">
            {{ $option->label }}
        </label>
    </div>
@endforeach
