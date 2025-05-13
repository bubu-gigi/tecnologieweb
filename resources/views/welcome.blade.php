@extends('layouts.layout_guest')

@section('title', 'Benvenuti - Struttura Sanitaria')

@section('content')
<div class="welcome-container">
    <!-- HERO HEADER -->
    <header class="relative">
        <img src="{{ asset('images/hero-banner.jpg') }}" alt="Struttura Sanitaria" class="w-full h-96 object-cover opacity-80">
        <div class="absolute inset-0 flex flex-col justify-center items-start px-12">
            <h1 class="text-white text-4xl md:text-5xl font-bold drop-shadow-md">STRUTTURA SANITARIA</h1>
            <p class="text-white text-lg mt-2">La tua salute, la nostra missione</p>
            <a href="#dipartimenti" class="mt-6 inline-block bg-white text-indigo-700 font-semibold py-2 px-4 rounded-lg shadow hover:bg-indigo-100 transition">Scopri i dipartimenti</a>
        </div>
    </header>

    <!-- CHI SIAMO -->
    <section id="struttura" class="my-6">
        <x-card class="bg-white shadow-lg border-l-4 border-blue-500">
            <div class="p-4">
                <h2 class="text-2xl text-indigo-800 font-bold mb-2">Chi Siamo</h2>
                <p class="text-gray-700 text-sm leading-relaxed">
                    La nostra struttura sanitaria rappresenta un punto di riferimento per l’assistenza medica qualificata, grazie a un team multidisciplinare, tecnologie all’avanguardia e un ambiente pensato per il benessere del paziente.
                    Ci impegniamo ogni giorno per offrire prestazioni sanitarie accessibili, tempestive e personalizzate, con un approccio umano e orientato alla cura globale della persona.
                </p>
            </div>
        </x-card>
    </section>

    <!-- ORGANIZZAZIONE -->
    <section id="organizzazione" class="my-6">
        <x-card class="bg-blue-50 shadow border-l-4 border-blue-500">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-indigo-700 mb-3">Organizzazione Interna dei Servizi</h2>
                <ul class="list-disc pl-5 space-y-2 text-gray-800 text-sm">
                    <li>Servizio Accoglienza e Segreteria</li>
                    <li>Ambulatori per visite specialistiche</li>
                    <li>Laboratorio analisi</li>
                    <li>Centro diagnostico per immagini</li>
                    <li>Servizio di prenotazione e informazioni</li>
                </ul>
            </div>
        </x-card>
    </section>

    <!-- FUNZIONALITÀ -->
    <section id="funzionalita" class="my-6">
        <x-card class="bg-blue-50 shadow border-l-4 border-indigo-400">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-indigo-700 mb-3">Funzionalità del Sito</h2>
                <ul class="list-disc pl-5 space-y-2 text-gray-800 text-sm">
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
        </x-card>
    </section>

    <!-- CONTATTI -->
    <section id="contatti" class="my-6">
        <x-card class="bg-white border-l-4 border-blue-500 shadow">
            <div class="p-4">
                <h2 class="text-2xl text-indigo-800 font-bold mb-4">Contatti e Dove Trovarci</h2>
                <p class="text-gray-700 text-sm">📍 Via della Salute, 123 - 00100 Roma (RM)</p>
                <p class="text-gray-700 text-sm">📞 Telefono: <a href="tel:+390612345678" class="text-blue-600 underline">06 123 45678</a></p>
                <p class="text-gray-700 text-sm">✉️ Email: <a href="mailto:info@strutturasanitaria.it" class="text-blue-600 underline">info@strutturasanitaria.it</a></p>
            </div>
        </x-card>
    </section>

    <!-- DIPARTIMENTI -->
    <section id="dipartimenti" class="my-6">
        <x-card class="bg-white shadow border border-indigo-200">
            <h2 class="text-2xl font-bold text-center text-indigo-800 mb-6">Dipartimenti Specialistici</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
                @foreach($departments as $department)
                    <x-card class="bg-blue-50 border border-indigo-100 shadow-sm p-4 hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-indigo-700 mb-2">{{ $department->nome }}</h3>
                        <p class="text-sm text-gray-700 mb-3">{{ $department->descrizione }}</p>

                        <div class="mb-4">
                            <h5 class="font-semibold text-indigo-600">Staff Medico</h5>
                            <ul class="list-disc pl-5 text-sm text-gray-800 space-y-1">
                                @forelse($department->medici as $medico)
                                    <li><strong>{{ $medico->nome }} {{ $medico->cognome }}</strong> – {{ $medico->specializzazione ?? 'N/D' }}</li>
                                @empty
                                    <li>Nessun medico registrato.</li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-semibold text-indigo-600">Prestazioni</h5>
                            <ul class="list-disc pl-5 text-sm text-gray-800 space-y-2">
                                @php
                                    $prestazioniDipartimento = $department->medici->flatMap(fn($m) => $m->prestazioni);
                                @endphp

                                @forelse($prestazioniDipartimento as $prestazione)
                                    <li>
                                        <strong>{{ $prestazione->descrizione }}</strong><br>
                                        <small class="text-gray-600">
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

                        <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white w-full">
                            Scopri di più
                        </x-button>
                    </x-card>
                @endforeach
            </div>
        </x-card>
    </section>
</div>
@endsection
