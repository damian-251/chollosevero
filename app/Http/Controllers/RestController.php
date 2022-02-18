<?php

namespace App\Http\Controllers;

use App\Models\Chollo;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class RestController extends Controller {

    public function listarChollos(){
        //$chollos = Http::get('http://127.0.0.1:8000/api/chollos')->collect(); //No funciona
        $chollos = Chollo::all(); //Así en entorno local
        return view('inicio', compact('chollos'));
    }

    public function inicioPokemon() {
        $respuesta = Http::get('https://pokeapi.co/api/v2/pokemon?offset=0&limit=251')->collect();
        return view('pokemon.inicio-pokemon', compact('respuesta'));
    }

    public function responsePost(Request $request){
        $response = Http::post('http://localhost:8000/api/chollo-severo', [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
         ]);
    }




}
