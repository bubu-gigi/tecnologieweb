<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">

    <x-card class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg">
        <div class="flex flex-col gap-6">
            <h2 class="text-center text-2xl font-bold text-indigo-700">Login</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <x-input
                    label="Username"
                    name="username"
                    placeholder="Inserisci username"
                    class="w-full"
                    autofocus
                />

                <x-input
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Inserisci la password"
                    class="w-full"
                />

                <div class="flex justify-center gap-4">
                    <x-button type="button"
                            onclick="window.history.back()"
                            class="w-1/2 bg-gray-400 hover:bg-gray-500 text-white font-semibold">
                        Torna indietro
                    </x-button>
                    <x-button type="submit"
                            class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                        Accedi
                    </x-button>
                </div>
                
            </form>
        </div>
    </x-card>

</body>
</html>
