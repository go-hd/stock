<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="d-flex">
    <?php ?>
    @if(\Auth::check())
        <sidebar :storages="{{ \App\Storage::all()->toJson() }}" style="width: 250px;">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </nav>
            <div class="border-secondary border-bottom container-fluid py-2">
                <div>
                    <a class="text-light" href="{{ route('home') }}">{{ __('Home') }}</a>
                </div>
            </div>
        </sidebar>
    @endif
    <main class="py-4 flex-grow-1">
        @yield('content')
    </main>
</div>
</body>
</html>
