<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">

    <x-card class="w-full max-w-2xl p-6 bg-white shadow-lg rounded-lg">
        <div class="flex flex-col gap-6">
            <h2 class="text-center text-2xl font-bold text-indigo-700">Registrazione</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

            @if(request()->has('redirect_to'))
                <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">
            @endif

            <div class="grid grid-cols-2 gap-4">
                <x-input name="nome" label="Nome" placeholder="Inserisci il tuo nome" autofocus />
                <x-input name="cognome" label="Cognome" placeholder="Inserisci il tuo cognome" />
                <x-input name="indirizzo" label="Indirizzo" placeholder="Via, numero civico" />
                <x-input name="citta" label="Città" placeholder="Città di residenza" />
                <x-input name="dataNascita" label="Data di nascita" type="date" />
                <x-input name="username" label="Username" placeholder="Scegli un username" />
                <x-input name="password" label="Password" type="password" placeholder="Crea una password" />
                <x-input name="password_confirmation" label="Conferma Password" type="password" placeholder="Ripeti la password" />
            </div>

            <div class="flex justify-center gap-4">
                <x-button type="button"
                        onclick="window.history.back()"
                        class="w-1/2 bg-gray-400 hover:bg-gray-500 text-black font-semibold">
                    Torna indietro
                </x-button>
                <x-button type="submit"
                        class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                    Registrati
                </x-button>
            </div>

            </form>
        </div>
    </x-card>

</body>
</html>
