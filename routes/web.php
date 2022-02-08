<?php

use App\Http\Controllers\CholloController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
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

//Página principal
Route::get("/",[PagesController::class, "inicio"]) ->name("inicio");

//Crear chollo, para la vista de crear chollos necesitamos inicar sesion
Route::get("chollos/add-chollo",[CholloController::class, 'crearChollo']) ->name('chollos.creacion');
Route::post("chollos/add-chollo", [PagesController::class, 'crear'])->name('chollos.crear');

//Eliminar chollo
Route::delete('eliminar/{id}', [CholloController::class, "eliminar"])->name('chollos.eliminar');

//Edición de chollo
Route::get('chollos/editar/{id}', [CholloController::class, 'editar' ]) -> name('chollos.editar')->where('id', '[0-9]+');
Route::put('chollos/editar/{id}', [PagesController::class, 'actualizar']) -> name('chollos.actualizar');

//Ver detalles de chollos
Route::get('chollos/detalles/{id?}', [PagesController::class, 'verDetalles'])->name('chollos.detalles')->where('id', '[0-9]+');

//Botón me gusta y no me gusta
Route::put('chollos/detalles/like/{id}', [CholloController::class, 'meGusta'])->name('chollos.megusta');
Route::put('chollos/detalles/dislike/{id}', [CholloController::class, 'noMeGusta'])->name('chollos.noMeGusta');

//Vista de chollos destacados
Route::get('destacados', [PagesController::class, 'destacado'])->name('destacado');

//Visita de las novedades
Route::get('novedades', [PagesController::class, 'novedades'])->name('novedades');

//Cerrar sesión
Route::post('logout', [CholloController::class, 'logout'])->name('logout');

Auth::routes();

//Aquí redirige tras cerrar sesión o iniciar, no recuerdo
Route::get('/home', [PagesController::class, 'inicio'])->name('home');

//Sección Mis Chollos
Route::get('chollos/mischollos', [CholloController::class, 'listarMisChollos'])->name('mis.chollos');