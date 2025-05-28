@extends('layouts.layout_admin')

@section('title', $prestazione->exists ? 'Modifica Prestazione' : 'Nuova Prestazione')

@section('content')
<x-card class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold text-indigo-700 mb-4">
        {{ $prestazione->exists ? 'Modifica Prestazione' : 'Nuova Prestazione' }}
    </h3>

    <form method="POST" action="{{ $prestazione->exists ? route('admin.prestazioni.update', $prestazione->id) : route('admin.prestazioni.store') }}">
        @csrf
        @if($prestazione->exists)
            @method('PUT')
        @endif

<!-- Altri Campi -->

        <div class="mb-4">
            <label for="titolo" class="block text-sm font-medium text-gray-700">Titolo</label>
            <input type="text" name="titolo" id="titolo" value="{{ old('titolo', $prestazione->titolo) }}" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="dipartimento" class="block text-sm font-medium text-gray-700">Dipartimento</label>
            <input type="text" name="dipartimento" id="dipartimento" value="{{ old('dipartimento', $prestazione->dipartimento) }}" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="giorno" class="block text-sm font-medium text-gray-700">Giorno</label>
            <select name="giorno" id="giorno" class="mt-1 block w-full">
                @foreach(['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'] as $giorno)
                    <option value="{{ $giorno }}" {{ old('giorno', $prestazione->giorno) == $giorno ? 'selected' : '' }}>
                        {{ $giorno }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fascia_oraria" class="block text-sm font-medium text-gray-700">Fascia Oraria Prenotabile</label>
            <select name="orario" id="orario" class="mt-1 block w-full">
            @foreach(range(9, 16) as $hour)
            @php
            $nextHour = $hour + 1;
            @endphp
        <option value="{{ $hour }}:00-{{ $nextHour }}:00" {{ old('orario', $prestazione->orario) == "$hour:00-$nextHour:00" ? 'selected' : '' }}>
            {{ $hour }}:00 - {{ $nextHour }}:00
        </option>
            @endforeach
            </select>

            <input type="text" name="fascia_oraria" id="fascia_oraria" value="{{ old('fascia_oraria', $prestazione->fascia_oraria) }}" class="mt-1 block w-full" placeholder="Es. 09:00 - 10:00">
        </div>

        <div class="mt-6">
            <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">{{ $prestazione->exists ? 'Aggiorna' : 'Crea' }}</x-button>
        </div>
    </form>
</x-card>
@endsection