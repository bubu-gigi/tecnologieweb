@extends('layouts.layout_customer')

@section('title', 'Modifica Profilo')

@section('content')
<div class="form-container">
    <h2>Modifica il tuo Profilo</h2>

    {!! html()->form('POST', route('profile.update'))->attribute('method', 'PATCH')->open() !!}
        @csrf

        <div class="form-grid">
            <div class="form-group">
                {{ html()->label('Username', 'username')->class('label-input') }}
                {{ html()->text('username')->value(old('username', auth()->user()->username))->class('input')->id('username') }}
                <x-field-errors field="username" />
            </div>

            <div class="form-group">
                {{ html()->label('Nome', 'nome')->class('label-input') }}
                {{ html()->text('nome')->value(old('nome', auth()->user()->nome))->class('input')->id('nome') }}
                <x-field-errors field="nome" />
            </div>

            <div class="form-group">
                {{ html()->label('Cognome', 'cognome')->class('label-input') }}
                {{ html()->text('cognome')->value(old('cognome', auth()->user()->cognome))->class('input')->id('cognome') }}
                <x-field-errors field="cognome" />
            </div>

            <div class="form-group">
                {{ html()->label('Indirizzo', 'indirizzo')->class('label-input') }}
                {{ html()->text('indirizzo')->value(old('indirizzo', auth()->user()->indirizzo))->class('input')->id('indirizzo') }}
                <x-field-errors field="indirizzo" />
            </div>

            <div class="form-group">
                {{ html()->label('Città', 'citta')->class('label-input') }}
                {{ html()->text('citta')->value(old('citta', auth()->user()->citta))->class('input')->id('citta') }}
                <x-field-errors field="citta" />
            </div>

            <div class="form-group">
                {{ html()->label('Data di Nascita', 'dataNascita')->class('label-input') }}
                {{ html()->date('dataNascita')->value(old('dataNascita', auth()->user()->dataNascita))->class('input')->id('dataNascita') }}
                <x-field-errors field="dataNascita" />
            </div>

            <div class="form-group">
                {{ html()->label('Nuova Password', 'password')->class('label-input') }}
                {{ html()->password('password')->class('input')->id('password') }}
                <x-field-errors field="password" />
            </div>

            <div class="form-group">
                {{ html()->label('Conferma Password', 'password_confirmation')->class('label-input') }}
                {{ html()->password('password_confirmation')->class('input')->id('password_confirmation') }}
            </div>
        </div>

        <div class="form-group">
            {{ html()->button('Aggiorna Profilo')->type('submit')->class('button') }}
        </div>

    {{ html()->form()->close() }}
</div>
@endsection
