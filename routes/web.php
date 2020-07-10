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

// API
Route::prefix('api')->group(function () {
    Route::get('/emails', 'EmailController@index')->name('api.emails.index');
    Route::post('/emails', 'EmailController@store');
    Route::get('/emails/{email}', 'EmailController@show');
    Route::put('/emails/{email}', 'EmailController@update');
    Route::delete('/emails/{email}', 'EmailController@destroy');

    Route::get('/students', 'StudentController@index');
    Route::post('/students/emails', 'StudentController@storeEmail')->name('app.students.emails.store');

    Route::get('/employees', 'EmployeeController@index');
    Route::post('/employees/emails', 'EmployeeController@storeEmail')->name('app.employees.emails.store');

    Route::post('/reportes/trabajadores', 'ReportController@trabajadores');
    Route::post('/reportes/alumnos', 'ReportController@alumnos');
    Route::post('/reportes/correos', 'ReportController@emails');

    Route::post('/reportes/make-report', 'ReportController@makeReport');
});