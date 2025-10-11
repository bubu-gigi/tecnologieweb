@extends('layouts.layout_amministratore')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-[#FB7116] mb-6">
            {{ isset($membro) ? 'Modifica membro dello staff' : 'Nuovo membro dello staff' }}
        </h1>

        <form 
            method="POST" 
            action="{{ isset($membro) 
                ? route('amministratore.tecnicoAzienda.update', $membro->id)
                : route('amministratore.tecnicoAzienda.store') }}"
        >
            @csrf
            @if(isset($membro))
                @method('PUT')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <input type="text" name="nome" value="{{ old('nome', $membro->nome ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cognome</label>
                    <input type="text" name="cognome" value="{{ old('cognome', $membro->cognome ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username', $membro->username ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="text" name="password" value="" placeholder="{{ isset($membro) ? 'Lascia vuoto per non modificare' : '' }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400">
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('amministratore.gestioneTecniciAzienda') }}" 
                   class="bg-gray-300 text-gray-700 px-4 cursor-pointer py-2 rounded-lg shadow hover:bg-gray-400 transition">
                   Annulla
                </a>
                <button type="submit" 
                        class="bg-[#FB7116] text-white cursor-pointer px-6 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition">
                    Salva staff
                </button>
            </div>
        </form>
    </div>
</div>

@if (session('success'))
<script>
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-5 right-5 z-50 bg-[#FB7116] text-white px-5 py-3 rounded-lg shadow-lg flex items-center space-x-3 transition-all duration-500';
    toast.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg><span class="font-semibold">{{ session('success') }}</span>';
    document.body.appendChild(toast);
    setTimeout(() => toast.style.opacity = '0', 3000);
</script>
@endif
@endsection