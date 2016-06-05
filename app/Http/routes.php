<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('master', function () {
    return view('layaout.master');
});

Route::get('index', function () {
    return view('index');
});

Route::get('NuestroServicio', function () {
    return view('servicio');
});

Route::get('QuienesSomos', function () {
    return view('somos');
});

Route::get('contacta', function () {
    return view('contacta');
});

Route::get('contact',
    ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact',
    ['as' => 'contact_store', 'uses' => 'AboutController@store']);


   /* Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('/handleLogin', ['as' => 'handleLogin', 'uses' => 'AuthController@handleLogin']);
    Route::get('/inicio', ['middleware' => 'auth', 'as' => 'inicio', 'uses' => 'UsersController@inicio']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    Route::resource('users', 'UsersController', ['only' => ['create', 'store']]);*/


Route::get('auth/register', 'AuthController@getRegister');
Route::post('auth/register', 'AuthController@postRegister');

Route::get('auth/regAlumno', 'AuthController@getRegAlumno');
Route::post('auth/regAlumno', 'AuthController@postRegisterAlumno');

Route::get('auth/regPadre', 'AuthController@getRegPadre');
Route::post('auth/regPadre', 'AuthController@postRegisterPadre');

Route::get('auth/confirm/email/{email}/confirm_token/{confirm_token}', 'AuthController@confirmRegister');
Route::get('auth/confirmalu/email/{email}/confirm_token/{confirm_token}', 'AuthController@confirmRegAlumno');

Route::get('/', 'inicioController@inicio');
Route::get('/home', 'inicioController@inicio');
Route::get('/inicio', 'inicioController@inicio');

Route::get('auth/login', 'AuthController@getLogin');
Route::post('auth/login', 'AuthController@postLogin');
Route::get('auth/logout', 'AuthController@getLogout');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('user', 'UserController@user');

Route::get('user/panel', 'UserController@userPanel');

Route::get('users/datospersonales', 'datosPersonalesController@datospersonales');
Route::post('users/datospersonales', 'datosPersonalesController@postDatosPersonales');

Route::get('users/imgperfil', 'UserController@imgperfil');
Route::post('users/updateimgprofile', 'UserController@updateImgProfile');

Route::get('users/password', 'UserController@password');
Route::post('users/updatepassword', 'UserController@updatePassword');

Route::get('users/updatedatospersonales', 'datosPersonalesController@updatedatosper');
Route::post('users/updatedatospersonales', 'datosPersonalesController@updatedatospersonales');

Route::get('alumnos/alumnos', 'alumnosController@index');


Route::post('alumnos/tareas', 'tareaController@postTarea');
Route::post('alumnos/asigntareas', 'tareaController@asignTarea');
Route::post('alumnos/eliminartarea', 'tareaController@eliminarTarea');
Route::post('alumnos/editTarea', 'tareaController@editTarea');

Route::post('alumnos/asistencia', 'asistenciaController@postAsistencia');
Route::post('alumnos/eliminarasistencia', 'asistenciaController@eliminarAsistencia');
Route::post('alumnos/editAsistencia', 'asistenciaController@editAsistencia');

Route::post('alumnos/calificacion', 'calificacionController@postCalificacion');
Route::post('alumnos/eliminarcalificacion', 'calificacionController@eliminarCalificacion');
Route::post('alumnos/editCalificacion', 'calificacionController@editCalificacion');

Route::post('alumnos/excursion', 'excursionController@postExcursion');
Route::post('alumnos/eliminarexcursion', 'excursionController@eliminarExcursion');
Route::post('alumnos/asignexcur', 'excursionController@asignExcursion');
Route::post('alumnos/editexcursion', 'excursionController@editExcursion');