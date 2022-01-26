<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[PagesController::class, "inicio"]) ->name("inicio");
Route::get("chollos/addChollo",[PagesController::class, 'crearChollo']) ->name('chollos.creacion');
Route::post("chollos/addChollo", [PagesController::class, 'crear'])->name('chollos.crear');
Route::delete('eliminar/{id}', [PagesController::class, "eliminar"])->name('chollos.eliminar');

//Edición de chollo
Route::get('chollos/editar/{id}', [ PagesController::class, 'editar' ]) -> name('chollos.editar')->where('id', '[0-9]+');
Route::put('chollos/editar/{id}', [PagesController::class, 'actualizar']) -> name('chollos.actualizar');

//Ver detalles de chollos
Route::get('chollos/detalles/{id}', [PagesController::class, 'verDetalles'])->name('chollos.detalles')->where('id', '[0-9]+');

//Botón me gusta y no me gusta
Route::put('chollos/detalles/like/{id}', [PagesController::class, 'meGusta'])->name('chollos.megusta');
Route::put('chollos/detalles/dislike/{id}', [PagesController::class, 'noMeGusta'])->name('chollos.noMeGusta');

//Vista de chollos destacados
Route::get('destacados', [PagesController::class, 'destacado'])->name('destacado');

Route::get('novedades', [PagesController::class, 'novedades'])->name('novedades');