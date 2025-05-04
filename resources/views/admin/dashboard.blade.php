@extends('layouts.layout_admin')

@section('title', 'Area Amministratore')

@section('content')
<div class="user-area-container">
    <h2>Benvenuto Amministratore</h2>

    <section class="search-prestazioni">
        <h3>Gestione Dipartimenti</h3>
        <p>Puoi aggiornare le tue informazioni e i dati relativi ai dipartimenti.</p>
        <a class="btn">Modifica Dipartimenti</a>
    </section>

    <section class="search-prestazioni">
        <h3>Gestione Prestazioni</h3>
        <p>Puoi aggiornare le tue informazioni e i dati relativi alle prestazioni e alle loro relativa agenda.</p>
        <a class="btn">Modifica Prestazioni</a>
    </section>

    <section class="search-prestazioni">
        <h3>Gestioni Utenti</h3>
        <p>Puoi aggiornare le tue informazioni e i dati relativi agli utenti registrati.</p>
        <a class="btn">Modifica Utenti</a>
    </section>

    <section class="search-prestazioni">
        <h3>Gestioni Statistiche</h3>
        <p>Puoi visualizzare le seguenti statistiche in base a un tuo desiderato intervallo temporale</p>
        <ul>
            <li>Il numero di prestazioni erogate suddivise per prestazione</li>
            <li>Il numero di prestazioni erogate suddivise per dipartimento</li>
            <li>Tutte le prestazioni erogate ad un utente esterno specificato</li>
        </ul>
        <a class="btn">Visualizza Statistiche</a>
    </section>
</div>
@endsection
