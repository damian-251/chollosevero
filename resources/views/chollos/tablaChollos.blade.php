<table border="1" class="table table-striped">
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
                <td>{{$chollo->puntuacion}}</td>
                <td>{{$chollo->titulo}}</td>
                <td>{{$chollo->categoria}}</td>
                <td>{{$chollo->precio}}€</td>
                <td>{{$chollo->precio_descuento}}€</td>
                <td>
                    <a href="{{ route('chollos.detalles', $chollo->id) }}" class="btn btn-primary">Ver detalles</a>
                    <form action={{ route('chollos.editar', $chollo -> id) }} method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                <a href="{{ route('chollos.editar', $chollo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>