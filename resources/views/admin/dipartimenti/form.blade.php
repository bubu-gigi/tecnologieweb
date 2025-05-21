@props(['dipartimento' => null])

@php
    $isEdit = $dipartimento !== null;
    $action = $isEdit
        ? route('admin.dipartimenti.edit', $dipartimento->id)
        : route('admin.dipartimenti.create');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp

<x-card class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-indigo-700 mb-6">
        {{ $isEdit ? 'Modifica Dipartimento' : 'Nuovo Dipartimento' }}
    </h3>

    <form method="POST" action="{{ $action }}" class="grid grid-cols-1 gap-4">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <x-input
            label="Nome"
            name="nome"
            value="{{ old('nome', $dipartimento->nome ?? '') }}"
        />

        <x-textarea
            label="Descrizione"
            name="descrizione"
            :value="old('descrizione', $dipartimento->descrizione ?? '')"
        />

        <div class="flex justify-center gap-4 mt-4">
            <x-button type="button"
                onclick="window.location.href='{{ route('admin.dipartimenti') }}'"
                class="w-1/2 bg-gray-400 hover:bg-gray-500 text-white font-semibold">
                Torna indietro
            </x-button>
            <x-button type="submit"
                class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                {{ $isEdit ? 'Aggiorna' : 'Crea' }}
            </x-button>
        </div>
    </form>
</x-card>
