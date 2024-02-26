<a class="nav-link {{ $item->active ? 'active' : '' }}" href="{{ $item->url }}" {{ $item->newTab ? 'target="_blank"' : '' }}>
    <div class="nav-button">
        <i class="{{ $item->icon }}"></i>
        <span>{{ $item->name }}</span>
    </div>

    @if ($item->badge)
        <span class="badge bg-{{ $item->badge->color ?? 'danger' }}">
            {{ $item->badge->value }}
        </span>
    @endif
</a>
