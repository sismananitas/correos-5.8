<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Usuarios
Route::resource('usuarios', 'UserController');

// Roles
Route::resource('roles', 'RoleController');

// Casos
Route::resource('casos', 'TaskController');

// Grupos
Route::resource('grupos', 'GroupController');

// Correos
Route::get('/correos', 'EmailController@page')->name('correos.index');

// Reportes
Route::get('/reportes', 'ReportController@index')->name('reportes.index');

// Departamentales
Route::post('/correo/departamental', 'DepartamentController@storeEmail')->name('correo.departament.store');

// Otros
Route::post('/correo/otro', 'OtherController@storeEmail')->name('correo.other.store');