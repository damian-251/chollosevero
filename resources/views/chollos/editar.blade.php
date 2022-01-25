@extends('plantilla')

@section('titulo')
    Editar el chollo número {{$chollo->id}}
@endsection

@section('contenidoMain')
@if (session('mensaje'))
    <div class="chollo-editado alert alert-success" role="alert">
        {{ session('mensaje') }}
    </div>
@endif

@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<h1>Edición de chollo</h1>
<form action={{ route('chollos.actualizar', $chollo -> id) }} enctype="multipart/form-data" method="POST">
    @method('PUT') {{-- Para editar --}}
    @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}

    <input type="text" name="titulo" placeholder="Título del chollo" class="form-control mb-2" value="{{$chollo->titulo}}" autofocus required>
    <textarea type="text" name="descripcion" placeholder="Descripción del chollo" class="form-control mb-2" required>{{$chollo->descripcion}}</textarea>
    <input type="text" name="url" placeholder="URL del chollo" class="form-control mb-2" value="{{$chollo->url}}" required>
    <input type="text" name="categoria" placeholder="Categoría del chollo" class="form-control mb-2" value="{{$chollo->categoria}}" required>
    <input type="text" name="precio" placeholder="Precio anterior" class="form-control mb-2" value="{{$chollo->precio}}" required>
    <input type="text" name="precio_descuento" placeholder="Nuevo precio" class="form-control mb-2" value="{{$chollo->precio_descuento}}" required>
    <label for="imagen">Imagen en formato JPEG (no subir ninguna para mantener la original)</label>
    <input type="file"  name="imagen">
    <button class="btn btn-primary btn-block" type="submit">
      Editar chollo
    </button>
</form>



@endsection