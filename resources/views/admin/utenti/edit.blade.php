@extends('layouts.layout_admin')

@section('title', 'Modifica Utente')

@section('content')
    @include('admin.utenti.form', ['user' => $user])
@endsection
