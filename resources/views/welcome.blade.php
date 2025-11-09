@extends('layouts.layout_guest')

@section('title', 'Benvenuti - Assistenza Tecnica')

@section('content')
<div class="container mx-auto px-4 py-8 space-y-12">

    <header class="relative bg-[#FB7116] rounded-xl overflow-hidden h-80">
        <img src="{{ asset('storage/prodotti/hero-banner.jpg') }}" alt="Azienda" class="w-full h-full object-cover opacity-70">
        <div class="absolute inset-0 flex flex-col justify-center items-start px-8">
            <h1 class="text-white text-4xl md:text-5xl font-bold drop-shadow-lg">AZIENDA TECNOLOGICA</h1>
            <p class="text-white mt-2 text-lg">Supporto tecnico e assistenza prodotti</p>
            <a href="#prodotti" class="mt-4 inline-block bg-white text-[#FB7116] font-semibold py-2 px-4 rounded-lg shadow hover:bg-orange-100 transition">Scopri i prodotti</a>
        </div>
    </header>

    <section id="funzionalita" class="bg-white shadow-lg rounded-xl p-6 space-y-3">
        <h2 class="text-2xl font-bold text-[#FB7116] mb-4">Funzionalità del Sito</h2>

        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-[#FB7116]">Pubblico Generico</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm">
                <li>Può accedere alle informazioni generali sull’azienda e sulle sue attività.</li>
                <li>Ha la possibilità di consultare il catalogo dei prodotti, comprensivo di schede tecniche, note d’uso e modalità di installazione (senza informazioni su malfunzionamenti).</li>
                <li>Può visualizzare l'elenco dei centri di assistenza presenti sul territorio.</li>
            </ul>

            <h3 class="text-xl font-semibold text-[#FB7116]">Tecnici dei Centri di Assistenza</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm">
                <li>Accedono a tutte le informazioni disponibili agli utenti generici.</li>
                <li>Possono consultare le schede prodotto complete, comprese le sezioni dedicate ai malfunzionamenti e alle relative soluzioni tecniche.</li>
            </ul>

            <h3 class="text-xl font-semibold text-[#FB7116]">Staff Tecnico Aziendale</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm">
                <li>Ha accesso a tutte le informazioni disponibili ai tecnici dei centri di assistenza.</li>
                <li>Può gestire le schede prodotto con la possibilità di inserire, modificare o cancellare malfunzionamenti e soluzioni tecniche correlate.</li>
            </ul>

            <h3 class="text-xl font-semibold text-[#FB7116]">Amministratore del Sito</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm">
                <li>Gestisce l'intero catalogo dei prodotti e le relative informazioni (ad eccezione dei malfunzionamenti e delle soluzioni tecniche).</li>
                <li>Amministra gli utenti registrati nel sistema, in particolare può creare, modificare o eliminare gli account di:
                    <ul class="list-disc list-inside ml-6">
                        <li>tecnici dei centri di assistenza (con nome, cognome, data di nascita, specializzazione, centro di appartenenza, username e password).</li>
                        <li>membri dello staff (con nome, cognome, username e password).</li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>


    <section id="azienda" class="bg-white shadow-lg rounded-xl p-6 space-y-3">
        <h2 class="text-2xl font-bold text-[#FB7116]">Chi Siamo</h2>
        <p class="text-gray-700 text-sm">
            La nostra azienda offre supporto tecnico a una rete di centri assistenza distribuiti sul territorio. Garantiamo informazioni complete sui prodotti e assistenza professionale per tutti i nostri clienti.
        </p>
        <p class="text-gray-700 text-sm">📍 Via Garibaldi, 12 - Ancona (AN)</p>
        <p class="text-gray-700 text-sm">📞 Telefono: <a href="tel:+390712345678" class="text-[#FB7116] underline">071 2345678</a></p>
        <p class="text-gray-700 text-sm">✉️ Email: <a href="mailto:info@aziendatecnologica.it" class="text-[#FB7116] underline">info@aziendatecnologica.it</a></p>
    </section>

    <section id="prodotti" class="space-y-6">
        <h2 class="text-2xl font-bold text-[#FB7116] mb-4">Catalogo Prodotti</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
           @foreach($prodotti as $prodotto)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
                    <img src="{{ asset('storage/prodotti/' . $prodotto->image_name) }}" 
                        alt="{{ $prodotto->nome }}" 
                        class="h-48 w-full object-cover rounded-lg mb-4">
                    <h3 class="text-lg font-semibold text-[#FB7116]">{{ $prodotto->nome }}</h3>
                    <p class="text-gray-700 text-sm mb-2">{{ Str::limit($prodotto->descrizione, 100) }}</p>
                    <p class="text-gray-600 text-xs mb-2"><strong>Note tecniche:</strong> {{ $prodotto->note_uso }}</p>
                    <p class="text-gray-600 text-xs mb-4"><strong>Installazione:</strong> {{ $prodotto->mod_installazione }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="centri_assistenza" class="space-y-6">
        <h2 class="text-2xl font-bold text-[#FB7116] mb-4">Centri di Assistenza sul Territorio</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($centri_assistenza as $centro)
                <div class="bg-white rounded-xl shadow p-4 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-[#FB7116]">{{ $centro->nome }}</h3>
                    <p class="text-gray-700 text-sm">{{ $centro->indirizzo }}</p>
                </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
