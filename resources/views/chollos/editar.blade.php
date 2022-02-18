
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


{{-- 
    Hay un bucle antes que va recorriendo todas las categorías
    TODO: Poner un checkbox con name='categorias[]' para así poder recibir un array 
    @foreach ($chollo->categorias as $cat) {
        @if ($categoria -> id === $cat -> pivot -> categoria_id)
        checked -> esto es lo único que mete 
        @endif
    @endforeach
    }
    Con este código ponemos en checked las categorías que tenía la tabla
    
--}}

<h1>Edición de chollo</h1>
<form action={{ route('chollos.actualizar', $chollo -> id) }} enctype="multipart/form-data" method="POST">
    @method('PUT') {{-- Para editar --}}
    @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}

    <input type="text" name="titulo" placeholder="Título del chollo" class="form-control mb-2" value="{{$chollo->titulo}}" autofocus required>
    <textarea type="text" name="descripcion" placeholder="Descripción del chollo" class="form-control mb-2" required>{{$chollo->descripcion}}</textarea>
    
    <input type="url" name="url" placeholder="URL del chollo" class="form-control mb-2" value="{{$chollo->url}}" required>

   
    @foreach ($categorias as $categoria)

    <label class="form-check-label">
    <input 
        type="checkbox"  
        class="form-check-input" 
        name="arrayCategorias[]" 
        value={{$categoria->id}}

        @foreach ($chollo->categorias as $cat)
            @if ($categoria->id === $cat->pivot->categoria_id)
                checked
            @endif
        @endforeach

        >{{ $categoria->nombre }}</label>
    @endforeach

    <input type="text" name="precio" placeholder="Precio anterior" pattern="[0-9]+(\.[0-9][0-9]?)?" class="form-control mb-2" value="{{$chollo->precio}}" required>
    <input type="text" name="precio_descuento" pattern="[0-9]+(\.[0-9][0-9]?)?" placeholder="Nuevo precio" class="form-control mb-2" value="{{$chollo->precio_descuento}}" required>
    
    <label for="imagen">Imagen en formato JPEG (no subir ninguna para mantener la original)</label>
    <input type="file"  name="imagen">
    <button class="btn btn-primary btn-block" type="submit">
      Editar chollo
    </button>
</form>


@endsection