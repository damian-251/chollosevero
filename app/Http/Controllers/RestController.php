<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestController extends Controller
{
    public function listarChollos(){
        $chollos = Http::get('http://localhost:8000/api/chollos')->collect();

        return view('inicio.rest', compact('chollos'));
    }
}
