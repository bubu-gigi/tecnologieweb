@extends('layouts.layout_staff')

@section('title', 'Area Staff')

@section('content')
<div class="flex flex-col gap-6">
    <h2 class="text-2xl font-bold text-indigo-700 text-center bg-white px-4 py-2 rounded shadow">
        Benvenuto {{ Auth::user()->nome }}
    </h2>

    <div class="grid grid-cols-2 gap-6">
        <x-card class="bg-green-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-green-800">Prenotazioni</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Assegna uno slot alle prenotazioni richieste dai pazienti.
                </p>
            </div>
            <a href="{{ route('staff.bookings.index') }}"
               class="mt-4 inline-block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Gestisci Prenotazioni
            </a>
        </x-card>

        <x-card class="bg-yellow-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-yellow-800">Agende</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Consulta le agende delle prestazioni filtrando per giorno e visualizzando i dettagli degli appuntamenti e degli utenti.
                </p>
            </div>
            <a href="{{ route('staff.services.index') }}"
               class="mt-4 inline-block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                Visualizza Agende
            </a>
        </x-card>
    </div>
</div>
@endsection
