@extends('plantilla')

@section('titulo')
    Pokémon destacacos
@endsection

@section('contenidoMain')
<h1>Lista de Pokémon</h1>
    <ul>
    @foreach ($respuesta['results'] as $pokemon)
        <li>{{ $pokemon['name'] }}</li>
    @endforeach
    <ul>
@endsection