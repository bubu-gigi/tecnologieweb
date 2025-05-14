@extends('layouts.layout_admin')

@section('title', 'Modifica Dipartimento')

@section('content')
    @include('admin.dipartimenti.form', ['dipartimento' => $dipartimento])
@endsection
