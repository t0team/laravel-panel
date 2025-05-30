<!DOCTYPE html>
<html dir="{{ $dir }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/vendor/panel/css/app.css">
    <link rel="stylesheet" href="/vendor/panel/css/typographies/{{ $config['font'] ?? '' }}.css">
    <link rel="stylesheet" href="/vendor/panel/css/{{ $dir }}.css">

    <title>
        @if (isset($title))
            {{ $title }} -
        @endif
        {{ $config['title'] }}
    </title>

    <style>
        :root {
            --color: {{ $theme }};
        }
    </style>
</head>

<body>
    <div id="loading"><span></span></div>
    <div class="container">
        @if (isset($button) && $button->buttonType == 'modal')
            <div>
                @php
                    $button->modal->customKey = 'panel-menu-button';
                    $hiddenButton = clone $button;
                    $hiddenButton->hidden = true;
                @endphp

                @include('panel::button.index', ['button' => $hiddenButton])
                @php($button->modal->open = true)
            </div>
        @endif

        <div class="top-menu justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button onclick="toggleSidebar('{{ $dir }}')"><i class="fas fa-bars"></i></button>
                @if (isset($title))
                    <h2 class="fs-4 gap-2 mb-0">{{ $title }}</h2>
                @endif
            </div>

            @if (isset($button))
                <div>
                    @include('panel::button.index', ['button' => $button])
                </div>
            @endif
        </div>

        <div class="sb-shadow" id="sb-shadow" style="display: none;" onclick="toggleSidebar('{{ $dir }}')">
        </div>

        <div class="sidebar" style="{{ $dir == 'rtl' ? 'right' : 'left' }}:-280px;" id="sidebar">
            <button class="btn-close-menu" onclick="toggleSidebar('{{ $dir }}')"><i
                    class="fa-light fa-times"></i></button>
            <div class="top-sidebar">
                <div class="user-info">
                    <a class="text-black d-flex flex-direction-row gap-2">
                        <div>
                            <img src="{{ $user->image ?? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email ?? ''))) . '?s=280&d=mm&r=g' }}"
                                alt="Profile Image">
                        </div>
                        <div>
                            <p>{{ $user->name ?? 'Anonymous User' }}</p>
                            <span>{{ $user->side ?? '' }}</span>
                        </div>
                    </a>
                </div>
                <hr>
                <div class="d-flex flex-column gap-2 overflow-hidden">
                    @foreach ($items as $item)
                        @if ($item->group ?? false)
                            <x-panel::sidebar.group :item="$item" :index="$loop->index" />
                        @else
                            <x-panel::sidebar.item :item="$item" />
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="bottom-sidebar mt-3">
                @if ($config['maintenance']['show'] && app()->maintenanceMode()->active())
                    <div class="badge text-bg-{{ $config['maintenance']['color'] ?? 'danger' }} py-2 w-100 mb-2"
                        style="white-space: normal;">
                        {{ $config['maintenance']['message'] ?? 'Maintenance Mode is active!' }}
                    </div>
                @endif
                @if (auth()->check())
                    <hr class="mt-0">
                    @if (strtolower($config['logout']['method']) == 'post')
                        <button onclick="document.getElementById('logout-form').submit();"
                            class="nav-link d-flex align-items-center gap-2">
                            <div class="nav-button">
                                <i class="fa-light fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </div>
                        </button>

                        <form id="logout-form" action="{{ route($config['logout']['route']) }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route($config['logout']['route']) }}"
                            class="nav-link d-flex align-items-center gap-2">
                            <div class="nav-button">
                                <i class="fa-light fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </div>
                        </a>
                    @endif
                @endif
            </div>
        </div>

        <div class="content">
            <div class="d-flex mb-4 justify-content-between">
                @if (isset($title) || isset($button))
                    <div class="header-row gap-3">
                        @if (isset($title))
                            <h2 class="d-flex gap-2 flex-row align-items-center">
                                <span style="padding:0;">{{ $config['title'] }}</span>
                                <i style="font-size: 18px;"
                                    class="fas fa-chevron-{{ $dir == 'rtl' ? 'left' : 'right' }}"></i>
                                <b>{{ $title }}</b>
                            </h2>
                        @endif
                        @if (isset($button))
                            <div class="mr-2">
                                @include('panel::button.index', ['button' => $button])
                            </div>
                        @endif
                    </div>
                @endif
                @if ($badge['active'] ?? false)
                    <div
                        class="bg-{{ $badge['color']['background'] }} balance-bg d-flex flex-direction-row align-items-center gap-2 px-3 py-2 rounded-2 justify-content-center">
                        <b class="text-{{ $badge['color']['text'] }}">
                            {{ $badge['title'] ?? '' }}
                        </b>
                        <span class="badge fs-6 bg-{{ $badge['color']['text'] }} text-{{ $badge['color']['value'] }}">
                            {{ app($badge['value'][0])->{$badge['value'][1]}() ?? '' }}
                        </span>

                        <p class="text-{{ $badge['color']['text'] }}">
                            {{ $badge['after'] ?? '' }}
                        </p>
                    </div>
                @endif
            </div>
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
            {!! $view !!}
        </div>
    </div>

    <script src="/vendor/panel/js/app.js"></script>

    @isset($scripts)
        <!-- start custom scripts -->
        @foreach ($scripts as $script)
            @if ($script['isUrl'])
                <script src="{{ $script['content'] }}"></script>
            @else
                <script>{!! $script['content'] !!}</script>
            @endif
        @endforeach
        <!-- end custom scripts -->
    @endisset
</body>

</html>
