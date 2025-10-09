@extends('layouts.layout_customer')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto mb-6">
        <h1 class="text-3xl font-bold text-[#FB7116] mb-4">{{ $prodotto->name }}</h1>

        <div class="mb-4 flex justify-end">
            <a href="{{ route('malfunzionamento.formNuovo') }}" 
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
                            <td>

                                <button
                                    type="button"
                                    class="delete-malfunzionamento-btn cursor-pointer text-red-600 hover:text-red-800"
                                    title="Elimina"
                                    data-malfunzionamento-id="{{ $malfunzionamento->id }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 32 32">
                                        <path d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                                Nessun malfunzionamento registrato.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
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
                success: function () { 
                    $(`tr#${malfunzionamentoId}`).fadeOut(300, function () {
                        $(this).remove();
                    });
                    alert('Malfunzionamento eliminato con successo.');
                },
                error: function () {
                    alert('Errore durante l\'eliminazione.');
                }
            });
        });
    });
</script>
@endpush