<?php

use Illuminate\Http\Request;

Route::post('auth/login', 'ApiControllers\UserController@login');

Route::post('imagenes', 'UserController@register');
Route::post('buscarImagen', 'UserController@register');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
});