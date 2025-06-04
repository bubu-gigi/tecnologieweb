@props(['prestazione' => null])

@php
    $isEdit = $prestazione !== null;
    $action = $isEdit
        ? route('admin.prestazioni.update', $prestazione->id)
        : route('admin.prestazioni.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp

<x-card class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-indigo-700 mb-6">
        {{ $isEdit ? 'Modifica Prestazione' : 'Nuova Prestazione' }}
    </h3>

    <form method="POST" action="{{ $action }}" class="grid grid-cols-1 gap-4">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <x-input
            label="Descrizione"
            name="descrizione"
            value="{{ old('descrizione', $prestazione->descrizione ?? '') }}"
            autofocus
        />

        <x-textarea
            label="Prescrizioni"
            name="prescrizioni"
            :value="old('prescrizioni', $prestazione->prescrizioni ?? '')"
        />

        <x-select
            label="Medico"
            name="medico_id"
            :options="$medici->pluck('full_name', 'id')"
            :selected="old('medico_id', $prestazione->medico_id ?? '')"
        />

        <x-select
            label="Staff (opzionale)"
            name="staff_id"
            :options="$staff->pluck('full_name', 'id')"
            :selected="old('staff_id', $prestazione->staff_id ?? '')"
            :nullable="true"
        />

        <div class="flex justify-center gap-4 mt-4">
            <x-button type="button"
                onclick="window.location.href='{{ route('admin.prestazioni') }}'"
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
