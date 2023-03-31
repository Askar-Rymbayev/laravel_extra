<!doctype html>
<html data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-lg">
        @yield('top_menu')

        @if(Route::currentRouteName() != 'home')
            @yield('breadcrumb')
        @endif

        @yield('content')
    </div>
</body>
</html>

