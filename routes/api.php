<?php

use Illuminate\Http\Request;

Route::post('auth/login', 'ApiControllers\UserController@login');

Route::get('imagenes', 'ApiControllers\ImagenesFrontController@imagenes');
Route::get('verImagen/{id}', 'ApiControllers\ImagenesFrontController@verImagen');

Route::get('secciones', 'ApiControllers\SeccionController@categorias');
Route::get('seccion/{id}/{tamanioPagina}', 'ApiControllers\SeccionController@imagenesCategoria');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
});