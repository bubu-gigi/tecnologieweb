<section class="navigation">
    <nav class="nav-primary">
        <a href="#struttura">Struttura</a>
        <a href="#dipartimenti">Dipartimenti</a>
        <a href="#funzionalita">Funzionalità</a>
    </nav>

    @if (Auth::check())
        <nav class="nav-secondary">
            <a href="/customers" class="button">Area Personale</a>
            <a href="/logout" class="button">Logout</a>
        </nav>
    @else
        <nav class="nav-secondary">
            <a href="/login" class="button">Login</a>
            <a href="/register" class="button">Registrati</a>
        </nav>
    @endif
</section>
