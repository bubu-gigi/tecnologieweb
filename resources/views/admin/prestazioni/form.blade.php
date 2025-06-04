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

        <label class="block font-semibold text-gray-700" for="medico_id">Medico</label>
            <select name="medico_id" id="medico_id" class="w-full border border-gray-300 rounded px-3 py-2">
                @foreach($medici as $medico)
                    <option value="{{ $medico->id }}" {{ old('medico_id', $prestazione->medico_id ?? '') == $medico->id ? 'selected' : '' }}>
                        {{ $medico->nome }} {{ $medico->cognome }}
                    </option>
                @endforeach
            </select>

            <label class="block font-semibold text-gray-700 mt-4" for="staff_id">Staff (opzionale)</label>
            <select name="staff_id" id="staff_id" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Nessuno --</option>
                @foreach($staff as $membro)
                    <option value="{{ $membro->id }}" {{ old('staff_id', $prestazione->staff_id ?? '') == $membro->id ? 'selected' : '' }}>
                        {{ $membro->nome }} {{ $membro->cognome }}
                    </option>
                @endforeach
            </select>

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
