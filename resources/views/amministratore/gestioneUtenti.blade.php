@extends('layouts.layout_amministratore')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center justify-start p-6">
    <div class="max-w-4xl w-full text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-[#FB7116]">Gestisci Utenti</h1>
        <p class="text-gray-700 mt-2 text-lg">Scegli quale tipologia di utente gestire</p>
    </div>

    <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- 👷‍♂️ GESTISCI TECNICI --}}
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between hover:shadow-xl transition">
            <h2 class="text-2xl font-semibold text-[#FB7116] mb-4">Gestisci Tecnici</h2>
            <p class="text-gray-700 mb-6">
                Gestisci i tecnici dei centri di assistenza.
            </p>
            <button 
                onclick="window.location.href='{{ route('amministratore.gestioneTecniciAssistenza') }}'"
                class="bg-[#FB7116] cursor-pointer hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors"
            >
                Gestisci Tecnici
            </button>
        </div>

        {{-- 👩‍💼 GESTISCI STAFF --}}
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between hover:shadow-xl transition">
            <h2 class="text-2xl font-semibold text-[#FB7116] mb-4">Gestisci Staff</h2>
            <p class="text-gray-700 mb-6">
                Aggiungi, modifica o elimina membri dello staff tecnico.
            </p>
            <button 
                onclick="alert('Sezione Staff in sviluppo');"
                class="bg-[#FB7116] cursor-pointer hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors"
            >
                Gestisci Staff
            </button>
        </div>
    </div>
</div>
@endsection
