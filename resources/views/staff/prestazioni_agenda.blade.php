@extends('layouts.layout_staff')

@section('title', 'Agenda Prestazioni')

@section('content')
@dump($slots)
<x-card class="bg-white p-4 rounded-lg shadow-md">

    @php
    $orari = collect(range(8, 19))->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00');
    $headers = array_merge(['Data'], $orari->toArray());
    @endphp

    <x-table :headers="$headers">
        @foreach($slots as $data => $fasce)
            <tr>
                <th class="px-4 py-2 font-medium text-left">
                    {{ \Carbon\Carbon::parse(time: $data)->format('d/m/Y') }}
                </th>

                @foreach($orari as $orario)
                    @php
                        $fascia = collect($fasce)->first(fn($f) => (int) $f['orario'] === (int) explode(':', $orario)[0]);
                    @endphp
                    <td
                        class="px-4 py-2 text-center
                            {{ $fascia
                                ? ($fascia['occupato'] ? 'bg-yellow-300' : 'cursor-pointer bg-green-100')
                                : 'bg-gray-100' }}"
                        @if($fascia && !$fascia['occupato'])
                            onclick="sendSlot('{{ $data }}', '{{ (int) explode(':', $orario)[0] }}')""
                        @endif
                    >
                        {{ $fascia ? ($fascia['occupato'] ? 'O' : 'L') : '-' }}
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
        </ul>
    </x-card>

</x-card>
@endsection
@push('scripts')
<script>
    function sendSlot(date, time) {
        $.ajax({
            url: '{{ route("staff.prenotazioni.assegnaSlot", ["id" => $prenotazioneId]) }}',
            method: 'PUT',
            data: {
                date: date,
                time: time,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                alert('Slot inviato con successo!');
                window.location.href = '{{ route("staff.prenotazioni") }}';
            },
            error: function (xhr) {
                alert('Errore durante l\'invio dello slot.');
            }
        });
    }
</script>
@endpush
