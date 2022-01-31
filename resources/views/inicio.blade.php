@extends('plantilla')
@section('titulo')
    CholloSevero - Inicio
@endsection

@section('contenidoMain')
    <h2>Lista de chollos</h2>
    @include('chollos/tablaChollos')

    <div class="text-center">
        {{ $chollos->links() }}
    </div>


@endsection