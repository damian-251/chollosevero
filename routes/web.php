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
Route::post("/", [PagesController::class, "crear"])->name("chollos.crear");
Route::delete('eliminar/{id}', [PagesController::class, "eliminar"])->name('chollos.eliminar');

Route::get('chollos/editar/{id}', [ PagesController::class, 'editar' ]) -> name('chollos.editar');
Route::put('chollos/editar/{id}', [PagesController::class, 'actualizar']) -> name('chollos.actualizar');

Route::get('chollos/detalles/{id}', [PagesController::class, 'verDetalles'])->name('chollos.detalles');

Route::put('chollos/detalles/{id}', [PagesController::class, 'meGusta'])->name('chollos.megusta');

Route::get('destacados', [PagesController::class, 'destacado'])->name('destacado');

Route::get('novedades', [PagesController::class, 'novedades'])->name('novedades');