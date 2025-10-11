<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - Nuovo Progetto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-r from-orange-100 via-orange-200 to-orange-300 flex items-center justify-center">

    <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-extrabold text-center text-[#FB7116] mb-6">Benvenuto</h1>
        <p class="text-center text-gray-500 mb-8">Accedi al tuo account</p>

        {{-- 🔴 MESSAGGIO DI ERRORE LOGIN --}}
        @if ($errors->has('login_error'))
            <div class="mb-4 flex items-center space-x-2 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                </svg>
                <span>{{ $errors->first('login_error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ url('login') }}" class="flex flex-col gap-4">
            @csrf

            <div>
                <label for="username" class="block text-gray-700 font-medium mb-1">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    placeholder="Inserisci username"
                    value="{{ old('username') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
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
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
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
                    class="w-1/2 bg-[#FB7116] hover:bg-orange-600 text-white font-semibold rounded-lg px-4 py-2 transition-colors cursor-pointer"
                >
                    Accedi
                </button>
            </div>
        </form>
    </div>

</body>
</html>

