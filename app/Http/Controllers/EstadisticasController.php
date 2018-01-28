<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Estadisticas;

class EstadisticasController extends Controller {
	public function __construct(){
        $this->middleware('auth');
    }

    public function estadisticasDescargas() {
    	$datos = Estadisticas::estadisticasDescargasProcedure();
    	dd($datos);
    }
}
