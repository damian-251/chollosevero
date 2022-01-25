<?php

namespace App\Http\Controllers;

use App\Models\Chollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller {
    
    public function inicio() {
        $chollos = Chollo::all();
        return view("inicio", compact('chollos'));
    }

    public function crearChollo() {
        return view('chollos/addChollo');
    }

    public function crear(Request $request) {
        //Validación de los datos
        $request -> validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'url' => 'required',
            'categoria' => 'required',
            'precio' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'precio_descuento' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'imagen' => 'required|mimes:jpeg'
        ]);

        $nuevoChollo = new Chollo();

        $nuevoChollo->titulo = $request->titulo;
        $nuevoChollo->descripcion = nl2br($request->descripcion);
        $nuevoChollo->url = $request->url;
        $nuevoChollo->categoria = $request->categoria;
        $nuevoChollo->precio = $request->precio;
        $nuevoChollo->precio_descuento = $request->precio_descuento;
          
        $nuevoChollo->save();

        $image_name = $nuevoChollo->id . "-chollo-severo.jpg";
            $path = base_path() . '/public/assets/images';
            $request->file('imagen')->move($path,$image_name);  

        return back()->with('mensaje', 'Chollo agregado correctamente');

    }

    function eliminar($id) {
        $cholloEliminar = Chollo::findOrFail($id);
        $cholloEliminar->delete();
        return back()->with('mensaje', 'Chollo eliminado correctamente');
    }

    public function editar($id) {
        $chollo = Chollo::findOrFail($id);
      
        return view('chollos.editar', compact('chollo'));
    }

    public function actualizar(Request $request, $id) {

        //Validación de los datos
        $request -> validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'url' => 'required',
            'categoria' => 'required',
            'precio' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'precio_descuento' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'imagen' => 'mimes:jpeg'
          ]);



        $cholloActualizar = Chollo::findOrFail($id);
        $cholloActualizar->titulo = $request->titulo;
        $cholloActualizar->descripcion = nl2br($request->descripcion);
        $cholloActualizar->url = $request->url;
        $cholloActualizar->categoria = $request->categoria;
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

    function verDetalles($id){
        $chollo = Chollo::findOrFail($id);
        return view('chollos.detalles', compact('chollo'));
    }

    function meGusta($id) {
        $cholloGustar = Chollo::findOrFail($id);
        $cholloGustar->puntuacion++;

        $cholloGustar->save();

        return back();
    }

    function noMeGusta($id) {
        $cholloNoMeGusta = Chollo::findOrFail($id);

        if($cholloNoMeGusta->puntuacion > 0) {
            
            $cholloNoMeGusta->puntuacion--;
            $cholloNoMeGusta->save();

        }

        return back();
    }

    function destacado() {
        $chollos = Chollo::all()->sortByDesc('puntuacion');

        return view('destacados', compact('chollos'));
    }

    function novedades() {
        $chollos = DB::table('chollos') ->orderByDesc('created_at')->limit(3)->get();

        return view('novedades', compact('chollos'));
    }

    

}
