@extends('layouts.layout_staff')

@section('title', 'Area Staff')

@section('content')
<div class="flex flex-col gap-6">
    <h2 class="text-2xl font-bold  text-white text-center">Benvenuto {{ Auth::user()->username }}</h2>

    <div class="grid grid-cols-3 gap-6">
        <!-- Inserimento Prestazioni -->
        <x-card class="bg-indigo-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-indigo-800">Inserimento Prestazioni</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Inserisci nuove prestazioni da associare al personale e ai dipartimenti.
                </p>
            </div>
            <a href="/staff/prenotazioni"
                class="mt-4 inline-block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                Inserisci
            </a>
        </x-card>

        <!-- Modifica Agende -->
        <x-card class="bg-green-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-green-800">Modifica Agende</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Accedi alla gestione delle agende delle prenotazioni per ciascuna prestazione.
                </p>
            </div>
            <a href="/staff/agende"
                class="mt-4 inline-block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Modifica Agende
            </a>
        </x-card>

        <!-- Visualizzazione Agende -->
        <x-card class="bg-yellow-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-yellow-800">Visualizzazioni Agende</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Consulta le agende delle prestazioni ancora da erogare, filtrando per giorno e visualizzando i dettagli degli appuntamenti e degli utenti.
                </p>
            </div>
            <a href="/staff/agende"
                class="mt-4 inline-block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                Visualizza Agende
            </a>
        </x-card>
    </div>
</div>
@endsection
