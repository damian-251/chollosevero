<?php

namespace App\Http\Controllers;

use App\Models\Chollo;
use Faker\Generator as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Author;

class PagesController extends Controller {
    
    public function inicio() {
        $chollos = Chollo::paginate(7);

        return view("inicio", compact('chollos'));
    }

    

    public function crear(Request $request) {
        //Validación de los datos
        $request -> validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'url' => 'required|url',
            'categoria' => 'required',
            'precio' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'precio_descuento' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'imagen' => 'required|mimes:jpeg'
        ]);


        $nuevoChollo = new Chollo();

        $nuevoChollo->titulo = $request->titulo;
        $nuevoChollo->descripcion = $request->descripcion;
        $nuevoChollo->url = $request->url;
        //$nuevoChollo->categoria = $request->categoria;
        $nuevoChollo->precio = $request->precio;
        $nuevoChollo->precio_descuento = $request->precio_descuento;
        $nuevoChollo->usuario_id = Auth::id(); //Le asignamos la id del usuario que ha iniciado sesión
        
        $nuevoChollo->save();


        //Le asignamos la categoría al chollo 
        DB::table('categoria_chollo')->insert([
            'chollo_id' => $nuevoChollo->id,
            'categoria_id' => DB::table('categorias')->where('nombre', $request->categoria)->value('id'),
            'created_at' => date('Y-m-d H:i:s')
        ]);


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
            'categoria' => 'required',
            'precio' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'precio_descuento' => 'required|regex:/[0-9]+(\.[0-9][0-9]?)?/',
            'imagen' => 'mimes:jpeg'
          ]);

        $cholloActualizar = Chollo::findOrFail($id);
        $cholloActualizar->titulo = $request->titulo;
        $cholloActualizar->descripcion = $request->descripcion;
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

    function verDetalles($id = 1){
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
        //$chollos = DB::table('chollos')->orderByDesc('puntuacion')->limit(4)->get();
        $chollos = Chollo::orderBy('puntuacion', 'desc')->take(4)->get();

        return view('destacados', compact('chollos'));
    }

    function novedades() {
        //$chollos = DB::table('chollos') ->orderByDesc('created_at')->limit(4)->get(); //As
        $chollos = Chollo::all()->sortByDesc('created_at')->take(4);
        return view('novedades', compact('chollos'));
    }

}
