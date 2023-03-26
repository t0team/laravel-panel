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
                    <th>عملیات</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($headers as $header => $label)
                        <td>{{ $row[$header] ?? ($row[$label] ?? 'یافت نشد') }}</td>
                    @endforeach
                    <td>
                        @if ($actions)
                            @foreach ($actions as $action)
                                @php
                                    $neededs = [];
                                    foreach ($action->needed as $need) {
                                        $neededs[] = $row[$need];
                                    }
                                @endphp
                                <a href="{{ route($action->route, $neededs, false) }}"
                                    class="btn btn-{{ $action->color }}" {{ $action->blanck ? 'target="_blank"' : '' }}
                                    {{ $action->disabled ? 'disabled' : '' }}>

                                    @if ($action->icon)
                                        <i class="text-white {{ $action->icon }}"></i>
                                    @endif
                                    {{ $action->title }}
                                </a>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @foreach ($headers as $h => $label)
                    <th>{{ $label }}</th>
                @endforeach
                @if ($actions)
                    <th>عملیات</th>
                @endif
            </tr>
        </tfoot>
    </table>
</div>
@if ($paginate)
    <div class="mt-4">{!! $paginate->withQueryString()->links() !!}</div>
@endif
