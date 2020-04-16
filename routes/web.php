<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inicio', 'peliculasController@verPeliculas')->middleware('esUsuario');
Route::get('/pelicula/detalle/{id?}', 'peliculasController@verPelicula')->middleware('esUsuario');
Route::get('/titulos', 'titulosController@verTitulos')->middleware('esUsuario');
Route::get('/titulos/busqueda/{busqueda?}', 'titulosController@buscarTitulos')->middleware('esUsuario');

Route::get('/ABM', 'ABMController@verPeliculas')->middleware('esUsuario')->middleware('esAdmin'); 
Route::post('/ABM', 'ABMController@eliminarPelicula')->middleware('esUsuario')->middleware('esAdmin'); ////
Route::get('/ABM/modificar/{id?}', 'ABMController@modificarPelicula')->middleware('esUsuario')->middleware('esAdmin');/////
Route::post('/ABM/modificar/{id}', 'ABMController@validarModificacion')->middleware('esUsuario')->middleware('esAdmin');
Route::get('/ABM/crear', 'ABMController@crearPelicula')->middleware('esUsuario')->middleware('esAdmin'); /////
Route::post('/ABM/crear', 'ABMController@validarCreacion')->middleware('esUsuario')->middleware('esAdmin');

