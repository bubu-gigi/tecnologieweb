@extends('layouts.layout_customer')

@section('title', 'Area Prenotazioni')

@section('content')
<div class="user-area-container">
    @if(isset($prenotazioni) && count($prenotazioni) > 0)
        <section class="grid-prestazioni">
            @foreach($prenotazioni as $prenotazione)
                <div class="card-prestazione">
                    <h4>{{ $prenotazione->prestazione->descrizione }}</h4>

                    <p><strong>Dipartimento:</strong> {{ $prenotazione->prestazione->medico->dipartimento->nome ?? 'N/A' }}</p>
                    <p><strong>Medico:</strong> {{ $prenotazione->prestazione->medico->nome ?? '' }} {{ $prenotazione->prestazione->medico->cognome ?? '' }}</p>
                    <p><strong>Richiesta il:</strong> {{ $prenotazione->created_at->format('d/m/Y H:i') }}</p>

                    @if($prenotazione->data_prenotazione)
                        <p><strong>Approvata:</strong> {{ \Carbon\Carbon::parse($prenotazione->data_prenotazione)->format('d/m/Y H:i') }}</p>
                        <p style="color: green;"><strong>Stato:</strong> Approvata</p>
                    @else
                        <p><strong>Stato:</strong> <span style="color: #d93025;">In attesa di approvazione</span></p>
                    @endif
                </div>
            @endforeach
        </section>
    @else
        <p>Non hai ancora effettuato nessuna prenotazione.</p>
    @endif
</div>
@endsection
