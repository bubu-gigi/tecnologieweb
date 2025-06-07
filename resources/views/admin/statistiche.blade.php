@extends('layouts.layout_admin')

@section('title', 'Statistiche')

@section('content')
<div class="bg-gray-50 flex flex-col items-center py-10 px-4 gap-6">

    <x-card class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg">
        <h3 class="text-lg font-semibold text-indigo-700 mb-4">Filtri Statistiche</h3>

        {!! html()->form('GET', route('admin.statistics'))->open() !!}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-input
                    label="Data Inizio"
                    type="date"
                    name="data_inizio"
                    id="data_inizio"
                    min="2025-06-01"
                    max="2025-06-30"
                    value="{{ request('data_inizio') ?? '2025-06-01' }}"
                />

                <x-input
                    label="Data Fine"
                    type="date"
                    name="data_fine"
                    id="data_fine"
                    min="2025-06-01"
                    max="2025-06-30"
                    value="{{ request('data_fine') ?? '2025-06-30' }}"
                />

                <div>
                    <label for="utente_esterno" class="block text-gray-700 font-medium mb-1">Utente Esterno (opzionale)</label>
                    <select id="utente_esterno" name="utente_esterno"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="">-- Tutti gli utenti --</option>
                        @foreach($utentiEsterni as $utente)
                            <option value="{{ $utente->username }}" @selected(request('utente_esterno') == $utente->username)>
                                {{ $utente->cognome }} {{ $utente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                    Visualizza Statistiche
                </x-button>
            </div>
        {!! html()->form()->close() !!}
    </x-card>

    @if(request()->has(['data_inizio', 'data_fine']) && isset($statistiche))
        <x-card class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg space-y-10" id="stats">
            <h3 class="text-xl font-semibold text-indigo-700">
                Risultati dal {{ \Carbon\Carbon::parse(request('data_inizio'))->format('d/m/Y') }}
                al {{ \Carbon\Carbon::parse(request('data_fine'))->format('d/m/Y') }}
                @if(request('utente_esterno'))
                    – Utente: <span class="text-indigo-800 font-medium">{{ request('utente_esterno') }}</span>
                @endif
            </h3>

            @if(request('utente_esterno'))
                <section>
                    <h4 class="text-lg font-semibold mb-3">Prestazioni per utente esterno</h4>
                    @if(!empty($statistiche['prestazioniUtente']))
                        <x-table :headers="['Data', 'Prestazione', 'Dipartimento']">
                            @foreach ($statistiche['prestazioniUtente'] as $item)
                                <tr>
                                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-3">{{ $item->prestazione }}</td>
                                    <td class="px-6 py-3">{{ $item->dipartimento }}</td>
                                </tr>
                            @endforeach
                        </x-table>
                    @else
                        <p class="italic text-sm text-gray-600">Nessuna prestazione trovata per l'utente specificato.</p>
                    @endif
                </section>
            @endif

            <section>
                <h4 class="text-lg font-semibold mb-2">Prestazioni erogate per tipo</h4>
                @if(count($statistiche['perPrestazione']) > 0)
                    <x-table :headers="['Prestazione', 'Totale']">
                        @foreach($statistiche['perPrestazione'] as $item)
                            <tr>
                                <td class="px-6 py-3">{{ $item['descrizione'] }}</td>
                                <td class="px-6 py-3 text-right">{{ $item['totale'] }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                @else
                    <p class="italic text-sm text-gray-600">Nessuna prestazione trovata.</p>
                @endif
            </section>

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
        </x-card>
    @endif
</div>
@endsection
