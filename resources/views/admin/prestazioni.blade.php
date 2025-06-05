@extends('layouts.layout_admin')

@section('title', 'Prestazioni')

@section('content')

<x-card class="bg-white p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-indigo-700 mb-4">Gestione Prestazioni</h3>
        <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
            <a href="{{ route('admin.services.create') }}" class="block text-white">Nuovo</a>
        </x-button>
    </div>

    @if(isset($prestazioni) && count($prestazioni) > 0)
        <x-table :headers="['ID', 'Descrizione', 'Prescrizioni', 'Medico', 'Staff', 'Azioni']">
            @foreach($prestazioni as $prestazione)
                <tr class="hover:bg-indigo-50 transition">
                    <td class="px-6 py-3">{{ $prestazione->id }}</td>
                    <td class="px-6 py-3">{{ $prestazione->descrizione }}</td>
                    <td class="px-6 py-3 text-sm text-gray-700">
                        {{ \Illuminate\Support\Str::limit($prestazione->prescrizioni, 60, '...') }}
                    </td>
                    <td class="px-6 py-3">{{ $prestazione->medico->nome }} {{ $prestazione->medico->cognome }}</td>
                    <td class="px-6 py-3">{{ $prestazione->staff ? $prestazione->staff->nome . ' ' . $prestazione->staff->cognome : '-' }}</td>
                    <td class="px-6 py-3 flex gap-4 items-center">
                        <a href="{{ route('admin.services.edit', $prestazione->id) }}" class="text-indigo-600 hover:text-indigo-800" title="Modifica">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
                                <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                            </svg>
                        </a>

                        <button type="button" class="delete-prestazione-btn text-red-600 hover:text-red-800 cursor-pointer" data-id="{{ $prestazione->id }}" title="Elimina">
                           <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 32 32">
                                <path d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-table>
    @else
        <p class="text-sm text-gray-600">Nessuna prestazione trovata.</p>
    @endif
</x-card>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.delete-prestazione-btn').on('click', function () {
            const id = $(this).data('id');
            const button = $(this);

            if (!confirm('Sei sicuro di voler eliminare questa prestazione?')) return;

            $.ajax({
                url: `{{ url('/admin/prestazioni') }}/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function () {
                    button.closest('tr').fadeOut(300, function () {
                        $(this).remove();
                    });
                },
                error: function (xhr) {
                    alert('Errore durante l\'eliminazione della prestazione.');
                    console.error(xhr);
                }
            });
        });
    });
</script>
@endpush
