<div class="form-check {{ config('panel.direction', 'ltr') == 'rtl' ? 'form-check-reverse' : '' }}">
    <input type="checkbox"
        id="{{ $input->id }}"
        name="{{ $input->name }}"
        class="form-check-input {{ implode(' ', $input->classes) }} @error($input->name) is-invalid @enderror"
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
    
    @error($input->name)
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>