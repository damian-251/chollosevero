@extends('plantilla')
@section('titulo')
    CholloSevero - Inicio
@endsection

@section('contenidoMain')
    <h2>Lista de chollos</h2>
    @include('chollos/tablaChollos')

    <h2>Añadir chollo</h2>
    <form action="{{ route('chollos.crear') }}" method="POST">
        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
    
        <input type="text" name="titulo" placeholder="Título del chollo" class="form-control mb-2" value="{{old('titulo')}}" autofocus required>
        <input type="text" name="descripcion" placeholder="Descripción del chollo" class="form-control mb-2" value="{{old('descripcion')}}" required>
        <input type="text" name="url" placeholder="URL del chollo" class="form-control mb-2" value="{{old('url')}}" required>
        <input type="text" name="categoria" placeholder="Categoría del chollo" class="form-control mb-2" value="{{old('categoria')}}" required>
        <input type="text" name="precio" placeholder="Precio anterior" class="form-control mb-2" value="{{old('precio')}}" required>
        <input type="text" name="precio_descuento" placeholder="Nuevo precio" class="form-control mb-2" value="{{old('precio_descuento')}}" required>
        <button class="btn btn-primary btn-block" type="submit">
          Añadir nuevo chollo
        </button>
    </form>
    @if (session('mensaje'))
    <div class="chollo-creado text-success">
        {{ session('mensaje') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection