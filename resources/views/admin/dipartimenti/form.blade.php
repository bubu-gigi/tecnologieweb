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
        >{{ old('descrizione', $dipartimento->descrizione ?? '') }}</x-textarea>

        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 mt-4">
            {{ $isEdit ? 'Aggiorna' : 'Crea' }}
        </x-button>
    </form>
</x-card>
