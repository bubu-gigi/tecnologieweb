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
        <h3>Prenotazioni</h3>
        <ul>
            <li><a >Cerca e richiedi una nuova prestazione</a></li>
            <li><a>Visualizza le prenotazioni future</a></li>
            <li><a>Storico delle prestazioni già usufruite</a></li>
            <li><a>Annulla una prenotazione attiva</a></li>
        </ul>
    </section>

    <section class="search-prestazioni">
        <h3>Ricerca Prestazioni</h3>
        <form method="GET">
            <label for="prestazione">Ricerca per prestazione:</label>
            <input type="text" name="prestazione" placeholder="es. Visita, Radiografia o R*">

            <button type="submit" class="btn">Cerca</button>
        </form>
        <form method="GET">
            <label for="dipartimento">Ricerca per dipartimento:</label>
            <input type="text" name="dipartimento" placeholder="es. Cardiologia o C*">
            <button type="submit" class="btn">Cerca</button>
        </form>

    </section>

    <section class="note">
        <p>Ricorda: quando richiedi una prestazione, non devi specificare data e ora. Lo staff assegnerà il primo slot disponibile e te lo comunicherà direttamente.</p>
    </section>
</div>
@endsection
