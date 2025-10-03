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
    <x-header class="bg-[#FB7116]">
        <div class="max-w-[1200px] mx-auto px-6 py-6">
            @include('layouts.navbar_guest')
        </div>
    </x-header>

    <main class="flex-1 px-8 max-w-[1000px] mx-auto">
        @yield('content')
    </main>

    @include('layouts.footer')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>


