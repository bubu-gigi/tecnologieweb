@extends('layouts.layout_admin')

@section('title', 'Statistiche')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4 gap-6">

    {{-- Form intervallo temporale --}}
    <x-card class="w-full max-w-4xl p-6 bg-white shadow-lg rounded-lg">
        <h3 class="text-lg font-semibold text-indigo-700 mb-4">Analisi Statistiche</h3>

        {!! html()->form('GET', route('admin.statistics'))->open() !!}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="data_inizio" class="block text-gray-700">Data Inizio</label>
                <input type="date" name="data_inizio" id="data_inizio" 
                    value="{{ request('data_inizio') ?? '2025-06-01' }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-400 focus:outline-none">
                @error('data_inizio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="data_fine" class="block text-gray-700">Data Fine</label>
                <input type="date" name="data_fine" id="data_fine"
                    value="{{ request('data_fine') ?? '2025-06-30' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-400 focus:outline-none">
                @error('data_fine')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-button type="submit" class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold w-full md:w-auto">
            Visualizza Statistiche
        </x-button>
        {!! html()->form()->close() !!}
    </x-card>

    @isset($statistiche)
        {{-- Seconda card con risultati --}}
        <x-card class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg space-y-8">

            <h3 class="text-xl font-semibold text-indigo-700 mb-4">
                Risultati dal {{ \Carbon\Carbon::parse(request('data_inizio'))->format('d/m/Y') }}
                al {{ \Carbon\Carbon::parse(request('data_fine'))->format('d/m/Y') }}
            </h3>

            {{-- Statistiche per Prestazione --}}
            <section>
                <h4 class="text-lg font-semibold mb-2">Prestazioni erogate per tipo</h4>
                @if(count($statistiche['perPrestazione']) > 0)
                    <x-table :headers="['Prestazione', 'Totale']">
                        @foreach($statistiche['perPrestazione'] as $descrizione => $totale)
                            <tr>
                                <td class="px-6 py-3">{{ $descrizione }}</td>
                                <td class="px-6 py-3 text-right">{{ $totale }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                @else
                    <p class="italic text-sm text-gray-600">Nessuna prestazione trovata.</p>
                @endif
            </section>

            {{-- Statistiche per Dipartimento --}}
            <section>
                <h4 class="text-lg font-semibold mb-2">Prestazioni erogate per dipartimento</h4>
                @if(count($statistiche['perDipartimento']) > 0)
                    <x-table :headers="['Dipartimento', 'Totale']">
                        @foreach($statistiche['perDipartimento'] as $nome => $totale)
                            <tr>
                                <td class="px-6 py-3">{{ $nome }}</td>
                                <td class="px-6 py-3 text-right">{{ $totale }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                @else
                    <p class="italic text-sm text-gray-600">Nessuna prestazione trovata.</p>
                @endif
            </section>

            {{-- Filtro per utente esterno --}}
            <section>
                <h4 class="text-lg font-semibold mb-4">Prestazioni per utente esterno</h4>

                {!! html()->form('GET', route('admin.statistiche'))->open() !!}
                    <input type="hidden" name="data_inizio" value="{{ request('data_inizio') }}">
                    <input type="hidden" name="data_fine" value="{{ request('data_fine') }}">

                    <div class="flex gap-4 items-end">
                        <div class="flex-1">
                            <label for="utente_esterno" class="block text-sm font-medium text-gray-700">Utente esterno</label>
                            <select id="utente_esterno" name="utente_esterno"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-400 focus:outline-none">
                                <option value="">-- Seleziona un utente --</option>
                                @foreach($utentiEsterni as $utente)
                                    <option value="{{ $utente->username }}" @selected(request('utente_esterno') == $utente->username)>
                                        {{ $utente->cognome }} {{ $utente->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                            Cerca
                        </x-button>
                    </div>
                {!! html()->form()->close() !!}

                @if(request('utente_esterno'))
                    @if(!empty($statistiche['perUtente']) && count($statistiche['perUtente']) > 0)
                        <x-table :headers="['Data', 'Prestazione', 'Dipartimento']" class="mt-4">
                            @foreach ($statistiche['perUtente'] as $item)
                                <tr>
                                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-3">{{ $item->prestazione }}</td>
                                    <td class="px-6 py-3">{{ $item->dipartimento }}</td>
                                </tr>
                            @endforeach
                        </x-table>
                    @else
                        <p class="italic text-sm text-gray-600 mt-4">Nessuna prestazione trovata per l'utente specificato.</p>
                    @endif
                @endif
            </section>
        </x-card>
    @endisset
</div>
@endsection
