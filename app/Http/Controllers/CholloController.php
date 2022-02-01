<?php

namespace App\Http\Controllers;

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
        return view('chollos/addChollo', compact('user'));
    }

    public function editar($id) {
        $chollo = Chollo::findOrFail($id);
        
        return view('chollos.editar', compact('chollo'));
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
        $cholloEliminar->delete();
        return back()->with('mensaje', 'Chollo eliminado correctamente');
    }
    //
}
