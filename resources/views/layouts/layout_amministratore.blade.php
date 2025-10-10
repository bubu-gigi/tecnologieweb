<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Area Amministratore')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen">

    <header class="bg-[#FB7116] text-white px-8 py-8 flex justify-between items-center rounded-b-lg">
        @include('layouts.navbar_amministratore')
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-20 w-20 object-contain rounded-lg">
    </header>

    <main class="main-content w-full mx-auto px-8">
        @yield('content')
    </main>

    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
