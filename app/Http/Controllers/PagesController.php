<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Chollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller {
    
    public function inicio() {
        //$chollos = Chollo::paginate(7);
        $chollos = Chollo::with('categorias')->paginate(7);
        //Mirar Eager loading, provocamos que la lectura se realice antes
        //Cuando tengamos que recuperar datos de las relaciones
        return view("inicio", compact('chollos'));
    }

    
    public function crear(Request $request) {
        //Validación de los datos
        $request -> validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'url' => 'required|url',
            'categorias' => 'required', //Array de categorías que recibimos
            'precio' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'precio_descuento' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'imagen' => 'required|mimes:jpeg'
        ]);


        $nuevoChollo = new Chollo();

        $nuevoChollo->titulo = $request->titulo;
        $nuevoChollo->descripcion = $request->descripcion;
        $nuevoChollo->url = $request->url;
        $nuevoChollo->precio = $request->precio;
        $nuevoChollo->precio_descuento = $request->precio_descuento;
        $nuevoChollo->usuario_id = Auth::id(); //Le asignamos la id del usuario que ha iniciado sesión
        $nuevoChollo->save(); //Hay que guardar antes para que se genere la id del chollo

        $nuevoChollo->attachCategorias($request->categorias); //Le pasamos el array de ids de categorías directamente

        $image_name = $nuevoChollo->id . "-chollo-severo.jpg";
        $path = base_path() . '/public/assets/images';
        $request->file('imagen')->move($path,$image_name);  
        
        return back()->with('mensaje', 'Chollo agregado correctamente');
    }
    

    public function actualizar(Request $request, $id) {

        //Validación de los datos
        $request -> validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'url' => 'required|url',
            'arrayCategorias' => 'required',
            'precio' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'precio_descuento' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'imagen' => 'mimes:jpeg'
          ]);

        $cholloActualizar = Chollo::findOrFail($id);
        $cholloActualizar->titulo = $request->titulo;
        $cholloActualizar->descripcion = $request->descripcion;
        $cholloActualizar->url = $request->url;
        
        //Eliminamos las categorías a las que pertenece ese chollo y le ponemos las nuevas
        $cholloActualizar->categorias()->detach(); //Con delete borraríamos también la categoría, no queremos eso

        //Al ponerle el array directamente añadimos todas las categorías (pasamos un array de ids)
        $cholloActualizar->attachCategorias($request->arrayCategorias);

        $cholloActualizar->precio = $request->precio;
        $cholloActualizar->precio_descuento = $request->precio_descuento;
        $cholloActualizar->save();


        //Si hemos adjuntado una imagen la editamos
        if($request->file('imagen')) {

            $image_name = $cholloActualizar->id . "-chollo-severo.jpg";
            $path = base_path() . '/public/assets/images';
            $request->file('imagen')->move($path,$image_name); 

        }
        return back()->with('mensaje', 'Chollo editado correctamente');
    }

    function verDetalles($id = 1){
        $chollo = Chollo::findOrFail($id);
        return view('chollos.detalles', compact('chollo'));
    }


    function destacado() {
        $chollos = Chollo::orderBy('puntuacion', 'desc')->take(4)->get();

        return view('destacados', compact('chollos'));
    }

    function novedades() {
        $chollos = Chollo::all()->sortByDesc('created_at')->take(4);
        return view('novedades', compact('chollos'));
    }

}
