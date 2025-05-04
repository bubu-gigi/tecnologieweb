@extends('layouts.layout_customer')

@section('title', 'Area Utente Registrato')

@section('content')
<div class="user-area-container">
    <h2>Benvenuto nella tua Area Personale</h2>

    <section class="search-prestazioni">
        <h3>Gestione Profilo</h3>
        <p>Puoi aggiornare le tue informazioni personali, come nome, email, indirizzo o password.</p>
        <a href="{{ route('profile.edit') }}" class="btn">Modifica Profilo</a>
    </section>

    <section class="search-prestazioni">
        <h3>Gestione Prestazioni</h3>
        <p>Puoi ricercare le prestazioni entrando in questa sezione</p>
        <a href="{{ route('customers.prestazioni') }}" class="btn">Ricerca Prestazioni</a>
    </section>

    <section class="search-prestazioni">
        <h3>Prenotazioni</h3>
        <ul>
            <li><a>Visualizza le prenotazioni future</a></li>
            <li><a>Storico delle prenotazioni già usufruite</a></li>
            <li><a>Annulla una prenotazione attiva</a></li>
        </ul>
        <a href="{{ route('customers.prenotazioni') }}" class="btn">Gestisci Prenotazioni</a>
    </section>
</div>
@endsection
