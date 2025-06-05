@extends('layouts.layout_admin')

@section('content')
<div class="p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Statistiche</h1>

    <form method="GET" action="{{ route('admin.statistiche') }}" class="mb-6 space-y-4">
        <div class="grid grid-cols-3 gap-4 items-end">
            <div>
                <label for="data_inizio" class="block font-semibold mb-1">Data Inizio</label>
                <input type="date" id="data_inizio" name="data_inizio" value="{{ request('data_inizio') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="data_fine" class="block font-semibold mb-1">Data Fine</label>
                <input type="date" id="data_fine" name="data_fine" value="{{ request('data_fine') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="utente_esterno" class="block font-semibold mb-1">Utente Esterno (email)</label>
                <input type="text" id="utente_esterno" name="utente_esterno" value="{{ request('utente_esterno') }}" placeholder="Email utente" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <button type="submit" class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-semibold">
            Filtra
        </button>
    </form>

    @isset($statistiche)
        <div class="space-y-8">

            <section>
                <h2 class="text-xl font-semibold mb-2">Numero di prestazioni erogate per tipo</h2>
                @if(count($statistiche['perPrestazione']) > 0)
                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Prestazione</th>
                                <th class="border px-4 py-2 text-right">Totale</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statistiche['perPrestazione'] as $descrizione => $totale)
                                <tr>
                                    <td class="border px-4 py-2">{{ $descrizione }}</td>
                                    <td class="border px-4 py-2 text-right">{{ $totale }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="italic">Nessuna prestazione trovata nell'intervallo selezionato.</p>
                @endif
            </section>

            <section>
                <h2 class="text-xl font-semibold mb-2">Numero di prestazioni erogate per dipartimento</h2>
                @if(count($statistiche['perDipartimento']) > 0)
                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Dipartimento</th>
                                <th class="border px-4 py-2 text-right">Totale</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statistiche['perDipartimento'] as $nome => $totale)
                                <tr>
                                    <td class="border px-4 py-2">{{ $nome }}</td>
                                    <td class="border px-4 py-2 text-right">{{ $totale }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="italic">Nessuna prestazione trovata nell'intervallo selezionato.</p>
                @endif
            </section>

            @if(!empty($statistiche['perUtente']) && count($statistiche['perUtente']) > 0)
                <section>
                    <h2 class="text-xl font-semibold mb-2">Prestazioni erogate all'utente esterno {{ request('utente_esterno') }}</h2>
                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Data</th>
                                <th class="border px-4 py-2">Prestazione</th>
                                <th class="border px-4 py-2">Dipartimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statistiche['perUtente'] as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                                    <td class="border px-4 py-2">{{ $item->prestazione }}</td>
                                    <td class="border px-4 py-2">{{ $item->dipartimento }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @elseif(request('utente_esterno'))
                <p class="italic">Nessuna prestazione trovata per l'utente esterno specificato.</p>
            @endif

        </div>
    @endisset

</div>
@endsection
