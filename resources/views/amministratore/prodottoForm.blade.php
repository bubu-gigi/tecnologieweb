@extends('layouts.layout_amministratore')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        @php
            // Verifica se si tratta di una modifica o creazione
            $isEdit = isset($prodotto);
        @endphp

        <h1 class="text-3xl font-bold text-[#FB7116] mb-6 text-center">
            {{ $isEdit ? 'Modifica prodotto' : 'Nuovo prodotto' }}
        </h1>

        <form 
            action="{{ $isEdit 
                ? route('amministratore.prodotto.update', $prodotto->id) 
                : route('amministratore.prodotto.store') }}"
            method="POST"
            class="bg-white shadow-lg rounded-lg p-6"
        >
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            {{-- Nome --}}
            <div class="mb-5">
                <label for="name" class="block text-gray-700 font-semibold mb-2">
                    Nome del prodotto
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    value="{{ old('name', $prodotto->name ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descrizione --}}
            <div class="mb-5">
                <label for="descrizione" class="block text-gray-700 font-semibold mb-2">
                    Descrizione
                </label>
                <textarea 
                    id="descrizione" 
                    name="descrizione"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >{{ old('descrizione', $prodotto->descrizione ?? '') }}</textarea>
                @error('descrizione')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Note d'uso --}}
            <div class="mb-5">
                <label for="note_uso" class="block text-gray-700 font-semibold mb-2">
                    Note d'uso
                </label>
                <textarea 
                    id="note_uso" 
                    name="note_uso"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >{{ old('note_uso', $prodotto->note_uso ?? '') }}</textarea>
                @error('note_uso')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Modalità di installazione --}}
            <div class="mb-6">
                <label for="mod_installazione" class="block text-gray-700 font-semibold mb-2">
                    Modalità di installazione
                </label>
                <textarea 
                    id="mod_installazione" 
                    name="mod_installazione"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >{{ old('mod_installazione', $prodotto->mod_installazione ?? '') }}</textarea>
                @error('mod_installazione')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
    <label for="staff" class="block text-sm font-medium text-gray-700 mb-1">
        Seleziona membro dello staff
    </label>
    <select 
        name="staff_id" 
        id="staff" 
        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400"
    >
        <option value="">-- Seleziona membro --</option>
        @foreach($staff as $membro)
            <option value="{{ $membro->id }}">
                {{ $membro->nome }}
            </option>
        @endforeach
    </select>
    @error('staff_id')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


            {{-- Pulsanti --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('amministratore.gestioneProdotti') }}"
                   class="bg-gray-200 text-gray-700 cursor-pointer font-semibold px-6 py-2 rounded-lg shadow hover:bg-gray-300 transition-all duration-200">
                    Annulla
                </a>

                <button 
                    type="submit"
                    class="bg-[#FB7116] text-white cursor-pointer font-semibold px-4 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition-all duration-200"
                >
                    {{ $isEdit ? 'Salva modifiche' : 'Crea prodotto' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
