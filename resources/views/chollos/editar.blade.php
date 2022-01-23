@extends('plantilla')

@section('titulo')
    Editar el chollo número {{$chollo->id}}
@endsection

@section('contenidoMain')
<h1>Edición de chollo</h1>
<form action={{ route('chollos.actualizar', $chollo -> id) }} method="POST">
    @method('PUT') {{-- Para editar --}}
    @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}

    <input type="text" name="titulo" placeholder="Título del chollo" class="form-control mb-2" value="{{$chollo->titulo}}" autofocus required>
    <input type="text" name="descripcion" placeholder="Descripción del chollo" class="form-control mb-2" value="{{$chollo->descripcion}}" required>
    <input type="text" name="url" placeholder="URL del chollo" class="form-control mb-2" value="{{$chollo->url}}" required>
    <input type="text" name="categoria" placeholder="Categoría del chollo" class="form-control mb-2" value="{{$chollo->categoria}}" required>
    <input type="text" name="precio" placeholder="Precio anterior" class="form-control mb-2" value="{{$chollo->precio}}" required>
    <input type="text" name="precio_descuento" placeholder="Nuevo precio" class="form-control mb-2" value="{{$chollo->precio_descuento}}" required>
    <button class="btn btn-primary btn-block" type="submit">
      Editar chollo
    </button>
</form>

@if (session('mensaje'))
    <div class="chollo-editado text-success">
        {{ session('mensaje') }}
    </div>
@endif

@endsection