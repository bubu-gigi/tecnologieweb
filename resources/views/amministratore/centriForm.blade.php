@extends('layouts.layout_amministratore')

@section('content')
<div class="min-h-screen bg-gray-50 p-6 flex flex-col items-center">
    <div class="max-w-xl w-full bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-[#FB7116] mb-6 text-center">
            {{ isset($centro) ? 'Modifica Centro di Assistenza' : 'Nuovo Centro di Assistenza' }}
        </h1>

        {{-- 🔹 Form --}}
        <form method="POST"
              action="{{ isset($centro) 
                    ? route('amministratore.centri.update', $centro->id) 
                    : route('amministratore.centri.store') }}">
            @csrf
            @if(isset($centro))
                @method('PUT')
            @endif

            {{-- Nome Centro --}}
            <div class="mb-5">
                <label for="nome" class="block text-gray-700 font-medium mb-2">Nome Centro</label>
                <input type="text"
                       id="nome"
                       name="nome"
                       value="{{ old('nome', $centro->nome ?? '') }}"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                       placeholder="Inserisci il nome del centro">
                @error('nome')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Indirizzo --}}
            <div class="mb-5">
                <label for="indirizzo" class="block text-gray-700 font-medium mb-2">Indirizzo</label>
                <input type="text"
                       id="indirizzo"
                       name="indirizzo"
                       value="{{ old('indirizzo', $centro->indirizzo ?? '') }}"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                       placeholder="Inserisci l'indirizzo completo">
                @error('indirizzo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pulsanti --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('amministratore.centri.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-5 py-2 rounded-lg shadow transition-colors cursor-pointer">
                    Annulla
                </a>
                <button type="submit"
                        class="bg-[#FB7116] hover:bg-orange-600 text-white cursor-pointer font-semibold px-6 py-2 rounded-lg shadow transition-colors cursor-pointer">
                    {{ isset($centro) ? 'Aggiorna' : 'Salva' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection