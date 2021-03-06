<?php

use App\Http\Controllers\CholloApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/chollos', [CholloApiController::class, 'index']); //api/chollos Obtenemos todos los chollos
Route::get('/chollo/{id?}', [CholloApiController::class, 'listarChollo']); //Json con un solo chollo
Route::get('/random', [CholloApiController::class, 'cholloRandom']); //Obtener un chollo aleatorio

//Enviar por post los datos y añadirlos a la base de datos
Route::post('/add-chollo', [CholloApiController::class, 'postChollo']);

