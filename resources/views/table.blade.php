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
                @if ($actions)
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($headers as $header => $label)
                        <td>{!! $row[$header] ?? ($row[$label] ?? '-') !!}</td>
                    @endforeach
                    @if ($actions)
                        <td>
                            @foreach ($actions as $action)
                                @include('panel::button.index', [
                                    'button' => $action,
                                    'row' => $row,
                                    'primaryKey' => $primaryKey,
                                ])
                            @endforeach
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @foreach ($headers as $h => $label)
                    <th>{{ $label }}</th>
                @endforeach
                @if ($actions)
                    <th></th>
                @endif
            </tr>
        </tfoot>
    </table>
</div>
@if ($paginate)
    <div class="mt-4">{!! $paginate->withQueryString()->links() !!}</div>
@endif
