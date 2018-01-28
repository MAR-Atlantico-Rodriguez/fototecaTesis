<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imagen;
use App\Categoria;

class SeccionController extends Controller {
    

    public function categorias(){
    	$cat = new Categoria();
    	$categorias = $cat->categorias_API();
    	return response()->json($categorias);
    }

    public function unaCategoria($id = 0){
    	$img = new Imagen();
    	$imagenes = $img->imagenes_API($id)->toArray();
    	return response()->json($imagenes);
    }
}
