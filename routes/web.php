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
Route::resource('correos', 'EmailController');

// Estudiantes
Route::get('/alumnos/todos', 'StudentController@getAllStudents');
Route::post('/correo/alumnos', 'StudentController@storeEmail')->name('correo.student.store');
Route::resource('alumnos', 'StudentController');

// Empleados
Route::get('/empleados/todos', 'EmployeeController@getAllEmployes')->name('employees.all');
Route::post('/correo/trabajadores', 'EmployeeController@storeEmail')->name('correo.employee.store');
Route::resource('empleados', 'EmployeeController');

Route::get('/reportes', 'ReportController@index')->name('reportes.index');

// Departamentales
Route::post('/correo/departamental', 'DepartamentController@storeEmail')->name('correo.departament.store');

// Otros
Route::post('/correo/otro', 'OtherController@storeEmail')->name('correo.other.store');

// API
Route::prefix('api')->group(function () {
    Route::get('/emails', 'ApiEmailController@index')->name('api.emails.index');
    Route::get('/emails/{email}', 'ApiEmailController@show');

    Route::get('/students', 'ApiStudentController@index');
    Route::post('/students/emails', 'ApiStudentControlle@storeEmail')->name('app.students.emails.store');

    Route::get('/employees', 'ApiEmployeeController@index');
    Route::post('/employees/emails', 'ApiEmployeeControlle@storeEmail')->name('app.employees.emails.store');

    Route::post('/reportes/trabajadores', 'ReportController@trabajadores');
    Route::post('/reportes/alumnos', 'ReportController@alumnos');
});