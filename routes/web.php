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

//Home
Route::get('/home', 'HomeController@index')->name('home');

//Usuarios
Route::get('listar-usuarios', 'UsuarioController@listarUsuarios')->name('listarUsuarios');
Route::get('registro-usuario', 'UsuarioController@registroUsuario')->name('registroUsuario');
Route::post('registro-usuario', 'UsuarioController@registroUsuarioPost')->name('registroUsuarioPost');
Route::get('editar-usuario/{usuarios_id}', 'UsuarioController@editarUsuario')->name('editarUsuario');
Route::put('actualizar-usuario/{usuarios_id}', 'UsuarioController@actualizarUsuario')->name('actualizarUsuario');
Route::delete('eliminar-usuario/{usuarios_id}', 'UsuarioController@eliminarUsuario')->name('eliminarUsuario');
