@extends('layouts.layout_customer')

@section('title', 'Area Prestazioni')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4 gap-6">
    <x-card class="w-full max-w-4xl p-6 bg-white shadow-lg rounded-lg">
        <div class="flex flex-col gap-6">
            <h2 class="text-2xl font-bold text-indigo-700 text-center">Ricerca Prestazioni</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ricerca per prestazione -->
                {!! html()->form('GET', route('customers.prestazioni.search'))->open() !!}
                    <div class="flex flex-col gap-2">
                        <label for="prestazione" class="text-sm font-medium text-gray-700">Ricerca per prestazione:</label>
                        <input
                            type="text"
                            name="prestazione"
                            value="{{ old('prestazione') }}"
                            placeholder="es. Visita, Radiografia o R*"
                            class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        >
                        @error('prestazione')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold mt-2">
                            Cerca
                        </x-button>
                    </div>
                {{ html()->form()->close() }}

                <!-- Ricerca per dipartimento -->
                {!! html()->form('GET', route('customers.prestazioni.search'))->open() !!}
                    <div class="flex flex-col gap-2">
                        <label for="dipartimento" class="text-sm font-medium text-gray-700">Ricerca per dipartimento:</label>
                        <input
                            type="text"
                            name="dipartimento"
                            value="{{ old('dipartimento') }}"
                            placeholder="es. Cardiologia o C*"
                            class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        >
                        @error('dipartimento')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold mt-2">
                            Cerca
                        </x-button>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </x-card>

    @if(isset($prestazioni) && count($prestazioni) > 0)
        <x-card class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg">
            <h3 class="text-xl font-semibold text-indigo-700 mb-4">Risultati trovati</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($prestazioni as $prestazione)
                    <div class="bg-gray-100 p-4 rounded-lg shadow flex flex-col justify-between">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">{{ $prestazione->descrizione }}</h4>
                            <p class="text-sm text-gray-700 mt-2">
                                <strong>Dipartimento:</strong> {{ $prestazione->medico->dipartimento->nome ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-700">
                                <strong>Medico:</strong> {{ $prestazione->medico->nome }} {{ $prestazione->medico->cognome }}
                            </p>
                            <p class="text-sm text-gray-700">
                                <strong>Giorni:</strong> {{ $prestazione->giorni ?? 'Non specificati' }}
                            </p>
                            <p class="text-sm text-gray-700">
                                <strong>Orari:</strong> {{ $prestazione->orari ?? 'Non specificati' }}
                            </p>
                        </div>
                        <x-button
                            class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold"
                            data-id="{{ $prestazione->id }}"
                            onclick="prenotaPrestazione('{{ $prestazione->id }}')">
                            Prenota
                        </x-button>
                        <div id="user-data" data-user-id="{{ auth()->id() }}"></div>
                    </div>
                @endforeach
            </div>
        </x-card>
    @endif

    <x-card class="w-full max-w-4xl p-4 bg-white shadow rounded-lg text-sm text-gray-600 mt-6">
        Ricorda: quando richiedi una prestazione, non devi specificare data e ora. Lo staff assegnerà il primo slot disponibile e te lo comunicherà direttamente.
    </x-card>
</div>
@endsection

@push('scripts')
<script>
    function prenotaPrestazione(prestazioneId) {
        const userId = document.querySelector('#user-data').dataset.userId;

        $.ajax({
            url: "{{ route('reservations.store') }}",
            type: 'POST',
            data: JSON.stringify({
                user_id: userId,
                prestazione_id: prestazioneId,
            }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                alert('Prenotazione effettuata con successo!');
            },
            error: function (error) {
                console.error('Errore durante la prenotazione:', error.responseText);
                alert('Errore durante la prenotazione.');
            }
        });
    }
</script>
@endpush
