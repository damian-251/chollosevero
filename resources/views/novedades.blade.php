@extends('plantilla')

@section('titulo')
    CholloSevero - Novedades
@endsection

@section('contenidoMain')
    {{-- Muestra los últimos 4 chollos añadidos--}}
    <h1>Novedades</h1>
    
    @include('chollos/tablaChollos')
@endsection