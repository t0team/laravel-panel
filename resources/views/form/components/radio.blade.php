@foreach ($input->options as $option)
    <div class="form-check form-check-reverse">
        <input type="radio"
            id="{{ $input->id . '_' . $loop->index }}"
            name="{{ $input->name }}"
            class="form-check-input {{ implode(' ', $input->classes) }} @error($input->name) is-invalid @enderror"
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
        
        @if ($loop->last)
            @error($input->name)
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        @endif
    </div>
@endforeach
