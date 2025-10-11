@extends('layouts.layout_amministratore')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto mb-6">
        <h1 class="text-3xl font-bold text-[#FB7116] mb-4">Tecnici</h1>

        <div class="mb-4 flex justify-end">
            <a href="{{ route('amministratore.tecnicoAssistenza.create') }}" 
                class="bg-[#FB7116] text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition-all duration-200">
                Nuovo tecnico
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nome</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Cognome</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Data di nascita</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Specializzazione</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Centro assistenza</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Password</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Azioni</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tecnici as $tecnico)
                        <tr id="tecnico-{{ $tecnico->id }}" class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">{{ $tecnico->nome }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $tecnico->cognome }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $tecnico->data_nascita }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $tecnico->specializzazione ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-800">
                                {{ $tecnico->centroAssistenza->nome ?? '—' }}<br>
                                <span class="text-sm text-gray-500">{{ $tecnico->centroAssistenza->indirizzo ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-800">{{ $tecnico->username }}</td>
                            <td class="py-3 px-6 text-center">******</td>
                            <td class="px-6 py-4 flex items-center justify-end space-x-3">
                                <a href="{{ route('amministratore.tecnicoAssistenza.edit', $tecnico->id) }}"
                                   class="text-[#FB7116] hover:text-[#e35f0f]"
                                   title="Modifica">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    class="delete-tecnico-btn cursor-pointer text-[#FB7116] hover:text-[#e35f0f]"
                                    title="Elimina"
                                    data-id="{{ $tecnico->id }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 32 32">
                                        <path d="M15 4c-.52 0-1.06.18-1.44.56A2 2 0 0 0 13 6v1H7v2h1v16c0 1.65 1.35 3 3 3h12c1.65 0 3-1.35 3-3V9h1V7h-6V6c0-.52-.18-1.06-.56-1.44A2 2 0 0 0 19 4Zm0 2h4v1h-4Zm-5 3h14v16c0 .55-.45 1-1 1H11c-.55 0-1-.45-1-1Zm2 3v11h2V12Zm4 0v11h2V12Zm4 0v11h2V12Z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Nessun tecnico registrato.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        $('.delete-tecnico-btn').on('click', function () {
            const tecnicoId = $(this).data('id');
            if (!confirm('Sei sicuro di voler eliminare questo tecnico?')) return;

            $.ajax({
                url: `{{ url('/amministratore/tecnici-assistenza') }}/${tecnicoId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function () {
                    $(`#tecnico-${tecnicoId}`).fadeOut(300, function () {
                        $(this).remove();
                    });
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-5 right-5 z-50 bg-[#FB7116] text-white px-5 py-3 rounded-lg shadow-lg flex items-center space-x-3 transition-all duration-500';
                    toast.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg><span class="font-semibold">Tecnico eliminato correttamente.</span>';
                    document.body.appendChild(toast);
                    setTimeout(() => toast.style.opacity = '0', 3000);
                },
                error: function () {
                    alert('Errore durante l\'eliminazione.');
                }
            });
        });
    });
</script>
@endpush
@endsection

