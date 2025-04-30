<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sanitaria Salus</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header class="header-container">
        <div class="header-left">
            <h1>Sanitaria Salus</h1>
            <p>Prendersi cura della tua salute, con passione e professionalità</p>
        </div>
        <div class="header-right">
            <a href="{{ route('login') }}" class="login-button">Login</a>
        </div>
    </header>

    <section>
        <h2>Chi siamo</h2>
        <p>
            Sanitaria Salus è una struttura sanitaria moderna e accogliente, nata per offrire servizi diagnostici e specialistici di alta qualità.
            Il nostro team è composto da medici e operatori sanitari altamente qualificati che mettono il paziente sempre al centro dell’attenzione.
        </p>

        <h2>I nostri servizi</h2>
        <ul>
            <li>Visite specialistiche (cardiologia, dermatologia, ginecologia...)</li>
            <li>Esami diagnostici (ecografie, elettrocardiogrammi, spirometria)</li>
            <li>Servizi infermieristici e prelievi del sangue</li>
            <li>Fisioterapia e riabilitazione</li>
            <li>Assistenza domiciliare</li>
        </ul>

        <h2>Perché sceglierci?</h2>
        <p>
            Offriamo appuntamenti rapidi, ambienti igienizzati e confortevoli, attenzione personalizzata e trasparenza nei costi.
            La salute dei nostri pazienti è la nostra priorità.
        </p>
    </section>

</body>
</html>
