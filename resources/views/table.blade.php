@if (session('success'))
    <div class="alert alert-success mb-3">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger mb-3">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="table-div">
    <table>
        <thead>
            <tr>
                @foreach ($headers as $h => $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($headers as $header => $label)
                        <td>{{ $row[$header] ?? ($row[$label] ?? 'یافت نشد') }}</td>
                    @endforeach
                    {{-- <td>
                        <a href="/users/{{ $row['id'] }}/edit" class="btn btn-primary" title="Edit">
                            <i class="fa-regular text-white fa-pen-to-square"></i>
                        </a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @foreach ($headers as $h => $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>
@if ($pagination != false)
    <div class="mt-4">{!! $pagination->links() !!}</div>
@endif
