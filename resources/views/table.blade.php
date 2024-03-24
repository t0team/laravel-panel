<div class="table-div">
    <table>
        <thead>
            <tr>
                @foreach ($headers as $label)
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
                        <td>{!! T0team\LaravelPanel\Helper::value($row, $header) ?? '-' !!}</td>
                    @endforeach
                    @if ($actions)
                        <td class="d-flex gap-2">
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
                @foreach ($headers as $label)
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
