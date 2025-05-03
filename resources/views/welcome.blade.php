@extends('layouts.layout_guest')

@section('title', 'Benvenuti - Struttura Sanitaria')

@section('content')
<div class="welcome-container">
    <header class="hero">
        <img src="{{ asset('images/hero-banner.jpg') }}" alt="Struttura Sanitaria" class="hero-img">
        <div class="hero-text">
            <h1>STRUTTURA SANITARIA</h1>
            <p class="subtitle">introducing</p>
            <a href="#dipartimenti" class="btn">Scopri i dipartimenti</a>
        </div>
    </header>

    <section id="struttura" class="info-block">
        <div class="info-text">
            <h2>Chi Siamo</h2>
            <p>La nostra struttura sanitaria offre servizi di alta qualità in un ambiente accogliente e professionale. La nostra missione è fornire cure eccellenti, accessibili e umane a tutti i pazienti.</p>
            <a href="#" class="btn">Scopri di più</a>
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
        <div class="departments">
            @foreach($departments as $department)
            <div class="department">
                <img src="{{ asset('images/' . ($department->image ?? 'default.jpg')) }}" alt="{{ $department->nome }}">
                <h3>{{ $department->nome }}</h3>
                <p>{{ $department->descrizione }}</p>

                <h4>Staff Medico</h4>
                <ul>
                    @forelse($department->medici as $medico)
                        <li>
                            <strong>{{ $medico->nome }} {{ $medico->cognome }}</strong> – {{ $medico->specializzazione ?? 'Specializzazione non disponibile' }}
                        </li>
                    @empty
                        <li>Nessun medico registrato per questo dipartimento.</li>
                    @endforelse
                </ul>

                <h4>Prestazioni Disponibili</h4>
                <ul>
                    @php
                        $prestazioniDipartimento = $department->medici->flatMap(function($medico) {
                            return $medico->prestazioni;
                        });
                    @endphp

                    @forelse($prestazioniDipartimento as $prestazione)
                        <li>
                            {{ $prestazione->descrizione }} –
                            {{ $prestazione->medico?->nome }} {{ $prestazione->medico?->cognome }} –
                            Giorni: {{ $prestazione->giorni ?? 'ND' }} –
                            Orari: {{ $prestazione->orari ?? 'ND' }} –
                            Prescrizioni: {{ $prestazione->prescrizioni ?? 'Nessuna' }}
                        </li>
                    @empty
                        <li>Nessuna prestazione disponibile per questo dipartimento.</li>
                    @endforelse
                </ul>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
