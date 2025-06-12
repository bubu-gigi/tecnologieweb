@extends('layouts.layout_staff')

@section('title', 'Staff Prenotazioni Prestazione')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">
    @if(isset($prenotazioni) && count($prenotazioni) > 0)
        <div class="flex justify-between items-center mb-2">
            <p class="text-base font-semibold text-indigo-700 mr-4">Prenotazioni {{ $prenotazioni->first()->prestazione->descrizione }}</p>
            <div class="flex items-center gap-2">
                <x-input
                    name="data_prenotazione"
                    label="Filtra per data:"
                    type="date"
                    min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                    max="2025-06-30"
                />

                <x-button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold"
                    id="bottone_reset"
                    >
                    Azzera
                </x-button>
            </div>
        </div>
    <x-table id="tabella_prenotazioni" :headers="['Utente', 'Dipartimento', 'Prestazione', 'Data e Ora Prenotazione']">
        @foreach($prenotazioni as $prenotazione)
            <tr class="hover:bg-indigo-50 transition">
                <td class="px-6 py-3 capitalize">{{ $prenotazione->user->cognome }} {{ $prenotazione->user->nome }}</td>
                <td class="px-6 py-3 capitalize">{{ $prenotazione->prestazione->medico->dipartimento->nome }} </td>
                <td class="px-6 py-3">{{  \Carbon\Carbon::parse($prenotazione->data_prenotazione)->format('d/m/Y H:i')}}</td>
            </tr>
        @endforeach
    </x-table>
    @else
        <p>Nessuna Prenotazione trovata</p>
    @endif
</x-card>
@endsection
@push('scripts')
<script>
    $(function () {
        $('#bottone_reset').on('click', function () {
            $('#data_prenotazione').val(null);
            searchTable();
        });

        $('#data_prenotazione').on('input', function () {
            searchTable();
        });

        function searchTable() {
            const search_data_raw = $('#data_prenotazione').val();
            const search_data = search_data_raw ? search_data_raw.split('-').reverse().join('/') : '';
            $('tr').each(function () {
                const cell = $(this).find('td').eq(3);
                if (cell.length) {
                    const cellDateTime = cell.text().trim();
                    const rowDate = cellDateTime.split(' ')[0];
                    $(this).toggleClass('hidden', rowDate !== search_data && search_data !== '');
                }
            });
        }
    });
</script>
@endpush


