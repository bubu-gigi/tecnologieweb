<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Area Utente')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body>
    <x-header>
        <x-wrapper-navbar>
            <x-left-navbar>
                <x-link-navbar href="/">
                    Home
                </x-link-navbar>
                <x-link-navbar href="/customers">
                    Dashboard
                </x-link-navbar>
                <x-link-navbar href="/customers/profilo">
                    Profilo
                </x-link-navbar>
                <x-link-navbar href="/customers/prestazioni">
                    Prestazioni
                </x-link-navbar>
                <x-link-navbar href="/customers/prenotazioni">
                    Prenotazioni
                </x-link-navbar>
            </x-left-navbar>
            <x-right-navbar>
                <x-button-navbar href="/logout">
                    Logout
                </x-button-navbar>
            </x-right-navbar>
        </x-wrapper-navbar>
    </x-header>

    <main class="main-content">
        @yield('content')
    </main>

    @extends('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
