<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Chollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Aquí estarán las funcionalidades de CholloSevero para las que se necesite
 * que el usuario esté con la sesión iniciada
 */
class CholloController extends Controller {

    public function __construct()     {
        $this->middleware('auth');
    }

    public function inicio()     {
        return view('inicio');
    }

    public function crearChollo() {
        $user = Auth::user();
        //Seleccionamos también las categorías para poder listarlas con checkbox
        $categorias = Categoria::all();
        return view('chollos/addChollo', compact('user', 'categorias'));
    }

    public function editar($id) {
        $chollo = Chollo::findOrFail($id);
        $categorias = Categoria::all();
        if (Auth::id() == $chollo->usuario_id ) {
            return view('chollos.editar', compact('chollo', 'categorias'));
        }
        return redirect('/');
    }

    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('inicio');
    }

    //Elimina un chollo
    function eliminar($id) {
        $cholloEliminar = Chollo::findOrFail($id);
        $cholloEliminar->categorias()->detach($cholloEliminar->categorias);
        $cholloEliminar->delete();
        return back()->with('mensaje', 'Chollo eliminado correctamente');
    }
    //

    //Lista los chollos del usuario
    function listarMisChollos() {
        $chollos = Chollo::where('usuario_id', Auth::id())->get(); //Chollos que tengan la id del usuario actual
        $usuario = Auth::user()->name;
        return view('chollos/mischollos', compact('chollos', 'usuario'));
    }


    //Usuario da me gusta a un chollo
    function meGusta($id) {
        $cholloGustar = Chollo::findOrFail($id);

        //Primero tenemos que comprobar si está en la tabla intermedia de chollos


        if ($cholloGustar->usuariosLike()->where('user_id', Auth::id())->first() != null) {
            //Si no está vacío quiere decir que el usuario ya ha votado algún chollo
            return back();
        }

        //Si no está en la tabla lo añadimos a la tabla intermedia y aumentamos la puntuación
        // DB::table('chollo_user')->insert(['user_id'=>Auth::id(), 'chollo_id'=> $id]);
        $cholloGustar->puntuacion++;
        $cholloGustar->save();

        //Añadimos mediante el método de eloqent a la tabla pivote
        $cholloGustar->usuariosLike()->attach(Auth::id());

        return back();
    }

    //Usuario da no me gusta a un Chollo
    function noMeGusta($id) {
        $cholloNo = Chollo::findOrFail($id);

        //Antes de empezar comprobamos que su puntuación no sea 0

        if ($cholloNo->puntuacion != 0) {

                //Primero tenemos que comprobar si está en la tabla intermedia de chollos
            if ($cholloNo->usuariosLike()->where('user_id', Auth::id())->first() != null) {
                //Si no está vacío quiere decir que el usuario ya ha votado algún chollo
                return back();
            } 

            // //Si no está en la tabla lo añadimos a la tabla intermedia y aumentamos la puntuación
            // DB::table('chollo_user')->insert(['user_id'=>Auth::id(), 'chollo_id'=> $id]);
            $cholloNo->puntuacion--;
            $cholloNo->save();

            //Añadimos a la table pivote mediante eloquent
            $cholloNo->usuariosLike()->attach(Auth::id());


        }
        
        return back();
    }
}


