@extends('layouts.layout_tecnicoAzienda')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-[#FB7116] mb-6">
            {{ isset($malfunzionamento) ? 'Modifica malfunzionamento e soluzione tecnica' : 'Nuovo malfunzionamento' }}
        </h1>

        {{-- FORM --}}
        <form 
            method="POST" 
            action="{{ isset($malfunzionamento) 
                ? url('/tecnico-azienda/malfunzionamenti/' . $malfunzionamento->id) 
                : url('/tecnico-azienda/prodotti/'. $prodotto_id . '/malfunzionamenti') }}"
        >
            @csrf
            @if(isset($malfunzionamento))
                @method('PUT')
            @endif

            {{-- Descrizione --}}
            <div class="mb-5">
                <label for="descrizione" class="block text-sm font-medium text-gray-700 mb-1">
                    Descrizione del malfunzionamento
                </label>
                <textarea 
                    name="descrizione" 
                    id="descrizione" 
                    rows="4" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                >{{ old('descrizione', $malfunzionamento->descrizione ?? '') }}</textarea>
            </div>

            {{-- Soluzione tecnica --}}
            <div class="mb-5">
                <label for="soluzione_tecnica" class="block text-sm font-medium text-gray-700 mb-1">
                    Soluzione tecnica
                </label>
                <textarea 
                    name="soluzione_tecnica" 
                    id="soluzione_tecnica" 
                    rows="4" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                >{{ old('soluzione_tecnica', $malfunzionamento->soluzione_tecnica ?? '') }}</textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
                {{-- 🔙 Bottone ANNULLA --}}
                <a 
                    href="{{ isset($malfunzionamento) 
                        ? route('tecnicoAzienda.prodotti.show', ['id' => $malfunzionamento->prodotto_id])
                        : url()->previous() }}"
                    class="bg-gray-200 text-gray-700 font-semibold px-6 py-2 rounded-lg shadow hover:bg-gray-300 transition-all duration-200"
                >
                    Annulla
                </a>

            {{-- Pulsante Salva --}}
            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="bg-[#FB7116] cursor-pointer text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition-all duration-200"
                >
                    Salva modifiche
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ✅ Toast notifica elegante --}}
@if(session('success'))
    <div id="toast-success"
         class="fixed bottom-6 right-6 bg-[#FB7116] text-white px-5 py-3 rounded-lg shadow-lg text-sm font-medium opacity-0 transition-opacity duration-500">
        {{ session('success') }}
    </div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Se esiste un messaggio di successo, mostra il toast
        @if(session('success'))
            const toast = document.getElementById('toast-success');
            setTimeout(() => toast.classList.remove('opacity-0'), 100);
            setTimeout(() => toast.classList.add('opacity-0'), 3500);
        @endif
    });

    // Funzione richiamabile in futuro anche via AJAX
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
