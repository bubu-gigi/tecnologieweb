@extends('layouts.layout_staff')

@section('title', 'Agenda Prestazioni')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">
    
    @php
    // Genera orari interi da 8 a 20
    $orari = collect(range(8, 20))->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00');
    $headers = array_merge(['Data'], $orari->toArray());
    @endphp

    <x-table :headers="$headers">
        @foreach($slots as $data => $fasce)
            <tr>
                <th class="px-4 py-2 font-medium text-left">
                    {{ \Carbon\Carbon::parse($data)->format('d/m/Y') }}
                </th>
            
                @foreach($orari as $orario)
                    @php
                        $slot = collect($fasce)->firstWhere('orario', $orario);
                    @endphp
                    <td class="px-4 py-2 text-center {{ $slot && $slot['occupato'] ? 'bg-yellow-300' : 'bg-green-100' }}">
                        {{ $slot ? ($slot[$data]['occupato'] ? 'O' : 'L') : '-' }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </x-table>

    <x-card class="bg-white mt-4 w-full max-w-sm">
        <h2 class="text-lg font-semibold mb-2 text-gray-800">Legenda orari:</h2>
        
        <ul class="space-y-2 text-sm text-gray-700">
            <li class="flex items-center gap-2">
                <span class="w-4 h-4 rounded-full bg-green-500 inline-block"></span>
                Orario disponibile
            </li>
            <li class="flex items-center gap-2">
                <span class="w-4 h-4 rounded-full bg-yellow-500 inline-block"></span>
                Orario occupato
            </li>
        </ul>
    </x-card>

</x-card>
@endsection