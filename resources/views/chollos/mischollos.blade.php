@extends('plantilla')
@section('titulo')
    Mis Chollos
@endsection

@section('contenidoMain')
    <h1>Mis chollos</h1>
    <p>Chollos agregados por {{ $usuario }}</p>
    @include('chollos/tablaChollos')

@endsection