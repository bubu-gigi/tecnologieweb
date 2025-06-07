@extends('layouts.layout_staff')

@section('title', 'Staff Prenotazioni Prestazione')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">
    @if(isset($prenotazioni) && count($prenotazioni) > 0)    
        <div class="flex justify-between items-center mb-2">
            <p class="text-base font-semibold text-indigo-700 mr-4">Prenotazioni {{ $prenotazioni->first()->prestazione->descrizione }}</p>
            <x-input
                name="data_prenotazione"
                label="Filtra per data:"
                type="date"
                min="2025-06-01"
                max="2025-06-30"
            />

            <x-button 
                class="ml-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold"
                id="bottone_reset"
                >
                Azzera
            </x-button>
        </div>
    <x-table id="tabella_prenotazioni" :headers="['Utente', 'Data e Ora Prenotazione']">
        @foreach($prenotazioni as $prenotazione)
            <tr class="hover:bg-indigo-50 transition">
                <td class="px-6 py-3 capitalize">{{ $prenotazione->user->cognome }} {{ $prenotazione->user->nome }}</td>
                <td class="px-6 py-3">{{ $prenotazione->data_prenotazione }}</td>
            </tr>
        @endforeach
    </x-table>
    @else
        <p>Nessuna Prenotazione trovata</p>
    @endif
</x-card>
@endsection

@push('script')
<script>
        const date = document.getElementById('data_prenotazione');
        const table_rows = document.querySelectorAll('tr');

        date.addEventListener('input', searchTable);

        function searchTable() {
            const search_data = date.value;
            table_rows.forEach(row => {
                const cellDateTime = row.cells[1].innerText.trim(); 
                const [rowDate] = cellDateTime.split(' '); 

                row.classList.toggle('hidden', rowDate !== search_data);
            });
        }
</script>
@endpush

