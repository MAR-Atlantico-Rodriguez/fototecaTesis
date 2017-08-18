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

Route::get('/', 'HomeController@index');
//Route::get('/cv', 'FototecaController@categoriaVista');
Auth::routes();

Route::middleware('auth')->group(function(){	
	Route::get('/', 'FototecaController@index');

	//Categorias
	Route::get('/formCategoria', 'FototecaController@formCategoria');
	Route::get('/newCategoria', 'FototecaController@newCategoria');
	
	Route::get('/galeria/{idGaleria}', 'FototecaController@galeria')->where(['idGaleria' => '[0-9]+']);	

	Route::get('/categorias/lista/{categoriaID}','CategoriasController@lista');
	//Formulario de nueva Categoria
	Route::get('/categorias/formulario/{categoriaPadreID}','CategoriasController@formulario')
	->where(['categoriaPadreID' => '[0-9]+']);
	//Formulario de Editar Categoria
	Route::get('/categorias/formulario/{categoriaPadreID}/{idCategoria}','CategoriasController@formulario')->where(['idCategoria' => '[1-9]+']);

	Route::post('categorias/NuevaEditarCategoria','CategoriasController@NuevaEditarCategoria');
	Route::post('categorias/block','CategoriasController@block');
	

	

	//Imagenes
	Route::get('/newImage/{categoriaID}', 'FototecaController@newImage')
		      ->where(['categoriaID' => '[0-9]+']);
	Route::post('/subir_imagen_usuario', 'FototecaController@newImagenUP');
	Route::get('/verImagen/{idImagen}', 'FototecaController@verImagen')
			  ->where(['idImagen' => '[0-9]+']);
	
	Route::get('/descargarImagen/{idImagen}/{imgORec}/{posicion}/{imgagua}/{opacacidad}/{tam}','FototecaController@descargarImagen')
			  ->where(['idImagen' => '[0-9]+'])
			  ->where(['posicion' => '[0-9]+'])
			  ->where(['imgagua' => '[0-9]+'])
			  ->where(['opacacidad' => '[0-9]+'])
			  ->where(['tam' => '[0-9]+']);//Tamaño

	Route::delete('/destroy/{id}', 'FototecaController@destroy');
	Route::post('/search', 'FototecaController@search');

	Route::get('/imagen/edit/{id}', 'FototecaController@edit');
	Route::post('/imagen/edit', 'FototecaController@editSave');


	//RECORTE DE IMAGENES
	Route::get('/recortar/{id}', 'FototecaController@recortar');
	Route::post('/recorte', 'FototecaController@recorte');
	
	//USUARIO 
	Route::get('/listaUser','FototecaController@listaUser');

	Route::get('/modificarClave','FototecaController@modificarClaveUsuario');
	Route::post('/modificarClave','FototecaController@modificarClave');
	Route::get('/listaUser','FototecaController@listaUser');

	//TAGS
	Route::get('/tags/lista','TagsController@lista');
	Route::post('/tags/block','TagsController@block');
	Route::get('/tags/newTag','TagsController@newTagForm');
	Route::get('/tags/editTag/{id}','TagsController@editTagForm');

	Route::post('/tags/newTag','TagsController@editAndNewTag');

	//TagsFormulario foto nueva
	Route::get('/tags/busqueda','TagsController@busqueda');
	
	Route::post('/eliminarTag', 'TagsController@eliminarTag');
	
});

