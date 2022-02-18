@extends('plantilla')

@section('titulo')
    CholloSevero - Añadir Chollo
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


<h2>Añadir chollo</h2>
<form action="{{ route('chollos.crear') }}" enctype="multipart/form-data" method="POST">
    @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}

    
    <input type="text" name="titulo" placeholder="Título del chollo" class="form-control mb-2" value="{{old('titulo')}}" autofocus required>
    
    <textarea type="text" name="descripcion" placeholder="Descripción del chollo" class="form-control mb-2" required>{{old('descripcion')}}</textarea>
    
    
    <input type="url" name="url" placeholder="URL del chollo" class="form-control mb-2" value="{{old('url')}}" required>
    
    @foreach ($categorias as $categoria)
        <label><input name="categorias[]" type="checkbox" value={{$categoria->id}}>{{ $categoria->nombre }}</label>
    @endforeach
    
    <input type="text" name="precio"  pattern="[0-9]+(\.[0-9][0-9]?)?" placeholder="Precio anterior" class="form-control mb-2" value="{{old('precio')}}" required>
    
    <input type="text" name="precio_descuento" pattern="[0-9]+(\.[0-9][0-9]?)?" placeholder="Nuevo precio" class="form-control mb-2" value="{{old('precio_descuento')}}" required>
    <label for="imagen">Imagen en formato JPEG</label>
    <input type="file"  name="imagen" required>
    <button class="btn btn-primary btn-block" type="submit">
      Añadir nuevo chollo
    </button>
</form>

@endsection