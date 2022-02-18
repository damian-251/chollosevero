<?php

namespace App\Http\Controllers;

use App\Models\Chollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CholloApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $chollos = Chollo::all();
        return $chollos;
    }


    public function listarChollo($id = 1) {
        $chollo = Chollo::findOrFail($id);
        return $chollo;
    }

    public function cholloRandom(){
        $chollo = Chollo::inRandomOrder()->take(1)->get();
        return $chollo;
    }

    public function postChollo(Request $response) {
        $chollo = new Chollo();
        $chollo->titulo = $response->titulo;
        $chollo->descripcion = $response->descripcion;
        $chollo->url = $response->url;
        $chollo->precio = $response->precio_descuento;
        $chollo->precio_descuento = $response->precio_descuento;
        $chollo->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
