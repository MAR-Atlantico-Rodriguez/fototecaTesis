<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imagen;

class ImagenesFrontController extends Controller {

    public function imagenes(){
    	$imagenes = Imagen::all()->toArray();
    	return response()->json($imagenes);
    }
}
