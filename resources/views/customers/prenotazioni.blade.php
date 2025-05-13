@extends('layouts.layout_customer')

@section('title', 'Area Prenotazioni')

@section('content')
<x-card class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-indigo-700 text-center mb-6">Le tue Prenotazioni</h2>

    @if(isset($prenotazioni) && count($prenotazioni) > 0)
        <div class="grid grid-cols-3 gap-6">
            @foreach($prenotazioni as $prenotazione)
                @php
                    $approvata = $prenotazione->data_prenotazione !== null;
                    $dataApprovata = $approvata
                        ? \Carbon\Carbon::parse($prenotazione->data_prenotazione)->format('d/m/Y H:i')
                        : null;
                    $dataRichiesta = $prenotazione->created_at->format('d/m/Y H:i');
                @endphp

                <div class="bg-white border border-gray-200 p-4 rounded-lg shadow flex flex-col justify-between h-full">
                    <div>
                        <h4 class="text-lg font-bold text-gray-800">{{ $prenotazione->prestazione->descrizione }}</h4>
                        <p class="text-sm text-gray-700 mt-2">
                            <strong>Dipartimento:</strong> {{ $prenotazione->prestazione->medico->dipartimento->nome ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <strong>Medico:</strong> {{ $prenotazione->prestazione->medico->nome ?? '' }} {{ $prenotazione->prestazione->medico->cognome ?? '' }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <strong>Richiesta il:</strong> {{ $dataRichiesta }}
                        </p>

                        @if($approvata)
                            <p class="text-sm text-green-700 font-semibold">
                                <strong>Approvata:</strong> {{ $dataApprovata }}
                            </p>
                            <p class="text-sm text-green-600 mt-1">
                                <strong>Stato:</strong> Approvata
                            </p>
                        @else
                            <p class="text-sm text-red-600 mt-2">
                                <strong>Stato:</strong> In attesa di approvazione
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-600 text-lg mt-6">
            <p>Non hai ancora effettuato nessuna prenotazione.</p>
        </div>
    @endif
</x-card>
@endsection
