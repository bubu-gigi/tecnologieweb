@extends('layouts.layout_admin')

@section('title', 'Utenti di test')

@section('content')

<x-card class="bg-white p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-indigo-700 mb-4">Gestione Utenti</h3>
        <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
            <a href="{{ route('admin.users.create') }}" class="block text-white">Nuovo</a>
        </x-button>
    </div>

    @if(isset($users) && count($users) > 0)
    <x-table :headers="['ID', 'Nome', 'Cognome', 'Username', 'Azioni']">
        @foreach($users as $user)
            <tr id="{{ $user->id }}" class="hover:bg-indigo-50 transition">
                <td class="px-6 py-3">{{ $user->id }}</td>
                <td class="px-6 py-3">{{ $user->nome }}</td>
                <td class="px-6 py-3">{{ $user->cognome }}</td>
                <td class="px-6 py-3 capitalize">{{ $user->username }}</td>
                <td class="px-6 py-3 flex gap-4 items-center">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-800" title="Modifica">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                            <path d="M 43.125 2 ... Z"></path>
                        </svg>
                    </a>

                    <button
                        type="button"
                        class="delete-user-btn cursor-pointer text-red-600 hover:text-red-800"
                        title="Elimina"
                        onclick="eliminaUtente('{{ $user->id }}')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
                            <path d="M 15 4 ... Z"></path>
                        </svg>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-table>
    @else
        <p>Nessun utente trovato</p>
    @endif
</x-card>
@endsection

@push('scripts')
<script>
    function eliminaUtente(userId) {
        if (!confirm('Sei sicuro di voler eliminare questo utente?')) return;

        $.ajax({
            url: `{{ url('/admin/utenti') }}/${userId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function () {
                $(`tr#${userId}`).fadeOut(300, function () {
                    $(this).remove();
                });
                alert('Utente eliminato con successo.');
            },
            error: function (xhr) {
                console.error(xhr);
                alert('Errore durante l\'eliminazione.');
            }
        });
    }
</script>
@endpush
