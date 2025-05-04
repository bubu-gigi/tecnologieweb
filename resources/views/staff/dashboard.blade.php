@extends('layouts.layout_staff')

@section('title', 'Area Staff')

@section('content')
<div class="user-area-container">
    <h2>Benvenuto {{ Auth::user()->username }}</h2>

    <section class="search-prestazioni">
        <h3>Inserimento Prestazioni</h3>
        <p>Puoi inserire nuove prestazioni</p>
        <a class="btn">Inserisci</a>
    </section>

    <section class="search-prestazioni">
        <h3>Modifica Agende</h3>
        <p>Puoi modificare le agende delle prenotazioni</p>
        <a class="btn">Modifica Agende</a>
    </section>

    <section class="search-prestazioni">
        <h3>Visualizzazioni Agende</h3>
        <p>Puoi modificare le agende di ciascuna prestazione, solo per prestazioni ancora da
            erogare, con l’indicazione, specificando un giorno, dei singoli appuntamenti di quel giorno e degli utenti
            a cui verranno erogati;</p>
        <a class="btn">Modifica Agende</a>
    </section>
</div>
@endsection
