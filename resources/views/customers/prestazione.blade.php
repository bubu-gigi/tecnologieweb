@extends('layouts.layout_customer')

@section('title', 'Area Prestazioni')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4 gap-6">
    <x-card class="w-full max-w-4xl p-6 bg-white shadow-lg rounded-lg">
        <div class="flex flex-col gap-6">
            <h2 class="text-2xl font-bold text-indigo-700 text-center">Ricerca Prestazioni</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <form method="GET" action="{{ route('customers.services.search') }}">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="prestazione" class="text-sm font-medium text-gray-700">Ricerca per prestazione:</label>
                        <input
                            id="prestazione"
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
                </form>

                <form method="GET" action="{{ route('customers.services.search') }}">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="dipartimento" class="text-sm font-medium text-gray-700">Ricerca per dipartimento:</label>
                        <input
                            id="dipartimento"
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
                </form>
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
                        <div class="mt-4 flex flex-col gap-2">
                    <label for="escludi_giorno_{{ $prestazione->id }}" class="text-sm text-gray-700 font-medium">
                        Vuoi escludere un giorno?
                    </label>
                    <select
                        id="escludi_giorno_{{ $prestazione->id }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-400 focus:outline-none"
                    >
                        <option value="">-- Nessun giorno escluso --</option>
                        <option value="1">Lunedì</option>
                        <option value="2">Martedì</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        <option value="6">Sabato</option>
                    </select>

                    <x-button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold prenota-btn"
                        data-prestazione-id="{{ $prestazione->id }}"
                        data-user-id="{{ auth()->id() }}">
                        Prenota
                    </x-button>
                </div>

                    </div>
                @endforeach
            </div>
        </x-card>
    @elseif(isset($prestazioni) && count($prestazioni) === 0)
        <x-card class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg text-center text-gray-600">
            Non ci sono prestazioni/dipartimenti che corrispondono alla ricerca.
        </x-card>
    @endif

    <x-card class="w-full max-w-4xl p-4 bg-white shadow rounded-lg text-sm text-gray-600 mt-6">
        Ricorda: quando richiedi una prestazione, non devi specificare data e ora. Lo staff assegnerà il primo slot disponibile e te lo comunicherà direttamente.
    </x-card>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
        $('.prenota-btn').on('click', function () {
            const prestazioneId = $(this).data('prestazione-id');
            const userId = $(this).data('user-id');
            const giornoDaEscludere = $(`#escludi_giorno_${prestazioneId}`).val() || null;

            $.ajax({
                url: "{{ route('customers.bookings.store') }}",
                type: 'POST',
                data: JSON.stringify({
                    user_id: userId,
                    prestazione_id: prestazioneId,
                    giorno_escluso: giornoDaEscludere
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function () {
                    alert('Prenotazione effettuata con successo!');
                    window.location.href = "{{ route('customers.bookings.index') }}";
                },
                error: function () {
                    alert('Errore durante la prenotazione.');
                }
            });
        });
    });
</script>
@endpush
