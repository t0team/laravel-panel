<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/vendor/panel/css/app.css">

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
        <div class="top-menu justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
                @if (isset($title))
                    <h2 class="fs-4 gap-2 mb-0">{{ $title }}</h2>
                @endif
            </div>

            @if (isset($button))
                <div>
                    @include('panel::button', ['button' => $button])
                </div>
            @endif
        </div>

        <div class="sb-shadow" id="sb-shadow" style="display: none;" onclick="toggleSidebar()"></div>

        <div class="sidebar" style="right:-280px;" id="sidebar">
            <button class="btn-close-menu" onclick="toggleSidebar()"><i class="fa-light fa-times"></i></button>
            <div class="top-sidebar">
                <div class="user-info">
                    <a class="text-black">
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
                <div class="menu">
                    @foreach ($items as $item)
                        <a class="nav-link {{ $item->active ? 'active' : '' }}" href="{{ $item->url }}">
                            <i class="{{ $item->icon }}"></i>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $item->name }}</span>
                                @if ($item->badge)
                                    <span class="badge bg-{{ $item->badge->color ?? 'danger' }}">
                                        {{ $item->badge->value }}
                                    </span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @if (auth()->check())
                <div class="bottom-sidebar">
                    <hr>
                    @if (strtolower($config['logout']['method']) == 'post')
                        <a class="nav-link" onclick="document.getElementById('logout-form').submit();">
                            <i class="fa-light fa-sign-out-alt"></i><span>خروج</span>
                        </a>

                        <form id="logout-form" action="{{ route($config['logout']['route']) }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    @else
                        <a class="nav-link" href="{{ route($config['logout']['route']) }}">
                            <i class="fa-light fa-sign-out-alt"></i><span>خروج</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <div class="content">
            @if (isset($title) || isset($button))
                <div class="header-row mb-4 gap-3">
                    @if (isset($title))
                        <h2 class="d-flex gap-2 flex-row align-items-center">
                            <span style="padding:0;">{{ $config['title'] }}</span>
                            <i style="font-size: 18px;" class="fas fa-chevron-left"></i>
                            <b>{{ $title }}</b>
                        </h2>
                    @endif
                    @if (isset($button))
                        <div class="mr-2">
                            @include('panel::button', ['button' => $button])
                        </div>
                    @endif
                </div>
            @endif
            {!! $view !!}
        </div>
    </div>

    <script src="/vendor/panel/js/app.js"></script>
</body>

</html>
