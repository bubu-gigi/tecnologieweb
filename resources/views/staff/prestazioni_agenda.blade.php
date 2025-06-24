@extends('layouts.layout_staff')

@section('title', 'Agenda Prestazioni')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">

    @php
        $orari = collect(range(8, 19))->map(fn($h) => $h . ':00');
        $headers = array_merge(['Data'], $orari->toArray());
    @endphp

    <!--
        slots' => [
            '2025-06-01' => [
                ['orario' => 8, 'occupato' => false],
                ['orario' => 9, 'occupato' => true],
            ],
        ....
        ]
     */ -->
    <x-table :headers="$headers">
        @foreach($slots as $data => $fasce)
            @php
                $oggi = \Carbon\Carbon::today();
                $dataCorrente = \Carbon\Carbon::parse($data);
                if ($dataCorrente->lessThan($oggi)) continue;
                $isGiornoEscluso = $dataCorrente->dayOfWeekIso == $giornoEscluso;
            @endphp
            <tr>
                <th class="px-4 py-2 font-medium text-left">
                    {{ \Carbon\Carbon::parse($data)->format('d/m/Y') }}
                </th>

                @foreach($orari as $orario)
                    @php
                        $oraInt = (int) explode(':', $orario)[0];
                        $fascia = collect($fasce)->first(fn($f) => (int) $f['orario'] === $oraInt);
                    @endphp

                    <td
                        class="px-4 py-2 text-center
                            {{ $isGiornoEscluso ? 'bg-red-400 text-white font-bold' :
                               ($fascia
                                ? ($fascia['occupato'] ? 'bg-yellow-300' : 'cursor-pointer bg-green-100')
                                : 'bg-gray-100') }}"
                        @if($fascia && !$fascia['occupato'] && !$isGiornoEscluso)
                            onclick="sendSlot('{{ $data }}', '{{ $oraInt }}')"
                        @endif
                    >
                        {{ $isGiornoEscluso ? 'X' : ($fascia ? ($fascia['occupato'] ? 'O' : 'L') : '-') }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </x-table>

    <x-card class="bg-white mt-4 w-full max-w-sm">
        <h2 class="text-lg font-semibold mb-2 text-gray-800">Legenda orari:</h2>

        <ul class="space-y-2 text-sm text-gray-700">
            <li class="flex items-center gap-2">
                <span class="w-4 h-4 rounded-full bg-green-500 inline-block"></span>
                Orario disponibile
            </li>
            <li class="flex items-center gap-2">
                <span class="w-4 h-4 rounded-full bg-yellow-500 inline-block"></span>
                Orario occupato
            </li>
             <li class="flex items-center gap-2">
                <span class="w-4 h-4 rounded-full bg-red-500 inline-block"></span>
                Giorno escluso dal paziente
            </li>
        </ul>
    </x-card>

</x-card>
@endsection

@push('scripts')
<script>
    function sendSlot(date, time) {
        $.ajax({
            url: '{{ url("/staff/prenotazioni/" . $prenotazioneId) }}',
            method: 'PUT',
            data: JSON.stringify({
                date: date,
                time: time
            }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                alert('Slot inviato con successo!');
                window.location.href = '{{ route("staff.bookings.index") }}';
            },
            error: function (xhr) {
                alert('Errore durante l\'invio dello slot.');
            }
        });
    }
</script>
@endpush
