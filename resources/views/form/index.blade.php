<form
    action="{{ $form->url }}"
    method="{{ $form->form_method ?? 'POST' }}"
    enctype="multipart/form-data"
    >

    @csrf
    @method($form->laravel_method)

    <div class="w-100 row me-0 flex-column flex-md-row">
        @foreach ($groups as $group)
            <div class="{{ $group->classes }}">
                @if ($group->title)
                    <h4 class="mb-3">
                        <b>{{ $group->title }}</b>
                    </h4>
                @endif

                @foreach ($group->inputs as $input)
                    <div class="mb-3">
                        @include("panel::form.components.{$input->file}", ['input' => $input])
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-{{ $form->submit_color ?? 'primary' }} btn-{{ $form->submit_size }}">
        {{ $form->submit ?? 'Submit' }}
    </button>

    @if (isset($form->reset))
        <button type="reset" class="btn btn-{{ $form->reset_color }} btn-{{ $form->reset_size }}">
            {{ $form->reset }}
        </button>
    @endif
</form>
