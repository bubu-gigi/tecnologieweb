<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Area Utente')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen">
    <x-header class="bg-[#FB7116]">
        @include('layouts.navbar_tecnicoAssistenza')
    </x-header>

    <main class="main-content w-full mx-auto px-8">
        @yield('content')
    </main>

    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
