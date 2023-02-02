<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/vendor/bootstrap-5.3.0/css/bootstrap.css">

    <title>@yield('title')</title>
</head>
<body>

<div class="container">

    <header>
        <h1>
            @yield('header')
        </h1>
    </header>

    @yield('content')
</div>
</body>
</html>
