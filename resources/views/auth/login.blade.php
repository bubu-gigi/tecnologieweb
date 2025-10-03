<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - Nuovo Progetto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 flex items-center justify-center">

    <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">Benvenuto</h1>
        <p class="text-center text-gray-500 mb-8">Accedi al tuo account</p>

        <form method="POST" action="{{ url('login') }}" class="flex flex-col gap-4">
            @csrf

            <div>
                <label for="username" class="block text-gray-700 font-medium mb-1">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    placeholder="Inserisci username"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    autofocus
                />
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Inserisci la password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                />
            </div>

            @php
                $backUrl = session('login_referrer', url('/'));
            @endphp

            <div class="flex gap-4 mt-4">
                <button
                    type="button"
                    onclick="window.location.href='{{ $backUrl }}'"
                    class="w-1/2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg px-4 py-2 transition-colors cursor-pointer"
                >
                    Torna indietro
                </button>

                <button
                    type="submit"
                    class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg px-4 py-2 transition-colors cursor-pointer"
                >
                    Accedi
                </button>
            </div>
        </form>
    </div>

</body>
</html>
