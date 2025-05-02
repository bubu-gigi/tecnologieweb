<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="form-container">
    <h2>Registrazione</h2>

    {!! html()->form('POST', url('register'))->open() !!}
    {{ csrf_field() }}

    <div class="form-grid">

        <div class="form-group">
            {{ html()->label('Nome', 'nome')->class('label-input') }}
            {{ html()->text('nome')->class('input')->id('nome') }}
            <x-field-errors field="nome" />
        </div>

        <div class="form-group">
            {{ html()->label('Cognome', 'cognome')->class('label-input') }}
            {{ html()->text('cognome')->class('input')->id('cognome') }}
            <x-field-errors field="cognome" />
        </div>

        <div class="form-group">
            {{ html()->label('Indirizzo', 'indirizzo')->class('label-input') }}
            {{ html()->text('indirizzo')->class('input')->id('indirizzo') }}
            <x-field-errors field="indirizzo" />
        </div>

        <div class="form-group">
            {{ html()->label('Città', 'citta')->class('label-input') }}
            {{ html()->text('citta')->class('input')->id('citta') }}
            <x-field-errors field="citta" />
        </div>

        <div class="form-group">
            {{ html()->label('Data di nascita', 'dataNascita')->class('label-input') }}
            {{ html()->date('dataNascita')->class('input')->id('dataNascita') }}
            <x-field-errors field="dataNascita" />
        </div>

        <div class="form-group">
            {{ html()->label('Username', 'username')->class('label-input') }}
            {{ html()->text('username')->class('input')->id('username') }}
            <x-field-errors field="username" />
        </div>

        <div class="form-group">
            {{ html()->label('Password', 'password')->class('label-input') }}
            {{ html()->password('password')->class('input')->id('password') }}
            <x-field-errors field="password" />
        </div>

        <div class="form-group">
            {{ html()->label('Conferma Password', 'password_confirmation')->class('label-input') }}
            {{ html()->password('password_confirmation')->class('input')->id('password_confirmation') }}
        </div>
    </div>

    {{ html()->button('Registrati')->type('submit')->class('button') }}

    {{ html()->form()->close() }}
</div>


</body>
</html>
