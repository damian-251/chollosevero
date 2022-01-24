@extends('plantilla')

@section('titulo')
    Chollos Destacados
@endsection

@section('contenidoMain')
    <h1>Chollos Destacados</h1>
    @include('chollos/tablaChollos')
@endsection