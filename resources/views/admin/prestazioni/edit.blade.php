@extends('layouts.layout_admin')

@section('title', 'Modifica Prestazione')

@section('content')
    @include('admin.prestazioni.form', ['prestazione' => $prestazione])
@endsection
