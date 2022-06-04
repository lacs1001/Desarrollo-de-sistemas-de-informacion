<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\ProductosController;

use App\Http\Controllers\v1\CategoriasController;

use App\Http\Controllers\v1\AutorizacionController;

use App\Http\Controllers\v1\UsersController;


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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/api1', function () {
    return "hola";
});

Route::get('/sunat/v1/empresas', function () {
    return "retorno de empresas";
});
*/



Route::get('/v1/productos',[ProductosController::class,'getAll']);
Route::get('/v1/productos/{id}',[ProductosController::class,'getItem']);

Route::get('/v1/categorias',[CategoriasController::class,'obtenerListado']);
 

Route::get('/v1/categorias/{id}',[CategoriasController::class,'obtenerElemento']);

Route::post('/v1/seguridad/login',[AutorizacionController::class,'login']);


Route::middleware('auth:api')->group(function () {

     Route::post('/v1/productos',[ProductosController::class,'store']);
    Route::put('/v1/productos',[ProductosController::class,'putUpdate']);
    Route::patch('/v1/productos',[ProductosController::class,'patchUpdate']);
    Route::delete('/v1/productos/{id}',[ProductosController::class,'delete']);



    Route::post('/v1/categorias',[CategoriasController::class,'guardar']);
    Route::put('/v1/categorias',[CategoriasController::class,'editarPut']);
    Route::patch('/v1/categorias',[CategoriasController::class,'editarPatch']);
    Route::delete('/v1/categorias/{id}',[CategoriasController::class,'eliminar']);

    Route::post('/v1/users',[UsersController::class,'save']);


});


