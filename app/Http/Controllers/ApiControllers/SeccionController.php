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

    public function imagenesCategoria($id = 0, $tamanioPagina = 0){
    	$img = new Imagen();
    	$imagenes = $img->imagenesCategoria_API($id, $tamanioPagina)->toArray();
    	return response()->json($imagenes);
    }
}
