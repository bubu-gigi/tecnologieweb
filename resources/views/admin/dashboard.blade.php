@extends('layouts.layout_admin')

@section('title', 'Area Amministratore')

@section('content')
<div class="flex flex-col gap-6">
    <h2 class="text-2xl font-bold text-indigo-700 text-center bg-white px-4 py-2 rounded shadow">Benvenuto Amministratore</h2>

    <div class="grid grid-cols-3 gap-6">
        <x-card class="bg-indigo-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-indigo-800">Gestione Dipartimenti</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Aggiorna le informazioni relative ai dipartimenti e alla loro struttura.
                </p>
            </div>
            <a href="{{ route('admin.departments.index') }}"
               class="mt-4 inline-block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                Modifica Dipartimenti
            </a>
        </x-card>

        <x-card class="bg-green-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-green-800">Gestione Prestazioni</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Gestisci prestazioni sanitarie e le relative agende in modo semplice e veloce.
                </p>
            </div>
            <a href="{{ route('admin.services.index') }}"
               class="mt-4 inline-block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Modifica Prestazioni
            </a>
        </x-card>

        <x-card class="bg-yellow-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-yellow-800">Gestione Utenti</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Modifica e monitora i dati degli utenti registrati sulla piattaforma.
                </p>
            </div>
            <a href="{{ route('admin.users.index') }}"
               class="mt-4 inline-block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                Modifica Utenti
            </a>
        </x-card>

        <x-card class="bg-blue-100 p-4 rounded-lg shadow-sm flex flex-col justify-between col-span-3">
            <div>
                <h3 class="text-lg font-semibold text-blue-800">Gestione Statistiche</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Visualizza report dettagliati sull’attività della struttura sanitaria.
                </p>
                <ul class="list-disc list-inside text-sm text-gray-800 mt-2 space-y-1">
                    <li>Prestazioni erogate per tipo</li>
                    <li>Prestazioni per dipartimento</li>
                    <li>Storico prestazioni di un utente</li>
                </ul>
            </div>
            <a href="{{ url('/admin/statistiche') }}"
               class="mt-4 inline-block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded w-1/2 mx-auto">
                Visualizza Statistiche
            </a>
        </x-card>
    </div>
</div>
@endsection
