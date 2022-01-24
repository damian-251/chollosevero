@extends('plantilla')

@section('titulo')
    Detalles del chollo
@endsection

@section('contenidoMain')
    <h1>Detalles del chollo {{ $chollo->id }}</h1>

    <h2>Puntuación</h2>
    <p>{{ $chollo->puntuacion }}</p>

    <h2>Imagen</h2>
    <img class="img-detalles" src={{ asset('assets/images/' . $chollo->id . '-chollo-severo.jpg') }} alt="imagen del chollo">

    <h2>Título</h2>
    <p>{{ $chollo-> titulo }}</p>

    <h2>Descripión</h2>
    <p>{{ $chollo->descripcion }}</p>

    <h2>Categoría</h2>
    <p>{{ $chollo->categoria }}</p>

    <h2>Precio anterior</h2>
    <p>{{ $chollo->precio }}</p>

    <h2>Precio actual</h2>
    <p>{{ $chollo->precio_descuento }}</p>

    <form action={{ route('chollos.megusta', $chollo -> id) }} method="POST">
        @method('PUT') {{-- Para editar --}}
        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        <button class="btn btn-success" type="submit">
          +
        </button>
    </form>

@endsection