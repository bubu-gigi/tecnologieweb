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

            {!! html()->form('POST', url('login'))->open() !!}
                {{ csrf_field() }}

                <x-input
                    label="Username"
                    name="username"
                    placeholder="Inserisci username"
                    class="w-full"
                />

                <x-input
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Inserisci la password"
                    class="w-full"
                />

                <div class="flex justify-center">
                    <x-button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 font-semibold">
                        Accedi
                    </x-button>
                </div>
            {{ html()->form()->close() }}
        </div>
    </x-card>

</body>
</html>
