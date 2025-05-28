@extends('layouts.layout_admin')

@section('title', 'Lista Prestazioni')

@section('content')
<x-card class="bg-white p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-indigo-700 mb-4">Gestione Prestazioni</h3>
        <x-button class="bg-indigo-600 hover:bg-indigo-700">
            <a href="{{ route('admin.prestazioni.create') }}" class="block text-white">Nuovo</a>
        </x-button>
    </div>

    @if($prestazioni->count() > 0)
        <x-table :headers="['ID', 'Titolo', 'Dipartimento', 'Giorno', 'Fascia Oraria', 'Azioni']">
            @foreach($prestazioni as $prestazione)
                <tr class="hover:bg-indigo-50 transition">
                    <td class="px-6 py-3">{{ $prestazione->id }}</td>
                    <td class="px-6 py-3">{{ $prestazione->titolo }}</td>
                    <td class="px-6 py-3">{{ $prestazione->dipartimento }}</td>
                    <td class="px-6 py-3">{{ $prestazione->giorno }}</td>
                    <td class="px-6 py-3">{{ $prestazione->fascia_oraria }}</td>
                    <td class="px-6 py-3 flex gap-4 items-center">
                        <a href="{{ route('admin.prestazioni.edit', $prestazione->id) }}"
                           class="text-indigo-600 hover:text-indigo-800" title="Modifica">
                            <!-- Icona di modifica SVG -->
                        </a>
                        <form action="{{ route('admin.prestazioni.destroy', $prestazione->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Elimina">
                                <!-- Icona di eliminazione SVG -->
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </x-table>
    @else
        <p class="text-sm text-gray-600">Nessuna prestazione trovata.</p>
    @endif
</x-card>
@endsection