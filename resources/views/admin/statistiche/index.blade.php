@extends('layouts.layout_admin')

@section('title', 'Statistiche')

@section('content')
<x-card class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold text-indigo-700 mb-4">Statistiche Generali</h3>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-indigo-100 rounded-lg">
            <h4 class="text-indigo-800 font-semibold">Total Prestazioni</h4>
            <p class="text-indigo-600 text-2xl">{{ $totalPrestazioni }}</p>
        </div>
        <div class="p-4 bg-green-100 rounded-lg">
            <h4 class="text-green-800 font-semibold">Total Dipartimenti</h4>
            <p class="text-green-600 text-2xl">{{ $totalDipartimenti }}</p>
        </div>
        <div class="p-4 bg-yellow-100 rounded-lg">
            <h4 class="text-yellow-800 font-semibold">Total Utenti</h4>
            <p class="text-yellow-600 text-2xl">{{ $totalUtenti }}</p>
        </div>
    </div>

    <h3 class="text-lg font-semibold text-indigo-700 mb-4">Prestazioni per Dipartimento</h3>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-indigo-50">Dipartimento</th>
                <th class="py-2 px-4 bg-indigo-50">Numero di Prestazioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestazioniPerDipartimento as $prestazione)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $prestazione->dipartimento }}</td>
                    <td class="py-2 px-4 border-b">{{ $prestazione->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-card>
@endsection