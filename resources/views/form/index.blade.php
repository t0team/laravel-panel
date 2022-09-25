<form
    action="{{ $form->url }}"
    method="{{ $form->form_method ?? 'POST' }}"
    {{ in_array('file', array_column($inputs, 'type')) ? 'enctype=multipart/form-data' : '' }}
    >

    @csrf
    @method($form->laravel_method)

    @foreach ($inputs as $input)
        <div class="mb-3">
            @include("panel::form.components.{$input->file}", ['input' => $input])
        </div>
    @endforeach

    <button type="submit" class="btn btn-{{ $form->submit_color ?? 'primary' }}">
        {{ $form->submit ?? 'ثبت فرم' }}
    </button>

    @if (isset($form->reset))
        <button type="reset" class="btn btn-{{ $form->reset_color }}">{{ $form->reset ?? 'ثبت فرم' }}</button>
    @endif
</form>
