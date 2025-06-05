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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                                <path d="M 43.125 2 ... Z"></path>
                            </svg>
                        </a>

                        <button type="button" class="delete-prestazione-btn text-red-600 hover:text-red-800 cursor-pointer" data-id="{{ $prestazione->id }}" title="Elimina">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
                                <path d="M 15 4 ... Z"></path>
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
