@extends('layouts.layout_guest')

@section('title', 'Benvenuti - Struttura Sanitaria')

@section('content')
<div class="welcome-container">
    <header class="hero">
        <img src="{{ asset('images/hero-banner.jpg') }}" alt="Struttura Sanitaria" class="hero-img">
        <div class="hero-text">
            <h1>STRUTTURA SANITARIA</h1>
            <p class="subtitle">La tua salute, la nostra missione</p>
            <a href="#dipartimenti" class="btn">Scopri i dipartimenti</a>
        </div>
    </header>

    <section id="struttura" class="info-block">
        <div class="info-text">
            <h2>Chi Siamo</h2>
            <p>La nostra struttura sanitaria rappresenta un punto di riferimento per l’assistenza medica qualificata, grazie a un team multidisciplinare, tecnologie all’avanguardia e un ambiente pensato per il benessere del paziente. Ci impegniamo ogni giorno per offrire prestazioni sanitarie accessibili, tempestive e personalizzate, con un approccio umano e orientato alla cura globale della persona.</p>
        </div>
    </section>


    <section id="funzionalita" class="features">
        <h2 class="section-header">Funzionalità del Sito</h2>
        <div class="feature-list">
            <ul>
                <li>Registrazione utenti con inserimento dati personali per accedere ai servizi online.</li>
                <li>Visualizzazione dei dipartimenti specialistici con informazioni su staff e prestazioni offerte.</li>
                <li>Catalogo delle prestazioni sanitarie consultabile per dipartimento o parola chiave.</li>
                <li>Possibilità di prenotare visite e prestazioni tramite il portale, senza specificare data e ora.</li>
                <li>Gestione delle prenotazioni da parte dello staff con assegnazione automatica del primo slot disponibile.</li>
                <li>Visualizzazione dello storico delle prestazioni prenotate e già usufruite.</li>
                <li>Area staff per la gestione delle agende, modifiche alle prenotazioni e comunicazione con gli utenti.</li>
                <li>Area amministratore per la gestione dell’intero sistema: utenti, dipartimenti, agende e statistiche.</li>
            </ul>
        </div>
    </section>

    <section id="dipartimenti" class="specialties">
        <h2 class="section-header">Dipartimenti Specialistici</h2>

        <div class="grid-prestazioni">
            @foreach($departments as $department)
                <div class="card-prestazione">
                    <img src="{{ asset('images/' . ($department->image ?? 'default.jpg')) }}" alt="{{ $department->nome }}" class="card-img">
                    <h4>{{ $department->nome }}</h4>
                    <p class="description">{{ $department->descrizione }}</p>

                    <div class="card-section">
                        <h5>Staff Medico</h5>
                        <ul class="staff-list">
                            @forelse($department->medici as $medico)
                                <li><strong>{{ $medico->nome }} {{ $medico->cognome }}</strong> – {{ $medico->specializzazione ?? 'N/D' }}</li>
                            @empty
                                <li>Nessun medico registrato.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="card-section">
                        <h5>Prestazioni</h5>
                        <ul class="prestazioni-list">
                            @php
                                $prestazioniDipartimento = $department->medici->flatMap(fn($m) => $m->prestazioni);
                            @endphp

                            @forelse($prestazioniDipartimento as $prestazione)
                                <li>
                                    <strong>{{ $prestazione->descrizione }}</strong><br>
                                    <small>
                                        Medico: {{ $prestazione->medico->nome ?? '' }} {{ $prestazione->medico->cognome ?? '' }}<br>
                                        Giorni: {{ $prestazione->giorni ?? 'N/D' }}<br>
                                        Orari: {{ $prestazione->orari ?? 'N/D' }}<br>
                                        Prescrizioni: {{ $prestazione->prescrizioni ?? 'Nessuna' }}
                                    </small>
                                </li>
                            @empty
                                <li>Nessuna prestazione disponibile.</li>
                            @endforelse
                        </ul>
                    </div>

                    @php
                        $dettaglioRoute = auth()->check()
                            ? route('customers.dipartimento', ['id' => $department->id])
                            : route('register', ['redirect_to' => 'departments/' . $department->id]);
                    @endphp

                    <a href="{{ $dettaglioRoute }}" class="btn-sm">Scopri di più</a>

                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
