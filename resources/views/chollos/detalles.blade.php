@extends('plantilla')

@section('titulo')
    Detalles del chollo
@endsection

@section('contenidoMain')
    <h1>Detalles del chollo {{ $chollo->id }}</h1>

    <div class="contenido-chollo">
    <div class="imagen-chollo-like>">
    <img class="img-detalles" src={{ asset('assets/images/' . $chollo->id . '-chollo-severo.jpg') }} alt="imagen del chollo">
    <div class="like-dislike">
        <form action={{ route('chollos.megusta', $chollo -> id) }} method="POST">
            @method('PUT') {{-- Para editar --}}
            @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
            <button class="btn btn-success" type="submit">
              +
            </button>
        </form>
    
        <form action={{ route('chollos.noMeGusta', $chollo -> id) }} method="POST">
            @method('PUT') {{-- Para editar --}}
            @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
            <button type="submit" class="btn btn-danger"> - </button>
        </form>
    </div>
    </div>
    <div class="datos-chollo">

    <h2>Puntuación</h2>
    <p>{{ $chollo->puntuacion }}</p>

    <h2>Título</h2>
    <p>{{ $chollo->titulo }}</p>

    <h2>Descripión</h2>
    <p><?=$descrip = nl2br($chollo->descripcion);?></p>
   
    <h2>Categoría</h2>
    <p> 
        @foreach ($chollo->categorias as $categoria)
            {{ $categoria->nombre }} <br>
        @endforeach
    </p>

    <h2>Precio anterior</h2>
    <p class="p-anterior">{{ $chollo->precio }}€</p>

    <h2>Precio actual</h2>
    <p class="p-descuento">{{ $chollo->precio_descuento }}€</p>

    <a href={{ $chollo->url }} target="_blank" class="btn btn-primary btn-lg boton-chollo"> Ir al chollo </a>
    
    </div>
    </div>

@endsection