@extends('layouts.layout_guest')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto mb-6">
        <h1 class="text-3xl font-bold text-[#FB7116] mb-4">{{ $prodotto->name }}</h1>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Malfunzionamento</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Soluzione tecnica</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($prodotto->malfunzionamenti as $malfunzionamento)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">{{ $malfunzionamento->descrizione }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $malfunzionamento->soluzione_tecnica }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                                Nessun malfunzionamento registrato.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
