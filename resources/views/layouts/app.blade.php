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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="sidebar bg-dark text-light">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </nav>
            <div class="border-secondary border-bottom container-fluid py-2">
                <a class="text-light" href="{{ route('home') }}">{{ __('Home') }}</a>
            </div>
            <div class="list-unstyled border-secondary border-bottom container-fluid py-3">
                <div class="text-secondary">{{ __('Storages') }}</div>
                @foreach(\App\Storage::all() as $storage)
                    <div class="py-1">{{ $storage->name }}</div>
                @endforeach
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
