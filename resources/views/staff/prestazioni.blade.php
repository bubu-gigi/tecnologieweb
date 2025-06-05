@extends('layouts.layout_staff')

@section('title', 'Staff Prestazioni')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">

    @if(isset($prestazioni) && count($prestazioni) > 0)
    <x-table :headers="['Prestazione', 'Medico', 'Calendario']">
        @foreach($prestazioni as $prestazione)
            <tr class="hover:bg-indigo-50 transition">
                <td class="px-6 py-3">{{ $prestazione->descrizione }}</td>
                <td class="px-6 py-3 capitalize">{{ $prestazione->medico->nome }} {{ $prestazione->medico->cognome }}</td>
                <td class="px-6 py-3 flex gap-4 items-center">

                    <x-input
                        name="data_prestazione"
                        label="Seleziona la data:"
                        type="date"
                        min="2025-06-01"
                        max="2025-06-30"
                    />

                    <a href="/staff/prestazioni/" id="confermaBtn" class="mt-1 inline-block bg-white text-indigo-700 font-semibold py-1 px-2 rounded-lg shadow hover:bg-indigo-100 transition hidden">Conferma</a>

                </td>
            </tr>
        @endforeach
    </x-table>
    @else
        <p>Nessuna Prestazione trovata</p>
    @endif
</x-card>
@endsection

@push('scripts')
<script>
        const inputData = document.getElementById('data_prestazione');
        const btn = document.getElementById('confermaBtn');

        inputData.addEventListener('change', function() {
            const dataSelezionata = this.value;
            if (dataSelezionata) {
                btn.href = '';
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
</script>
@endpush
