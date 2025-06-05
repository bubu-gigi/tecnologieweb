@extends('layouts.layout_staff')

@section('title', 'Staff Prenotazioni')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">
    @if(isset($prenotazioni) && count($prenotazioni) > 0)
        <x-table :headers="['Utente', 'Prestazione', 'Data Prenotazione', 'Azioni']">
            @foreach($prenotazioni as $prenotazione)
                <tr id="{{ $prenotazione->id }}" class="hover:bg-indigo-50 transition">
                    <td class="px-6 py-3">{{ $prenotazione->user->cognome }} {{ $prenotazione->user->nome }}</td>
                    <td class="px-6 py-3 capitalize">{{ $prenotazione->prestazione->descrizione }}</td>
                    <td class="px-6 py-3">
                        {{ $prenotazione->data_prenotazione ?? 'Prenotazione non assegnata' }}
                    </td>
                    <td class="px-6 py-3 flex gap-4 items-center">
                        <a href="{{ route('staff.bookings.getSlot', $prenotazione->id) }}"
                           class="text-indigo-600 hover:text-indigo-800" title="Modifica">
                            <!-- Edit Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                                <path d="M 43.125 2 ... Z"></path>
                            </svg>
                        </a>

                        <button
                            type="button"
                            class="delete-prenotazione-btn cursor-pointer text-red-600 hover:text-red-800"
                            title="Elimina"
                            onclick="eliminaPrenotazione('{{ $prenotazione->id }}')"
                        >
                            <!-- Delete Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
                                <path d="M 15 4 ... Z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-table>
    @else
        <p class="text-gray-600">Nessuna Prenotazione trovata</p>
    @endif
</x-card>
@endsection

@push('scripts')
<script>
    function eliminaPrenotazione(prenotazioneId) {
        if (!confirm('Sei sicuro di voler eliminare questa prenotazione?')) return;

        $.ajax({
            url: `/staff/prenotazioni/${prenotazioneId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function () {
                $(`tr#${prenotazioneId}`).remove();
                alert('Prenotazione eliminata con successo.');
            },
            error: function (xhr) {
                console.error(xhr);
                alert('Errore durante l\'eliminazione.');
            }
        });
    }
</script>
@endpush
