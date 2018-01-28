<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Estadisticas extends Model {
    protected $table = "imagen_descargas";

    protected $fillable = ['id','id_imagen','id_imagen_recorte','id_users'];

    static function estadisticasDescargasProcedure(){
        return DB::select('CALL descargasRanking()');
    }

}
