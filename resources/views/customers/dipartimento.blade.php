@extends('layouts.layout_customer')

@section('title', 'Dipartimento - ' . $dipartimento->nome)

@section('content')
<div class="dipartimento-container">
    <h2>{{ $dipartimento->nome }}</h2>
    <p>{{ $dipartimento->descrizione }}</p>

    <h3>Staff Medico</h3>
    <ul>
        @forelse($dipartimento->medici as $medico)
            <li><strong>{{ $medico->nome }} {{ $medico->cognome }}</strong> – {{ $medico->specializzazione ?? 'N/D' }}</li>
        @empty
            <li>Nessun medico registrato.</li>
        @endforelse
    </ul>

    <h3>Prestazioni Disponibili</h3>
    <ul>
        @php
            $prestazioni = $dipartimento->medici->flatMap(fn($m) => $m->prestazioni);
        @endphp
        @forelse($prestazioni as $prestazione)
            <li>
                <strong>{{ $prestazione->descrizione }}</strong><br>
                Giorni: {{ $prestazione->giorni ?? 'N/D' }} – Orari: {{ $prestazione->orari ?? 'N/D' }}<br>
                Prescrizioni: {{ $prestazione->prescrizioni ?? 'Nessuna' }}
            </li>
        @empty
            <li>Nessuna prestazione disponibile.</li>
        @endforelse
    </ul>
</div>
@endsection
