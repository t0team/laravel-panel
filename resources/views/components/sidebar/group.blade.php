<div class="nav-group">
    <button class="nav-link {{ $item->active ? '' : 'collapsed' }}" data-bs-toggle="collapse"
        data-bs-target="#group-{{ $index }}">
        <div class="nav-button">
            <i class="{{ $item->icon }}"></i>
            <span>{{ $item->name }}</span>
        </div>
        <i class="fa-regular fa-chevron-right"></i>
    </button>
    <div class="collapse {{ $item->active ? 'show' : '' }}" id="group-{{ $index }}">
        <div class="items">
            @foreach ($item->items as $item)
                @if ($item->group ?? false)
                    <x-panel::sidebar.group :item="$item" :index="$index . '-' . $loop->index" />
                @else
                    <x-panel::sidebar.item :item="$item" />
                @endif
            @endforeach
        </div>
    </div>
</div>
