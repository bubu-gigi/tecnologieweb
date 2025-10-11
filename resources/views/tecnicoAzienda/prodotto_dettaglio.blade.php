@extends('layouts.layout_tecnicoAzienda')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto mb-6">
        <h1 class="text-3xl font-bold text-[#FB7116] mb-4">{{ $prodotto->name }}</h1>

        <div class="mb-4 flex justify-end">
            <a href="{{ route('malfunzionamento.formNuovo', ['id' => $prodotto->id]) }}" 
                class="bg-[#FB7116] text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition-all duration-200">
                    Nuovo malfunzionamento
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Malfunzionamento</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Soluzione tecnica</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Azioni</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($prodotto->malfunzionamenti as $malfunzionamento)
                        <tr id="{{ $malfunzionamento->id }}" class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">{{ $malfunzionamento->descrizione }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $malfunzionamento->soluzione_tecnica }}</td>
                            <td class="px-6 py-4 flex items-center justify-end space-x-3">
                                <a href="{{ route('malfunzionamento.edit', $malfunzionamento->id) }}"
                                   class="text-[#FB7116] hover:text-[#e35f0f]"
                                   title="Modifica">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    class="delete-malfunzionamento-btn cursor-pointer text-[#FB7116] hover:text-[#e35f0f]"
                                    title="Elimina"
                                    data-malfunzionamento-id="{{ $malfunzionamento->id }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 32 32">
                                        <path d="M15 4c-.52 0-1.06.18-1.44.56A2 2 0 0 0 13 6v1H7v2h1v16c0 1.65 1.35 3 3 3h12c1.65 0 3-1.35 3-3V9h1V7h-6V6c0-.52-.18-1.06-.56-1.44A2 2 0 0 0 19 4Zm0 2h4v1h-4Zm-5 3h14v16c0 .55-.45 1-1 1H11c-.55 0-1-.45-1-1Zm2 3v11h2V12Zm4 0v11h2V12Zm4 0v11h2V12Z"/>
                                     </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Nessun malfunzionamento registrato.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ✅ Toast di successo, visibile anche dopo redirect --}}
@if(session('success'))
    <div id="toast-success"
         class="fixed bottom-6 right-6 bg-[#FB7116] text-white px-5 py-3 rounded-lg shadow-lg text-sm font-medium opacity-0 transition-opacity duration-500">
        {{ session('success') }}
    </div>
@endif
@endsection

@push('scripts')
<script>
    $(function () {
        $('.delete-malfunzionamento-btn').on('click', function () {
            const malfunzionamentoId = $(this).data('malfunzionamento-id');
            if (!confirm('Sei sicuro di voler eliminare questo malfunzionamento?')) return;

            $.ajax({
                url: `{{ url('/tecnico-azienda/malfunzionamenti') }}/${malfunzionamentoId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) { 
                    $(`tr#${malfunzionamentoId}`).fadeOut(300, function () {
                        $(this).remove();
                    });
                    showToast(response.message || 'Malfunzionamento eliminato con successo.');
                },
                error: function () {
                    showToast('Errore durante l\'eliminazione.');
                }
            });
        });

        // Mostra toast se presente nella sessione
        @if(session('success'))
            const toast = document.getElementById('toast-success');
            setTimeout(() => toast.classList.remove('opacity-0'), 100);
            setTimeout(() => toast.classList.add('opacity-0'), 3500);
        @endif
    });

    // ✅ Funzione toast riutilizzabile
    function showToast(message) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.className = 'fixed bottom-6 right-6 bg-[#FB7116] text-white px-5 py-3 rounded-lg shadow-lg text-sm font-medium opacity-0 transition-opacity duration-500';
        document.body.appendChild(toast);
        setTimeout(() => toast.classList.remove('opacity-0'), 100);
        setTimeout(() => toast.classList.add('opacity-0'), 3500);
        setTimeout(() => toast.remove(), 4000);
    }
</script>
@endpush
