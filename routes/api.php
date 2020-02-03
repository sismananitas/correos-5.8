<?php

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

Route::get('/emails', 'EmailController@index')->name('api.emails.index');
Route::get('/emails/{email}', 'EmailController@show');

Route::get('/students', 'StudentController@index');
Route::post('/students/emails', 'StudentController@storeEmail')->name('app.students.emails.store');

Route::get('/employees', 'EmployeeController@index');
Route::post('/employees/emails', 'EmployeeController@storeEmail')->name('app.employees.emails.store');

Route::post('/reportes/trabajadores', 'ReportController@trabajadores');
Route::post('/reportes/alumnos', 'ReportController@alumnos');
Route::post('/reportes/correos', 'ReportController@emails');