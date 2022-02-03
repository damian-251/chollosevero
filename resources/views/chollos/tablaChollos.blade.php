<table border="1" class="table table-striped tabla-chollos">
    <thead>
        <tr>
        <th>Imagen</th>
        <th>Fecha de adición</th>
        <th>Puntuación</th>
        <th>Título</th>
        <th>Categoría</th>
        <th>Precio Anterior</th>
        <th>Precio actual</th>
        <th>Acción</th>  
        </tr>
    </thead>
    <tbody>
        @foreach ($chollos as $chollo)
            <tr>
                <td> <img src={{ asset('assets/images/' . $chollo->id . '-chollo-severo.jpg') }} alt="imagen chollo" > </td>
                <td> {{ date('d/m/Y H:i', strtotime($chollo->created_at)) }}</td>
                <td class="text-center">{{$chollo->puntuacion}}
                    <div class="like-dislike">
                        <form action={{ route('chollos.megusta', $chollo -> id) }} method="POST">
                            @method('PUT') {{-- Para editar --}}
                            @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                            <button class="btn btn-success" type="submit"> + </button>
                        </form>
                    
                        <form action={{ route('chollos.noMeGusta', $chollo -> id) }} method="POST">
                            @method('PUT') {{-- Para editar --}}
                            @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                            <button type="submit" class="btn btn-danger"> - </button>
                        </form>
                    </div>
                    </td>
                <td>{{$chollo->titulo}}</td>
                <td>
                    @foreach ($chollo->categorias as $categoria)
                    {{ $categoria->nombre }} <br>
                    @endforeach   
                </td> 
                <td class="p-anterior">{{$chollo->precio}}€</td>
                <td class="p-descuento">{{$chollo->precio_descuento}}€</td>
                <td>
                    <a href="{{ route('chollos.detalles', $chollo->id) }}" class="btn btn-primary btn-sm boton">Ver detalles</a>
                    @if (Auth::check() && auth()->user()->id == $chollo->usuario_id) {{-- Si coinciden mostramos el botón editar --}}
                    <form action={{ route('chollos.eliminar', $chollo -> id) }} method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm boton" type="submit">Eliminar</button>
                    </form>
                    <a href="{{ route('chollos.editar', $chollo->id) }}" class="btn btn-warning btn-sm boton">Editar</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>