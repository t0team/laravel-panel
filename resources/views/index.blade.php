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
        {{ $config->title }}
    </title>
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
                    <a href="{{ $button->url }}" {{ $button->blanck ? 'target="_blank"' : '' }}
                        class="btn btn-{{ $button->outLine ? 'outline-' : '' }}{{ $button->color }}">

                        @if ($button->icon)
                            <i class="{{ $button->icon }}"></i>
                        @endif
                        {{ $button->title }}
                    </a>
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
                    @foreach ($config->items as $route => $item)
                        @if ($item['show'])
                            <a class="nav-link {{ request()->is($route) ? 'active' : '' }} {{ $item['disabled'] ? 'disabled' : '' }}"
                                href="{{ rtrim($route, '*') }}">
                                <i class="{{ $item['icon'] }}"></i><span>{{ $item['name'] }}</span>
                            </a>
                        @endif
                    @endforeach
                    {{-- <a class="nav-link {{ request()->is('pending-file*') ? 'active' : '' }}" href="/pending-file">
                            <i class="fa-light fa-file-circle-question"></i>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>فایل های نامشخص</span>
                                @if ($pendingFile_count > 0)
                                    <span class="badge bg-danger">{{ $pendingFile_count }}</span>
                                @endif
                            </div>
                        </a> --}}
                </div>
            </div>
            @if (auth()->check())
                <div class="bottom-sidebar">
                    <hr>
                    <a class="nav-link" href="{{ route($config->logoutRoute) }}">
                        <i class="fa-light fa-sign-out-alt"></i><span>خروج</span>
                    </a>
                </div>
            @endif
        </div>

        <div class="content">
            @if (isset($title) || isset($button))
                <div class="header-row mb-4 gap-3">
                    @if (isset($title))
                        <h2 class="d-flex gap-2 flex-row align-items-center">
                            <span style="padding:0;">{{ $config->title }}</span>
                            <i style="font-size: 18px;" class="fas fa-chevron-left"></i>
                            <b>{{ $title }}</b>
                        </h2>
                    @endif
                    @if (isset($button))
                        <div class="mr-2">
                            <a href="{{ $button->url }}" {{ $button->blanck ? 'target="_blank"' : '' }}
                                class="btn btn-{{ $button->outLine ? 'outline-' : '' }}{{ $button->color }}">

                                @if ($button->icon)
                                    <i class="{{ $button->icon }}"></i>
                                @endif
                                {{ $button->title }}
                            </a>
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
