<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Area Utente')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="site-header">
        @include('layouts.navbar_customer')
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    @extends('layouts.footer')
</body>
</html>
