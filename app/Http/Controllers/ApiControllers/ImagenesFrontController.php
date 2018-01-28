<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imagen;

class ImagenesFrontController extends Controller {

    public function imagenes($id = 0){
    	$img = new Imagen();
    	$imagenes = $img->imagenes_API($id)->toArray();
    	return response()->json($imagenes);
    }

    public function verImagen($id){
    	$img = new Imagen();
        $imagen = $img->unaImagen($id)->where('repositorio','=',1);
        $imagen = ['titulo' => $imagen[0]->titulo, 
        		   'descripcion' => $imagen[0]->descripcion, 
        		   'categoria' => $imagen[0]->categoria, 
        		   'fechaCreacion' => $imagen[0]->created_at, 
        		   'url' => $imagen[0]->urlImg];
        $data = ["imagen" => $imagen, "tags" => Imagen::tags($id)];
    	return response()->json($data);
    }
}
