@extends('layouts.layout_tecnicoAzienda')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-[#FB7116] mb-6">
            {{ isset($malfunzionamento) ? 'Modifica malfunzionamento' : 'Nuovo malfunzionamento' }}
        </h1>

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

            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="bg-[#FB7116] cursor-pointer text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition-all duration-200"
                >
                    Salva
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
