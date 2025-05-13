<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Benvenuto')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(entrypoints: 'resources/css/app.css')
</head>
<body>
    <header class="site-header">
        @include('layouts.navbar_guest')
    </header>

    <main class="flex-1 px-8 max-w-[1000px] mx-auto">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
