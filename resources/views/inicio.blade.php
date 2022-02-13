@extends('plantilla')
@section('titulo')
    CholloSevero - Inicio
@endsection

@section('contenidoMain')

    @if (session('mensaje'))
        <div class="chollo-editado alert alert-success" role="alert">
            {{ session('mensaje') }}
        </div>
    @endif
    <h2>Lista de chollos</h2>
    @include('chollos/tablaChollos')

    <div class="text-center">
        {{--$chollos->links()--}}
    </div>


@endsection