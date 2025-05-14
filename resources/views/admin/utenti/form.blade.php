@props(['user' => null])

@php
    $isEdit = $user !== null;
    $action = $isEdit
        ? route('admin.users.edit', $user->id)
        : route('admin.users.create');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp

<x-card class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-indigo-700 mb-6">
        {{ $isEdit ? 'Modifica Utente' : 'Nuovo Utente' }}
    </h3>

    <form class="grid grid-cols-2 gap-4" method="POST" action="{{ $action }}">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <x-input
            label="Nome"
            name="nome"
            value="{{ old('nome', $user->nome ?? '') }}"
            class="mb-4"
        />

        <x-input
            label="Cognome"
            name="cognome"
            value="{{ old('cognome', $user->cognome ?? '') }}"
            class="mb-4"
        />

        <x-input
            label="Username"
            name="username"
            value="{{ old('username', $user->username ?? '') }}"
            class="mb-4"
        />

        <x-input
            label="Password"
            name="password"
            type="password"
            placeholder="{{ $isEdit ? 'Lascia vuoto per non modificare' : '' }}"
            class="mb-4"
        />

        <div class="col-span-2 flex justify-center gap-4 mt-4">
            <x-button
                type="button"
                onclick="window.history.back()"
                class="w-1/2 bg-gray-400 hover:bg-gray-500 text-black font-semibold">
                Indietro
            </x-button>
            <x-button
                type="submit"
                class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                {{ $isEdit ? 'Aggiorna' : 'Crea' }}
            </x-button>
        </div>
    </form>
</x-card>
