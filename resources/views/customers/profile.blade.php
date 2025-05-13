@extends('layouts.layout_customer')

@section('title', 'Modifica Profilo')

@section('content')
<x-card class="w-full max-w-2xl p-6 bg-white shadow-lg rounded-lg">
    <div class="flex flex-col gap-6">
        <h2 class="text-center text-2xl font-bold text-indigo-700">Modifica il tuo Profilo</h2>

        {!! html()->form('POST', route('profile.update'))->open() !!}
        {{ csrf_field() }}

        <div class="grid grid-cols-2 gap-4">
            <x-input
                name="username"
                label="Username"
                placeholder="Modifica il tuo username"
                value="{{ old('username', auth()->user()->username) }}"
            />
            <x-input
                name="nome"
                label="Nome"
                placeholder="Modifica il tuo nome"
                value="{{ old('nome', auth()->user()->nome) }}"
            />
            <x-input
                name="cognome"
                label="Cognome"
                placeholder="Modifica il tuo cognome"
                value="{{ old('cognome', auth()->user()->cognome) }}"
            />
            <x-input
                name="indirizzo"
                label="Indirizzo"
                placeholder="Modifica il tuo indirizzo"
                value="{{ old('indirizzo', auth()->user()->indirizzo) }}"
            />
            <x-input
                name="citta"
                label="Città"
                placeholder="Modifica la tua città"
                value="{{ old('citta', auth()->user()->citta_nascita) }}"
            />
            <x-input
                name="dataNascita"
                label="Data di nascita"
                type="date"
                value="{{ old('dataNascita', auth()->user()->dataNascita) }}"
            />
            <x-input
                name="password"
                label="Nuova Password"
                type="password"
                placeholder="Lascia vuoto se non vuoi cambiare password"
            />
            <x-input
                name="password_confirmation"
                label="Conferma Password"
                type="password"
                placeholder="Ripeti la nuova password"
            />
        </div>

        <div class="flex justify-center">
            <x-button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                Aggiorna Profilo
            </x-button>
        </div>

        {{ html()->form()->close() }}
    </div>
</x-card>
@endsection
