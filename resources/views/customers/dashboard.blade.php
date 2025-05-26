@extends('layouts.layout_customer')

@section('title', 'Area Utente Registrato')

@section('content')
<div class="flex flex-col gap-6">
    <h2 class="text-2xl font-bold text-indigo-700 text-center">Benvenuto nella tua Area Personale, {{ Auth::user()->nome }}</h2>

    <div class="grid grid-cols-3 gap-6">
        <x-card class="bg-indigo-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-indigo-800">Gestione Profilo</h3>
                <p class="text-sm text-gray-700 mt-2">Aggiorna le tue informazioni personali come nome, indirizzo o password.</p>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="mt-4 inline-block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                Modifica Profilo
            </a>
        </x-card>

        <x-card class="bg-green-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-green-800">Gestione Prestazioni</h3>
                <p class="text-sm text-gray-700 mt-2">Accedi alla sezione di ricerca e gestione delle prestazioni disponibili.</p>
            </div>
            <a href="{{ route('customers.prestazioni') }}"
                class="mt-4 inline-block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Ricerca Prestazioni
            </a>
        </x-card>

        <x-card class="bg-yellow-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-yellow-800">Prenotazioni</h3>
                <ul class="list-disc list-inside text-sm text-gray-700 mt-2 space-y-1">
                    <li>Visualizza prenotazioni future</li>
                    <li>Consulta lo storico</li>
                    <li>Annulla una prenotazione attiva</li>
                </ul>
            </div>
            <a href="{{ route('customers.prenotazioni') }}"
                class="mt-4 inline-block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                Gestisci Prenotazioni
            </a>
        </x-card>
    </div>
</div>
@endsection
